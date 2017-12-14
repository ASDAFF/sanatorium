/**
 * Панель фильтров
 */
var Filters = {
	price_from: 0,
	price_to: 0,
	price_min: 0,
	price_max: 0,
	price: false,
	mfWidth: 0,
	curMfg: false,
	priceInputFl: false,
	init: function() {
		this.panel = $('#filters-panel');
		if (!this.panel.length)
			return;

		this.catalogPath = this.panel.find('input[name=catalog_path]').val();
		this.separator = this.panel.find('input[name=separator]').val();
		this.q = this.panel.find('input[name=q]').val();
		this.groups = this.panel.find('.filter-group');
		this.cb = this.panel.find('input[type=checkbox]');
		this.ajaxCont = $('#catalog-list');
		this.ajaxHeadCont = $('#catalog-head');
		this.bcCont = $('#cron-crox');
		this.h1Cont = $('#cron-title h1');

		this.priceInit();

		this.cb.click(this.checkboxClick);
		this.ajaxHeadCont.on('click', '#products-summary a', this.urlClick);
		this.ajaxCont.on('click', '#pagination a', this.urlClick);
		this.bcCont.on('click', 'a', this.urlClick);
		this.groups.find('.title').click(this.toggleGroup);

		$(window).on('popstate', function (e) {
			var url = e.target.location;
			Filters.loadProducts(url, false);
		});
	},
	priceInit: function() {
		this.priceSlider = $('#slider-range-ext');
		this.inputFrom = $("#ext-from");
		this.inputTo = $("#ext-to");
		this.price_min = 0;
		this.price_max = parseInt(this.priceSlider.data('max'));
		this.price_from = parseInt(this.inputFrom.text());
		this.price_to = parseInt(this.inputTo.text());

		this.priceSlider.slider({
			range: true,
			min: Filters.price_min,
			max: Filters.price_max,
			values: [Filters.price_from, Filters.price_to],
			step: 100,
			slide: Filters.priceChange,
			stop: Filters.priceStop
		});
	},
	priceChange: function (event, ui) {
		Filters.price_from = ui.values[0];
		Filters.price_to = ui.values[1];
		Filters.inputFrom.text(Filters.price_from);
		Filters.inputTo.text(Filters.price_to);
	},
	priceStop: function () {
		Filters.updateProducts();
	},
	priceCorrect: function(data) {
		Filters.price_from = data.FROM;
		Filters.price_to = data.TO;
		Filters.inputFrom.text(data.FROM);
		Filters.inputTo.text(data.TO);
		Filters.priceSlider.slider('values', [Filters.price_from, Filters.price_to]);
	},
	toggleGroup: function () {
		var gr = $(this).parent();
		var dropmenu = gr.children('.profiles');
		if (gr.hasClass('closed')) {
			gr.removeClass('closed');
			dropmenu.stop().fadeIn('slow', 'linear');
		}
		else {
			gr.addClass('closed')
			dropmenu.stop().fadeOut('slow', 'linear');
		}
		var val = '';
		Filters.groups.each(function() {
			var s = $(this).hasClass('closed') ? 1 : 0;
			val += s + ',';
		});
		var d = new Date();
		d.setTime(d.getTime() + 8640000000);
		var name = (Filters.q) ? "filter_groups_search=" : "filter_groups=";
		document.cookie = name + val + "; path=/; expires=" + d.toUTCString();
	},
	checkboxClick: function() {
		var input = $(this);
		Filters.updateCb(input);
	},
	updateCb: function(input) {
		var li = input.closest('li');
		var checked = input.prop('checked');
		if (checked)
			li.addClass('checked');
		else
			li.removeClass('checked');
		Filters.updateProducts();
	},
	updateProducts: function() {
		var url = Filters.catalogPath;
		Filters.groups.each(function() {
			var cb = $(this).find('input[type=checkbox]:checked');
			var part = '';
			cb.each(function() {
				if (part)
					part += Filters.separator;
				part += $(this).attr('name');
			});
			if (part)
				url += part + '/';
		});
		var params = '';
		if (Filters.q) {
			params += params ? '&' : '?';
			params += 'q=' + Filters.q;
		}
		if (Filters.price_from <= Filters.price_to) {
			if (Filters.price_from > Filters.price_min) {
				params += params ? '&' : '?';
				params += 'p-from=' + Filters.price_from;
			}
			if (Filters.price_to < Filters.price_max) {
				params += params ? '&' : '?';
				params += 'p-to=' + Filters.price_to;
			}
		}
		url += params;
		Filters.loadProducts(url, true);
	},
	loadProducts: function(url, setHistory) {
		$.post(url, {
			'mode': 'ajax'
		}, function (resp) {
			Filters.ajaxCont.html(resp.HTML);
			Filters.ajaxHeadCont.html(resp.HEAD);
			for (var i in resp.FILTERS) {
				if (i == 'PRICE') {
					Filters.priceCorrect(resp.FILTERS[i]);
				}
				else {
					var cnt = resp.FILTERS[i][0];
					var checked = resp.FILTERS[i][1];
					var cb = Filters.panel.find('input[name=' + i + ']');
					var li = cb.closest('li');
					cb.prop('checked', checked);
					if (checked)
						li.addClass('checked');
					else
						li.removeClass('checked');
					if (cnt) {
						cb.prop('disabled', false);
						li.removeClass('disabled');
						//li.stop().slideDown();
					}
					else {
						cb.prop('disabled', true);
						li.addClass('disabled');
						//li.stop().slideUp();
					}
					cb.checkboxradio('refresh');
					cb.siblings('i').text(cnt);
				}
			}

			document.title = resp.TITLE;
			if (setHistory)
				history.pushState('', resp.TITLE, url);

			Filters.q = resp.SEARCH;

			return false;
		});
	},
	urlClick: function() {
		var url = $(this).attr('href');
		if (url == '/')
			return true;

		Filters.loadProducts(url, true);
		return false;
	}
};

