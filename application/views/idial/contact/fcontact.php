<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:200,300,400,600,700' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,600,700' rel='stylesheet' type='text/css'/>
<script language="javascript" type="text/javascript" src="../../ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='{base_url}js/jquery-1.8.3.min.js'><\/script>")</script>
<script language="javascript" type="text/javascript" src="{base_url}js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=true"></script>
<script language="javascript" type="text/javascript" src="{base_url}js/jquery.ui.map.full.min.js"></script>
<script>
    jQuery(window).load(function()
    {
        $('.dropdown-toggle').dropdown();

        $('#map').gmap().bind('init', function(ev, map)
        {
            $('#map').gmap('addMarker', {'position': '-6.223668,106.825862', 'bounds': true}).click(function()
            {
                $('#map').gmap('openInfoWindow',
                    {
                        'content':

                            '<p>iDial Corner </p><p>ITC Kuningan, Jembatan 1, Lantai 3, No.07 </p>'
                    }, this);
            });
            $('#map').gmap('option', 'zoom', 15);
        });
    });
</script>

</body>
