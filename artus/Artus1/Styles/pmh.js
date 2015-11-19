
/*-------------------popup init-------------------*/
function InitPopup(popup){
	popup = $(popup);
	var cls = popup.attr('data-popup');
	$('.custom-popup.'+cls).fadeIn('300');
	$('.custom-popup.'+cls).prev('.custom-overlay').fadeIn('300');	

		
}
/*-------------------end popup init-------------------*/


function AlignPopup(){
	$('.custom-popup').each(function(){
		if($(this).outerWidth() > $(window).width() && $(this).outerHeight()+80 > $(window).height()) {
			$(this).css({
				"position": "absolute",
				"top": $(window).scrollTop() + 50 + "px",
				'left': '10px'
			});
		}
		
		else if($(this).outerHeight()+80 > $(window).height()) {
			$(this).css({
				"position": "absolute",
				"top": $(window).scrollTop() + 50 + "px",
				'left': ($(window).width()-$(this).outerWidth())/ 2 + 'px'
			});
		}
		
		else if($(this).outerWidth() > $(window).width()) {
			$(this).css({
				"position": "absolute",
				"top": $(window).scrollTop() + 50 + "px",
				'left': '10px'
			});
		}
		
		else {
			$(this).css('top',($(window).height()-$(this).outerHeight())/ 2 + 'px');
			$(this).css('left',($(window).width()-$(this).outerWidth())/ 2 + 'px');
			$(this).css('position', 'fixed');	
		}
	});
}




$( window ).resize(function() {
	AlignPopup();			
});	


$(document).ready(function(){

	AlignPopup();

	var flag=true;
	var startSlide;	
		
/*-----------------------------POPUP-------------------------*/
    $('[data-popup]').on('click', function(e){
        e.preventDefault();
		AlignPopup();
		InitPopup($(this));
		
		
		/*images gallery carousel*/
		startSlide = parseInt($(this).attr('data-current'));

		if (flag){
		$('#carousel').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: true,
			slideshow: false,
			itemWidth: 123,
			itemMargin: 11,
			asNavFor: '#slider',
			prevText: "", 
			mousewheel: true, 
			startAt: startSlide,
			nextText: ""
		  });

		  $('#slider').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			sync: "#carousel",
			startAt: startSlide,
			prevText: "",     
			nextText: "",
			smoothHeight:true,

		    start: function(slider) {
				
				  var height = $('#slider .flex-active-slide img').height();
				  height = height-29;
				  var quantity_html = '<div class="popup_gallery_quantity"><span class="js_popup_gallery_current">' + (slider.currentSlide + 1) + '</span>/' + slider.slides.length + '</div>';
				  slider.append(quantity_html);
				  flexslider = slider;
				  AlignPopup();
				  
			  },
			  
			  after: function(slider) {
			  	
				$('.js_popup_gallery_current').html(slider.currentSlide + 1);
				
			  }
		  });
		   flag = false;
		  /*images gallery carousel*/
		  
		 
		 
		 
		 
		
		 
		
		}else{
			
//			flexslider.flexAnimate(startSlide);
	   }
	   
	    /*Sertificates*/
		if($(this).attr = 'js_sert_popup'){
			$('#sert_resourse').html($(this).parents('.js_sert_parent').find('.sertificates_slider_big').clone());

			$('#sert_resourse #sert_slider').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			startAt: startSlide,
			prevText: "",     
			nextText: "",
			smoothHeight:true,

		    start: function(slider) {
				  var height = $('#sert_resourse #sert_slider .flex-active-slide img').height();
				  height = height-29;
				  var quantity_html = '<div class="popup_gallery_quantity"><span class="js_popup_gallery_current">' + (slider.currentSlide + 1) + '</span>/' + slider.slides.length + '</div>';
				  slider.append(quantity_html);
				  flexslider = slider;  
				  AlignPopup();
			  },
			  
			  after: function(slider) {
			  	
				$('.js_popup_gallery_current').html(slider.currentSlide + 1);
				
			  }
		  });
			
			
		}
		/*Sertificates*/  

   });


    $('.custom-overlay, .custom-popup .close, .js_close_popup').on('click',function(e){
		e.preventDefault();	
		$('.custom-overlay').delay(200).fadeOut('300');																		  
		$('.custom-popup').fadeOut('300');		

    });
