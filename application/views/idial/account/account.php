 <div class="container">
        
		<div class="row">
		    <div class="span12">
			    <div class="breadcrumbs">
				    <ul class="breadcrumb">
                        <li><a href="{site_url}">Home</a> <span class="divider">/</span></li>
                        <li class="active">Account</li>
                    </ul>
				</div>
			</div>
			
		</div>
		
		<div class="row">
		    <div class="span12">
                <h2>Welcome To iDial Corner Dashboard Account</h2>
			</div>
		</div>
		
		<div class="row">
		    <div class="span12">

                <div class="tabs">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#home">DASHBOARD</a></li>
                        <li><a href="#profile">ACCOUNT</a></li>
                        <li><a href="#address">ADDRESS</a></li>
                        <li><a href="#orders">ORDERS</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <h3>Hello, {firstname} !</h3>

                            <p>
                            Here on your Dashboard you have the ability to view a snapshot of your recent account activity and update your account information.
                            <br/> Select a link below to view or edit information.
                            </p>
                        </div>
                        <div class="tab-pane" id="profile">

                            <h3>EDIT ACCOUNT INFORMATION</h3>
                            <p>You can edit your account information here :</p>
                            <form  id="editAccountInfo" method="post" action="{site_url}idial/account_action/editAccount">

                                <fieldset>
                                    <div class="span4" style="margin-left: -5px">
                                          <div class="control-group">
                                                <div class="controls">
                                                    <input type="text" value="{firstname}" id="fname" name="fname" placeholder="First Name" class="validate[required] text-input">
                                                </div>

                                        </div>
                                        <div class="control-group" >
                                        <span class="required" style="float: right;margin-bottom:-20px">*</span>

                                            <div class="controls">
                                                <input type="text" value="{email}" placeholder="Email" class="validate[required,custom[email]] text-input" name="email" id="email">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="span4" style="">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="text" value="{lastname}" id="lname" name="lname"  placeholder="Last Name" >
                                            </div>

                                        </div>

                                        <div class="control-group">
                                            <span class="required" style="float: right;margin-bottom:-20px">*</span>
                                            <div class="controls">
                                                <input type="text" value="{phone}" id="phone" name="phone" placeholder="Phone Number" class="validate[custom[phone]] text-input">
                                            </div>

                                        </div>
                                    </div>

                                </fieldset>
                             <div style="padding: 10px 0">
                                <input type="checkbox" id="ChangePass" onclick="tabChangePass()"/>
                                <span class="required" style="padding-top:2px "> Change password</span>
                             </div>
                                <div class="changepass" style="display: none">
                               <label><h3>CHANGE PASSWORD</h3></label>
                               <div class="span4" style="margin-left: -5px">
                               <div class="control-group">
                                   <span class="required" style="float: right;margin-bottom:-20px">*</span>
                                   <div class="controls">
                                       <input type="password" name="oldpass" id="oldpass" placeholder="Current Password"  class="validate[required,minSize[6]] text-input">
                                   </div>
                               </div>
                               </div>

                                <br clear='all'/>
                               <div class="span4" style="margin-left: -5px">
                                    <div class="control-group">
                                       <span class="required" style="float: right;margin-bottom:-20px">*</span>
                                       <div class="controls">
                                           <input type="password" name="password" id="password" placeholder="Password"  class="validate[required,minSize[6]] text-input">
                                       </div>
                                   </div>

                               </div>
                               <div class="span4">
                                   <div class="control-group">
                                       <span class="required" style="float: right;margin-bottom:-20px">*</span>
                                       <div class="controls">
                                           <input type="password" id="inputPassword" placeholder="Re-enter password" name="cpassword" id="cpassword" class="validate[required,equals[password],minSize[6]] text-input">
                                       </div>
                                   </div>

                               </div>


                           </div>
                            <br clear='all'/>

                            <p id="review_btn">
                                <input type="submit" class="btn" value="SAVE">
                            </p>
                            </form>
                        </div>

                        <div class="tab-pane" id="address">
                            <p>There are no reviews yet, would you like to <a href="#review_btn">submit yours?</a></p>
                            <h3>Be the first to review “Blue Dress” </h3>
                            <form>
                                <fieldset>
                                    <label>Name<span class="required">*</span></label>
                                    <input type="text" placeholder="Name">
                                    <label>Email<span class="required">*</span></label>
                                    <input type="text" placeholder="Email">
                                    <label class="rating">Rating</label>
                                    <img alt="rating" src="image/stars-5.png">
                                </fieldset>
                            </form>
                            <label>Your Review<span class="required">*</span></label>
                            <textarea rows="3"></textarea>
                            <p id="review_btn">
                                <button class="btn" type="button">Submit Review</button>
                            </p>
                        </div>

                        <div class="tab-pane" id="orders">
                            <table class="table specs">
                                <tr>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Weight</th>
                                </tr>
                                <tr>
                                    <td>Blue</td>
                                    <td>XS</td>
                                    <td>1.00</td>
                                </tr>
                                <tr>
                                    <th>Composition</th>
                                    <th>Sleeve</th>
                                    <th>Care</th>
                                </tr>
                                <tr>
                                    <td>100% Cotton</td>
                                    <td> Long Sleeve</td>
                                    <td>IRON AT 110ºC MAX</td>
                                </tr>
                            </table>
                        </div>


                    </div>
                </div>


            </div>
			</div>
			

		
	</div>	
  