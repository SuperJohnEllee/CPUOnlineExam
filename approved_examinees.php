<!DOCTYPE html>
<?php
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'online_exam') or die('Connection Failed: ' . mysqli_error());
	
	if (!isset($_SESSION['username'])) {
		header("location: index.php");
	}
	
	$user_id = htmlspecialchars($_GET['user_id']);
	$user_sql = mysqli_query($conn, "SELECT * FROM users WHERE UsersID = '$user_id'");
	$user_row = mysqli_fetch_assoc($user_sql);

	$name = $user_row['FirstName'] . " " . $user_row['LastName'];  
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
					<a class="nav-link active text-white" href="admin-dashboard.php"><span class="fa fa-home"></span> Home<span class="sr-only">(current)</span></a>
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
                            <h3 class="text-center text-dark mb-0">Give Exam Code for <span class="text-info"><?php echo $name; ?></span></h3>
                        </div>
                        <div class="card-body cyan lighten-5 text-dark">
                            <form class="form" role="form" autocomplete="off" method="post">
                                <div class="md-form">
                                    <i class="fa fa-user prefix text-dark"></i>
                                    <input class="form-control" id="exam_code" type="text" name="exam_code" maxlength="6" required>
                                    <label>Exam Code - 6 digit</label>
                                </div>
                            <div class="form-group">
                              <div class="col-md-8">
                                <button  type="submit" class="btn btn-success col-md-6 btn-lg float-right" name="send_exam_code" id="btn_send"><i class="fa fa-paper-plane"></i>&nbsp;SEND</button>
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
	if (isset($_POST['send_exam_code'])) {

		require('PHPMailer/PHPMailerAutoload.php');
		
		$exam_code = $_POST['exam_code'];

		$select_exam_code = mysqli_query($conn, "SELECT * FROM exam WHERE ExamCode = '$exam_code'");


		if (mysqli_num_rows($select_exam_code) > 0) {
			echo "<script>
				alert('You already sent this code');
			</script>
			<meta http-equiv='refresh' content='0; url=approved_examinees.php'>";
		
		} else {

			$exam_id = htmlspecialchars($_GET['user_id']);
			
			$select_user = mysqli_query($conn, "SELECT * FROM users WHERE UsersID = '$exam_id'");
			$select_row = mysqli_fetch_assoc($select_user);
			$select_id = $select_row['UsersID'];
			$code_name = $select_row['FirstName'] . " " . $select_row['LastName'];	
			$select_email = $select_row['EmailAddress'];

			//$select_exam_sql = "SELECT * FROM exam INNER JOIN users ON users.UsersID = exam.UsersID WHERE UsersID = '$exam_id'";
			//$select_exam_res = mysqli_query($conn, $select_exam_sql);
			//$select_exam_row = mysqli_fetch_assoc($select_exam_res);

			//$exam_id = $select_exam_row['UsersID'];
			//$exam_name = $select_exam_row['FirstName'] . " " . $select_exam_row['LastName']; 


			$mail = new PHPMailer();
			$mail->SMTPDebug = 2; //Debugging
            $mail->isSMTP();
            $mail->Host = "ssl://smtp.gmail.com:465"; //Host Name
            $mail->SMTPAuth = true; //if SMTP Host requires authentication to send email
            $mail->SMTPSecure = "ssl"; //Security --> Secure Sockets Layer
            $mail->mailer = "smtp"; //Protocol Type
            $mail->Port = 465; // set port number for SMTP
            $mail->setFrom('cputheolib@gmail.com', 'Central Philippine University');
            $mail->AddReplyTo('cputheolib@gmail.com', 'Central Philippine University');
            $mail->addAddress($select_email);
            $mail->isHTML(true);
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 
                'verify_peer_name' => false, 'allow_self_signed' => true));

            //Account
            $mail->Subject = "Central Philippine University Online Exam";
            $mail->Username = "cputheolib@gmail.com";
            $mail->Password = "theolibrary";
            $mail->FromName = 'Exam Administrator';

            $mail->Body = "<h1> Hello ".$code_name."</h1>
            <h3>This is your exam code for your online exam '".$exam_code."'";
            $mail->AltBody = "This is the plain text version of the email content";

            $update_user = mysqli_query($conn, "UPDATE users SET Status = 'Approved' WHERE UsersID = '$exam_id'");

			$insert_exam_code = "INSERT INTO exam(UsersID, ExamCode) VALUES('$exam_id','$exam_code')";
			$insert_exam_res = mysqli_query($conn, $insert_exam_code);

			if ($insert_exam_res && $update_user && $mail->send()) {
				ob_end_clean();
				echo "<script>
					alert('Exam Code sent successfully');
				</script>";
				return true;
			} else {
				ob_end_clean();
            	echo "<script>
                        alert('Failure in sending a Password to email, please check your internet connection'); 
                        </script>". $mail->ErrorInfo;
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