var MobileMenu = {
	init: function () {
		this.pull = $('#pull');
		this.menu = $('nav ul');
        this.menulist = $('nav a');
		this.menu_p = $(".menu_parent");
		this.menuHeight = this.menu.height();
		this.pull.on('click', this.menuClick);
		this.menu_p.on('click', this.menu_parentClick);
        this.menulist.on('click', this.menulistClick);
		$(".p-head li:has(ul)").addClass("menu_parent");
		$(window).resize(function () {
			var menu = $('nav ul');
			var w = $(window).width();
			if (w > 320 && menu.is(':hidden')) {
				menu.removeAttr('style');
			}
		});

		if ($(window).width() < 750) {
			$(window).scroll(function(){
			var head = $('.header-line_wbg');
			var head_h = head.height();
				if($(this).scrollTop() > head_h){
					$('.main-menu').addClass('fixed');
				}
				else if ($(this).scrollTop()<140){
					 $('.main-menu').removeClass('fixed');
				}
			});
		}

	},
	menuClick: function (e) {
		e.preventDefault();
		var menu = $('nav ul');
		menu.slideToggle();
	},
	menu_parentClick: function (e) {
        $(this).find(">ul").toggleClass("menu_expanded");
		$(this).toggleClass("menu_parent_exp");
	},
    menulistClick: function (e) {
        var w = $(window).width();
        if (w < 1100) {
            if ($(this).parent().hasClass("menu_parent")) {
				$(this).parent().find("ul").toggleClass("menu_expanded");
                return false;
            }
        }
    }

}

var SearchTop = {
	init: function () {
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
	}
}


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
var _form_check = {
    init: function () {
        this.form_check = $('input[name="_check"]');

        this.form_check.each(function(index, element){
            $(element).on('click', _form_check.click);
        });
    },
    click: function (){
        if ($(this).prop("checked")) {
            $(this).prop("checked",true);
            $('.'+$(this).attr('data-class')).addClass('active');
        } else {
            $(this).prop("checked",false);
            $('.'+$(this).attr('data-class')).removeClass('active');
        }
    }
};
$(document).ready(function () {
    _form_check.init(); /* Чекбокс */

	// Якоря
    $('a[href^="#"]#content-top').on('click', function(event) {
        event.preventDefault(); // отменяем стандартное действие

        var sc = $(this).attr("href"), // sc - в переменную заносим информацию о том, к какому блоку надо перейти
            dn = $(sc).offset().top; // dn - определяем положение блока на странице

        $('html , body').animate({scrollTop: dn}, 1000); // 1000 скорость перехода в миллисекундах
    });


	$(".controlgroup").controlgroup()
	$(".controlgroup-vertical").controlgroup({
		"direction": "vertical"
	});


	var yearNow = new Date().getFullYear();
	var monthNow = new Date().getMonth() + 1;
	var dateNow = new Date().getDate();
	if (monthNow < 10) {
		var monthNow = '0' + monthNow;
	}
	if (dateNow < 10) {
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
		padding: '0',
		helpers: {
			overlay: {
			  locked: true
			}
		}
	});

    var engBtnTop = $('#engBtnTop');
    $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
            engBtnTop.fadeIn();
        } else {
            engBtnTop.fadeOut();
        }
    });

    engBtnTop.click(function () {
        $('body,html').animate({scrollTop: 0}, 800);
    });

	$(".fancy_images a").fancybox();

	$(document).on('click', '#popup-bron-btn', function () {
		$.fancybox.close();
		var scroll_el = $('#right-form');
		var roomId = $(this).data('id');
		if ($(scroll_el).length != 0) {
			$('html, body').animate({scrollTop: $(scroll_el).offset().top}, 500);
			$('#right-form select[name="room"]').val(roomId).selectmenu('refresh');
			;
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
		navigationText: ["", ""],
		items: 2,
		itemsCustom: [
			[0, 1],
			[1000, 2]
		]
	});
    $('.elIndexVideoSlider').owlCarousel({
        loop: true,
        navigation: true,
        pagination: false,
        navigationText: ["", ""],
        items: 3,
        itemsCustom: [
            [0, 1],
            [750, 2],
            [1000, 3]
        ]
    });



    $(".elAboutBox_fancy").fancybox({
        padding: '0',
        helpers: {
            overlay: {
                locked: true
            }
        }
    });


    var owl = $('#elAboutBox3-slider');
    owl.owlCarousel({
        loops:true,
        autoplay: true,
        center: true,
        loop:true,

        navigation: true,
        pagination: false,
        navigationText: ["", ""],

        items: 5,
        animateOut: 'fadeOut',
    });

    //Закарываем ссылки он индекса
    $('.header-account a').click(function(){window.open($(this).data("link"));return false;});

});

