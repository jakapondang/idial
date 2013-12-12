</head>
<body >
        <!-- Header -->
        <noscript>
      	 <div style="position:fixed; top:0px; left:0px; z-index:3000; height:100%; width:100%; background-color:#FFFFFF">
   		<div style="font-family: Tahoma; font-size: 14px; background-color:#5AC6FF; padding: 10pt;">To see this page as it is meant to appear, we ask that you please enable your Javascript!</div></div>
  		</noscript>
<?php print $mpreload;?>
	<div class="page-header container_black" <?php print $hm_background;?>>
        <!--header-->

    <div class="container header">
		<div class="row">
		    <div class="span9">
                <div class="logo" style="float:left">
                    <a href="<?php print base_url();?>">
                        <img src="<?php print $mbaseurl; ?>img/iDialLogo.png"  style="width:100px">
                    </a>
                </div>

                <div class="span7" style="float:left">
                    <div class="navbar">
                        <div class="navbar-inner">
                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>
                            <div class="nav-collapse collapse navbar-responsive-collapse">
                                <ul class="nav">
                                    <?php
                                    print $mMenu;
                                    ?>


                                </ul>
                            </div><!-- /collapse -->
                        </div><!-- /navbar-inner -->
                    </div><!-- /navbar -->


                </div><!--span-->

            </div>

                    <div class="cart dropdown">
                       <a href="cart.html" class="dropdown-toggle" data-toggle="dropdown">
                           <div class="icon_cart"></div>
                       </a>
                     <!-- <div class="cart-info dropdown-menu">
                           <table class="table">
                               <thead>
                               </thead>
                               <tbody>
                               <tr>
                                   <td class="image"><img alt="IMAGE" src="<?php print $mbaseurl; ?>products/dress33.jpg"></td>
                                   <td class="name"><a href="<?php print $mbaseurl; ?>product.html">iPhone 5s</a></td>
                                   <td class="quantity">x&nbsp;3</td>
                                   <td class="total">Rp.8000.000</td>
                                   <td class="remove"><img src="<?php print $mbaseurl; ?>image/remove-small.png" alt="Remove" title="Remove"></td>
                               </tr>
                               <!--<tr>
                                   <td class="image"><img alt="IMAGE" src="<?php print $mbaseurl; ?>products/dress11.jpg"></td>
                                   <td class="name"><a href="<?php print $mbaseurl; ?>product.html">Blue Dress</a></td>
                                   <td class="quantity">x&nbsp;3</td>
                                   <td class="total">$230.00</td>
                                   <td class="remove"><img src="<?php print $mbaseurl; ?>image/remove-small.png" alt="Remove" title="Remove"></td>
                               </tr>
                               </tbody>
                           </table>
                           <div class="cart-total">
                               <table>
                                   <tbody>
                                   <tr>
                                       <td><b>Sub-Total:</b></td>
                                       <td>$400.00</td>
                                   </tr>
                                   <tr>
                                       <td><b>Total:</b></td>
                                       <td>$400.00</td>
                                   </tr>
                                   </tbody>
                               </table>
                               <div class="checkout"><a href="cart.html">View Cart</a> | <a href="checkout.html">Checkout</a></div>
                           </div>
                       </div>

-->
                    </div>
                <div class="headerMenu">
                    <a href="<?php print base_url();?>login">
                     <div class="icon_account"></div>
                    </a>
                 </div>

                <?php print $macc_logout;?>
                <div class="headerSearch">
                    <div class="icon_search"></div>
                    <input type="text" id="search" placeholder="Search" style=""/>
                </div>


                </div>

		    </div>
        </div>


        <br/>
