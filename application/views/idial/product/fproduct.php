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

<script type="text/javascript" src="<?php print $mbaseurl;?>js/tinybox.js"></script>
<script>
    function jp_popUP(){
		var qty = document.getElementById('qty').value;
		if(qty==""){
			var qty = "1";
			}
			//alert(qty);
        //TINY.box.show({html:'This is a warning!',animate:false,close:false,boxid:'error',top:5});
        TINY.box.show({url:'<?php print base_url();?>subscriber',post:'var=<?php print $this->input->get('i');?>,<?php print $pro_name?>,<?php print uri_string();?>,'+qty,width:320,height:300});
    }
</script>
<script type="text/javascript">
	function hideForm(){
		$('#formSubscriber1').hide();
		$('#formSubscriber2').hide();
		$('#loadingBar').fadeIn();
		var id =document.getElementById('id').value;
		var namep =document.getElementById('namep').value;
		var uri =document.getElementById('uri').value;
		var qty =document.getElementById('qty').value;
		if(qty==""){
			var qty = "1";
			}
		var nameu =document.getElementById('nameu').value;
		var email =document.getElementById('email').value;
		var address =document.getElementById('address').value;
		
		$.post( "<?php print base_url(); ?>action/subscriber", { id: id, namep: namep, uri: uri,qty: qty,nameu: nameu,email: email,address: address,}).done(function( data ) {
			if(data=="1"){
					$('.thank-message').hide();
					 $('.start-message').hide();
					 $('.error-message').html('Please fill the required field ( * )');
					 $('#loadingBar').hide();
					$('#formSubscriber1').show();
					$('#formSubscriber2').show();
					$('.exist-message').show();
					 
					}
				else if(data=="2"){
					$('.thank-message').hide();
					 $('.start-message').hide();
					 $('.error-message').html('Wrong format Email or Phone number !');
					 $('#loadingBar').hide();
					 $('.exist-message').hide();
					$('#formSubscriber1').show();
					$('#formSubscriber2').show();
					
				}
				else if(data=="3"){
					$('#loadingBar').hide();
					$('.start-message').hide();
					$('.error-message').hide();
					$('.thank-message').hide();
					$('.exist-message').show();
				}
			else if(data=="0"){
				$('#loadingBar').hide();
				$('.start-message').hide();
				$('.error-message').hide();
				$('.exist-message').hide();
				$('.thank-message').show();
				// setInterval(function(){location.reload(); },6000);

			}
			
		});
		return false;
		
	}/**/
	
</script>


</body>
</html>
