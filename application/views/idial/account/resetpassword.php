 <div class="container">
        
		<div class="row">
		    <div class="span12">
			    <div class="breadcrumbs">
				    <ul class="breadcrumb">
                        <li><a href="{site_url}">Home</a> <span class="divider">/</span></li>
                        <li class="active">Reset Password</li>
                    </ul>
				</div>
			</div>
			
		</div>
		
		<div class="row">
		    <div class="span12">
				<h2>RESET PASSWORD</h2>
			</div>
		</div>
		
		<div class="row">
            <div class="span12">
                {error_message}
            </div>
			
			<div class="span6">


			    <div class="row">

				    <div class="span9">
							<p>Please type on your new password below :</p>
				            <form class="form-horizontal" id="registerForm" method="post" action="{site_url}idial/account_action/NewResetPassword">

                            <input type="hidden" name="token" id="token"  value="{token}">
                             <input type="hidden" name="userid" id="userid"  value="{userid}">
                            <div class="span4" style="margin-left:-5px">
                                <div class="control-group">
                                    <span class="required">*</span>
                                    <div class="controls">

                                        <input type="password" placeholder="Password" name="password" id="password"  class="validate[required,minSize[6]] text-input">
                                    </div>
                                </div>



                                <div class="control-group">
                                    <span class="required">*</span>
                                    <div class="controls">
                                        <input type="password" placeholder="Re-enter password" id="inputPassword" name="cpassword" id="cpassword" class="validate[required,equals[password],minSize[6]] text-input">
                                    </div>
                                </div>
				            </div>
			           
				    </div>
                    <div class="span5" align="left">
                    	<div class="control-group">
					            <div class="controls">
					                <input class="btn" value ="SUBMIT" type="submit"/>
					            </div>
				            </div>
                    </div>
                    </form>	
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