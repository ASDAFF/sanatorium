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
			pull_2.text('Свернуть');
		} else {
			menu_2.css("height", "20px");
			value = 0;
			pull_2.text('Развернуть');
		}
	});

	//$("#tabs").tabs();
	$("#tabs2").tabs();

});

$(function() {
 	$(window).scroll(function() {
		if($(this).scrollTop() != 0) {
	$('.to-top').fadeIn();
		} else {
	$('.to-top').fadeOut();
}
});
	$('.to-top').click(function() {
	$('body,html').animate({scrollTop:0},800);
});
});


$(function() {
	$("#head li:has(ul)").addClass("menu_parent");
    $(".menu_parent").click(
      function(){
        $(this).find(">ul").toggleClass("menu_expanded");
        $(this).toggleClass("menu_parent_exp");
      }
    )  
});