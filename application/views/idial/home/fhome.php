<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:200,300,400,600,700' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,600,700' rel='stylesheet' type='text/css'/>
<script language="javascript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='{base_url}js/jquery-1.8.3.min.js'><\/script>")</script>
<script language="javascript" type="text/javascript" src="{base_url}js/bootstrap.min.js"></script>
<script language="javascript" type="text/javascript" src="{base_url}js/jquery.easing.1.3.js"></script>
<script language="javascript" type="text/javascript" src="{base_url}js/jquery.eislideshow.js"></script>
<link href='{base_url}css/ei-slider.css' rel='stylesheet' type='text/css'/>
<link href='{base_url}css/slideshow.css' rel='stylesheet' type='text/css'/>

<script language="javascript" type="text/javascript" src="{base_url}js/jquery.jcarousel.min.js"></script>
<link href='{base_url}css/carousel.css' rel='stylesheet' type='text/css'/>
<script type="text/javascript" src="{base_url}js/jpreloader.min.js"></script>
<script>
    jQuery(document).ready(function()
    {
        $('.dropdown-toggle').dropdown();
        $('.carousel').carousel();

        $('.jcarousel').jcarousel({
            vertical: false,
            wrap: 'circular',
            visible: 5,
            scroll: 3});


        $('.ei-slider').eislideshow({
            animation:"sides",
            autoplay:true,
            slideshow_interval:6000,
            speed:800,
            easing:"",
            titleFactor:0.60,
            titlespeed:800,
            titleeasing:"",
            thumbMaxWidth:150 		});

    });
</script>


<script>
    // Preload the page with jPreLoader
    $('body').jpreLoader({
        splashID: "#jSplash",
        showSplash: true,
        showPercentage: true,
        autoClose: true,
        splashFunction: function() {
            $( ".jAddress-top" ).fadeIn( "slow");
            $( ".jAddress-bot" ).fadeIn( "slow");
            $('#circle').delay(250).animate({'opacity' : 1}, 1000, 'linear');
        }
    });</script>

</body>