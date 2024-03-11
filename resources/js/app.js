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

