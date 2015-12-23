(function($){

	$('html').addClass('js');

	//add classes to form inputs based on their type
	for(var i = 0, len = document.getElementsByTagName('input').length; i<len; i++){
		document.getElementsByTagName('input')[i].className += ' ' + document.getElementsByTagName('input')[i].type;
	}

	//open links in new window (target=_blank); checks if the url is external
	var hostname = window.location.hostname,
	links = document.getElementsByTagName('a'),
	pattern = /^https?:\/\/(www.)?/i;

	for(var i=0, len = links.length; i<len; i++) {
	  if(pattern.test(links[i].href) && links[i].href.toLowerCase().indexOf(hostname) == -1){
	    links[i].target = "_blank";
	    links[i].className += ' external';
	  }
	}

	//clear form fields on focus
	$('textarea, input:text').bind('focus click', function(){
		if (this.value == this.defaultValue) {
		this.value = '';
		}
	}).bind('blur', function(){
		if (this.value == '') {
		this.value = this.defaultValue;
		}
	});

	//--------------------------------------- utils ------------------------------------------------//

	//equal height columns function
	function equalHeight(group) {
		var tallest = 0;
		group.each(function() {
			var thisHeight = $(this).height();
			if(thisHeight > tallest) {
				tallest = thisHeight;
			}
		});
		group.height(tallest);
	}
	//equalHeight($("//here put the selector"));

	//---------------------------------- other scripts ---------------------------------------------//

	// homepage
	var page_h = $(window).height();
	
	var header_h = $('#header').height();
	$('#slideshow-container').height( page_h - header_h );

	$(window).resize(function(){
		var page_h = $(window).height();
		var header_h = $('#header').height();
		$('#slideshow-container').height( page_h - header_h );
	});

	//homepage slides
	$(document).ready(function () {
		//$('#slideshow-container .slide').find('.slide-overlay h3').css({opacity: 0});
		
		var slider = $('#slideshow').bxSlider({
			slideSelector: 'div.slide',
			mode: 'fade',
			auto: true,
			infiniteLoop: true,
	        stopAuto: false,
	        startSlide: 0,
			autoDelay: 50,
			preloadImages: 'all',
			pause: 5000,
			controls: true,
			pager: true,
			onSlideAfter: function($slideElement, oldIndex, newIndex){
				$($slideElement).siblings('.slide').find('.slide-overlay h3').css({opacity: 0});
				$($slideElement).siblings('.slide').find('.slide-overlay h4').css({opacity: 0});
				setTimeout(function(){
					$($slideElement).find('.slide-overlay h3').animate({opacity: 1}, 1000);
					$($slideElement).find('.slide-overlay h4').animate({opacity: 1}, 1000);
				}, 500);
			}
		});
		
		$('#slideshow-mobile').bxSlider({
			slideSelector: 'div.slide',
			mode: 'fade',
			auto: true,
			infiniteLoop: true,
	        stopAuto: false,
	        startSlide: 0,
			autoDelay: 500,
			preloadImages: 'all',
			pause: 5000,
			controls: true,
			pager: true,
			onSlideAfter: function($slideElement, oldIndex, newIndex){
				$($slideElement).siblings('.slide').find('.slide-overlay h3').css({opacity: 0});
				setTimeout(function(){
					$($slideElement).find('.slide-overlay h3').animate({opacity: 1}, 1000);
				}, 2000);
			}
		});
	     
	    $(document).on('click','.bx-pager-link',function() {
	        slider.stopAuto();
	        slider.startAuto();
	    });
	});

	// mobile nav
	$('#main-navigation').clone().insertAfter('.mobile-navigation > a.logo-ucla-mobile').removeAttr('id');

	$('#toggle-menu').bind('click touch', function(){
	    if( $('div.mobile-navigation').hasClass('open') ){
	        $('div.mobile-navigation').animate({width: "0px"}, 300).removeClass('open');
	        $('#container, .not-frontpage #header').animate({left: "0px"}, 300);
	    } else {
	        $('div.mobile-navigation').animate({width: "300px"}, 300).addClass('open');
	        $('#container, .not-frontpage #header').animate({left: "300px"}, 300);
	    }
	});

	// tabs
	$('div.content-tabs .tab-bar .tab-title:first-child').addClass('active');

	$('div.content-tabs div.tab-content').hide();
	$('div.content-tabs div.tab-content:nth-child(2)').show();

	$('div.content-tabs .tab-bar .tab-title').bind('click touch',function() {
		$(this).addClass('active').siblings().removeClass('active');
		$(this).parent('.tab-bar').siblings('div.tab-content').hide();
		$('div.tab-content').eq($('.tab-bar .tab-title').index(this)).fadeIn(500);

		preventDefault();
	});

	// gallery slider
	var gallery_slider = $('.gallery > ul').bxSlider({
		mode: 'fade',
		controls: true,
		pagerCustom: '#gallery-bx-pager',
		adaptiveHeight: true,
		touchEnabled: false
	});

	// full width gallery slider
	$('.full-width-gallery > ul').bxSlider({
		mode: 'fade',
		controls: true,
		pager: true,
		adaptiveHeight: true,
		touchEnabled: false
	});

	// toogle floorplan
/*	$('.attraction .attraction-heading').bind('click touch', function(){
		$(this).toggleClass('expanded');
		$(this).next('.attraction-content').slideToggle('fast');
		
		//floorplans
		$('#attraction').bxSlider({
			slideSelector: 'div.attraction',
				mode: 'fade',
				auto: false,
				infiniteLoop: true,
				preloadImages: 'all',
				adaptiveHeight: true,
				controls: true,
				pager: false,
				touchEnabled: false
		});
	}); */
	// toggle attractions
	$('.attraction-content').hide();
	$('.attraction-content-trigger').bind('click touch', function(){
		$(this).toggleClass('expanded');
		$(this).next('.attraction-content-div-toggle').slideToggle('fast');
	});
	
	// toogle room type
	$('.room-types-mobile .room-type-div-toggle').hide();
	$('.room-types-mobile .room-type-div-toggle-trigger').bind('click touch', function(){
	//	$(this).toggleClass('expanded');
		$(this).next('.room-type-div-toggle').slideToggle('fast');
	});
	
	//fake select dropdown
	$(document).ready(function() {
		$('#gallery-filters').after('<span>' + $('option:selected', this).text() + '</span>');
		
		$('#gallery-filters').click(function(event) {
			$(this).siblings('span').remove();
			$(this).after('<span>' + $('option:selected', this).text() + '</span>');
		});
	});
	
	//explore UCLA gallery slider mobile nav
	$('#mobile-gallery-nav > .mobile-gallery-nav-select').bind('click touch', function(){
		$(this).next('ul').slideToggle('fast');
	});
	
	var current_slide_name = $('.gallery ul > li:first-child > .overlay > h4').text();
	$('#mobile-gallery-nav > .mobile-gallery-nav-select').text(current_slide_name);
	
	$('#mobile-gallery-nav > ul > li').each(function(index) {
		$(this).bind('click touch', function(){
			var current_slide_name = $(this).text();
			$('#mobile-gallery-nav > .mobile-gallery-nav-select').text(current_slide_name);
			$(this).siblings().removeClass('current');
			$(this).addClass('current');
			$(this).parent('ul').slideUp('fast', function(){
				gallery_slider.goToSlide(index);
			});
			
		});
	});
	
	//gallery controls position hack on tablet
	$(window).load(function(){
		var page_w = $(window).width();
		var img_h = $('.gallery li > img').height();
		//console.log(img_h);
		if(page_w <= 768){
			$('.gallery .bx-prev, .gallery .bx-next').css('top', (img_h/2));
		} else {
			$('.gallery .bx-prev, .gallery .bx-next').removeAttr('style');
		}
	});
	
	$(window).resize(function(){
		var page_w = $(window).width();
		var img_h = $('.gallery li > img').height();
		//console.log(img_h);
		if(page_w <= 768){
			$('.gallery .bx-prev, .gallery .bx-next').css('top', (img_h/2));
		} else {
			$('.gallery .bx-prev, .gallery .bx-next').removeAttr('style');
		}
	});
	
	//separator images slider
	window.onload = function(){
		$( '.separator-images > .slider' ).lemmonSlider({
			'infinite' : true
		});
	}
	
	//masonry gallery
	$('#gallery-container .item > a').fancybox({
		padding: 3,
		margin: 0
	});



})(jQuery);