/**
 * Карточка товара и быстрый просмотр
 */
var Detail = {
	productId: 0,
	map: false,

	init: function() {
		this.tabs = $('#content-menu-show');
		if (this.tabs.length) {
			this.productId = this.tabs.data('id');
			this.h1TabSpan = $('.js-tab-name');
			this.bcDetail = $('.js-bc-detail');
			this.bcSep = $('.js-bc-sep');
			this.bcLast = $('.js-bc-last');
			this.productName = this.bcDetail.text();

			this.reserveFormInit();

			this.calcInit();

			// Переключение табов при клике
			this.tabs.find('a').click(this.tabClick);
			// Переключение табов по событию хождения по истории
			$(window).on('popstate', this.popstate);
			// На первую вкладку
			this.bcDetail.click(this.toMainTab);

			$('.el-nomer a').click(this.showPopup);

			if (typeof ymaps != 'undefined')
				ymaps.ready(this.mapInit);
		}
		this.showSlider();
		this.ProgramsPopup();
	},

	reserveFormInit: function () {
		this.reserveForm = $('#formx');
		this.reserveResult = $('#bronx');

		this.inputName = this.reserveForm.find($('input[name="name"]'));
		this.inputNameLog = this.reserveForm.find($('[data-input="name"]'));
		this.inputNameValue = false;

		this.inputPhone = this.reserveForm.find($('input[name="phone"]'));
		this.inputPhoneLog = this.reserveForm.find($('[data-input="phone"]'));
		this.inputPhoneValue = false;

		this.inputName.keyup(this.itValidName);
		this.inputPhone.keyup(this.itValidPhone);
		this.reserveForm.on('click', '._form-check-btn .btn', this.reserve);
	},
	itValidName: function () {
		if (Detail.inputName.val().length < 1) {
			Detail.inputNameLog.text('Введите Имя');
			Detail.inputNameValue = false;
		} else {
			Detail.inputNameLog.text('');
			Detail.inputNameValue = true;
		}
	},
	itValidPhone: function () {
		if (Detail.inputPhone.val().length < 11) {
			Detail.inputPhoneLog.text('Введите номер телефона (минимум 11 цифр)');
			Detail.inputPhoneValue = false;
		} else {
			Detail.inputPhoneLog.text('');
			Detail.inputPhoneValue = true;
		}
	},

	popstate: function (e) {
		var href = e.target.location.pathname;
		var ar = href.split('/');
		var code = ar[1];
		if (code === '')
			code = 'main';
		var a = $('#tabs a#tab-' + code + ':first');
		var li = a.parent();
		if (!li.is('.active')) {
			Detail.showTab(a, li);
		}
	},

	goTab: function(a) {
		var li = a.parent();
		if (!li.is('.active')) {
			var url = a.attr('href');
			if (url !== location.pathname)
				history.pushState('', '', url);
			Detail.showTab(a, li);
		}
	},

	tabClick: function () {
		var a = $(this);
		Detail.goTab(a);
		return false;
	},

	toMainTab: function () {
		var a = Detail.tabs.find('a:first');
		Detail.goTab(a);
		return false;
	},

	showPopup: function() {
		var a = $(this);
		if (a.hasClass('btn')) {
			var roomId = a.data('id');
			Detail.reserveForm.find('select[name="room"]').val(roomId).selectmenu('refresh');
			Detail.reserveForm.find('input[name="name"]').focus();
			$('html, body').animate({scrollTop: $(Detail.reserveForm).offset().top - 100}, 500);
		}
		else {
			var item = $(this).closest('.item');
			var popup = item.children('.okno');
			$.fancybox.open(popup);
		}
		return false;
	},

	showSlider: function(){
		$(".popap-slider").owlCarousel({
			navigation: true,
			singleItem: true,
			navigationText: ["", ""],
			transitionStyle: "fade"
		});
	},

	ProgramsPopup: function(){
		$('.preview-text a').on('click', function(e) {
			e.preventDefault();
			$.fancybox({
				content: $(this).parent().parent().find('.detail-text'),
				padding: '0',
				helpers: {
					overlay: {
					  locked: true
					}
				}
			})
		});
	},

	showTab: function(a, li) {
		var id = a.data('id');
		var tab = $(id);
		li.addClass('active').siblings('.active').removeClass('active');
		tab.addClass('active').siblings('.active').removeClass('active');
		var tabSpan = '';
		var tabName = Detail.productName;
		if (id !== '#main') {
			tabName = a.text();
			tabSpan = ': ' + tabName;
			Detail.bcDetail.show();
			Detail.bcSep.show();
		}
		else {
			Detail.bcDetail.hide();
			Detail.bcSep.hide();
		}
		Detail.h1TabSpan.text(tabSpan);
		Detail.bcLast.text(tabName);

		document.title = li.data('title');

		if (tab.is('.empty')) {
			$.get('/ajax/detail_tab.php?tab=' + tab.attr('id') + '&id=' + Detail.productId, function (html) {
				tab.html(html);
				tab.removeClass('empty');
				Detail.showSlider();
				Detail.ProgramsPopup();
				Detail.mapInit();
			});
		}
	},
	reserve: function() {

		Detail.itValidName();
		Detail.itValidPhone();

		if (!Detail.inputNameValue || !Detail.inputPhoneValue)
			return false;

		var form_data = Detail.reserveForm.serialize();
		$.ajax({
			type: 'POST',
			url: '/ajax/reserve_room.php',
			data: form_data,
			dataType: 'json',
			success: function(data) {
                if(data.success)
                {
                    dataLayer = window.dataLayer || [];
                    dataLayer.push(data.gtmObject);
                    Detail.reserveForm[0].reset();
                    Detail.reserveResult.html(data.message).show();
                }
                else
                    $.fancybox('<div class="errors feedback-popup-content">' + data.errors.join('<br>') + '</div>');
			}
		});

		return false;
	},
	mapInit: function () {
		if (typeof(yMapPoint) === 'undefined' || yMapPoint.length < 2)
			return false;

		if (Detail.map !== false)
			return true;

		Detail.map = new ymaps.Map("dmap", {
			center: yMapPoint,
			zoom: 17
		});
		Detail.pm = new ymaps.Placemark(yMapPoint, {
			iconContent: '',
			balloonContent: Detail.productName,
			hintContent: Detail.productName
		}, {
			preset: 'twirl#violetIcon'
		});
		Detail.map.geoObjects.add(Detail.pm);
	},
	calcInit: function() {

		this.priceForm = $('#price-form');
		if (!this.priceForm.length)
			return false;

		this.reserveResults = this.priceForm.find('#reserve-results');

		this.dateFrom = this.priceForm.find('#datepicker');
		this.dateTo = this.priceForm.find('#datepicker2');

		this.resPersons = this.priceForm.find('.js-persons');
		this.resSum = this.priceForm.find('.js-sum');
		this.firstPerson = this.priceForm.find('.first-person');
		this.otherPersons = this.priceForm.find('.other-persons');
		this.peopleCount = this.priceForm.find('#count-people');
		this.calcSubmit = this.priceForm.find('#calc-submit');
		this.peopleCount.on('input', this.peopleCountChange);
		this.otherPersons.on('click', '.people-delete', this.deletePeople);
		this.priceForm.on('change', '.js-age', this.fieldChange);
		this.priceForm.on('change', '.js-room', this.fieldChange);
		this.priceForm.on('change', '.js-place', this.fieldChange);
		this.priceForm.on('change', '.js-programm', this.calculate);
		this.priceForm.on('submit', this.submitCalc);

		this.priceForm.find("#numb-phone").mask("+7(999) 999-9999");

		$.datepicker.regional['ru'] = {
			closeText: 'Закрыть',
			prevText: '&#x3c;Пред',
			nextText: 'След&#x3e;',
			currentText: 'Сегодня',
			monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
				'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
			monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн',
				'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
			dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
			dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
			dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
			dateFormat: 'dd.mm.yy',
			firstDay: 1,
			//maxDate: '25.12.2017',
			isRTL: false,
			onSelect: function() {
				Detail.calculate();
			}
		};
		$.datepicker.setDefaults($.datepicker.regional['ru']);

		this.dateFrom.datepicker();
		this.dateTo.datepicker();

		Detail.calculate();
	},
	peopleCountChange: function() {
		var count = Detail.peopleCount.val();
		if (count > 6)
			count = 6;
		else if (count < 1)
			count = 1;

		var curCount = Detail.otherPersons.children().length + 1;

		if (count > curCount) {
			var original = Detail.otherPersons.children('.form-body:last');
			if (!original.length)
				original = Detail.firstPerson.children('.form-body:last');
			for (var i = curCount; i < count; i++) {
				Detail.otherPersons.append(original.clone());
				var block = Detail.otherPersons.children('.form-body:last');
				Detail.correctBlock(block);
			}
		}
		else if (count < curCount) {
			for (var j = count; j < curCount; j++) {
				Detail.otherPersons.children('.form-body:last').remove();
			}
		}
		Detail.calculate();
	},
	deletePeople: function() {
		var count = Detail.peopleCount.val() - 1;
		Detail.peopleCount.val(count);
		$(this).closest('.form-body').remove();
		Detail.calculate();
	},
	fieldChange: function() {
		var block = $(this).closest('.form-body');
		Detail.correctBlock(block);
		Detail.calculate();
	},
	correctBlock: function(block) {
		var age = block.find('.js-age').val();
		var roomSelect = block.find('.js-room');
		var room = roomSelect.val();
		var placeSelect = block.find('.js-place');
		var place = placeSelect.val();
		var progSelect = block.find('.js-programm');
		var prog = progSelect.val();

		// Номер
		var availRooms = roomsByAge[age];
		if (!availRooms[room]) {
			roomSelect.val(0);
			room = 0;
		}
		roomSelect.children('option').each(function() {
			var v = $(this).val();
			if (v) {
				if (availRooms[v]) {
					if ($(this).prop('disabled'))
						$(this).removeAttr('disabled');
				}
				else {
					if (!$(this).prop('disabled'))
						$(this).prop('disabled', 'disabled');
				}
			}
		});

		// Размещение
		var availPlaces = placeByAgeRoom[age + '|' + room];
		if (!availPlaces[place]) {
			if (availPlaces['M'])
				place = 'M';
			else if (availPlaces['A'])
				place = 'A';
			placeSelect.val(place);
		}
		placeSelect.children('option').each(function() {
			var v = $(this).val();
			if (availPlaces[v]) {
				if ($(this).prop('disabled'))
					$(this).removeAttr('disabled');
			}
			else {
				if (!$(this).prop('disabled'))
					$(this).prop('disabled', 'disabled');
			}
		});

		// Программа
		var availProg = programmByAgeRoomPlace[age + '|' + room + '|' + place];
		if (!availProg[prog]) {
			progSelect.val(0);
		}
		progSelect.children('option').each(function() {
			var v = $(this).val();
			if (v) {
				if (availProg[v]) {
					if ($(this).prop('disabled'))
						$(this).removeAttr('disabled');
				}
				else {
					if (!$(this).prop('disabled'))
						$(this).prop('disabled', 'disabled');
				}
			}
		});
	},
	calculate: function() {
		Detail.correct = true;
		var result = 0;
		var cnt0 = 0;
		var cnt1 = 0;

		var from = Detail.dateFrom.datepicker('getDate');
		var to = Detail.dateTo.datepicker('getDate');

		if (!from || !to)
			Detail.correct = false;

		if (Detail.correct) {
			var d = to - from;
			if (d < 0)
				Detail.correct = false;
		}

		if (Detail.correct) {
			var days = from.getDate();

			var di = d / 86400000;
			var dates = [];
			for (var i = 0; i <= di; i++) {
				from.setDate(days + i);
				var m1 = from.getMonth() + 1;
				var d1 = from.getDate();
				dates.push([d1, m1]);
			}

			var datesLength = dates.length;
			if (datesLength <= 0)
				Detail.correct = false;
		}

		if (Detail.correct) {
			Detail.priceForm.find('.who-you-are').each(function () {
				var age = $(this).find('.js-age').val();
				var room = $(this).find('.js-room').val();
				var point = $(this).find('.js-place').val();
				var programm = $(this).find('.js-programm').val();
				var priceIndex = point;
				if (age !== '0') {
					priceIndex += age;
					cnt1++;
				}
				else
					cnt0++;

				var personCorrect = true;
				var roomPrices = prices[room];
				if (roomPrices) {
					var progPrices = roomPrices[programm];
					if (progPrices) {
						for (var dm = 0; dm < datesLength; dm++) {
							var d2 = dates[dm][0];
							var m2 = dates[dm][1];
							var dateCorrect = false;
							for (var int in progPrices) {
								if (progPrices.hasOwnProperty(int)) {
									var intPrices = progPrices[int];
									var intSplit = int.split('-');
									var intFrom = intSplit[0];
									var intFromSplit = intFrom.split('.');
									var intTo = intSplit[1];
									var intToSplit = intTo.split('.');
									var intFromD = parseInt(intFromSplit[0]);
									var intFromM = parseInt(intFromSplit[1]);
									var intToD = parseInt(intToSplit[0]);
									var intToM = parseInt(intToSplit[1]);
									if (Detail.dateInInt(d2, m2, intFromD, intFromM, intToD, intToM)) {
										if (intPrices.hasOwnProperty(priceIndex)) {
											var price1 = intPrices[priceIndex];
											result = result + price1;
											dateCorrect = true;
										}
										break;
									}
								}
							}
							if (!dateCorrect)
								personCorrect = false;
						}
					}
					else
						personCorrect = false;
				}
				else
					personCorrect = false;

				if (!personCorrect)
					Detail.correct = false;
			});
		}

		/*Detail.calcSubmit.prop('disabled', !Detail.correct);
		if (Detail.correct)
			Detail.calcSubmit.removeClass('disabled');
		else
			Detail.calcSubmit.addClass('disabled');*/

		var resPersons = '';
		if (cnt0 > 0) {
			if (cnt0 === 1)
				resPersons = '1 взрослый';
			else
				resPersons = cnt0 + ' взрослых';
		}
		if (cnt1 > 0) {
			if (resPersons)
				resPersons += ', ';
			if (cnt1 === 1)
				resPersons += '1 ребёнок';
			else
				resPersons += cnt1 + ' детей';
		}

		if (Detail.correct) {
			Detail.resPersons.html(resPersons);
			var resSum = 'сумма ' + result + ' руб.';
			Detail.resSum.html(resSum);
		}
		else {
			Detail.resPersons.html('');
			Detail.resSum.html('');
		}
	},
	dateInInt: function(d, m, d1, m1, d2, m2) {
		var NY = Detail.dateCmp(d1, m1, d2, m2) < 0;
		var cmp1 = Detail.dateCmp(d, m, d1, m1);
		var cmp2 = Detail.dateCmp(d, m, d2, m2);
		if (NY) {
			if (cmp1 <= 0 || cmp2 >= 0)
				return true;
		}
		else {
			if (cmp1 <= 0 && cmp2 >= 0)
				return true;
		}

		return false;
	},
	dateCmp: function(d1, m1, d2, m2) {
		if (m1 > m2)
			return -2;
		else if (m1 < m2)
			return 2;
		else if (d1 > d2)
			return -1;
		else if (d1 < d2)
			return 1;
		else
			return 0;
	},
	submitCalc: function() {
		var form_data = Detail.priceForm.serialize();
		$.ajax({
			type: 'POST',
			url: '/ajax/reserve_room.php',
			data: form_data,
			dataType: 'json',
			success: function(data) {
				if(data.success)
				{
					dataLayer = window.dataLayer || [];
					dataLayer.push(data.gtmObject);
					Detail.priceForm[0].reset();
					Detail.reserveResults.html(data.message).show();
				}
				else
					$.fancybox('<div class="errors feedback-popup-content">' + data.errors.join('<br>') + '</div>');
			}
		});

		return false;
	}
};

