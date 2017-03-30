var MobileMenu = {
	init: function () {
		this.pull = $('#pull');
		this.menu = $('nav ul');
		this.menu_p = $(".menu_parent");
		this.menuHeight = this.menu.height();
		this.pull.on('click', this.menuClick);
		this.menu_p.on('click', this.menu_parentClick);
		$(".p-head li:has(ul)").addClass("menu_parent");
		$(window).resize(function () {
			var menu = $('nav ul');
			var w = $(window).width();
			if (w > 320 && menu.is(':hidden')) {
				menu.removeAttr('style');
			}
		});
	},
	menuClick: function (e) {
		e.preventDefault();
		var menu = $('nav ul');
		menu.slideToggle();
	},
	menu_parentClick: function (e) {
		$(this).find(">ul").toggleClass("menu_expanded");
		$(this).toggleClass("menu_parent_exp");
	}
}


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

var SearchExtDisplay = {

	init: function () {
		this.btn = $('#el-search-btn');
		this.btn.on('click', this.btnClick);
	},
	btnClick: function (e) {
		var list = $('#el-search-select');
		var icon = $('#icon-down-top');
		var value = 0;
		if (value == 0) {
			list.css("display", "block");
			value = 1;
			icon.css("background-position-y", "7px");
		} else {
			list.css("display", "none");
			value = 0;
			icon.css("background-position-y", "-7px");
		}
	}
}


/*var textCrop = {
	init: function () {
		var size = 320;
		var newsContent = $('.preview-text-inner');
		var newsText = newsContent.text();

		if (newsText.length > size) {
			newsContent.text(newsText.slice(0, size) + ' ...');
		}
	}

}*/

