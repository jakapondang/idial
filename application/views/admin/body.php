
<body>


    <div id="login-wrap">

		<div id="login-buttons">
			<div class="btn-wrap">
				<button type="button" class="btn" data-target="#login-form"><i class="icon-key"></i></button>
			</div>
			<!--<div class="btn-wrap">
				<button type="button" class="btn" data-target="#register-form"><i class="icon-edit"></i></button>
			</div>
			<div class="btn-wrap">
				<button type="button" class="btn" data-target="#forget-form"><i class="icon-question-sign"></i></button>
			</div>-->
		</div>

		<div id="login-inner" class="login-inset">

			<div id="login-circle">
				<section id="login-form" class="login-inner-form">
					<h1>Login</h1>
                    {error_message}
					<form class="form-vertical" action="{site_url}jp/action/login" method="post">
						<div class="control-group-merged">
							<div class="control-group">
								<input type="text" placeholder="Username" name="username" id="input-username" class="big required">
							</div>
							<div class="control-group">
								<input type="password" placeholder="Password" name="password" id="input-password" class="big required">
							</div>
						</div>
						<div class="control-group">
							<label class="checkbox">
								<input type="checkbox" name="remember" class="uniform"> Remember me
							</label>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-success btn-block btn-large">Login</button>
						</div>
					</form>
				</section>
				<section id="register-form" class="login-inner-form">
					<h1>Register</h1>
					<form class="form-vertical" action="dashboard.html">
						<div class="control-group">
							<label class="control-label">Email</label>
							<div class="controls">
								<input type="text" name="Register[email]" class="required email">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Password</label>
							<div class="controls">
								<input type="password" name="Register[password]" class="required">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Fullname</label>
							<div class="controls">
								<input type="text" name="Register[fullname]" class="required">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Payment Method</label>
							<div class="controls">
								<select class="required" name="Register[payment]">
									<option>PayPal</option>
									<option>Credit Card</option>
								</select>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-danger btn-block btn-large">Register</button>
						</div>
					</form>
				</section>
				<section id="forget-form" class="login-inner-form">
					<h1>Reset Password</h1>
					<form class="form-vertical" action="dashboard.html">
						<div class="control-group">
							<div class="controls">
								<input type="text" name="Reset[email]" class="big required email" placeholder="Enter Your Email...">
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-danger btn-block btn-large">Reset</button>
						</div>
					</form>
				</section>
			</div>

		</div>


    </div>
