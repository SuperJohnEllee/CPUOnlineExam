<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale-1.0">
	<title>CPU Online Exam</title>
	<link rel="icon" href="img/CPULogo.png">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/mdb.min.css">
</head>
<body>
	<div class="container py-5 mt-5">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6 mx-auto">
						<div class="card cyan lighten-4 rounded-0">
							 <div class="card-header yellow lighten-1">
                            	<h3 class="text-center text-dark mb-0"><span class="fa fa-sign-in"></span> Admin Login Credentials</h3>
                        	</div>
							<div class="card-body">
								<form class="form" method="post" role="form" autocomplete="off" id="formLogin">
									<div class="md-form">
										<i class="fa fa-user prefix"></i>
										<input class="form-control form-control-lg rounded-0" type="text" name="username" required>
										<label class="text-dark">Username</label>
									</div>
									<div class="md-form">
										<i class="fa fa-lock prefix"></i>
										<input class="form-control form-control-lg rounded-0" type="password" name="password" id="admin_pass" required autocomplete="new-password">
										<label class="text-dark">Password</label>
									</div>
									<button class="btn btn-success btn-lg float-right" type="submit" name="login" id="btnLogin"><i class="fa fa-sign-in"></i> Login
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'online_exam') or die('Connection Failed: ' . mysqli_error());
		if (isset($_POST['login'])) {
			//admin login variables
      		$username = mysqli_real_escape_string($conn, $_POST['username']);
      		$password = mysqli_real_escape_string($conn, $_POST['password']);

      		//query start
      		$admin_sql = "SELECT * FROM admin WHERE Username = '$username' AND Password = '$password'";
      		$admin_res = mysqli_query($conn, $admin_sql);
     		$admin_count = mysqli_num_rows($admin_res);

      		if ($admin_count == 1) {
          		$row = mysqli_fetch_assoc($admin_res);
          
          		//session variables
          		$_SESSION['id'] = $row['AdminID'];
          		$_SESSION['username'] = $row['Username'];
          		$_SESSION['lastname'] = $row['LastName'];
          		$_SESSION['firstname'] = $row['FirstName'];
          		$_SESSION['midname'] = $row['MiddleName'];
          		$_SESSION['name'] = $row['FirstName'] . ' ' . $row['LastName'];
          		$_SESSION['fullname'] = $row['FirstName'] . ' ' . $row['MiddleName'] . ' ' . $row['LastName'];
          		header("location: admin-home.php");
      } else {
          echo "<script>
            alert('Wrong username or password');
          </script>";
      }
}
?>
<!-- JQuery -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</body>
</html>