$(document).ready(function () {


	$(".controlgroup").controlgroup()
	$(".controlgroup-vertical").controlgroup({
		"direction": "vertical"
	});



var yearNow = new Date().getFullYear();
var monthNow = new Date().getMonth() + 1;
var dateNow = new Date().getDate();
if(monthNow < 10){
	var monthNow = '0' + monthNow;
}
if(dateNow < 10){
	var dateNow = '0' + dateNow;
}
var dateFin = '' + yearNow + '/' + monthNow + '/' + dateNow + '';

$("#datepicker").datepicker({
	minDate: new Date(dateFin)
});
$("#datepicker2").datepicker({
	minDate: new Date(dateFin)
});
	$.datepicker.regional['ru'] = {
            closeText: 'Закрыть',
            prevText: '&#x3c;Пред',
            nextText: 'След&#x3e;',
            currentText: 'Сегодня',
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            monthNamesShort: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
            dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
            dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            weekHeader: 'Нед',
            dateFormat: 'dd.mm.yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
       };
$.datepicker.setDefaults($.datepicker.regional['ru']);

	$(".el-search-dop-input").checkboxradio();

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




	$(document).on('click', '#popup-bron-btn', function () {
		$.fancybox.close();
		var scroll_el = $('#right-form');
		var roomId = $(this).data('id');
		if ($(scroll_el).length != 0) {
			$('html, body').animate({scrollTop: $(scroll_el).offset().top}, 500);
			$('#right-form select[name="room"]').val(roomId).selectmenu('refresh');;
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

	$(window).scroll(function () {
		if ($(this).scrollTop() != 0) {
			$('.search-fix').fadeIn();
		} else {
			$('.search-fix').fadeOut();
		}
	});

 $('.elComments-list').owlCarousel({
	loop: true, 
	navigation: true, 
	pagination: false,
	navigationText: ["<img src='/images/elSlider-left.png'>", "<img src='/images/elSlider-right.png'>"],
	items: 2, 
	itemsCustom: [
        [0, 1],
        [1000, 2]
      ],
});

});


// Slider (главная, карточка)
var SincSlider = {
	init: function () {
		this.sync1 = $("#sync1, #about-slider");
		this.sync2 = $("#sync2, #about-slider-nav");

		this.sync1.owlCarousel({
			singleItem: true,
			slideSpeed: 1000,
			navigation: true,
			pagination: false,
			afterAction: this.syncPosition,
			responsiveRefreshRate: 200,
			navigationText: ["<img src='/images/owl-left.png'>", "<img src='/images/owl-right.png'>"],
			transitionStyle: "fade"
		});

		$("#sync2").owlCarousel({
			items: 10,
			itemsDesktop: [1199, 10],
			itemsDesktopSmall: [979, 10],
			itemsTablet: [768, 8],
			itemsMobile: [479, 4],
			pagination: false,
			responsiveRefreshRate: 100,
			afterInit: function (el) {
				el.find(".owl-item").eq(0).addClass("synced");
			}
		});

		$("#about-slider-nav").owlCarousel({
			pagination: false,
			responsiveRefreshRate: 100,
			afterInit: function (el) {
				el.find(".owl-item").eq(0).addClass("synced");
			}
		});

		this.sync2.on("click", ".owl-item", this.toNext);
	},

	toNext: function (e) {
		e.preventDefault();
		var sync1 = $("#sync1, #about-slider");
		var number = $(this).data("owlItem");
		//console.log(number);
		$(sync1).trigger("owl.goTo", number);
	},

	center: function (number) {
		var sync2visible = this.sync2.data("owlCarousel").owl.visibleItems;

		var num = number;
		var found = false;
		for (var i in sync2visible) {
			if (num === sync2visible[i]) {
				var found = true;
			}
		}

		if (found === false) {
			if (num > sync2visible[sync2visible.length - 1]) {
				this.sync2.trigger("owl.goTo", num - sync2visible.length + 2)
			} else {
				if (num - 1 === -1) {
					num = 0;
				}
				this.sync2.trigger("owl.goTo", num);
			}
		} else if (num === sync2visible[sync2visible.length - 1]) {
			this.sync2.trigger("owl.goTo", sync2visible[1])
		} else if (num === sync2visible[0]) {
			this.sync2.trigger("owl.goTo", num - 1)
		}
	},

	syncPosition: function (el) {
		var sync2 = $("#sync2, #about-slider-nav");
		var current = this.currentItem;
		$(sync2).find(".owl-item")
			.removeClass("synced")
			.eq(current)
			.addClass("synced")
		if ($(sync2).data("owlCarousel") !== undefined) {
			SincSlider.center(current);
		}
	}

};

/**
 * Ползунки цен и выбор города
 */
var PriceSlider = {
	cityCode: 0,
	init: function () {
		this.topSlider = $("#slider-range");
		this.isTop = this.topSlider.length > 0;
		this.botSlider = $("#slider-range-d");
		this.isBot = this.botSlider.length > 0;
		this.fromSpan = $("#slider-range-value-d-from, #slider-range-value-from");
		this.toSpan = $("#slider-range-value-d-to, #slider-range-value-to");
		this.max = parseInt(this.toSpan.eq(0).text());
		this.from = 0;
		this.to = this.max;
		if (this.isTop) {
			this.topSlider.slider({
				range: true,
				min: 0,
				max: PriceSlider.max,
				values: [PriceSlider.from, PriceSlider.to],
				step: 100,
				slide: PriceSlider.topSlide
			});
		}
		if (this.isBot) {
			this.botSlider.slider({
				range: true,
				min: 0,
				max: PriceSlider.max,
				values: [PriceSlider.from, PriceSlider.to],
				step: 100,
				slide: PriceSlider.botSlide
			});
		}

		this.submitBtnTop = $('.filter-find');
		this.citySelectTop = $('#city-vibor-top');
		this.citySelectBot = $('#city-vibor-bot');
		this.slctBot = $(".slct");
		this.extBtn = $('.el-search-btn');

		this.citySelectTop.selectmenu({
			change: this.cityTopChange
		});
		this.slctBot.on('click', this.slctDrop);
		this.submitBtnTop.click(this.submitClick);
		this.extBtn.click(this.extBtnClick);
		this.citySelectBot.find('li').click(this.slctLiClick);
	},
	cityTopChange: function (event, ui) {
		PriceSlider.cityCode = PriceSlider.citySelectTop.val();
		var text = PriceSlider.citySelectTop.children(':selected').text();
		PriceSlider.slctBot.html(text);
	},
	slctLiClick: function () {
		PriceSlider.cityCode = $(this).data('code');
		PriceSlider.slctBot.removeClass('active');
		PriceSlider.slctBot.html($(this).text());
		PriceSlider.citySelectBot.slideUp();
		PriceSlider.citySelectTop.val(PriceSlider.cityCode);
		PriceSlider.citySelectTop.selectmenu('refresh');
	},
	slctDrop: function (e) {
		e.preventDefault();

		if (PriceSlider.citySelectBot.is(':hidden')) {
			PriceSlider.citySelectBot.slideDown();
			$(this).addClass('active');
		}
		else {
			PriceSlider.citySelectBot.slideUp();
			$(this).removeClass('active');
		}

		return false;
	},
	topSlide: function (event, ui) {
		PriceSlider.slide(ui.values[0], ui.values[1]);
		PriceSlider.botSlider.slider('values', ui.values);
	},
	botSlide: function (event, ui) {
		PriceSlider.slide(ui.values[0], ui.values[1]);
		PriceSlider.topSlider.slider('values', ui.values);
	},
	slide: function (from, to) {
		PriceSlider.from = from;
		PriceSlider.to = to;
		PriceSlider.fromSpan.text(PriceSlider.from);
		PriceSlider.toSpan.text(PriceSlider.to);
	},
	getPriceParams: function () {
		var res = '';
		if (PriceSlider.from > 0)
			res += '?p-from=' + PriceSlider.from;
		if (PriceSlider.to < PriceSlider.max) {
			if (res)
				res += '&';
			else
				res += '?';
			res += 'p-to=' + PriceSlider.to;
		}
		return res;
	},
	submitClick: function () {
		var url = '/sanatorium/';
		if (PriceSlider.cityCode != 0)
			url += PriceSlider.cityCode + '/';
		url += PriceSlider.getPriceParams();
		window.location = url;

		return false;
	},
	extBtnClick: function () {
		window.location = '/sanatorium/';
	}
};

/**
 * Отзывы
 */
var Review = {
	init: function () {
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


jQuery(document).ready(function () {
	Review.init();
	SincSlider.init();
	PriceSlider.init();
	MobileMenu.init();
	SearchExtDisplay.init();

});