// Фиксируем меню
var headHeight = 70; // высота шапки

$(window).on('scroll resize load', function() {
    if ($(this).scrollTop() > headHeight){
        $('.head_full').addClass('set-fixed');
        $('.head_pun_full').addClass('set-fixed');
    }else{
        $('.head_full').removeClass('set-fixed');
        $('.head_pun_full').removeClass('set-fixed');
    }
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
			navigationText: ["", ""],
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

        this.btn = this.form.find('.feedback-form-btn');
		this.tnxDiv = this.form.find('.js-feedback-tnx');

		this.form.submit(this.send);
	},
	send: function () {
		var form_data = Review.form.serialize();
		$.ajax({
			type: 'POST',
			url: '/ajax/add_review.php',
			data: form_data,
			dataType: 'json',
			success: function (ans) {
				if(ans.success)
				{
					dataLayer = window.dataLayer || [];
					dataLayer.push(ans.gtmObject);
                    Review.btn.hide();
                    Review.tnxDiv.show();
                }
				else
					$.fancybox('<div class="errors feedback-popup-content">' + ans.errors.join('<br>') + '</div>');
			}
		});
		return false;
	}
};

/**
 * Форма "задать вопрос"
 */
var Feedback = {
	init: function () {
		this.form = $('.feedback-form');
		if (!this.form.length)
			return false;

		this.btn = this.form.find('.feedback-form-btn');
		this.tnx = this.form.find('.js-submit-tnx');
		this.form.submit(this.send);
	},
	send: function () {
		var form_data = Feedback.form.serialize();
		$.ajax({
			type: 'POST',
			url: '/ajax/feedback.php',
			data: form_data,
			dataType: 'json',
			success: function (ans) {
                if(ans.success)
                {
                    dataLayer = window.dataLayer || [];
                    dataLayer.push(ans.gtmObject);
                    Feedback.btn.hide();
                    Feedback.tnx.show();
                }
                else
                    $.fancybox('<div class="errors feedback-popup-content">' + ans.errors.join('<br>') + '</div>');
			}
		});
		return false;
	}
};

/**
 * Форма обратного звонка
 */
var Callback = {
	init: function () {
		this.form = $('#callback-form');
		if (!this.form.length)
			return false;

		$('#people .btn').click(this.popup);
		this.manager = this.form.find('input[name=manager]');
		this.btn = this.form.find('.popup-btn');
		this.tnx = this.form.find('.js-submit-tnx');
		this.form.submit(this.send);
	},
	popup: function() {
		Callback.manager.val($(this).data('manager'));
	},
	send: function () {
		var form_data = Callback.form.serialize();
		$.ajax({
			type: 'POST',
			url: '/ajax/callback.php',
			data: form_data,
            dataType: 'json',
            success: function (ans) {
                if(ans.success)
                {
                    dataLayer = window.dataLayer || [];
                    dataLayer.push(ans.gtmObject);
                    Callback.btn.hide();
                    Callback.tnx.show();
                }
                else
                    $.fancybox('<div class="errors feedback-popup-content">' + ans.errors.join('<br>') + '</div>');
            }
		});
		return false;
	}
};

