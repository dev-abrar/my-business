$(document).ready(function () {
    // Typed.js
    $(".typed").typed({
        strings: ["Earn Money Online", "Earn money With Jubair"],
        // Optionally use an HTML element to grab strings from (must wrap each string in a <p>)
        stringsElement: null,
        // typing speed
        typeSpeed: 100,
        // time before typing starts
        startDelay: 600,
        // backspacing speed
        backSpeed: 20,
        // time before backspacing
        backDelay: 800,
        // loop
        loop: true,
        // false = infinite
        loopCount: 5,
        // show cursor
        showCursor: true,
        // character for cursor
        cursorChar: "|",
        // attribute to type (null == text)
        attr: null,
        // either html or text
        contentType: 'html',
        // call when done callback function
        callback: function () {},
        // starting callback function before each string
        preStringTyped: function () {},
        // callback for every typed string
        onStringTyped: function () {},
        // callback for reset
        resetCallback: function () {}
    });

});

var swiper = new Swiper(".mySwiper", {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
});
var swiper2 = new Swiper(".mySwiper2", {
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: swiper,
    },
});


document.getElementById('paymentMethod').addEventListener('change', function () {
    // Hide all payment info sections
    document.querySelectorAll('.payment-info').forEach(function (info) {
        info.classList.add('d-none');
    });

    // Show the selected payment info section
    const selectedMethod = this.value;
    if (selectedMethod) {
        const infoElement = document.getElementById(`${selectedMethod}Info`);
        if (infoElement) {
            infoElement.classList.remove('d-none');
        }
    }
});