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