var engInputValid = {
    init: function () {
        this.engForm = $('form[data-form="bron"]');
        this.engFormBtn =  this.engForm.find($('[type="submit"]'));

    	this.inputName = this.engForm.find($('input[name="name"]'));
		this.inputNameLog = this.engForm.find($('[data-input="name"]'));
        this.inputNameValue = false;

        this.inputPhone = this.engForm.find($('input[name="phone"]'));
        this.inputPhoneLog = this.engForm.find($('[data-input="phone"]'));
        this.inputPhoneValue = false;

        this.inputName.keyup(this.itValidName);
        this.inputPhone.keyup(this.itValidPhone);

        this.engFormBtn.on('click', this.itClick);
    },
    log: function () {},
    itValidName: function () {
		if(engInputValid.inputName.val().length < 1){
            engInputValid.inputNameLog.text('Введите Имя');
            engInputValid.inputNameValue = false;
		}else{
            engInputValid.inputNameLog.text('');
            engInputValid.inputNameValue = true;
		};
    },
    itValidPhone: function () {
        if(engInputValid.inputPhone.val().length < 11){
            engInputValid.inputPhoneLog.text('Введите номер телефона (минимум 11 цифр)');
            engInputValid.inputPhoneValue = false;
        }else{
            engInputValid.inputPhoneLog.text('');
            engInputValid.inputPhoneValue = true;
        };
    },
    itClick: function () {
        engInputValid.itValidName();
        engInputValid.itValidPhone();

		if(engInputValid.inputNameValue == false){
			return false;
		}
	}
};

