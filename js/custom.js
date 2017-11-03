jQuery(document).ready( function() {
	jQuery('#searchicon').click(function() {
		jQuery('#jumbosearch').fadeIn();
		jQuery('#jumbosearch input').focus();
	});
	jQuery('#jumbosearch .closeicon').click(function() {
		jQuery('#jumbosearch').fadeOut();
	});
	jQuery('body').keydown(function(e){
	    
	    if(e.keyCode == 27){
	        jQuery('#jumbosearch').fadeOut();
	    }
	});
		
	jQuery('#site-navigation ul.menu').slicknav({
		label: 'Menu',
		duration: 1000,
		prependTo:'#slickmenu'
	});	
	
	jQuery('.flex-images').flexImages({rowHeight: 200, object: '.item', truncate: true});
	
});
 
    

// Swiper Slider Coverflow		
jQuery(function(){
  var myCoverflow = jQuery('.swiper-container').swiper({
    pagination: '.swiper-pagination',
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    slideToClickedSlide: true,
    paginationClickable: true,
    loop: true,
    coverflow: {
	        rotate: 50,
	        stretch: 0,
	        depth: 100,
	        modifier: 1,
	        slideShadows : true
	    }
    });
    
    //myCoverflow.slideTo(3, 0, false);
    
});

jQuery(function(){
  var myCoverflow = jQuery('.swiper-container-posts').swiper({
    pagination: '.swiper-pagination',
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    slideToClickedSlide: true,
    paginationClickable: true,
    loop: true,
    coverflow: {
	        rotate: 50,
	        stretch: 0,
	        depth: 100,
	        modifier: 1,
	        slideShadows : true
	    }
    });
    
    //myCoverflow.slideTo(3, 0, false);
    
});

//Featured Products - CUbe
jQuery(function(){
  var mySwiper = jQuery('.fp-container').swiper({
        pagination: '.swiper-pagination',
        effect: 'cube',
        grabCursor: true,
        paginationClickable: true,
        loop: true,
        pagination: false,
        nextButton: '.sbnc',
        prevButton: '.sbpc',
        cube: {
            shadow: false,
            slideShadows: true,
            shadowOffset: 12,
            shadowScale: 0.64
        }
        });
    });

jQuery(function(){
  var mySwiper = jQuery('.fposts-container').swiper({
        pagination: '.swiper-pagination',
        effect: 'cube',
        grabCursor: true,
        paginationClickable: true,
        loop: true,
        pagination: false,
        nextButton: '.sbncp',
        prevButton: '.sbpcp',
        cube: {
            shadow: false,
            slideShadows: true,
            shadowOffset: 12,
            shadowScale: 0.64
        }
        });
    });
    
//Carousel
jQuery(function(){
  var mySwiper = jQuery('.carousel-container').swiper({
        effect: 'slide',
        grabCursor: true,
        paginationClickable: true,
        loop: true,
        pagination: false,
        nextButton: '.sbncp_c',
        prevButton: '.sbpcp_c',
        autoplay: 4000,
        autoplayDisableOnInteraction: false,
        slidesPerView: 4,
        spaceBetween: 30,
        breakpoints: {
	    // when window width is <= 320px
	    480: {
	      slidesPerView: 1,
	      spaceBetweenSlides: 20
	    },
	    767: {
	      slidesPerView: 2,
	      spaceBetweenSlides: 20
	    },
	    // when window width is <= 640px
	    991: {
	      slidesPerView: 3,
	      spaceBetweenSlides: 30
	    }
	  	}
        });
    });    

//SLIDER
jQuery(function(){
  var mySlider = jQuery('.slider-container').swiper({
        pagination: '.swiper-pagination',
        paginationClickable: '.swiper-pagination',
        nextButton: '.slidernext',
        prevButton: '.sliderprev',
        spaceBetween: 30,
        autoplayDisableOnInteraction: false,
        autoplay: parseInt(slider_object.autoplay),
        speed: parseInt(slider_object.speed),
        effect: slider_object.effect
    });		
});		
	