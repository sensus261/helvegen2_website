$(document).ready(function(){
	$("#slider").Slider();

	$(".ranking-button").click(function () {
		$(".ranking").toggle("bounceslide");
	});
});