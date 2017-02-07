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

	$("#tabs").tabs();
	$("#tabs2").tabs();

	$(".various").fancybox({
		maxWidth: 800,
		maxHeight: 600,
		fitToView: false,
		width: '700',
		height: '600',
		autoSize: false,
		closeClick: false,
		beforeShow: function(){$(window).resize();$(window).resize();$(window).resize();$(window).resize();$(window).resize()}
	});
});