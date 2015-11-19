/*-------------------popup init-------------------*/
function InitPopup(popup){
	popup = $(popup);
	var cls = popup.attr('data-popup');
	$('.custom-popup.'+cls).fadeIn('300');
	$('.custom-popup.'+cls).prev('.custom-overlay').fadeIn('300');	

		
}
/*-------------------end popup init-------------------*/


/*----------------------------------ALIGN POPUPS-------------------------*/
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
/*----------------------------------END ALIGN POPUPS-------------------------*/




/*---------------------ITEM COUNTER---------------------*/
function ItemCounter(){   
	$('.js_counter').each(function(){
			var the_counter = $(this);
			
			$('.js_btn_counter_next', the_counter).click(function(e){
				e.preventDefault();
				$count = $('.js_counter_input', the_counter).val();
				$count2 = parseInt($count)+1;
				$('.js_counter_input', the_counter).val($count2);
			})
			
			$('.js_btn_counter_prev', the_counter).click(function(e){
				e.preventDefault();
				$count = $('.js_counter_input', the_counter).val();
				$count2 = parseInt($count)-1;
				if($count2<0) $count2 = 0;
				$('.js_counter_input' ,the_counter).val($count2);
			})						   
	}); 
}
/*----------------END ITEM COUNTER-----------------*/


/*ream more content*/
function showMoreContent() {
	$('.js_read_more').click(function(e){
		e.preventDefault();	
		$(this).parent().find($('.read_more_content')).slideToggle();
		$(this).toggleClass('active');
	});
}
/*end ream more content*/



/*-------------------news blocks near to each other-------------------*/
function alignBlocks(){
	var $container = $('.news_block_holder');
	$container.masonry({
	  itemSelector: '.news'
	});
}
/*-------------------End news blocks near to each other-------------------*/


/*-------------------Tabs-------------------*/
function initTabs() {
    var isAnimating = false;
    $('[data-tab]').click(function(e) {
         e.preventDefault();
		$('.js_announce').fadeOut();
        if(!isAnimating) {
            var parent = $(this).parent().parent();
            var cls = $(this).attr('data-tab');
            isAnimating = true;
            $('[data-tab]', parent).removeClass('active');
            $(this, parent).addClass('active');

            if($('.hidden_content').hasClass('active')){
                $('.hidden_content.active', parent).fadeOut(300, function(){
                    $('.hidden_content.active', parent).removeClass('active');
                    $('.hidden_content'+'#'+cls, parent).fadeIn(300, function() {
                        isAnimating = false;
                    });  
                    $('.hidden_content'+'#'+cls, parent).addClass('active');
                })
            }
            else {
                $('.hidden_content'+'#'+cls, parent).fadeIn(300, function() {
                    isAnimating = false;
                }); 
                $('.hidden_content'+'#'+cls, parent).addClass('active');
            }
        }
    });
	$('.hidden_content.active').fadeIn();	
}
/*-------------------end Tabs-------------------*/








function calcResults(){
	$('.js_results_block .js_block').each(function(){
		var block = $(this);
		var amount = $('.counter_input', block).val();
		$('.js_amount', block).html(amount);

		$('.btn_counter_next', block).click(function(){	
			updateResult(block);
			amount = $('.counter_input', block).val();
			$('.js_amount', block).html(amount);
			changePriceView();
		})
		
		$('.btn_counter_prev', block).click(function(){
			updateResult(block);
			amount = $('.counter_input', block).val();
			$('.js_amount', block).html(amount);
			changePriceView();
		})
		
		$('.counter_input', block).keyup(function(){
			
			if($('.counter_input', block).val()==""){
				amount = 1;
			}
			else{
				amount = $('.counter_input', block).val();
			}
			
			updateResult(block);
			$('.js_amount', block).html(amount);
			changePriceView();
		})

		var temp_price = $('.js_item_price', block).html();
		temp_price = temp_price.replace( " ", "" );
		
	
		temp_price =  parseFloat(temp_price);
		$('.js_hidden_price', block).html(temp_price);
		updateResult(block, temp_price);
		
	})

	function updateResult(cart_item, temp_pr){
		var price = $('.js_item_price', cart_item).html();
		price = price.replace( " ", "" );
		price =  parseFloat(price);
		temp_pr = $('.js_hidden_price', cart_item).html();
		var amount = $('.counter_input', cart_item).val();
		//alert(amount);
		var total = (temp_pr*parseInt(amount)).toFixed(2);
		$('.js_hidden_total_price', cart_item).html(total);
		$('.js_item_total_price', cart_item).html(total);
		showFinalResult();
	}
	
	function showFinalResult(){
		var c=0;
		$('.js_results_block .js_block').each(function(){
			var parent = $(this).parent();								   
			var total_block = $(this);
			var totals = $('.js_hidden_total_price', total_block).html();
			totals=parseFloat(totals);
			c += totals;
		})
		$('.js_item_final_price').html(c.toFixed(2));
	}
	
	showFinalResult();

}
/*end calc results in cart*/ 



