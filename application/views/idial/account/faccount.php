<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:200,300,400,600,700' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,600,700' rel='stylesheet' type='text/css'/>
<script language="javascript" type="text/javascript" src="../../ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='{base_url}js/jquery-1.8.3.min.js'><\/script>")</script>
<script language="javascript" type="text/javascript" src="{base_url}js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{base_url}css/validation_engine/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8">
<script type="text/javascript" src="{base_url}js/validation_engine/jquery.validationEngine.js"></script>
<script type="text/javascript" src="{base_url}js/validation_engine/languages/jquery.validationEngine-en.js"></script>
<script type="text/javascript">

    $("#editAccountInfo").validationEngine();

</script>
<script>
jQuery(document).ready(function() 
{
    $('.dropdown-toggle').dropdown();

    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
});

function tabChangePass(){
    var remember = document.getElementById('ChangePass');
    if (remember.checked){
        $( '.changepass' ).show();
    }else{
        $( '.changepass' ).hide();
    }
}
</script>	
</body>
