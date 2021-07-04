"use strict";

import 'owl.carousel/dist/owl.carousel';

$('#products-carousel').owlCarousel({
    items: 2,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 5000,
    loop: true,
    dots: false,
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 1
        },
        1200: {
            items: 2
        }
    }
});
