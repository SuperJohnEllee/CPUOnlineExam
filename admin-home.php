<!DOCTYPE html>
<?php
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'online_exam') or die('Connection Failed: ' . mysqli_error());
	
	if (!isset($_SESSION['username'])) {
		header("location: index.php");
	}
?>
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
	<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-dark">
		<a class="navbar-brand" href="#"><img src="img/CPULogo.png" height="30" width="30"></a>
		<button class="navbar-toggler mdb-color" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<div class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link active text-white" href="index.php"><span class="fa fa-home"></span> Home<span class="sr-only">(current)</span></a>
				</li>
			</div>
			<div class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link text-white" href="profile.php"><span class="fa fa-user"></span> <?php echo $_SESSION['username']; ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white" href="logout.php"><span class="fa fa-sign-out"></span> Logout</a>
				</li>
			</div>
		</div>
	</nav><br><br><br>
	<div class="container">
		<div class="page-header">
			<h1>Hello, <?php echo $_SESSION['name']; ?></h1>
			<hr>
		</div>
		<div class="row">
			<div class="col-4">
				<h1><a class="btn btn-info" href="examinees.php"><span class="fa fa-users fa-5x"></span> Registered Examinees</h1></a>
			</div>
			<div class="col-4">
				<h1><a class="btn btn-success" href="view-approved-examinees.php"><span class="fa fa-check fa-5x"></span> Approved Examinees</a></h1>
			</div>
			<div class="col-4">
				<h1><a class="btn btn-warning" href="#"><span class="fa fa-file fa-5x"></span> Create Exam</a></h1>
			</div>
		</div>
	</div>

<!-- JQuery -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>