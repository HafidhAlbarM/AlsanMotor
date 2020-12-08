<!DOCTYPE html>
<html lang="en">
<head>
	<title>Alsan Motor | Login Admin Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<!-- <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/Login_v6/images/icons/favicon.ico"/> -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/img/logo_alsan.png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login_v6/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login_v6/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login_v6/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login_v6/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login_v6/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login_v6/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login_v6/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login_v6/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login_v6/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login_v6/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
				<form class="login100-form validate-form" method="POST" action="<?php echo base_url('c_login/login') ?>">
					<!-- <span class="login100-form-title p-b-70">
						Welcome
					</span> -->
					<span class="login100-form-avatar">
						<img src="<?php echo base_url()?>assets/img/logo_alsan.png" alt="AVATAR">
					</span>
					<span class="login100-form-avatar-2">
						<img src="<?php echo base_url()?>assets/img/logo_alsan_2.png" alt="AVATAR">
					</span>
					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter User ID">
						<input class="input100" type="text" name="User_Id">
						<span class="focus-input100" data-placeholder="User ID"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter Password">
						<input class="input100" type="password" name="Password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					
					<?php
						if( isset($pesan) ){ ?>
							<span class="text-danger">
								<?php echo $pesan; ?>
							</span>
					<?php } ?>

					<ul class="login-more p-t-190">
						<li class="m-b-8">
							<span href="#" class="txt2">
								Forgot Username / Password?
							</span>
						</li>

						<li>
							<a href="#" class="txt">
								Please contact Your Administrator.
							</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/Login_v6/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/Login_v6/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/Login_v6/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url()?>assets/Login_v6/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/Login_v6/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/Login_v6/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url()?>assets/Login_v6/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/Login_v6/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/Login_v6/js/main.js"></script>

</body>
</html>