/*-----------------------END POPUP----------------------------*/
						   




	

	

	
	
	

	
	






/*---------------------small sertificates hover and width-----------------*/
	$(window).load(function() {
	 	$('.sert .image_block').each(function() {
			var width = $(this).find('img').width();
			$(this).css('width', width+'px');
		});
		
		$('.sert .image_block .sert_hidden_text .text').each(function() {
			var height = $(this).parent().parent().find('img').height();
			var width = $(this).parent().parent().find('img').width();
			
			$(this).css('height', height+'px');
			$(this).css('width', width+'px');
		});
		
	 
	 
	 
	 
		
	});
	
	
	$('.sert .image_block').mouseover(function(){
		$(this).addClass('active');									   
	});
	
	$('.sert .image_block').mouseout(function(){
		$(this).removeClass('active');									   
	});

/*--------------------end small sertificates hover and width----------------------*/
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 	
	 
	//main menu hover
	var imh;
	$('.headmenu__item__spoilerMenu').css('display',"block").fadeOut(1);
	
	$('.headmenu__item').hover(function(){
		$(this).find('.headmenu__item__spoilerMenu').stop( true, true ).delay(1000).fadeIn(300);
	}, function(){
		$(this).find('.headmenu__item__spoilerMenu').stop( true, true ).fadeOut(300);
	});

	if(navigator.userAgent.match(/Android/i) ||
		navigator.userAgent.match(/webOS/i)||
		navigator.userAgent.match(/iPhone/i) ||
		navigator.userAgent.match(/iPod/i) ||
		navigator.userAgent.match(/iPad/i) ||
		navigator.userAgent.match(/Blackberry/i) )
    {
		$('.headmenu__item__spoilerMenu').addClass('disabled');	
    }
	
		     
	//
	// INDEX PAGE
	//
			$('.indexHead_v2__backgroundsItems:eq(0)').addClass('active');
			$('.indexHead_v2__content_headerItem:eq(0)').addClass('active');
			$('.indexHead_v2__slideCaption_item').css({'left':"-20px", "opacity":0,"display":"block"});
				$('.indexHead_v2__slideCaption_item:eq(0)').css({'left':0, "opacity":1}).addClass('active');
			$('.indexHead_v2__slideLinkButton a').css({'left':"-20px", "opacity":0,"display":"block", "z-index":0});
			
			
			
				$('.indexHead_v2__slideLinkButton a:eq(0)').css({'left':0, "opacity":1}).addClass('active');	
			$('.indexHead_v2__slideINfografics_item').css({'left':"-20px", "opacity":0,"display":"block"});
				$('.indexHead_v2__slideINfografics_item:eq(0)').css({'left':0, "opacity":1}).addClass('active');
			
			function iHv2_changer(toSlide){
				
				// background change
				$('.indexHead_v2__backgroundsItems.active').fadeOut(800);
				$('.indexHead_v2__backgroundsItems:eq('+ toSlide +')').fadeIn(800, function(){
					$('.indexHead_v2__backgroundsItems.active').removeClass('active');
					$(this).addClass('active');
				});				
				
				// left column caption change
				$('.indexHead_v2__content_headerItem.active').fadeOut(300);
				$('.indexHead_v2__content_headerItem:eq('+ toSlide +')').delay(300).fadeIn(500, function(){
					$('.indexHead_v2__content_headerItem.active').removeClass('active');
					$(this).addClass('active');
				});	
				
				// left column desription change
				$('.indexHead_v2__content_descriptonWrapper').delay(1000).animate({top: -1*$('.indexHead_v2__content_descriptonItem').height()*toSlide},600);
				
				// left column files change
				$('.indexHead_v2__content_filesWrapper').delay(1000).animate({top: -1*$('.indexHead_v2__content_filesWrapperItem').height()*toSlide},600);
				
				// left column news change
				$('.indexHead_v2__content_newsWrapper').delay(1000).animate({top: -1*$('.indexHead_v2__content_newsWrapperItem').height()*toSlide},600);
				
				
				// maininfo caption change
				$('.indexHead_v2__slideCaption_item.active').animate({opacity:0},function(){ $(this).css({'left':"-20px"}) });
				$('.indexHead_v2__slideCaption_item:eq('+ toSlide +')').delay(700).animate({left:0, opacity: 1},600, function(){
					$('.indexHead_v2__slideCaption_item.active').removeClass('active');
					$(this).addClass('active');
				});	

				// maininfo link change
				$('.indexHead_v2__slideLinkButton a.active').animate({opacity:0},function(){ $(this).css({'left':"-20px", "z-index":100}) });
				$('.indexHead_v2__slideLinkButton a:eq('+ toSlide +')').delay(1100).animate({left:0, opacity: 1},600, function(){
					$('.indexHead_v2__slideLinkButton a.active').removeClass('active');
					$(this).addClass('active');
				});	

				// maininfo infografics change
				$('.indexHead_v2__slideINfografics_item.active').animate({opacity:0},function(){ $(this).css({'left':"-20px"}) });
				$('.indexHead_v2__slideINfografics_item:eq('+ toSlide +')').delay(1100).animate({left:0, opacity: 1},600, function(){
					$('.indexHead_v2__slideINfografics_item.active').removeClass('active');
					$(this).addClass('active');
				});					
				
			};
			
			//main slider v2
				$( "#indexHead_v2__selector" ).on( "selectmenuselect", function( event, ui ) {
					iHv2_changer ($(this).val());
				});
			//END main slider v2
			  
	       
	 		
			  
			// слайдер Продукция, главная страница
			var rotation=0;
			var swiper_indexProductionID = new Swiper('#pmhGalery__indexProductionID', {
				paginationClickable: true,
				slidesPerView: 'auto',
				onSlideChangeEnd: function(swiper){
					checkProductsButtons(swiper_indexProductionID.activeIndex)
				},
				onSlideChangeStart: function(swiper){
					if (swiper.activeIndex > swiper.previousIndex)
						$('#kolo').css("transform","rotate("+ (rotation += 90)  +"deg)").css("transition-duration","500ms");
					else	
						$('#kolo').css("transform","rotate("+  (rotation -= 90)  +"deg)").css("transition-duration","500ms");				
				}				
			})
			$('#pmhGalery__indexProductionID_NAvi .slider_navi_next').click(function(){
				swiper_indexProductionID.swipeNext();
				checkProductsButtons(swiper_indexProductionID.activeIndex);
				return false;
			});
			$('#pmhGalery__indexProductionID_NAvi .slider_navi_prew').click(function(){
				swiper_indexProductionID.swipePrev();
				checkProductsButtons(swiper_indexProductionID.activeIndex);
				return false;
			});
			
			function checkProductsButtons(actIndex)
			{
				$('#pmhGalery__indexProductionID_NAvi .slider_navi_next').removeClass("swiper-button-disabled");
				$('#pmhGalery__indexProductionID_NAvi .slider_navi_prew').removeClass("swiper-button-disabled");
				if(	$('#pmhGalery__indexProductionID .swiper-slide:eq(' + (swiper_indexProductionID.slides.length-1) + ')').hasClass('swiper-slide-visible'))
					$('#pmhGalery__indexProductionID_NAvi .slider_navi_next').addClass("swiper-button-disabled");
				if(actIndex <= 0)
					$('#pmhGalery__indexProductionID_NAvi .slider_navi_prew').addClass("swiper-button-disabled");
			}
			// END слайдер Продукция, главная страница
			
			// слайдер ФОТО, история страница в табах
			var swiper_tabsFoto = new Swiper('#tabsGalery__FOTO .swiper-container', {
				paginationClickable: true,
				slidesPerView: 3,
				onSlideChangeEnd: function(swiper){
					check_tabsFotoButtons(swiper_tabsFoto.activeIndex)
				},
				
			})
			$('#tabsGalery__FOTO .tabsGalery__manage_next').click(function(){
				swiper_tabsFoto.swipeNext();
				check_tabsFotoButtons(swiper_tabsFoto.activeIndex);
				return false;
			});
			$('#tabsGalery__FOTO .tabsGalery__manage_prew').click(function(){
				swiper_tabsFoto.swipePrev();
				check_tabsFotoButtons(swiper_tabsFoto.activeIndex);
				return false;
			});
			
			function check_tabsFotoButtons(actIndex)
			{
				$('#tabsGalery__FOTO .tabsGalery__manage_next').removeClass("swiper-button-disabled");
				$('#tabsGalery__FOTO .tabsGalery__manage_prew').removeClass("swiper-button-disabled");
				if(	$('#tabsGalery__FOTO .swiper-slide:eq(' + (swiper_tabsFoto.slides.length-1) + ')').hasClass('swiper-slide-visible'))
					$('#tabsGalery__FOTO .tabsGalery__manage_next').addClass("swiper-button-disabled");
				if(actIndex <= 0)
					$('#tabsGalery__FOTO .tabsGalery__manage_prew').addClass("swiper-button-disabled");
			}
			// END слайдер ФОТО, история страница в табах
			
			
			
			// слайдер СОБЫТИЯ, история страница в табах
			var swiper_tabsENevt = new Swiper('#tabsGalery__EVENTS .swiper-container', {
				paginationClickable: true,
				slidesPerView: 3,
				spaceBetween: 100,
				onSlideChangeEnd: function(swiper){
					check_tabsEventsButtons(swiper_tabsENevt.activeIndex)
				},
				
			})
			$('#tabsGalery__EVENTS .tabsGalery__manage_next').click(function(){
				swiper_tabsENevt.swipeNext();
				check_tabsEventsButtons(swiper_tabsENevt.activeIndex);
				return false;
			});
			$('#tabsGalery__EVENTS .tabsGalery__manage_prew').click(function(){
				swiper_tabsENevt.swipePrev();
				check_tabsEventsButtons(swiper_tabsENevt.activeIndex);
				return false;
			});
			
			function check_tabsEventsButtons(actIndex)
			{
				$('#tabsGalery__EVENTS .tabsGalery__manage_next').removeClass("swiper-button-disabled");
				$('#tabsGalery__EVENTS .tabsGalery__manage_prew').removeClass("swiper-button-disabled");
				if(	$('#tabsGalery__EVENTS .swiper-slide:eq(' + (swiper_tabsENevt.slides.length-1) + ')').hasClass('swiper-slide-visible'))
					$('#tabsGalery__EVENTS .tabsGalery__manage_next').addClass("swiper-button-disabled");
				if(actIndex <= 0)
					$('#tabsGalery__EVENTS .tabsGalery__manage_prew').addClass("swiper-button-disabled");
			}
			// END слайдер СОБЫТИЯ, история страница в табах
			
			
			
			//слайдер ФОТО, левая колонка
			var pmhGalery__leftFotoID = new Swiper('#pmhGalery__leftFotoID', {
				paginationClickable: true,
				slidesPerView: 1,
				loop: true,
				keyboardControl: true
			});
			$('#pmhGalery__leftFotoID_navi .slider_navi_next').click(function(){
				pmhGalery__leftFotoID.swipeNext();
				return false;
			});
			$('#pmhGalery__leftFotoID_navi .slider_navi_prew').click(function(){
				pmhGalery__leftFotoID.swipePrev();
				return false;
			});
		// END слайдер ФОТО, левая колонка
	  
		// слайдер ВИДЕО, левая колонка
			var pmhGalery__leftVideoID = new Swiper('#pmhGalery__leftVideoID', {
				paginationClickable: true,
				slidesPerView: 1,
				loop: true,
				keyboardControl: true
			});
			$('#pmhGalery__leftVideoID_navi .slider_navi_next').click(function(){
				pmhGalery__leftVideoID.swipeNext();
				return false;
			});
			$('#pmhGalery__leftVideoID_navi .slider_navi_prew').click(function(){
				pmhGalery__leftVideoID.swipePrev();
				return false;
			});
		// END слайдер ВИДЕО, левая колонка
		 
		
		
		 


		//Слайдер показателей "икнока-цифры-текст" на странице акционеров
		var aLIndex = 0;

		// скрываем старые данные 
		function indicatorsChange_remover(){
			tileLength = 0;
			tileDelay = 0;
			while (tileLength < $('.investors_inducators__slide.active .over_info_cell').length)
				{
					$('.investors_inducators__slide.active .over_info_cell:eq('+tileLength+')').delay(tileDelay).animate({left:'30%', opacity: 0}, function(){$(this).css('left','-30px')});
					tileLength++;
					tileDelay+=200;
					if(tileLength== $('.investors_inducators__slide.active .over_info_cell').length)
						{
							$('.investors_inducators__slide.active').removeClass('active')
							indicatorsChange_opener();
						}
				}
		};

		//открываем новые данные
		function indicatorsChange_opener(){
				tileLength = 0;
				tileDelay = 0;
				while (tileLength < $('.investors_inducators__slide:eq('+(aLIndex)+') .over_info_cell').length)
					{
						$('.investors_inducators__slide:eq('+(aLIndex)+') .over_info_cell:eq('+tileLength+')').delay(tileDelay).animate({left:'0', opacity: 1});
						tileLength++;
						tileDelay+=200;
						if(tileLength == $('.investors_inducators__slide:eq('+(aLIndex)+') .over_info_cell').length)
							$('.investors_inducators__slide:eq('+(aLIndex)+')').addClass('active')
					};
		};

		// евент  - вперёд
		$('.investors_inducators__manage_next').click(function(){
				if (aLIndex == $('.investors_inducators__slide').length-1)
					aLIndex = 0; 
				else
					aLIndex++;
				indicatorsChange_remover();
				return false;
		});

		// евент  - назад
		$('.investors_inducators__manage_prew').click(function(){
				if (aLIndex == 0)
					aLIndex = $('.investors_inducators__slide').length-1;
				else
					aLIndex--;
				indicatorsChange_remover();
				console.log(aLIndex);
				return false;
		});			 		
		//END Слайдер показателей "икнока-цифры-текст" на странице акционеров
					
					

		//запуск сортировки элементов на узловой странице Новости
		if (document.getElementById('main_newsList_ID') != null){ 		
			 var msnry = new Masonry( '#main_newsList_ID', {
				columnWidth: 410,
				itemSelector: '.main_newsList__item'
			});	
		};
		// END запуск сортировки элементов на узловой странице Новости
	
	
	// MANAGERS PAGE ########################################################################
	
	$(".managers_customSlider").each(function( index ) {
		$(this).find('.managers_customSlider__Dotsnavi ul').html("");
	  
		$(this).find(".mcS__contentItem").each(function( index2 ) {
			$(this).parent().find('.managers_customSlider__Dotsnavi ul').append('<li><a href="#">&nbsp;</a></li>');
		});
		$(this).find(".managers_customSlider__Dotsnavi ul li:eq(0)").addClass("active");
	});
	
	
	
	$('.managers_customSlider__content').each(function(){
		$(this).css("height", $(this).find('.mcS__contentItem.active').height());
	})
	
	
	function changeActiveManagers(objj, toWhat)
	{
		objj.find('.managers_customSlider__Dotsnavi ul li.active').removeClass('active');
		objj.find('.managers_customSlider__Dotsnavi ul li:eq('+toWhat+')').addClass('active');
		
		objj.find('.mcS__naviItem.active').removeClass('active');
		objj.find('.mcS__naviItem:eq('+toWhat+')').addClass('active');
		
		objj.find('.mcS__contentItem.active').fadeOut(500,function(){$(this).removeClass("active")});
		objj.find('.mcS__contentItem:eq('+toWhat+')').fadeIn(500,function(){$(this).addClass("active")});
		
		objj.find('.managers_customSlider__content').animate({height: objj.find('.mcS__contentItem:eq('+toWhat+')').height()},400,function(){})
	}
	
	$('.managers_customSlider__Dotsnavi li a').click(function(){
		if (!$(this).hasClass("active"))
			changeActiveManagers($(this).parent().parent().parent().parent().parent(), $(this).parent().index());
		return false;
	});
	
	$('.mcS__naviItem a.js_mcS_link').click(function(){
		if (!$(this).parent().hasClass("active"))
		{
			changeActiveManagers($(this).parent().parent().parent().parent(), $(this).parent().index());
			console.log($(".managers_customSlider__navi").offset().top);
			$('body,html').animate({scrollTop: $(this).parent().parent().parent().offset().top}, 600);
		}		
		return false;
	});
	// END MANAGERS PAGE ########################################################################
 	
	
	// feedbackForm
	$('.js_feedform_coverOpener').click(function(){
		$(this).slideUp(300);
		$(this).parent().find(".gradiBorderBox").slideDown(400)
		return false;
	});
	// END feedbackForm
	
	//слайдер-споллер в тексте
	$('.slideredItem__content:not(.opened)').slideUp(1);
	$('.slideredItem__name').click(function(){
		$(this).parent().toggleClass('active');
		$(this).parent().find('.slideredItem__content').slideToggle(300);
	});
	
	//нумерованные многоуровневые списки
	 $(".ul_numedBlue").addClass('jsPads');
	 var dataNumVariable;
	 $.each(  $(".ul_numedBlue li") , function(  ) {
		if($(this).parent().parent().attr('data-num') != null)
			dataNumVariable = $(this).parent().parent().attr('data-num')+".";
		else
			dataNumVariable = "";
		$(this).attr('data-num', dataNumVariable+($(this).index()+1));
		$(this).prepend("<span class='linum'>"+dataNumVariable+($(this).index()+1)+"</span>");
	});
	
	//masked input
	$(".JSMaskToPhone").inputmask("+7 (999) 999-99-99"); 
	$(".JSMaskToMail").inputmask({
            mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
            greedy: false,
            onBeforePaste: function (pastedValue, opts) {
                pastedValue = pastedValue.toLowerCase();
                return pastedValue.replace("mailto:", "");
            },
            definitions: {
                '*': {
                    validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                    cardinality: 1,
                    casing: "lower"
                }
            }
    });
	//END masked input
	
	//	
	//INPUT FILE-TYPE changer
	//
		$('.file_link input[type=file]').change(function() {
			if ($('.file_link input[type=file]').val() != '') {
				$(this).parent().addClass('isAttached');
				var fileResult = $(this).val().replace(/.+[\\\/]/, "");
				$(this).parent().find('span.sucess_text').text(fileResult);
				$(this).parent().attr('title',fileResult);				
			} else {
				$(this).parent().removeClass('isAttached');
			}
		});	
	
	//
	// FANCYBOX init
	//
	// fancybox — one item
	$('.fancybox_item').fancybox({
		helpers : {
			overlay: {
				locked: false
			},
			title : {
				type : 'outside'
			}
		}
	});
		
	// fancybox — list of images
	$('.fancybox_thumbs').fancybox({
		prevEffect : 'none',
		nextEffect : 'none',
		padding: '0',
		helpers : {
			overlay: {
				locked: false
			},
			thumbs : {
				width  : 125,
				height : 83
			},
			title : {
				type : 'outside'
			}
		}
	});
	
	// jQ UI select
	if ((document.getElementsByClassName('jq_custom_select') != null) || (document.querySelectorAll('.jq_custom_select') !=null)) {		$( ".jq_custom_select" ).selectmenu();};
	// jQ UI tabs
	if ((document.getElementsByClassName('jq_custom_tabs') != null) || (document.querySelectorAll('.jq_custom_tabs') !=null)) { 		$( ".jq_custom_tabs" ).tabs({hide: {  duration: 400 }, show: {  duration: 400 }});};
	
	// jQ UI accordion
	if ((document.getElementsByClassName('jq_custom_accordion') != null)  || (document.querySelectorAll('.jq_custom_accordion') !=null)) {	$( ".jq_custom_accordion" ).accordion(); $( ".jq_custom_accordion" ).accordion({collapsible: true}); };
	// jQ UI checkboxes
	if ((document.getElementsByClassName('jq_custom_checkboxes') != null)  || (document.querySelectorAll('.jq_custom_checkboxes') !=null)) {	$( ".jq_custom_checkboxes" ).buttonset(); };
	// jQ UI radio
	if ((document.getElementsByClassName('jq_custom_radio') != null)  || (document.querySelectorAll('.jq_custom_radio') !=null)) {	$( ".jq_custom_radio" ).buttonset(); };
	// jQ UI datepicker
	if ((document.getElementsByClassName('jq_custom_radio') != null)  || (document.querySelectorAll('.jq_custom_radio') !=null)) {	
			$( "#datepicker1" ).datepicker({
				showOn: "button",
				buttonImage: "../_i/select_date_icon.png",
				buttonImageOnly: true,
				buttonText: "ђыберите дату"	  
			});
			$( "#datepicker1" ).datepicker( $.datepicker.regional["ru"] );
			$(".JSMaskToPhone").inputmask("+7 (999) 999-99-99"); 
	};
	
		
		
	if('.js_select'){
		$('.js_select select').styler();
	}
	
	
	
	
	
	
	

	/*inline slider for sertificates*/
	$('.sertifSlide_1').flexslider({
        animation: "slide",
        controlNav: false,                
        directionNav: true,
        prevText: "",
        nextText: "",
		slideshow: false 
    });
    
   
/*end inline slider for sertificates*/
	
	
});