// 
$(document).on('click', '#toggle-password', function(event){
    var passwordField = document.getElementById('pwd');
    var icon = this;

    // Toggle the type between password and text
    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});

// side menu work
$('.menu_toggle').click(function(){
   $('.side_bar').css('left', '0');
});
$('.menu_close').click(function(){
   $('.side_bar').css('left', '-100%');
});

// notification
$('.notification').click(function(){
   $('.notify_table').css('right', '30px');
});
$('.notify_close').click(function(){
   $('.notify_table').css('right', '-100%');
});


// refer code code copy
$(document).on('click', '.copy_code', function () {
    // Get the refer code text
    var referCode = $('#refer_code').text();

    // Create a temporary input element to copy the text
    var tempInput = $('<input>');
    $('body').append(tempInput);
    tempInput.val(referCode).select();
    document.execCommand('copy');
    tempInput.remove();

    // Find the "Copied" message and show it
    var copiedMessage = $(this).siblings('.copied_message');
    copiedMessage.stop(true, true).fadeIn(200).delay(1000).fadeOut(200); // Show and hide the message
});

var menu = $('.navbar').offset().top;
$(window).scroll(function () {
  var scroll = $(this).scrollTop();

  if (scroll > menu) {
    $('.navbar').addClass('menu_fix');
  } else {
    $('.navbar').removeClass('menu_fix');
  }
});


$('.category').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: false,
  arrows:false,
  dots:false,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2,
      }
    },
  ]
});