var FullCatalog = {
	delay: 1000,
	debug: false,
	debugName: 'FULL_CATALOG_POPUP',
	timerDelay: 60 * 2, //two minutes
	showed: false,
	counterName: 'FULL_CATALOG_POPUP_TIME_LEFT',
	cn: 'FULL_CATALOG_POPUP_SHOWED',
	interval: null,
	init: function () {
		this.popup = $('#elPopup-form');
		if (!this.popup.length)
		{
            this.debug && console.log(FullCatalog.debugName + ' => is not exists');
            return false;
        }

        if(this.debug)
        	this.timerDelay = 10;

		//setTimeout(this.showPopup, this.delay);
        this.interval = setInterval(this.showPopup, this.delay);
	},
	showPopup: function() {

        FullCatalog.showed = FullCatalog.getCookie(FullCatalog.cn) === true;

        //popup already showed
		if(FullCatalog.showed)
		{
            FullCatalog.debug && console.log(FullCatalog.debugName + ' => already showed');
            return false;
        }

		//get elapsed time or null if first run
		var timeLeft = FullCatalog.getCookie(FullCatalog.counterName)

		//timer already started
		if(timeLeft)
		{
			//time isn't end, wait next step
			if(--timeLeft)
			{
				//set elapsed time to cookie
                FullCatalog.setCookie(FullCatalog.counterName, timeLeft);
                FullCatalog.debug && console.log(FullCatalog.debugName + ' => Time --: ' + timeLeft);
            }
			else
			{
                FullCatalog.debug && console.log(FullCatalog.debugName + ' => Time end');
                //remove timer, show popup, set cookie showed
				clearInterval(FullCatalog.interval);
                $.fancybox.open(FullCatalog.popup); //Выводим
                FullCatalog.setCookie(FullCatalog.cn, true);
                FullCatalog.setCookie(FullCatalog.counterName, '', -1);

                $('.ajax_catalog_pdf').on('submit', function(e){
                	e.preventDefault();
                	var _form = $(this),
						btn = _form.find('button, input[type="submit"]').get(0);
                	BX.showWait(btn)
                	$.post(_form.attr('action'), _form.serialize(), function(ans) {
                		if(ans.errors)
						{
							for(var inp in ans.errors)
							{
                                _form.find('[name="' + inp + '"]').css({'border': '1px solid red'})
									.parent().find('.error').html(ans.errors[inp]);
							}
						}
						else
						{
							_form.find('input, textarea, select').css({'border': '1px solid #dcdcdc'});
							_form.find('.error').empty();
						}
						$.fancybox.close();
                        $.fancybox.open('<div class="success">Сообщение успешно отправлено</div>');
                        BX.closeWait(btn)
					}, 'json')
				})
			}
		}
		else
		{
            FullCatalog.debug && console.log(FullCatalog.debugName + ' => Time start');
            //set elapsed time
            FullCatalog.setCookie(FullCatalog.counterName, FullCatalog.timerDelay)
		}

		//FullCatalog.popup.show();

		//$.fancybox.close(); // Закрываем
	},
	setCookie: function (name, value, expires) {
		if(!expires)
		{
            var d = new Date();
            d.setTime(d.getTime() + 8640000000);
            expires = d.toUTCString();
        }
        document.cookie = name + '=' + value + '; path=/; expires=' + expires;
		/*var d = new Date();
		d.setTime(d.getTime() + 8640000000);
		document.cookie = FullCatalog.cn + "1; path=/; expires=" + d.toUTCString();*/
	},
	getCookie: function (name) {
        var arr = document.cookie.split(';');
        name += '=';
        for (var i = 0; i < arr.length; ++i) {
            var c = arr[i];
            while (c.charAt(0) == ' ')
				c = c.substring(1, c.length);
            if (c.indexOf(name) == 0)
            	return c.substring(name.length, c.length);
        }
        return null;
    },
    popupClosed: function() {
		//@TODO..

	},
	send: function () {
		FullCatalog.setCookie();
		/*var name = (Filters.q) ? "filter_groups_search=" : "filter_groups=";
		document.cookie = name + val + "; path=/; expires=" + d.toUTCString();
		var form_data = Callback.form.serialize();
		$.ajax({
			type: 'POST',
			url: '/ajax/callback.php',
			data: form_data,
			dataType: 'json',
			success: function (ans) {
				if(ans.success)
				{
					dataLayer = window.dataLayer || [];
					dataLayer.push(ans.gtmObject);
					Callback.btn.hide();
					Callback.tnx.show();
				}
				else
					$.fancybox('<div class="errors feedback-popup-content">' + ans.errors.join('<br>') + '</div>');
			}
		});*/
		return false;
	}
};


jQuery(document).ready(function () {
	SearchTop.init();
	Callback.init();
	Feedback.init();
	Review.init();
	SincSlider.init();
	PriceSlider.init();
	MobileMenu.init();
	SearchExtDisplay.init();

	engInputValid.init();
	FullCatalog.init();
	YaMap.init();

    _tabs.init(); /* Табы
	 ._tabs-nav : Стиль меню >li>a id ='val'
	 ._tabs : Табы переключения div id ='val'
	 */
});


var _tabs = {
    init: function () {
        this.tabs = $('._tabs');
        this.tabsNav = $('._tabs-nav');
        this.tabsContent = $('._tabs-content');

        this.tabsNav_ar = this.tabsNav.find('a');
        this.tabsContent_ar = this.tabsContent.find('._tab');

        _tabs.load();

        this.tabsNav_ar.each(function(index, element){
            $(element).on('click', _tabs.click);
        });
    },
    load: function () {
        _tabs.tabs.each(function(index, element){
            $(element).attr('_tabs-data-id',index);

            $(element).find('._tab').removeClass('active');

            if($(element).find('a.active').length !== Number(1)){
                $(element).find('a').removeClass('active');
                $(element).find('a').filter(':first').addClass('active');
            }

            var id = $(element).find('a.active').attr('href');
            $(element).find('._tab'+id).addClass('active');
        });
    },
    click: function (e){
        e.preventDefault();
        var id = $(this).attr("href"),
            tab = _tabs.tabsContent.find(id),
            tabs = tab.parents('._tabs[_tabs-data-id]');

        _tabs.update(tabs);

        $(this).addClass('active');
        tab.addClass('active');

    },
    update: function (_this) {
        _this.find('._tabs-nav a').removeClass('active');
        _this.find('._tabs-content ._tab').removeClass('active');
    }
};
// Карты

