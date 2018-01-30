//show underline when nav item is pointed by mouse
$(".navigation-top * :not(.current)").hover(function () {
	if(!$(this).is(':animated')) {
		$(this).css({borderBottom: '0 solid #456dbc', fontWeight: 0}).animate({
	        borderWidth: 4,
	        fontWeight: 700
    	}, 200);
	}
}, function () {
     $(this).animate({
        borderWidth: 0,
        fontWeight: 0
    }, 200);
});
