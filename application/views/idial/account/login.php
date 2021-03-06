 <div class="container">
        
		<div class="row">
		    <div class="span12">
			    <div class="breadcrumbs">
				    <ul class="breadcrumb">
                        <li><a href="<?php print base_url();?>">Home</a> <span class="divider">/</span></li>
                        <li class="active">Account</li>
                    </ul>
				</div>
			</div>
			
		</div>
		
		<div class="row">
		    <div class="span12">
				<h2>LOGIN OR CREATE AN ACCOUNT</h2>
			</div>
		</div>
		
		<div class="row">
            <?php print $error_message?>
		    <div class="span6">

				<div class="row">
              
				    <div class="span6">
                     	
			        <form class="form-horizontal loginbox" id="loginForm" method="post" action="<?php print base_url();?>action/login">
						<div class="control-group">
                       		 <p>Please type on your Email & Password :</p>
                            <span class="required">*</span><!--<label class="control-label" for="inputEmail"></label>-->
                            <div class="span4" style="margin-left:-5px">
                                <div class="controls">
                                    <input type="text" placeholder="Username or email" class="validate[required,custom[email]] text-input" name="email" id="email">
                                </div>
                            </div>
						</div>
						<div class="control-group">
                            <span class="required">*</span><!--<label class="control-label" for="inputEmail"></label>-->
                            <div class="span4" style="margin-left:-5px">
                                <div class="controls">
                                    <input type="password" placeholder="Password" name="password" id="password"  class="validate[required,minSize[6]]">
                                </div>
                            </div>
						</div>
						<div class="control-group">
							<div class="controls">
								<input class="btn" type="submit" value="LOGIN"/>
								<a href="<?php print base_url();?>account/lost-password">Lost Password?</a>
							</div>
						</div>
			        </form>
				    </div>
				</div>
			</div>
			
			<div class="span6">
            	  <div class="row">
				    <div class="span6">
                    	<div style="padding:20px">
                    	<div class="control-group">
                        	<div class="controls">
                    			<p>New Customers</p>
                            </div>
                     	</div>
                     	 <div class="control-group">
                         	<div class="controls">
                                <p style="margin: 0 0 20px !important;">
                                By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.
                                </p>
                            </div>
                       </div>
                       <div class="control-group">
                       		<div class="controls">
                            </div>
                       </div>
                      	<div class="control-group">
					        <div class="controls">
					                <button class="btn" type="button" onclick="javascript:window.location='<?php print base_url();?>account/register'">REGISTER</button>
					         </div>
				       </div>
                     </div>
                    </div>
                  </div>

				</div>
			</div>
		</div>
		
	</div>	
  