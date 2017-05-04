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
		this.bcCont = $('#cron-crox');
		this.h1Cont = $('#cron-title h1');

		this.priceInit();

		this.cb.click(this.checkboxClick);
		this.ajaxCont.on('click', '#products-summary a', this.urlClick);
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
		var name = (Filters.q) ? "filter_groups=" : "filter_groups_search=";
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
			Filters.bcCont.html(resp.BC);
			Filters.h1Cont.html(resp.H1);
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
	init: function() {
		this.tabs = $('#content-menu-show');
		if (this.tabs.length) {
			this.reserveForm = $('#formx');
			this.reserveResult = $('#bronx');
			this.productId = this.tabs.data('id');
			this.h1TabSpan = $('.js-tab-name');
			this.bcDetail = $('.js-bc-detail');
			this.bcSep = $('.js-bc-sep');
			this.bcLast = $('.js-bc-last');
			this.productName = this.bcDetail.text();

			this.reserveForm.on('submit', this.reserve);


			// Переключение табов при клике
			this.tabs.find('a').click(this.tabClick);
			// Переключение табов по событию хождения по истории
			$(window).on('popstate', this.popstate);
			// На первую вкладку
			this.bcDetail.click(this.toMainTab);

			if (typeof ymaps != 'undefined')
				ymaps.ready(this.mapInit);
		}
		this.showSlider();
		this.ProgramsPopup();
	},

	popstate: function (e) {
		var href = e.target.location.pathname;
		var a = $('ul#tabs a[href="' + href + '"]');
		var li = a.parent();
		if (!li.is('.active')) {
			Detail.showTab(a, li);
		}
	},

	goTab: function(a) {
		var li = a.parent();
		if (!li.is('.active')) {
			var url = a.attr('href');
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
		if (id != '#main') {
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
			});
		}
	},
	reserve: function() {
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
		if (yMapPoint.length < 2)
			return false;

		this.map = new ymaps.Map("map", {
			center: yMapPoint,
			zoom: 17
		});
		this.pm = new ymaps.Placemark(yMapPoint, {
			iconContent: '1',
			balloonContent: 'Балун',
			hintContent: 'Стандартный значок метки'
		}, {
			preset: 'twirl#violetIcon'
		});
		this.map.geoObjects.add(this.pm);
	}
};

/**
 * Старт
 */
$(document).ready(function() {
	Filters.init();
	Detail.init();
});