import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

var swiper = new Swiper(".swiper-container", {
    autoplay: {
        delay: 3000, // 5 seconds delay between slides
    },
    pagination: {
        el: ".swiper-pagination",
    },
});

$(document).ready(function () {
    $("#searchForm").submit(function (e) {
        e.preventDefault(); // Prevent default form submission
        let searchQuery = $("#searchQuery").val();

        // Make AJAX request
        $.ajax({
            url: '{{ route("searchByTitle") }}',
            type: "GET",
            data: { search_query: searchQuery },
            success: function (response) {
                $("#eventList").html(response); // Update the content of the event list
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            },
        });
    });
});

// document.addEventListener('DOMContentLoaded', function () {
//     const searchButton = document.getElementById('searchButton');
//     const categoryId = document.getElementById('categoryId').value;

//     searchButton.addEventListener('click', function () {
//         const formData = new FormData();
//         formData.append('category_id', categoryId);

//         fetch('{{ route('searchByCategory') }}', {
//             method: 'POST',
//             headers: {
//                 'X-CSRF-TOKEN': '{{ csrf_token() }}',
//                 'Content-Type': 'application/json',
//                 'Accept': 'application/json',
//             },
//             body: JSON.stringify({ category_id: categoryId })
//         })
//         .then(response => response.json())
//         .then(data => {
//             // Update the DOM with the received data
//             // For example, update the events list
//             console.log(data);
//         })
//         .catch(error => {
//             console.error('Error:', error);
//         });
//     });
// });
$(document).ready(function () {
    const searchForm = $("#searchForm");
    const searchInput = $("#search-dropdown");
    const categoryDropdown = $("#category-dropdown");
    const eventGrid = $("#eventGrid");
    const searchResultsContainer = $("#searchResults");
    const searchUrl = searchForm.data("url");

    function performSearch() {
        const name = searchInput.val().trim();
        const category = categoryDropdown.val();

        $.ajax({
            url: searchUrl,
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { name: name, category: category },
            dataType: "json",
            success: function (data) {
                eventGrid.hide();
                searchResultsContainer.html("");

                if (data.length > 0) {
                    data.forEach((event) => {
                        const resultHtml = `
                            <div id="eventList" class="bg-white rounded-lg overflow-hidden shadow-md">
                                <img src="storage/${event.event_img}" alt="${
                            event.title
                        }" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h2 class="text-xl font-semibold">${
                                        event.title
                                    }</h2>
                                    <div class="mt-2">
                                        <p class="text-gray-600 font-semibold">Categories:</p>
                                        ${
                                            event.categories.length > 0
                                                ? event.categories
                                                      .map(
                                                          (category) => `
                                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                                                    ${category.name}
                                                </span>
                                            `
                                                      )
                                                      .join("")
                                                : '<span class="text-gray-600">No categories</span>'
                                        }
                                    </div>
                                    <div class="mt-4 flex justify-between items-center">
                                        <a href="${searchUrl}/event/${
                            event.id
                        }" class="px-4 py-2 bg-blue-500 text-white rounded-md">View Details</a>
                                    </div>
                                </div>
                            </div>
                        `;

                        searchResultsContainer.append(resultHtml);
                    });
                } else {
                    searchResultsContainer.html("<p>No results found</p>");
                }
            },
            error: function (error) {
                console.error("Error fetching search results:", error);
            },
        });
    }

    searchInput.on("input", performSearch);
    categoryDropdown.on("change", performSearch);

    searchForm.on("submit", function (event) {
        event.preventDefault();
    });
});
