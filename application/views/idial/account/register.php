 <div class="container">
        
		<div class="row">
		    <div class="span12">
			    <div class="breadcrumbs">
				    <ul class="breadcrumb">
                        <li><a href="<?php print base_url()?>">Home</a> <span class="divider">/</span></li>
                        <li class="active">Register</li>
                    </ul>
				</div>
			</div>
			
		</div>
		
		<div class="row">
		    <div class="span12">
				<h2>Create an Account</h2>
			</div>
		</div>
		
		<div class="row">
            <div class="span12">
                <?php print $error_message?>
            </div>
			
			<div class="span6">


			    <div class="row">

				    <div class="span7">

				            <form class="form-horizontal" id="registerForm" method="post" action="<?php print base_url()?>action/register">
                           
                            
				            <div class="control-group" >
					           <span class="required">*</span>
                                <div class="span4" style="margin-left:-5px">
                                    <div class="controls">
                                        <input type="text" placeholder="Email" class="validate[required,custom[email]] text-input" name="email" id="email">
                                    </div>
                                </div>
				            </div>
                            <div class="control-group">
                                <div class="span4" style="margin-left:-5px">
                                    <div class="controls">
                                        <input type="text" id="phone" name="phone" placeholder="Phone Number" class="validate[custom[phone]] text-input">
                                    </div>
                                 </div>
				            </div>
                            
				            <div class="control-group">
					           <span class="required">*</span>
                                <div class="span4" style="margin-left:-5px">
                                    <div class="controls">
                                        <input type="password" name="password" id="password" placeholder="Password"  class="validate[required,minSize[6]] text-input">
                                    </div>
                                </div>
				            </div>
				        
				            
                            
							<div class="control-group">
								<span class="required">*</span>
                                <div class="span4" style="margin-left:-5px">
                                    <div class="controls">
                                        <input type="password" id="inputPassword" placeholder="Re-enter password" name="cpassword" id="cpassword" class="validate[required,equals[password],minSize[6]] text-input">
                                    </div>
                                </div>
							</div>
				        
			           
				    </div>
                    <div class="span4" align="right">
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