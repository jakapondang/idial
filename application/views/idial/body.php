<body>
        <!-- Header -->
        <noscript>
      	 <div style="position:fixed; top:0px; left:0px; z-index:3000; height:100%; width:100%; background-color:#FFFFFF">
   		<div style="font-family: Tahoma; font-size: 14px; background-color:#5AC6FF; padding: 10pt;">To see this page as it is meant to appear, we ask that you please enable your Javascript!</div></div>
  		</noscript>
        
        <!-- This section is for Splash Screen -->
<div class="ole">
<section id="jSplash">
	<div id="circle"></div>
</section>
</div>
<!-- End of Splash Screen -->
<script>
// Preload the page with jPreLoader
	$('body').jpreLoader({
		splashID: "#jSplash",
		showSplash: true,
		showPercentage: true,
		autoClose: true,
		splashFunction: function() {
			$('#circle').delay(250).animate({'opacity' : 1}, 1000, 'linear');
		}
	});</script>

	<div class="page-container container">
    <div class="container header">
		<div class="row">
		    <div class="span7">
			    <div class="logo">
				    <a href="{site_url}">iDial</a>
				</div>
			</div>
			<div class="span5">
			    <div id="search">
                    <input type="text" placeholder="Search" name="filter_name">
                    <div class="button-search"></div>
                </div>
			    <div class="cart dropdown">
					<img alt="cart empty" src="{base_url}image/shopping_basket.png">
					<a href="cart.html" class="dropdown-toggle" data-toggle="dropdown">2 items(s) - $360.00</a>
						<div class="cart-info dropdown-menu">
							<table class="table">
								<thead>
								</thead>
								<tbody>
									<tr>
										<td class="image"><img alt="IMAGE" src="{base_url}products/dress33.jpg"></td>
										<td class="name"><a href="{base_url}product.html">Black Dress</a></td>
										<td class="quantity">x&nbsp;3</td>
										<td class="total">$130.00</td>
										<td class="remove"><img src="{base_url}image/remove-small.png" alt="Remove" title="Remove"></td>
									</tr>
									<tr>
										<td class="image"><img alt="IMAGE" src="{base_url}products/dress11.jpg"></td>
										<td class="name"><a href="{base_url}product.html">Blue Dress</a></td>
										<td class="quantity">x&nbsp;3</td>
										<td class="total">$230.00</td>
										<td class="remove"><img src="{base_url}image/remove-small.png" alt="Remove" title="Remove"></td>
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
					</div>
				</div>
			</div>
		</div>

    <div class="container menu">
		<div class="row">
		    <div class="span12">
                <div class="navbar">
                    <div class="navbar-inner">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
					<div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav">							
                        <li><a href="category.html">Shop</a></li>
						<li class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#">Sliders</a>
							<ul class="dropdown-menu">
								<li><a href="bootstrap-carousel.html">Bootsrap Carousel</a></li>
								<li><a href="elastic-slider.html">Elastic Slider</a></li>
								<li><a href="nivo-slider.html">Nivo Slider</a></li>
								<li><a href="slice-box.html">Slicebox</a></li>
								<li><a href="index-2.html">Flexslider</a></li>
							</ul>
						</li>
						<li><a href="account.html">My Account</a></li>
						<li class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#">Pages</a>
							<ul class="dropdown-menu">
								<li><a href="cart.html">Shopping Cart</a></li>
								<li><a href="site-map.html">Site Map</a></li>
								<li><a href="404.html">404 Error Page</a></li>
								<li><a href="forgot-password.html">Lost Password</a></li>
								<li><a href="search.html">Search</a></li>
							</ul>
						</li>						
						<li><a href="checkout.html">Checkout</a></li>
						<li><a href="about.html">About Us</a></li>
						<li><a href="contact.html">Contact</a></li>
						<li><a href="blog.html">Blog</a></li>
						<li><a href="docs/index.html">Bootstrap Documentation</a></li>
					</ul>
					</div><!-- /collapse -->
                    </div><!-- /navbar-inner -->
					</div><!-- /navbar -->
                </div><!-- /span -->
		</div><!-- /row -->
    </div>