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
