// Select SearchFix
var SearchSelect = {
	init: function() {
		 this.slct = $(".slct");
		 this.slct.on("click", this.slctDrop);
	},
	
	slctDrop: function(e){
		e.preventDefault();
		var dropBlock = $(this).parent().find('.drop');

		if( dropBlock.is(':hidden') ) {
			dropBlock.slideDown();
			$(this).addClass('active');
			$('.drop').find('li').click(function(){	
				var selectResult = $(this).html();		
				$(this).parent().parent().find('input').val(selectResult);
				$(this).parent().parent().find('.slct').removeClass('active').html(selectResult);	
				dropBlock.slideUp();
			});

		} else {
			$(this).removeClass('active');
			dropBlock.slideUp();
		}

		return false;
	}
}

$(function () {

	$(".controlgroup").controlgroup()
	$(".controlgroup-vertical").controlgroup({
		"direction": "vertical"
	});
	$("#datepicker").datepicker();
	$("#datepicker2").datepicker();


	var pull = $('#pull');
	menu = $('nav ul');
	menuHeight = menu.height();

	$(pull).on('click', function (e) {
		e.preventDefault();
		menu.slideToggle();
	});

	$(window).resize(function () {
		var w = $(window).width();
		if (w > 320 && menu.is(':hidden')) {
			menu.removeAttr('style');
		}
	});
	var pull_2 = $('#content-menu-pun');
	menu_2 = $('#content-menu-show');
	value = 0;

	$(pull_2).on('click', function (e) {
		if (value == 0) {
			menu_2.css("height", "100%");
			value = 1;
			pull_2.text('свернуть');
		} else {
			menu_2.css("height", "20px");
			value = 0;
			pull_2.text('развернуть');
		}
	});
	$(".various").fancybox({
		maxWidth: 800,
		maxHeight: 600,
		padding: '0',
		fitToView: false,
		width: '700',
		height: '600',
		autoSize: false,
		closeClick: false

	});
	// перенес в шаблон кампонента
	//   $( "#slider-range" ).slider({
	// 	range: true,
	// 	min: 0,
	// 	max: 20000,
	// 	values: [ 1500, 15000    ],
	// 	slide: function( event, ui ) {
	// 		$("#slider-range-value1").text(ui.values[0]);
	// 		$("#slider-range-value2").text(ui.values[1]);
	// 	}
	// });
	var btn = $('#el-search-btn');
	list = $('#el-search-select');
	icon = $('#icon-down-top');
	value = 0;

	$(btn).on('click', function (e) {
		if (value == 0) {
			list.css("display", "block");
			value = 1;
			icon.css("background-position-y", "7px");
		} else {
			list.css("display", "none");
			value = 0;
			icon.css("background-position-y", "-7px");
		}
	});
	$(".el-search-dop-input").checkboxradio();


	var l = $(".price-group").attr("data-min");
	var r = $(".price-group").attr("data-max");
	$("#slider-range").slider({
		range: true,
		min: l,
		max: r,
		values: [l, r],
		slide: function (event, ui) {
			$("#slider-range-value1").text(ui.values[0]);
			$("#slider-range-value2").text(ui.values[1]);
			$(".from").val(ui.values[0]);
			$(".to").val(ui.values[1]);
		}
	});
	$("#slider-range-d").slider({
		range: true,
		min: l,
		max: r,
		values: [l, r],
		slide: function (event, ui) {
			$("#slider-range-value01").text(ui.values[0]);
			$("#slider-range-value02").text(ui.values[1]);
			$(".from").val(ui.values[0]);
			$(".to").val(ui.values[1]);
		}
	});

	var btn_d = $('#el-search-btn-d');
	list_d = $('#el-search-select-d');
	icon_d = $('#icon-down-top-d');
	value = 0;

	$(btn_d).on('click', function (e) {
		if (value == 0) {
			list_d.css("display", "block");
			value = 1;
			icon_d.css("background-position-y", "7px");
		} else {
			list_d.css("display", "none");
			value = 0;
			icon_d.css("background-position-y", "-7px");
		}
	});


	$(".p-head li:has(ul)").addClass("menu_parent");
	$(".menu_parent").click(
		function () {
			$(this).find(">ul").toggleClass("menu_expanded");
			$(this).toggleClass("menu_parent_exp");
		}
	)

});

$(document).ready(function () {
	var submitIcon = $('.searchbox-icon');
	var inputBox = $('.searchbox-input');
	var searchBox = $('.searchbox');
	var isOpen = false;
	submitIcon.click(function () {
		if (isOpen == false) {
			searchBox.addClass('searchbox-open');
			inputBox.focus();
			isOpen = true;
		} else {
			searchBox.removeClass('searchbox-open');
			inputBox.focusout();
			inputBox.val('');
			isOpen = false;
		}
	});
	submitIcon.mouseup(function () {
		return false;
	});
	searchBox.mouseup(function () {
		return false;
	});
	$(document).mouseup(function () {
		if (isOpen == true) {
			$('.searchbox-icon').css('display', 'block');
			submitIcon.click();
		}
	});
	function buttonUp() {
		var inputVal = $('.searchbox-input').val();
		inputVal = $.trim(inputVal).length;
		if (inputVal !== 0) {
			$('.searchbox-icon').css('display', 'none');
		} else {
			$('.searchbox-input').val('');
			$('.searchbox-icon').css('display', 'block');
		}
	}

});


