<?php
if (isset($_COOKIE["SESS_ID"]) && !empty($_COOKIE["SESS_ID"])){
	header("Location: ../valid.php?rem=" .$_COOKIE["SESS_ID"]. "");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</head>

<body>
	<div class="container">
		<div class="d-flex justify-content-center h-100">
			<div class="card">
				<div class="card-header">
					<h3>Login</h3>
					<div class="d-flex justify-content-end social_icon">
						<a href="#"><span><i class="fab fa-facebook-square"></i></span></a>
						<a href="#"><span><i class="fab fa-google-plus-square"></i></span></a>
						<a href="#"><span><i class="fab fa-twitter-square"></i></span></a>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="valid.php">
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" class="form-control" name="user" placeholder="username">

						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" class="form-control" name="passwd" placeholder="password">
						</div>
						<div class="row align-items-center remember">
							<input type="checkbox" name="remember">Remember Me
						</div>
						<div class="form-group">
							<input type="submit" name="login" value="Login" class="btn float-right login_btn">
						</div>
					</form>
					<br>
					<?php if (isset($_GET['msg'])) {
						$err = explode(",", $_GET['msg']);
						echo "<div class='card-body red'>";
						if (in_array("user", $err)) {
							echo "please fill the user name" . "<br>";
						};
						if (in_array("passwd", $err)) {
							echo "please fill the password";
						};
						echo "</div>";
					}
					?>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-center links">
						Don't have an account?<a href="signup.php">Sign Up</a>
					</div>
					<div class="d-flex justify-content-center">
						<a href="#">Forgot your password?</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>