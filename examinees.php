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
		</div>
	</nav><br><br><br>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center"><span class="fa fa-users"></span> Student Information</h1>
			<hr>
			<h5>List of Students who are taking online exam</h5>
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th style="font-size: 20px;"><span class="fa fa-user"></span> Student Name</th>
						<th style="font-size: 20px;"><span class="fa fa-envelope"></span> Email</th>
						<th style="font-size: 20px;"><span class="fa fa-phone"></span> Contact Number</th>
						<th style="font-size: 20px;"><span class="fa fa-info-circle"></span> Status</th>
						<th class="text-center" colspan="2" style="font-size: 20px;"><span class="fa fa-tasks"></span> Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$disp_stud = "SELECT * FROM users ORDER BY UsersID DESC";
						$disp_res = mysqli_query($conn, $disp_stud);

						if (mysqli_num_rows($disp_res) > 0) {
							while ($disp_row = mysqli_fetch_assoc($disp_res)) {
								echo "<tr>
									<td>".$disp_row['LastName'].", ".$disp_row['FirstName']." ".$disp_row['MiddleName']."</td>
									<td>".$disp_row['EmailAddress']."</td>
									<td>".$disp_row['ContactNumber']."</td>
									<td>".$disp_row['Status']."</td>
									<td><a class='btn btn-info' href='approved_examinees.php?user_id=".$disp_row['UsersID']."'><span class='fa fa-check'></span> Approve</a></td>
									<td><a class='btn btn-danger'><span class='fa fa-close'></span> Reject</a></td>
								</tr>";
							}
						} else {
							echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-info-circle'></span> No Students Found</h3></td></tr>";
						}
					?>
				</tbody>
			</table>
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