$(document).ready(function () {

	$('.preview-text a').on('click', function (e) {
		e.preventDefault();
		$.fancybox({
			content: $(this).parent().parent().find('.detail-text'),
			maxWidth: $(window).width() - 200,
			maxHeight: $(window).height() - 100,
			fitToView: false,
			padding: '0',
			width: '700',
			height: '600',
			autoSize: true,
			closeClick: false,
		})
	});

	var size = 520,
		newsContent = $('.preview-text-inner'),
		newsText = newsContent.text();

	if (newsText.length > size) {
		newsContent.text(newsText.slice(0, size) + ' ...');
	}

	$(document).on('click', '#popup-bron-btn', function () {
		$.fancybox.close();
		var scroll_el = $('#right-form');
		if ($(scroll_el).length != 0) {
			$('html, body').animate({scrollTop: $(scroll_el).offset().top}, 500);
			$('#right-form input[name="name"]').focus();
		}
		return false;
	});



	if ($(window).width() < 500) {
		$('.actions-item').readmore({
			maxHeight: 418,
			moreLink: '<a href="#"><span>Подробнее</span></a>',
			lessLink: '<a href="#"><span>Скрыть</span></a>'
		});
	} else {
		$('.actions-item').readmore({
			maxHeight: 218,
			moreLink: '<a href="#"><span>Подробнее</span></a>',
			lessLink: '<a href="#"><span>Скрыть</span></a>'
		});
	}
	$("#people .btn>a").fancybox({padding: 0});
	$('.seo-content .seo-content-inner').readmore({
		maxHeight: 140,
		moreLink: '<a href="#"><span>Подробнее</span></a>',
		lessLink: '<a href="#"><span>Скрыть</span></a>'
	});
});
$(window).load(function () {
	// The slider being synced must be initialized first
	$('#carousel').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		itemWidth: 110,
		itemMargin: 5,
		asNavFor: '#slider'
	});

	$('#slider').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		sync: "#carousel"
	});
$(window).scroll(function() {
	if($(this).scrollTop() != 0) {
	$('.search-fix').fadeIn();
	} else {
	$('.search-fix').fadeOut();
	}
});

});

// Slider (главная, карточка)
var SincSlider = {
	init: function() {
		this.sync1 = $("#sync1");
		this.sync2 = $("#sync2");
		
		this.sync1.owlCarousel({
			singleItem : true,
			slideSpeed : 1000,
			navigation: true,
			pagination:false,
			afterAction : this.syncPosition,
			responsiveRefreshRate : 200,
			navigationText: ["<img src='/local/templates/san/images/left.png'>", "<img src='/local/templates/san/images/right.png'>"],
			transitionStyle: "fade"
		  });

		  this.sync2.owlCarousel({
			items : 10,
			itemsDesktop      : [1199,10],
			itemsDesktopSmall     : [979,10],
			itemsTablet       : [768,8],
			itemsMobile       : [479,4],
			pagination:false,
			responsiveRefreshRate : 100,
			afterInit : function(el){
			  el.find(".owl-item").eq(0).addClass("synced");
			}
		  });

		  this.sync2.on("click", ".owl-item", this.toNext);
	},
	
	toNext: function(e){
		e.preventDefault();
        var number = $(this).data("owlItem");
		//console.log(number);
        $(sync1).trigger("owl.goTo",number);
	},
	
	center: function(number){
	var sync2visible = this.sync2.data("owlCarousel").owl.visibleItems;

	var num = number;
	var found = false;
	for(var i in sync2visible){
	  if(num === sync2visible[i]){
		var found = true;
	  }
	}

	if(found===false){
	  if(num>sync2visible[sync2visible.length-1]){
		this.sync2.trigger("owl.goTo", num - sync2visible.length+2)
	  }else{
		if(num - 1 === -1){
		  num = 0;
		}
		this.sync2.trigger("owl.goTo", num);
	  }
	} else if(num === sync2visible[sync2visible.length-1]){
	  this.sync2.trigger("owl.goTo", sync2visible[1])
	} else if(num === sync2visible[0]){
	  this.sync2.trigger("owl.goTo", num-1)
	}
	},
	  
	syncPosition: function (el) {
		var current = this.currentItem;
		$(sync2).find(".owl-item")
		  .removeClass("synced")
		  .eq(current)
		  .addClass("synced")
		if($(sync2).data("owlCarousel") !== undefined){
		  SincSlider.center(current);
		}
	}
	
};

/**
 * Отзывы
 */
var Review = {
	init: function() {
		this.form = $('#review-form');
		if (!this.form.length)
			return false;

		this.form.submit(this.send);
	},
	send: function () {
		var form_data = Review.form.serialize();
		$.ajax({
			type: 'POST',
			url: '/ajax/add_review.php',
			data: form_data,
			success: function () {
				//Review.form[0].reset();
			}
		});
		return false;
	}
};

jQuery(document).ready(function() {
	Review.init();
	SincSlider.init();
	SearchSelect.init();
});