/**
 * Калькулятор на вкладке бронирование
 */
var TabCalc = {

	init: function() {
		this.tabs = $('#content-menu-show');
		if (this.tabs.length)
			this.calcInit();
	},

	calcInit: function() {

		this.priceForm = $('#price-form-tab');
		if (!this.priceForm.length)
			return false;

		this.reserveResults = this.priceForm.find('#reserve-results');

		this.dateFrom = this.priceForm.find('#datepicker');
		this.dateTo = this.priceForm.find('#datepicker2');

		this.resPersons = this.priceForm.find('.js-persons');
		this.resSum = this.priceForm.find('.js-sum');
		this.firstPerson = this.priceForm.find('.first-person');
		this.otherPersons = this.priceForm.find('.other-persons');
		this.peopleCount = this.priceForm.find('#count-people');
		this.calcSubmit = this.priceForm.find('#calc-submit');
		this.peopleCount.on('input', this.peopleCountChange);
		this.otherPersons.on('click', '.people-delete', this.deletePeople);
		this.priceForm.on('change', '.js-age', this.fieldChange);
		this.priceForm.on('change', '.js-room', this.fieldChange);
		this.priceForm.on('change', '.js-place', this.fieldChange);
		this.priceForm.on('change', '.js-programm', this.calculate);
		this.priceForm.on('submit', this.submitCalc);

		this.priceForm.find("#numb-phone").mask("+7(999) 999-9999");

		$.datepicker.regional['ru'] = {
			closeText: 'Закрыть',
			prevText: '&#x3c;Пред',
			nextText: 'След&#x3e;',
			currentText: 'Сегодня',
			monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
				'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
			monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн',
				'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
			dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
			dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
			dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
			dateFormat: 'dd.mm.yy',
			firstDay: 1,
			//maxDate: '25.12.2017',
			isRTL: false,
			onSelect: function() {
				TabCalc.calculate();
			}
		};
		$.datepicker.setDefaults($.datepicker.regional['ru']);

		this.dateFrom.datepicker();
		this.dateTo.datepicker();

		TabCalc.calculate();
	},
	peopleCountChange: function() {
		var count = TabCalc.peopleCount.val();
		if (count > 6)
			count = 6;
		else if (count < 1)
			count = 1;

		var curCount = TabCalc.otherPersons.children().length + 1;

		if (count > curCount) {
			var original = TabCalc.otherPersons.children('.form-body:last');
			if (!original.length)
				original = TabCalc.firstPerson.children('.form-body:last');
			for (var i = curCount; i < count; i++) {
				TabCalc.otherPersons.append(original.clone());
				var block = TabCalc.otherPersons.children('.form-body:last');
				TabCalc.correctBlock(block);
			}
		}
		else if (count < curCount) {
			for (var j = count; j < curCount; j++) {
				TabCalc.otherPersons.children('.form-body:last').remove();
			}
		}
		TabCalc.calculate();
	},
	deletePeople: function() {
		var count = TabCalc.peopleCount.val() - 1;
		TabCalc.peopleCount.val(count);
		$(this).closest('.form-body').remove();
		TabCalc.calculate();
	},
	fieldChange: function() {
		var block = $(this).closest('.form-body');
		TabCalc.correctBlock(block);
		TabCalc.calculate();
	},
	correctBlock: function(block) {
		var age = block.find('.js-age').val();
		var roomSelect = block.find('.js-room');
		var room = roomSelect.val();
		var placeSelect = block.find('.js-place');
		var place = placeSelect.val();
		var progSelect = block.find('.js-programm');
		var prog = progSelect.val();

		// Номер
		var availRooms = roomsByAge[age];
		if (!availRooms[room]) {
			roomSelect.val(0);
			room = 0;
		}
		roomSelect.children('option').each(function() {
			var v = $(this).val();
			if (v) {
				if (availRooms[v]) {
					if ($(this).prop('disabled'))
						$(this).removeAttr('disabled');
				}
				else {
					if (!$(this).prop('disabled'))
						$(this).prop('disabled', 'disabled');
				}
			}
		});

		// Размещение
		var availPlaces = placeByAgeRoom[age + '|' + room];
		if (!availPlaces[place]) {
			if (availPlaces['M'])
				place = 'M';
			else if (availPlaces['A'])
				place = 'A';
			placeSelect.val(place);
		}
		placeSelect.children('option').each(function() {
			var v = $(this).val();
			if (availPlaces[v]) {
				if ($(this).prop('disabled'))
					$(this).removeAttr('disabled');
			}
			else {
				if (!$(this).prop('disabled'))
					$(this).prop('disabled', 'disabled');
			}
		});

		// Программа
		var availProg = programmByAgeRoomPlace[age + '|' + room + '|' + place];
		if (!availProg[prog]) {
			progSelect.val(0);
		}
		progSelect.children('option').each(function() {
			var v = $(this).val();
			if (v) {
				if (availProg[v]) {
					if ($(this).prop('disabled'))
						$(this).removeAttr('disabled');
				}
				else {
					if (!$(this).prop('disabled'))
						$(this).prop('disabled', 'disabled');
				}
			}
		});
	},
	calculate: function() {
		TabCalc.correct = true;
		var result = 0;
		var cnt0 = 0;
		var cnt1 = 0;

		var from = TabCalc.dateFrom.datepicker('getDate');
		var to = TabCalc.dateTo.datepicker('getDate');

		if (!from || !to)
			TabCalc.correct = false;

		if (TabCalc.correct) {
			var d = to - from;
			if (d < 0)
				TabCalc.correct = false;
		}

		if (TabCalc.correct) {
			var days = from.getDate();

			var di = d / 86400000;
			var dates = [];
			for (var i = 0; i <= di; i++) {
				from.setDate(days + i);
				var m1 = from.getMonth() + 1;
				var d1 = from.getDate();
				dates.push([d1, m1]);
			}

			var datesLength = dates.length;
			if (datesLength <= 0)
				TabCalc.correct = false;
		}

		if (TabCalc.correct) {
			TabCalc.priceForm.find('.who-you-are').each(function () {
				var age = $(this).find('.js-age').val();
				var room = $(this).find('.js-room').val();
				var point = $(this).find('.js-place').val();
				var programm = $(this).find('.js-programm').val();
				var priceIndex = point;
				if (age !== '0') {
					priceIndex += age;
					cnt1++;
				}
				else
					cnt0++;

				var personCorrect = true;
				var roomPrices = prices[room];
				if (roomPrices) {
					var progPrices = roomPrices[programm];
					if (progPrices) {
						for (var dm = 0; dm < datesLength; dm++) {
							var d2 = dates[dm][0];
							var m2 = dates[dm][1];
							var dateCorrect = false;
							for (var int in progPrices) {
								if (progPrices.hasOwnProperty(int)) {
									var intPrices = progPrices[int];
									var intSplit = int.split('-');
									var intFrom = intSplit[0];
									var intFromSplit = intFrom.split('.');
									var intTo = intSplit[1];
									var intToSplit = intTo.split('.');
									var intFromD = parseInt(intFromSplit[0]);
									var intFromM = parseInt(intFromSplit[1]);
									var intToD = parseInt(intToSplit[0]);
									var intToM = parseInt(intToSplit[1]);
									if (TabCalc.dateInInt(d2, m2, intFromD, intFromM, intToD, intToM)) {
										if (intPrices.hasOwnProperty(priceIndex)) {
											var price1 = intPrices[priceIndex];
											result = result + price1;
											dateCorrect = true;
										}
										break;
									}
								}
							}
							if (!dateCorrect)
								personCorrect = false;
						}
					}
					else
						personCorrect = false;
				}
				else
					personCorrect = false;

				if (!personCorrect)
					TabCalc.correct = false;
			});
		}

		/*TabCalc.calcSubmit.prop('disabled', !TabCalc.correct);
		 if (TabCalc.correct)
		 TabCalc.calcSubmit.removeClass('disabled');
		 else
		 TabCalc.calcSubmit.addClass('disabled');*/

		var resPersons = '';
		if (cnt0 > 0) {
			if (cnt0 === 1)
				resPersons = '1 взрослый';
			else
				resPersons = cnt0 + ' взрослых';
		}
		if (cnt1 > 0) {
			if (resPersons)
				resPersons += ', ';
			if (cnt1 === 1)
				resPersons += '1 ребёнок';
			else
				resPersons += cnt1 + ' детей';
		}

		if (TabCalc.correct) {
			TabCalc.resPersons.html(resPersons);
			var resSum = 'сумма ' + result + ' руб.';
			TabCalc.resSum.html(resSum);
		}
		else {
			TabCalc.resPersons.html('');
			TabCalc.resSum.html('');
		}
	},
	dateInInt: function(d, m, d1, m1, d2, m2) {
		var NY = TabCalc.dateCmp(d1, m1, d2, m2) < 0;
		var cmp1 = TabCalc.dateCmp(d, m, d1, m1);
		var cmp2 = TabCalc.dateCmp(d, m, d2, m2);
		if (NY) {
			if (cmp1 <= 0 || cmp2 >= 0)
				return true;
		}
		else {
			if (cmp1 <= 0 && cmp2 >= 0)
				return true;
		}

		return false;
	},
	dateCmp: function(d1, m1, d2, m2) {
		if (m1 > m2)
			return -2;
		else if (m1 < m2)
			return 2;
		else if (d1 > d2)
			return -1;
		else if (d1 < d2)
			return 1;
		else
			return 0;
	},
	submitCalc: function() {
		var form_data = TabCalc.priceForm.serialize();
		$.ajax({
			type: 'POST',
			url: '/ajax/reserve_room.php',
			data: form_data,
			dataType: 'json',
			success: function(data) {
				if(data.success)
				{
					dataLayer = window.dataLayer || [];
					dataLayer.push(data.gtmObject);
					TabCalc.priceForm[0].reset();
					TabCalc.reserveResults.html(data.message).show();
				}
				else
					$.fancybox('<div class="errors feedback-popup-content">' + data.errors.join('<br>') + '</div>');
			}
		});

		return false;
	}
};

/**
 * Старт
 */
$(document).ready(function() {
	Filters.init();
	Detail.init();
	TabCalc.init();
});