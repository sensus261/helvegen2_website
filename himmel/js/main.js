// Copyright (c)2013 Maino Development

$(document).ready(function() {

	$(document).ready(function(){ 
	    $("#slider").Slider();
	});

	$("#login_center, .login-btn").click(function(e) {
		if(!$(e.target).hasClass('login_link')) {
			e.preventDefault();
		}
		$("#login").fadeToggle();
	}).children().click(function(e) {
		if(!$(e.target).hasClass('login_link')) {
	 		return false;
	 	}
	});


});
