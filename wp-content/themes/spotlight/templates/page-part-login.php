<?php if (!is_user_logged_in() && get_theme_option('show_login')=='yes') { ?>
	<div id="user-popUp" class="user-popUp mfp-with-anim mfp-hide">
		<div class="sc_tabs">
			<ul class="loginHeadTab">
				<li><a href="#loginForm" class="loginFormTab icon"><i class="icon icon-key"></i>Log In</a></li>
				<li><a href="#registerForm" class="registerFormTab icon"><i class="icon icon-pencil"></i>Create an Account</a></li>
			</ul>
			
			<div id="loginForm" class="formItems loginFormBody">
				<div class="itemformLeft formEqualColumn">
					<form action="<?php echo wp_login_url(); ?>" method="post" name="login_form" class="formValid">
						<input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>" />
						<ul class="formList">
							<li class="icon formRow formLogin"><label for="login"><i class="icon-mail-2"></i></label><input type="text" id="login" name="log" value="" placeholder="Email"></li>
							<li class="icon formRow formPass"><label for="password"><i class="icon-lock"></i></label><input type="password" id="password" name="pwd" value="" placeholder="Password"></li>
							<li class="remember">
								<a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" class="forgotPwd"><?php _e('Forgot password?', 'themerex'); ?></a>
								<input type="checkbox" value="forever" id="rememberme" name="rememberme">
								<label for="rememberme">Remember me</label>
							</li>
							<li class="formSubmit"><a href="#" class="sc_button style_border size_big type_rounded sendEnter enter">Login</a></li>
						</ul>
					</form>
				</div>

				<div class="itemformRight formEqualColumn">
					<ul class="formList">
						<li>You can login using your social profile</li>
						<li class="loginSoc">
							<a href="#" class="iconLogin fb"><i class="icon-facebook"></i></a><!-- 
						 --><a href="#" class="iconLogin tw"><i class="icon-twitter"></i></a><!-- 
						 --><a href="#" class="iconLogin gg"><i class="icon-gplus"></i></a>
						</li>
						<li><a href="#" class="underlink">Problem with login?</a></li>
					</ul>
				</div>
				<div class="result messageBlock"></div>
			</div>

			<div id="registerForm" class="formItems registerFormBody">
				<form name="register_form" method="post" class="formValid">
					<input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>"/>
					<div class="itemformLeft">
						<ul class="formList">
							<li class="icon formRow formUser"><input type="text" id="registration_username" name="registration_username"  value="" placeholder="User name (login)"><label for="login"><i class="icon-user"></i></label></li>
							<li class="icon formRow formLogin"><input type="text" id="registration_email" name="registration_email" value="" placeholder="E-mail"><label for="login"><i class="icon-mail-2"></i></label></li>
						</ul>
					</div>
					<div class="itemformRight">
						<ul class="formList">
							<li class="icon formRow formPass"><input type="password" id="registration_pwd" name="registration_pwd" value="" placeholder="Password"><label for="login"><i class="icon-lock"></i></label></li>
							<li class="icon formRow formPass"><input type="password" id="registration_pwd2" name="registration_pwd2" value="" placeholder="Confirm Password"><label for="login"><i class="icon-lock"></i></label><small><?php echo __('Minimum 6 characters', 'themerex'); ?></small></li>
						</ul>
					</div>
					<div class="itemFormSubmit">
						<ul>							
							<li class="i-agree">
								<input type="checkbox" value="forever" id="i-agree" name="i-agree">
								<label for="i-agree">I agree with</label> <a href="#">Terms &amp; Conditions</a>
							</li>
							<li class="formRegSubmit"><a href="#" class="sendEnter sc_button style_border size_big type_rounded sendEnter enter"><?php echo __('Sign Up', 'themerex'); ?></a></li>
						</ul>
					</div>
				</form>
				<div class="result messageBlock"></div>
			</div>

		</div>	<!-- /.sc_tabs -->
	</div>		<!-- /.user-popUp -->
<?php } ?>
