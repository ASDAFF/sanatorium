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
		this.ajaxCont.on('click', '#current-filters a', this.urlClick);
		this.ajaxCont.on('click', '.pagination a', this.urlClick);
		this.bcCont.on('click', 'a', this.urlClick);

		$(window).on('popstate', function (e) {
			var url = e.target.location;
			Filters.loadProducts(url, false);
		});
	},
	priceInit: function() {
		this.priceGroup = $('.price-group');
		this.inputFrom = this.priceGroup.find('.from');
		this.inputTo = this.priceGroup.find('.to');
		this.price_from = this.inputFrom.val();
		this.price_to = this.inputTo.val();
		this.price_min = this.priceGroup.data('min');
		this.price_max = this.priceGroup.data('max');

		if (this.price_min == this.price_max)
			return;

		this.inputFrom.on('change', Filters.priceChange);
		this.inputTo.on('change', Filters.priceChange);
	},
	priceChange: function() {
		Filters.price_from = Filters.inputFrom.val();
		Filters.price_to = Filters.inputTo.val();
		//Filters.updateProducts();
	},
	priceCorrect: function(data) {
		Filters.price_from = data.FROM;
		Filters.price_to = data.TO;
		Filters.inputFrom.val(data.FROM);
		Filters.inputTo.val(data.TO);
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
		var tabs = $('#tabs');
		if (tabs.length) {
			this.productId = tabs.data('id');
			tabs.find('a').click(function () {
				var li = $(this).parent();
				if (!li.is('.active')) {
					var url = $(this).attr('href');
					history.pushState('', '', url);
					Detail.showTab($(this), li);
				}

				return false;
			});
			// Событие хождения по истории
			$(window).on('popstate', function (e) {
				var href = e.target.location.pathname;
				var a = $('ul#tabs a[href="' + href + '"]');
				var li = a.parent();
				if (!li.is('.active')) {
					Detail.showTab(a, li);
				}
			});
		}
	},
	showTab: function(a, li) {
		var id = a.data('id');
		var tab = $(id);
		li.addClass('active').siblings('.active').removeClass('active');
		tab.addClass('active').siblings('.active').removeClass('active');

		if (tab.is('.empty')) {
			$.get('/ajax/detail_tab.php?tab=' + tab.attr('id') + '&id=' + Detail.productId, function (html) {
				tab.html(html);
				tab.removeClass('empty');
			});
		}
	}
};

$(document).ready(function() {
	Filters.init();
	Detail.init();
});