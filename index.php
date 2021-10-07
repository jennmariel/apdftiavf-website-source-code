<!DOCTYPE html>
<html lang="en">
<head>
	<title>Group 3-Thesis</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="assets_index/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets_index/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets_index/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="assets_index/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="assets_index/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="assets_index/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets_index/css/main.css">
</head>
<body>
  <style>
    body {
      background-image: url('images/tomato.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
  </style>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/logo_circle.png" alt="IMG">
				</div>
                <form id="form" class="login100-form validate-form flex-sb flex-w" name="f1" action = "authentication.php" onsubmit = "return validation()" method = "POST">
					<span class="login100-form-title">
						USER LOGIN
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" id="user" name="user" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" id="pass" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--JAVASCRIPT-->	
	<script src="assets_index/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="assets_index/vendor/bootstrap/js/popper.js"></script>
	<script src="assets_index/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets_index/vendor/select2/select2.min.js"></script>
	<script src="assets_index/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
		
        $('input').keydown(function(e) {
            if (e.keyCode == 13) {
                $(this).closest('form').submit();
            }
        });
	</script>
	<script src="assets_index/js/main.js"></script>

</body>
</html>