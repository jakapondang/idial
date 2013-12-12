 <div class="container">
        
		<div class="row">
		    <div class="span12">
			    <div class="breadcrumbs">
				    <ul class="breadcrumb">
                        <li><a href="<?php print base_url()?>">Home</a> <span class="divider">/</span></li>
                        <li class="active">Lost Password</li>
                    </ul>
				</div>
			</div>
			
		</div>
		
		<div class="row">
		    <div class="span12">
				<h2>Forgot Your Password?</h2>
			</div>
		</div>
		
		<div class="row">
            <div class="span12">
                <?php print $error_message?>
			</div>
			<div class="span6">


			    <div class="row">

				    <div class="span9">

				            <form class="form-vertical" id="registerForm" method="post" action="<?php print base_url()?>action/lost-password">
                           
                            
				            <div class="control-group" >

                                   <p>Please enter your email address below. You will receive a link to reset your password.</p>
                                   <span class="required">*</span>

                                <div class="span4" style="margin-left:-5px">
                                    <div class="controls">
                                        <input type="text" placeholder="Email"  class="validate[required,custom[email]] text-input" name="email" id="email">
                                    </div>
                                    <div class="controls">
                                        <input class="btn" value ="SUBMIT" type="submit"/>
                                    </div>
                                </div>

                            </div>

				        
			           
				    </div>

                    </form>
                    <br clear="all"/>
                    <br/>
                    <!-- 
             <div class="span6">
				
				<div class="row">
              
				    <div class="span6">
                   
				    </div>
				</div>
			</div> -->
                    
				</div>
			</div>
		</div>
		
	</div>		