<div class="container">
	<div  class="row">
     	<div class="span4" >
        	
    		 <div class="thank-message">
              <br/>
           
        		
            	 <a href="<?php print base_url();?>">
                        <img src="<?php print $mbaseurl; ?>img/iDialLogo.png"  style="width:100px">
                 </a>
                <br/><br/>
                Thank for your order,<br /> We will process your order and contact you back immediately .
                 <br/>
                 <a href="<?php print base_url();?>contact">iDial Corner Store</a>
            </div>
            
            <div class="exist-message">
              <br/>
              
        		
            	 <a href="<?php print base_url();?>">
                        <img src="<?php print $mbaseurl; ?>img/iDialLogo.png"  style="width:100px">
                 </a>
                <br/><br/>
               		<span style="color:red">Sorry , your previous order is still on process.</span>
                    If you have any questions about your order,<br />
                	please feel free to <a href="<?php print base_url();?>contact">contact us</a>.
                 <br/>
                 <a href="<?php print base_url();?>contact">iDial Corner Store</a>
            </div>
        </div>
    </div>
	
    <div class="row"  id="loadingBar">
        <div class="span4" >
        <br/>
        <br/>
        <br/>
      	<h3>Please wait ..</h3>
       <br/>
        <img id="loadform" src="<?php print $mbaseurl;?>img/loading-animation.gif" title="iDial load" width=""/>
        </div>
   </div>
    <div class="row"  id="formSubscriber1">
        <div class="span4">
            <p>
               PROCEED TO CHECKOUT <br /><span style="color:#762B90;font-size: 14px "><?php print $qty;?> unit <?php print $nameP;?></span> .<br>
               
               <!-- <span style="color:red;">*<span> are required field.-->
            </p>
        </div>
    </div>
  

    <div class="row"  id="formSubscriber2">
        <div class="span6">
			<div class="start-message">Please fill the form below.</div>
           
			<div class="error-message" style="color:red"></div>
           
            <div class="row">
				
                  <form class="form-horizontal" id="subscribeForm" method="post"  onsubmit="return hideForm()" action="<?php print base_url()?>subscriber/action">
                        <input type="hidden" value="<?php print $idP;?>" name="id" id="id" />
                        <input type="hidden" value="<?php print $nameP;?>" name="namep" id="namep"/>
                        <input type="hidden" value="<?php print $uriP;?>" name="uri" id="uri"/>
                        <input type="hidden" value="<?php print $qty;?>" name="qty"id="qty" />

                        <div class="control-group" >
                            <span class="required">*</span>
                            <div class="span4">
                                <div class="controls">
                                    <input type="text" placeholder="Name" class="validate[required] text-input" name="nameu" id="nameu">
                                </div>
                            </div>
                        </div>

                        <div class="control-group" >
                            <span class="required">*</span>
                            <div class="span4">
                                <div class="controls">
                                    <input type="text" placeholder="Email or Phone Number" class="validate[required,custom[email]] text-input" name="email" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="control-group" >
                            <span class="required">*</span>
                            <div class="span4" >
                                <div class="controls">
                                    <textarea placeholder="Address" name="address" id="address" style="height: 50px"></textarea>
                                </div>
                            </div>
                        </div>


                    <div class="span4" align="right" >
                    <div class="control-group">
                        <div class="controls">
                            <input class="btn" value ="PLACE ORDER" type="submit" onclick="return hideForm()"/>

                        </div>
                    </div>
                </div>
                </form>


            </div>
        </div>
    </div>

</div>
