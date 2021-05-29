$( document ).ready(function() {
    //ACCORDINN START
	$("a[href='#top']").click(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});
	
    $(".scroll-form .heading-sf").click(function(event) {
        var accordins_settings = document.getElementsByClassName("heading-sf");
        var i;
        for (i = 0; i < accordins_settings.length; i++) {
            $(accordins_settings[i]).removeClass("open");
        }
        $(this).toggleClass("open");

    });
    //ACCORDINN END
    //SLIDER START
    var slideIndex = 1;
    showSlides(slideIndex);
    $( ".pixarts-slider .pagination .right" ).click(function() {
        plusSlides(1);
    });
    $( ".pixarts-slider .pagination .left" ).click(function() {
        plusSlides(-1);
    });
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }
    function currentSlide(n) {
    showSlides(slideIndex = n);
    }
    function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("pixartsslider-item");
    if (n > slides.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        $(slides[i]).removeClass("active");
    }
    $(slides[slideIndex-1]).addClass("active");  
    $('.pixarts-slider .pagination .actual d').html('/0' +slides.length);
    $('.pixarts-slider .pagination .actual b').html(slideIndex);
    }
    //SLIDER END
    //VIDEO ANIMATION HEADER START
    var $video = $('video');
    videoElement = $video[0];
    $video.on('canplaythrough', playheadervideo);
    if (videoElement.readyState > 3) {
        playheadervideo();
    }
    function playheadervideo() {
        $("video.pixarts-header-video").addClass("play");
        videoElement.play();
    }
    //VIDEO ANIMATION HEADER END
});