/*make cents in price upper*/
function changePriceView(){
	$.each($('.js_change_price'), function(){
	var price = $(this).html();
	$(this).html(price.replace(/(\D*)(\d+)([\.\,])(\d*)/,'<span class=js_"price_rub">$1</span><span class="js_price_rub">$2</span><span class="js_price_cent">$4</span><span style="width:15px; display:inline-block;"></span>'));
	});	
}
/*make cents in price upper*/











$( window ).resize(function() {
	AlignPopup();			
});	

$(window).scroll(function() {
	var scrolled_top = $(window).scrollTop();
	if(scrolled_top>115) {
		$('.top_block').addClass('fixed');
		$('.content_block').css('margin-top', "40px");
		
		$('.catalog_menu').addClass('fixed');
		$('.catalog_menu').css('margin-top', "47px");
	}
	else {
		$('.top_block').removeClass('fixed');
		$('.catalog_menu').removeClass('fixed');
		$('.content_block').css('margin-top', "0px");
		$('.catalog_menu').css('margin-top', "0px");
	}
});


$(window).load( function() {
	alignBlocks();
});


$(document).ready(function(){
	AlignPopup();
	ItemCounter();
	showMoreContent();
	initTabs();
	calcResults();
	changePriceView();
	
	$('.js_scroll').click(function(e){
		e.preventDefault();
		var href = $(this).attr('href');
		$('body').scrollTo(href, {duration:'slow'});						  
	})


	$(".js_phone_mask").mask("+7 (999) 999-99-99");

/*-------------------custom select-------------------*/
	$('.js_select select').styler({
		selectSearch:false
		/*onSelectOpened: function() { 
		 $(this).find(".jq-selectbox__dropdown ul").jScrollPane({							
				showArrows: false,
				verticalDragMinHeight: 28,
				verticalDragMaxHeight: 28,
				horizontalDragMinWidth: 28,
				horizontalDragMaxWidth: 28
		});
 }*/
	});
	
	$("select.js_icons_select").each(function() {					
		var sb = new SelectBox({
			selectbox: $(this),
			//height: 150,
			width: 200
		});
	});
/*-------------------custom select-------------------*/




/*-----------------------------POPUP-------------------------*/
    $('[data-popup]').on('mousemove', function(e){
        e.preventDefault();
		AlignPopup();
		InitPopup($(this));
   });


    $('.custom-overlay, .custom-popup .close, .js_close_popup').on('click',function(e){
		e.preventDefault();	
		$('.custom-overlay').delay(200).fadeOut('300');																		  
		$('.custom-popup').fadeOut('300');		

    });
/*-----------------------END POPUP----------------------------*/


	




/*---------------Tabs----------
	$('[data-preview]').click(function(e) {
	   	e.preventDefault();
		var parent = $(this).parent().parent().parent();
		var cls = $(this).attr('data-preview');
		
		$('[data-preview]', parent).removeClass('active');
		$(this, parent).addClass('active');
		$('.item_preview_big.active', parent).fadeOut( function(){
			$('.item_preview_big.active', parent).removeClass('active');
			$('.item_preview_big'+'#'+cls, parent).fadeIn(); 
			$('.item_preview_big'+'#'+cls, parent).addClass('active');
		})
	});
	$('.tabs .hidden_content.active').fadeIn();										
/*------------------End Tabs-------------------*/
	
	
	
/*show comments form*/
 $('.js_btn_live_comment').click(function(e) {
	   	e.preventDefault();
		$('.js_btn_live_comment').css('opacity', '0');		
		$('.js_leave_comment_block').slideToggle(700, function(){
												   
		});
	});
 
  $('.js_btn_hide_comment').click(function(e) {
	   	e.preventDefault();
		$('.js_leave_comment_block').slideToggle(700, function(){
			$('.js_btn_live_comment').css('opacity', '1');							   
		});
	});
/*end show comments form*/ 
 


/*catalog menu*/
	//$('.js_catalog_item_click').click(function(e) {
	   	//e.preventDefault();
		//$(this).toggleClass('active');
		//$(this).parent().find('.js_catalog_subitem_block').slideToggle();
	//})
	$('.js_btn_catalog').click(function(e) {
	   	e.preventDefault();
		
		$(this).parent().find('.js_catalog_list_block_small').fadeIn();
	})
	$('.js_btn_catalog_opened').click(function(e) {
	   	e.preventDefault();
		
		$(this).parent().parent().find('.js_catalog_list_block_small').fadeOut();
	})
/*end catalog menu*/


	$('.js_more_parameters').click(function(e) {
	   	e.preventDefault();
        $(this).toggleClass('opened')
		$('.parameters_hidden_block').slideToggle();
	});

/*price range slider*/
    $("#range_slider").slider({
        min: 0,
        max: 100000,
        step: 1,
		range: true,
        values: [4500, 90000],
        slide: function(event, ui) {
            for (var i = 0; i < ui.values.length; ++i) {
                $("input.sliderValue[data-index=" + i + "]").val(ui.values[i]);
            }
        }
    });

    $("input.sliderValue").keyup(function() {
        var $this = $(this);
        $("#range_slider").slider("values", $this.data("index"), $this.val());
    });
	$("input.sliderValue").change(function() {
        var $this = $(this);
        $("#range_slider").slider("values", $this.data("index"), $this.val());
    });
/*end price range slider*/

	
/*main page top slider*/
$('.bxslider').bxSlider({
	controls:false,				
	mode: 'fade',
	auto:true,
	pause: 5000
});
/*end main page top slider*/



for(var i = 1; i<=$('.js_swiper').length; ++i){
	var swiper = new Swiper('.js_swiper'+i+' .swiper-container', {
	slidesPerView: 'auto',
	spaceBetween: 0,
	loop:true,
	nextButton: '.js_swiper'+i+'  .js_swiper_next',
	prevButton: '.js_swiper'+i+'  .js_swiper_prev',
	//mousewheelControl: true,
	loopedSlides:6
	});
}


var swipernews = new Swiper('.js_swiper_news .swiper-container', {
	slidesPerView: 'auto',
	spaceBetween: 0,
	loop:true,
	nextButton: '.js_swiper_news .js_swiper_next',
	prevButton: '.js_swiper_news .js_swiper_prev',
	//mousewheelControl: true,
	loopedSlides:4
});

$('.btn_item_buy').mousedown(function(){
	$(this).addClass('active');								  
})
$('.btn_item_buy').mouseup(function(){
	$(this).removeClass('active');								  
})
$('.btn_item_buy').mouseout(function(){
	$(this).removeClass('active');								  
})
/*end items sliders*/


$('.js_show_hide').click(function(e) {
	var btn = $(this)
	e.preventDefault();

	$(this).parent().parent().find('.js_block').slideToggle(300, function(){
		btn.toggleClass('active');																	  
	});

});


$('.js_add_new_address').click(function(e) {
	e.preventDefault();
	$('.js_new_address_block').fadeIn(300);
});


$('.js_btn_order_delivery').click(function(e) {
	e.preventDefault();
	$('.js_order_delivery_block').slideDown();
	$('.js_btn_order_delivery').css('opacity','0');
	$('.js_btn_order_delivery').css('cursor','default');
});

$('.js_btn_order_payment').click(function(e) {
	e.preventDefault();
	$('.js_order_payment_block').slideDown();
	$('.js_btn_order_payment').css('opacity','0');
	$('.js_btn_order_payment').css('cursor','default');
});




  $('.js_flexslider').flexslider({
	animation: "fade",
	manualControls: ".thumbnails a",
	prevText: "",
	nextText: "", 
	slideshow: false, 
	start: function(slider){
	  $('body').removeClass('loading');
	}
  });
	
	
$('.js_show_panel').click(function(e){
	e.stopPropagation();
	e.preventDefault();	
	$(this).toggleClass('active');
	$(this).parent().find('.js_panel').fadeToggle();
})

/*-------------------validation-------------------*/
	$.validate({
	  form : '.js_validation',
	  /*onError : function() {
            alert('Validation failed');
        },*/
		onSuccess : function() {
          
             // Will stop the submission of the form
        }
		/*,
        onValidate : function() {
            return {
                element : $('#some-input'),
                message : 'This input has an invalid value for some reason'
            }
        }*/
	});
/*-------------------validation-------------------*/	
});