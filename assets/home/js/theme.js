/*
 ===========================================================
 Table of Contents
 -----------------------------------------------------------
 ---------------------------------------------
 ** Js Index
 ---------------------------------------------
// Preloader
// Bootstrap Essentials
// Smooth Scrolling Effect
// Adjust Header Menu On Scroll Down
// On click hide collapse menu
// Hero Section Slider
// Testimonial Carousel Slider
// Counter Js
// Team slider Section Slider
//scrollReveal js Init
// Ajax Contact Form 
 ===========================================================
 ===========================================================
 */


// Js Index
(function($) {
    "use strict";

    // Preloader
    $(window).on('load', function() {
        $('.preloader-wrap').fadeOut('slow', function() { $(this).remove(); });
    });

    // Bootstrap Essentials
    $(".embed-responsive iframe").addClass("embed-responsive-item");
    $(".carousel-inner .item:first-child").addClass("active");
    $('[data-toggle="tooltip"]').tooltip();

    // Smooth Scrolling Effect
    $('.smoothscroll').on('click', function(e) {
        e.preventDefault();
        var target = this.hash;

        $('html, body').stop().animate({
            'scrollTop': $(target).offset().top - 50
        }, 1200);
    });

    // Adjust Header Menu On Scroll Down
    $(window).scroll(function() {
        var wScroll = $(this).scrollTop();

        if (wScroll > 0) {
            $('.navbar-default').addClass('sticky');
        } else {
            $('.navbar-default').removeClass('sticky');
        }

    });

    // On click hide collapse menu
    $(".navbar-nav li a").on('click', function(event) {
        $(".navbar-collapse").removeClass("collapse in").addClass("collapse").removeClass('open');
        $(".navbar-toggle").removeClass('open');

    });
    $(".dropdown-toggle").on('click', function(event) {
        $(".navbar-collapse").addClass("collapse in").removeClass("collapse");
        $(".navbar-toggle").addClass('open');
    });
    $('.navbar-toggle').on('click', function() {
        $(this).toggleClass('open');
    });

    // Hero Section Slider
    function hero_slider_carousel() {
        var owl = $("#hero-slider-screen");
        owl.owlCarousel({
            loop: true,
            margin: 10,
            smartSpeed: 2000,
            responsiveClass: true,
            navigation: true,
            items: 1,
            addClassActive: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            responsive: {}
        });
    }
    hero_slider_carousel();


    // Video hero Section
    scaleVideoContainer();

    initBannerVideoSize('.video-container .poster img');
    initBannerVideoSize('.video-container .filter');
    initBannerVideoSize('.video-container video');

    $(window).on('resize', function() {
        scaleVideoContainer();
        scaleBannerVideoSize('.video-container .poster img');
        scaleBannerVideoSize('.video-container .filter');
        scaleBannerVideoSize('.video-container video');
    });
    // Testimonial Carousel Slider
    function testimonial_carousel() {
        var owl = $("#testimonial-slider");
        owl.owlCarousel({
            loop: true,
            margin: 0,
            centar: true,
            smartSpeed: 2000,
            responsiveClass: true,
            navigation: false,
            items: 1,
            addClassActive: true,
            dots: true,
            autoplay: false,
            autoplayTimeout: 5000,
            responsive: {}
        });
    }
    testimonial_carousel();


    // Counter Js
    $('.counter').counterUp({
        delay: 10,
        time: 2000
    });

    // Team slider Section Slider
    function team_carousel() {
        var owl = $("#team-slider");
        owl.owlCarousel({
            loop: true,
            margin: 10,
            smartSpeed: 2000,
            responsiveClass: true,
            navigation: false,
            nav: false,
            items: 3,
            addClassActive: true,
            dots: false,
            autoplay: false,
            autoplayTimeout: 7000,
            responsive: {
                0: {
                    items: 1
                },
                760: {
                    items: 2

                },
                1100: {
                    items: 3
                }
            }
        });
    }
    team_carousel();


    //scrollReveal js Init
    window.sr = ScrollReveal({ duration: 800 });
    sr.reveal('.foo');

    // Ajax Contact Form  

    $('.cf-msg').hide();
    $('form#cf button#submit').on('click', function() {
        var fname = $('#fname').val();
        var email = $('#email').val();
        var subject = $('#subject').val();
        var msg = $('#msg').val();

        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!regex.test(email)) {
            alert('Please enter valid email');
            return false;
        }

        fname = $.trim(fname);
        email = $.trim(email);
        subject = $.trim(subject);
        msg = $.trim(msg);

        if (fname != '' && email != '' && subject != '' && msg != '') {
            var values = "fname=" + fname + "&email=" + email + "&subject=" + subject + "&msg=" + msg;
            $.ajax({
                type: "POST",
                url: "sendMail.php",
                data: values,
                success: function() {
                    $('#fname').val('');
                    $('#email').val('');
                    $('#subject').val('');
                    $('#msg').val('');

                    $('.cf-msg').fadeIn().css('background-color', 'rgba(98, 181, 87, 0.7)').html('<p>Email has been sent successfully.</p>');
                    setTimeout(function() {
                        $('.cf-msg').fadeOut('slow');
                    }, 2000);

                }
            });
        } else {
            $('.cf-msg').fadeIn().css('background-color', 'rgba(181,62,75,0.7)').html('<p>Please fillup the informations correctly.</p>')
        }


        return false;
    });
    // Video Hero Wrap Essentials
    function scaleVideoContainer() {
        var height = $(window).height() + 5;
        var unitHeight = parseInt(height, 10) + 'px';
        $('.homepage-hero-module').css('height', unitHeight);
    }

    function initBannerVideoSize(element) {
        $(element).each(function() {
            $(this).data('height', $(this).height());
            $(this).data('width', $(this).width());
        });
        scaleBannerVideoSize(element);
    }

    function scaleBannerVideoSize(element) {
        var windowWidth = $(window).width(),
            windowHeight = $(window).height() + 5,
            videoWidth,
            videoHeight;
        $(element).each(function() {
            var videoAspectRatio = $(this).data('height') / $(this).data('width');
            $(this).width(windowWidth);
            if (windowWidth < 1200) {
                videoHeight = windowHeight;
                videoWidth = videoHeight / videoAspectRatio;
                $(this).css({
                    'margin-top': 0,
                    'margin-left': -(videoWidth - windowWidth) / 2 + 'px'
                });
                $(this).width(videoWidth).height(videoHeight);
            }
            $('.hero-area .video-container video').addClass('fadeIn animated');
        });
    }


// All Js

}(jQuery));
