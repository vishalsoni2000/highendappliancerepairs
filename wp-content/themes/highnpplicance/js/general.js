$headerHeight = '';
$headerHeight = '';
$headerHeightscroll = '';

jQuery(document).ready(function($) {

     if ($('.run-slider').length > 0) {

        if ($('.home__single--slide').length > 1) {
            /* HomeSlider */
            /** slick slider on initialized event */
            $('.home-slider').on('init', function(event, slick) {
                $('.slick-current ').find('.home__single--slide-content').addClass(' show ');
            });

            /** slick slider on initialized event */
            $('.home-slider').slick({
                arrows: true,
                nextArrow: '<span class="slick-next"> &#10095; </span>',
                prevArrow: '<span class="slick-prev"> &#10094; </span>',
                dots: true,
                autoplay: true,
                adaptiveHeight: true,
                autoplaySpeed: 3000,
            });

            /** slick slider on before change event */
            jQuery('.home-slider').on('beforeChange', function(slick, slide, current) {
                $('.slick-slide ').find('.home__single--slide-content').removeClass(' show ');
                $('.slick-slide ').find('.home__single--slide-content').addClass(' hide ');
            });

            /** slick slider on after change event */
            jQuery('.home-slider').on('afterChange', function(slick, slide, current) {
                $('.slick-current ').find('.home__single--slide-content').addClass(' show ');
            });
        } else {
            setTimeout(function() {
                $('.home-slider').find('.home__single--slide-content').addClass(' show ');
            }, 1000);
        }
    } else {
        if ($('.home-slider').find('.home__single--slide-content').hasClass('mobile-show')) {
            setTimeout(function() {
                $('.home-slider').find('.home__single--slide-content').addClass(' show ');
            }, 1000);
        }
    }

        $(".navbar-toggle").click(function() {
            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $('.mobile_menu').animate({
                    'right': '-100%'
                }, 500);
            } else {
                $(this).addClass("active");
                $('.mobile_menu').animate({
                    'right': '0'
                }, 500);
            }
        });
        $(".mobile_menu ul li").find("ul").parents("li").prepend("<span></span>");
        $(".mobile_menu ul li ul").addClass("first-sub");
        $(".mobile_menu ul li ul").prev().prev("span").addClass("first-em");
        $(".mobile_menu ul li ul ul").removeClass("first-sub");
        $(".mobile_menu ul li ul ul").addClass("second-sub");
        $(".mobile_menu ul li ul ul").prev().prev("span").addClass("second-em");
        $(".mobile_menu ul li ul ul").prev().prev("span").removeClass("first-em");
        $(".mobile_menu ul li span.first-em").click(function(e) {
            $(".mobile_menu ul li span.first-em").removeClass('active');
            $(".mobile_menu ul li span.second-em").removeClass('active');
            if ($(this).parent("li").hasClass("active")) {
                $(this).parent("li").removeClass("active");
                $(this).next().next("ul.first-sub").slideUp();
                $(".mobile_menu ul li ul.second-sub li").removeClass("active");
                $(".mobile_menu ul li ul.second-sub").slideUp();
            } else {
                $(this).addClass('active');
                $(".mobile_menu ul li").removeClass("active");
                $(this).parent("li").addClass("active");
                $(".mobile_menu ul li ul.first-sub").slideUp();
                $(this).next().next("ul.first-sub").slideDown();
                $(".mobile_menu ul li ul.second-sub li").removeClass("active");
                $(".mobile_menu ul li ul.second-sub").slideUp();
            }
        });
        $(".mobile_menu ul li ul.first-sub li span.second-em").click(function(e) {
            $(".mobile_menu ul li span.second-em").removeClass('active');
            if ($(this).parent("li").hasClass("active")) {
                $(this).parent("li").removeClass("active");
                $(this).next().next("ul.second-sub").slideUp();
            } else {
                $(this).addClass('active');
                $(".mobile_menu ul li ul li").removeClass("active");
                $(this).parent("li").addClass("active");
                $(".mobile_menu ul li ul.second-sub").slideUp();
                $(this).next().next("ul.second-sub").slideDown();
            }
        });
        $(".close-btn").click(function() {
            $('.mobile_menu').animate({
                'right': '-100%'
            }, 500);
            $(" .navbar-toggle").removeClass("active");
        });


    $(document).on('click', '.quick-not-closer', function() {
        cookieName = $(this).parent('.quick-notes').attr('attr-quick-note-name');
        console.log( cookieName );
        $.cookie( cookieName , 1 , { expires : 1 });
        $('.quick-notes').slideUp(500);
        setTimeout(function() {
            $headerHeight = jQuery('header').outerHeight();
            jQuery('#wrapper').css('padding-top', $headerHeight);
        }, 500);
    });


    // our brands
		var brands_length = $(".our-brands-section ul > li").length;
		if(brands_length > 4) {
	    jQuery('.our-brands-section ul').slick({
	        infinite: true,
	        slidesToShow: 7,
	        slidesToScroll: 1,
					dots: false,
					autoplay: true,
					autoplaySpeed: 2500,
	        arrows: true,
					adaptiveHeight: true,
	        responsive:[
							{
									breakpoint: 1024,
									settings: {
											slidesToShow: 4,
											slidesToScroll: 1,
                      arrows: false,
  										dots: true,
									}
							},
	            {
	                breakpoint: 767,
	                settings: {
	                    slidesToShow: 2,
	                    slidesToScroll: 1,
                      arrows: false,
  										dots: true,
	                }
	            }
	        ]
	    });
		}

    // testimonial-slider
		$('.testimonials-section .slider-wrapper').slick({
				infinite: true,
				slidesToShow: 3,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 2500,
        dots: false,
				arrows: true,
        nextArrow: '<span class="slick-next"> &#10095; </span>',
        prevArrow: '<span class="slick-prev"> &#10094; </span>',
				responsive:[
            {
  							breakpoint: 1200,
  							settings: {
  									dots: true,
                    arrows: false,
  							}
  					},
						{
								breakpoint: 992,
								settings: {
										slidesToShow: 2,
										slidesToScroll: 1,
										adaptiveHeight: true,
                    arrows: false,
										dots: true,
								}
						},
						{
								breakpoint: 640,
								settings: {
										slidesToShow: 1,
										slidesToScroll: 1,
										adaptiveHeight: true,
                    arrows: false,
										dots: true,
								}
						}
				]
    });

    AOS.init();
});
jQuery(window).on('load resize ready', function($) {

    setTimeout(function(){
        $headerHeight = jQuery('header').outerHeight();
        jQuery('#wrapper').css('padding-top', $headerHeight);
    },500);
    if( jQuery(window).scrollTop() > 50 ){
        setTimeout(function(){
            stickyHeader();
        },500);
    }


});
jQuery(window).scroll(function(event) {
    stickyHeader();
});

function stickyHeader() {
    var sticky = jQuery('header'),
        scroll = jQuery(window).scrollTop();

    if (scroll >= 50) {
        sticky.addClass('sticky');
        $headerHeightscroll = jQuery('header.sticky').outerHeight();
    } else sticky.removeClass('sticky');
}
/* function for Lazyload and set image to background in InternetExplorer 11 Only */
var userAgent, ieReg, ie;
userAgent = window.navigator.userAgent;
ieReg = /msie|Trident.*rv[ :]*11\./gi;
ie = ieReg.test(userAgent);
if (ie) {
    jQuery(".innbaner").each(function() {
        var $container = jQuery(this),
            imgUrl = $container.find("img").prop("src");
        if (imgUrl) {
            $container.css({
                "background-image": 'url(' + imgUrl + ')',
                "background-size": "cover",
                "background-position": "center center"
            }).addClass("custom-object-fit");
            jQuery(".innbaner img").css("display", "none");
        }
    });
}