var YaMap = {
	init: function() {
		this.mapCont = $('#map_cont');
		if (!this.mapCont.length)
			return;

		this.titleCont = $('#cron-title h1');
		this.bcCont = $('#cron-crox');

		ymaps.ready(this.ready);
		$('.elMapsMenu a').click(this.aClick);
		this.bcCont.on('click', 'a', this.bcClick);

		$(window).on('popstate', function (e) {
			var url = e.target.location;
			YaMap.changeCity(url, false);
		});
	},
    ready: function() {
		//console.log(mapPM);
		YaMap.map = new ymaps.Map('map_cont', {
			center: [55.7652, 37.63836],
			zoom: 15,
			controls: []
		});
		YaMap.map.behaviors.disable('scrollZoom');
		YaMap.map.controls.add("zoomControl", {
			position: {top: 15, left: 15}
		});
		YaMap.map.events.add('click', function() {
			YaMap.map.balloon.close();
		});

		YaMap.showPoints();
	},
	aClick: function() {
		if ($(this).hasClass('active'))
			return false;

		var url = $(this).attr('href');
		$('.elMapsMenu a.active').removeClass('active');
		$(this).addClass('active');
		YaMap.changeCity(url, true);
		return false;
	},
	bcClick: function() {
		var url = $(this).attr('href');
		if (url != '/') {
			YaMap.changeCity(url, true);
			return false;
		}
	},
	changeCity: function(url, setHistory) {
		var parts = url.split('/');
		var city = citiesData[0];
		if (parts[2]) {
			city = citiesData[parts[2]];
			cityCode = parts[2]
		}
		else
			cityCode = '';
		document.title = city.TITLE;
		YaMap.titleCont.html(city.TITLE);
		YaMap.bcCont.html(city.BC);
		if (setHistory)
			history.pushState('', city.TITLE, url);

		YaMap.showPoints();
	},
	showPoints: function () {
		YaMap.map.geoObjects.removeAll();
		for (var city in mapPM) {
			if (city === cityCode || cityCode === '') {
				var ar = mapPM[city];
				for (var i in ar) {
					var item = ar[i];
					var html = ('' +
					'<div class="info-map">' +
					'<div class="img"><img src="' + item.img + '"></div>' +
					'<div class="name">' + item.name + '</div>' +
					'<div class="map">' + item.map + '</div>' +
					'<div class="footer">' +
					'<div class="left">' +
					'<div class="price">сутки <br><b>от ' + item.price + '</b></div>' +
					'</div>' +
					'<div class="right">' +
					'<a href="' + item.url + '" class="btn">Подробнее</a>' +
					'</div>' +
					'</div>' +
					'</div>');

					var pm = new ymaps.Placemark(
						[item.x, item.y],
						{balloonContent: html},
						{
							iconLayout: 'default#image',
							iconImageHref: '/images/YandexMap-point.png',
							iconImageSize: [27, 39],
							iconImageOffset: [-20, -47],
							balloonLayout: "default#imageWithContent",
							balloonContentSize: [289, 151],
							balloonImageHref: '/images/YandexMap-point.png',
							balloonImageSize: [27, 39],
							balloonImageOffset: [-20, -47],
							balloonShadow: false
						}
					);

					YaMap.map.geoObjects.add(pm);
				}
			}
		}
		YaMap.map.setBounds(YaMap.map.geoObjects.getBounds());
	}
};