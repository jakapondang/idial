
jQuery(document).ready(function() {
	/*
        Background slideshowurl(../img/BgPurple.jpg) 50% 10%
    */
    $('.coming-soon').backstretch([
      "assets/cs/img/backgrounds/iphone5-banner-landing-page-top.png" 
	 , "assets/cs/img/backgrounds/ipad.jpg"
	, "assets/cs/img/backgrounds/iphone5s3.jpg"
    , "assets/cs/img/backgrounds/iphone5c.jpg"
	, "assets/cs/img/backgrounds/iphone5c-1.jpg"
	, "assets/cs/img/backgrounds/iphone5c-2.jpg"
	, "assets/cs/img/backgrounds/iphone5c-3.jpg"
	, "assets/cs/img/backgrounds/iphone5c-4.jpg"
    ], {duration: 4000, fade: 750});

    /*
        Countdown initializer
    */
    var now = new Date();
    var countTo = 25 * 24 * 60 * 60 * 1000 + now.valueOf();
    $('.timer').countdown(countTo, function(event) {
        var $this = $(this);
        switch(event.type) {
            case "seconds":
            case "minutes":
            case "hours":
            case "days":
            case "weeks":
            case "daysLeft":
                $this.find('span.'+event.type).html(event.value);
                break;
            case "finished":
                $this.hide();
                break;
        }
    });

    /*
        Tooltips
    */
    $('.social a.facebook').tooltip();
    $('.social a.twitter').tooltip();
    $('.social a.dribbble').tooltip();
    $('.social a.googleplus').tooltip();
    $('.social a.pinterest').tooltip();
    $('.social a.flickr').tooltip();

    /*
        Subscription form
    */
    $('.success-message').hide();
    $('.error-message').hide();
	$('#loadform').hide();

    $('.subscribe form').submit(function() {
		$('#submit').hide();
		$('#loadform').fadeIn();
        var postdata = $('.subscribe form').serialize();
        $.ajax({
            type: 'POST',
            url: 'homeroot/subscribe',
            data: postdata,
            dataType: 'json',
            success: function(json) {
				
                if(json.valid == 0) {
                    $('.success-message').hide();
                    $('.error-message').hide();
                    $('.error-message').html(json.message);
                    $('.error-message').fadeIn(function(){
							setInterval(function(){
								$('.error-message').hide("10000");
							},4000);
						});
						
					$('#submit').fadeIn();
				 	$('#loadform').hide();
					 
                }
                else {
                    $('.error-message').hide();
                    $('.success-message').hide();
                    $('.subscribe form').hide();
                    $('.success-message').html(json.message);
                    $('.success-message').fadeIn();
					
					$('#loadform').hide();
					
                }
            }
        });
        return false;
    });

});

