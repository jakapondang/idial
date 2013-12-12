<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:200,300,400,600,700' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,600,700' rel='stylesheet' type='text/css'/>
<script language="javascript" type="text/javascript" src="../../ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='<?php print $mbaseurl;?>js/jquery-1.8.3.min.js'><\/script>")</script>
<script language="javascript" type="text/javascript" src="<?php print $mbaseurl;?>js/bootstrap.min.js"></script>

<script language="javascript" type="text/javascript" src="<?php print $mbaseurl;?>js/cloud-zoom.1.0.3.js"></script>
<script>
    $.fn.CloudZoom.defaults = {
        zoomWidth:"auto",
        zoomHeight:"auto",
        position:"inside",
        adjustX:0,
        adjustY:0,
        adjustY:"",
        tintOpacity:0.5,
        lensOpacity:0.5,
        titleOpacity:0.5,
        smoothMove:3,
        showTitle:false};

    jQuery(document).ready(function()
    {
        $('#myTab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })
    });
</script>
</body>
