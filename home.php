<?php
session_start();

if (isset($_SESSION["UserId"])) {
?>

	<link href="style/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

	<script src="js/bootstrap.min.js"></script>
	<script src="jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home.css">

	<div class="container">
		<div class="row profile">
			<div class="col-md-3">
				<div class="profile-sidebar">
					<!-- SIDEBAR USERPIC -->
					<div class="profile-userpic text-center">
						<img src="img/profile.jpg" class="img-responsive" width="220px" alt="">
					</div>
					<!-- END SIDEBAR USERPIC -->
					<!-- SIDEBAR USER TITLE -->
					<div class="profile-usertitle">
						<div class="profile-usertitle-name">
							Ahmed AbdelHamid
						</div>
						<div class="profile-usertitle-job">
							Developer
						</div>
					</div>
					<!-- END SIDEBAR USER TITLE -->
					<!-- SIDEBAR BUTTONS -->
					<div class="profile-userbuttons">
						<button type="button" class="btn btn-success btn-sm">Follow</button>
						<button type="button" class="btn btn-danger btn-sm">Message</button>
					</div>

					<div class="profile-usermenu">
						<ul class="nav">
							<li>
								<a href="#">
									<i class="glyphicon glyphicon-home"></i>
									Overview </a>
							</li>
							<li>
								<a href="#">
									<i class="glyphicon glyphicon-user"></i>
									Account Settings </a>
							</li>

							<?php if (isset($_SESSION["Admin"])) { ?>
								<li>
									<a href="admin.php" target="_blank">
										<i class="glyphicon glyphicon-ok"></i>
										Admin </a>
								</li>
							<?php } ?>
							<li>
							<form method="GET" action="valid.php">
								<div class="form-group">
									<input type="submit" name="logout" value="Logout" class="ml-5 btn btn-danger">
								</div>
							</form>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="profile-content">
					Some user related content goes here...
				</div>
			</div>
		</div>
	</div>
	<center><strong>Powered by <a href="http://j.mp/metronictheme" target="_blank">KeenThemes</a></strong></center>
	<br>
	<br>';
<?php
} else {
	header("Location: ../login.php");
}
?>