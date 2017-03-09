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
		
		$(".filter_find").on('click', function(e) {
		    console.log(dfdf);
		    Filters.updateProducts();
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
		console.log(url);
		//location.href = "/event/?d-from=" + selectedDate;
	}
};

$(document).ready(function() {
	Filters.init();
});