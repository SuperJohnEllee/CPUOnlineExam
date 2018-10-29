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
	<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center text-dark mb-4">Central Philippine University Online Exam</h2>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card rounded-0">
                        <div class="card-header yellow lighten-1">
                            <h3 class="text-center text-dark mb-0">Enter Exam Code</h3>
                        </div>
                        <div class="card-body cyan lighten-5 text-dark">
                            <form method="post">
                                <div class="md-form">
                                    <i class="fa fa-user prefix text-dark"></i>
                                    <input class="form-control" id="exam_code" type="text" name="exam_code" maxlength="6">
                                    <label>Exam Code - 6 digit</label>
                                </div>
                            <div class="form-group">
                              <div class="col-md-8">
                                <button  type="submit" class="btn btn-success col-md-6 btn-lg float-right" name="take_exam" id="take_exam"><i class="fa fa-check"></i> Submit</button>
                              </div>
                            </div>
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
	$conn = mysqli_connect('localhost', 'root', '', 'online_services') or 
	die("Connection Failed: " . mysqli_error());
    
    //Take Exam
    if (isset($_POST['take_exam'])) {
        
        $exam_code = mysqli_real_escape_string($conn, $_POST['exam_code']);

        if (empty($exam_code)) {
            echo "<script>
              alert('Please input your exam code');
            </script>";
        } else {

        $sql = "SELECT * FROM exam INNER JOIN users USING(UsersID) WHERE ExamCode = '$exam_code'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        $res_exam_code = $row['ExamCode'];
        $res_exam_name = $row['FirstName'] . " " . $row['LastName'];
        $res_exam_email = $row['EmailAddress'];

        if ($res_exam_code == $exam_code) {

          $_SESSION['name'] = $res_exam_name;
          $_SESSION['email'] = $res_exam_email;
          header("location: exam.php");

        } else {
          echo "<script>
            alert('Incorrect exam code');
          </script>";
        }
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
</html>