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

				            <form class="form-horizontal" id="registerForm" method="post" action="{site_url}idial/account_action/resetpassword">

                            
				            <div class="control-group">
					            <label class="control-label" for="inputPassword">Password<span class="required">*</span></label>
					            <div class="controls">
					                <input type="password" name="password" id="password"  class="validate[required,minSize[6]] text-input">
					            </div>
				            </div>
				        
				            
                            
							<div class="control-group">
								<label class="control-label" for="inputPassword">Re-enter password<span class="required">*</span></label>
								<div class="controls">
									<input type="password" id="inputPassword" name="cpassword" id="cpassword" class="validate[required,equals[password],minSize[6]] text-input">
								</div>
							</div>
				        
			           
				    </div>
                    <div class="span5" align="right">
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