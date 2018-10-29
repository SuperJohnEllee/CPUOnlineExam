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
  <style>
    .center{ margin-left: auto; margin-right: auto; display: block; width: 100%; }
  </style>
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
					<a class="nav-link text-white" href="login.php"><span class="fa fa-sign-in"></span> Login</a>
				</li>
			</div>
		</div>
	</nav><br>
  <div class="modal fade" id="forgotExamCodeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content cyan lighten-5">
            <div class="modal-header text-center yellow lighten-1">
                <h4 class="modal-title w-100 font-weight-bold"><span class="fa fa-sign-in"></span> Forgot Exam Code </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <p class="text-center">Note: Just type in your email address and we will sent you your exam code</p>
            <div class="modal-body mx-3">
                <form  method="post">
                    <div class="md-form mb-4">
                        <i class="fa fa-envelope prefix dark-text"></i>
                        <input type="email" name="email" id="email" class="form-control" required>
                        <label data-error="wrong" data-success="right" for="username">Email</label>
                    </div>
                    <div class="md-form mb-4">
                        <button type="submit" class="btn btn-primary pull-right" name="forgot_exam_code"><span class="fa fa-paper-plane-o"></span> Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
    <div class="view jarallax" style="height: 100vh;">
    <img class="jarallax-img" src="https://mdbootstrap.com/img/Photos/Others/img%20%2844%29.jpg" alt="">
    <div class="mask rgba-blue-slight">
      <div class="container flex-center text-center">
        <div class="row mt-5">
          <div class="col-md-12 wow fadeIn mb-3">
            <h1 class="display-3 mb-2 wow fadeInDown" data-wow-delay="0.3s">Central Philippine University <a class="text-warning font-weight-bold">Online Examination</a></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
	<div class="container">
		<h5 class="text-center">Please fill up this form to take the online exam</h5>
	
	<form method="post">	
		<div class="row">
   			<div class="md-form col-md-6">
   				<i class="fa fa-user prefix"></i>
   				<input class="form-control" type="text" name="last_name" required>
   				<label>Last Name</label>
   			</div>
   			<div class="md-form col-md-6">
   				<i class="fa fa-user prefix"></i>
   				<input class="form-control" type="text" name="first_name" required>
   				<label>First Name</label>
   			</div>
   			<div class="md-form col-md-6">
   				<i class="fa fa-user prefix"></i>
   				<input class="form-control" type="text" name="mid_name" required>
   				<label>Midle Name</label>
   			</div>
   			<div class="md-form col-md-6">
   				<i class="fa fa-phone prefix"></i>
   				<input class="form-control" type="text" name="contact_num" required>
   				<label>Contact Number</label>
   			</div>
   			<div class="md-form col-md-6">
   				<i class="fa fa-envelope prefix"></i>
   				<input class="form-control" type="email" name="email" required>
   				<label>&nbsp;Email</label>
   			</div>
   		</div>
   			<div class="md-form">
   				<button class="btn btn-success" type="submit" name="register">REGISTER</button>
          <a class="btn btn-primary" href="take_exam.php"><span class="fa fa-pencil"></span> Take Exam</a>
          <a class="btn btn-danger" data-toggle="modal" data-target="#forgotExamCodeModal"><span class="fa fa-tag"></span> Forgot Exam Code</a>
   			</div>
   	</form>
</div>
<div style="padding: 15px 0;" class="text-center mdb-color darken-4 text-white">
  <h5 class="col-lg-12">Develop by Ellee Solutions &copy; 2018. All Rights Reserved</h5>
</div>
<?php
	$conn = mysqli_connect('localhost', 'root', '', 'online_exam') or die('Connection Failed: ' . mysqli_error()); 
  //Registration
  if (isset($_POST['register'])) {
		  
        //Define variables
			  $last_name = $_POST['last_name'];
    		$first_name = $_POST['first_name'];
    		$mid_name = $_POST['mid_name'];
    		$email = $_POST['email'];
    		$contact_num = $_POST['contact_num'];

    		//Prevent in same email and information duplication
    		$check_email = mysqli_query($conn, "SELECT * FROM users WHERE EmailAddress = '$email'");
    		$count_email = mysqli_num_rows($check_email);
			
			if ($count_email > 0) {
    			echo "<script>
    				alert('Email is already existing');
    			</script>";
    		
    		} else {
    			//query start
    			$insert_user = mysqli_query($conn, "INSERT INTO users(LastName, FirstName, MiddleName, EmailAddress, ContactNumber, Status) 
    				VALUES('$last_name', '$first_name', '$mid_name', '$email', '$contact_num', 'Pending');");

    			if ($insert_user) {
    				echo "<script>
    					alert('Successfully registered');
    				</script>
            <meta http-equiv='refresh' content='0; url=index.php'>";
    			
    			} else {
    				echo "<script>
    					alert('Failure in registration');
    				</script>";
    			}
    		}
    		mysqli_close($conn); 
		}

    //Forgot Exam Code

    if (isset($_POST['forgot_exam_code'])) {

        require('PHPMailer/PHPMailerAutoload.php');
        
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $sql = "SELECT * FROM exam INNER JOIN users USING(UsersID)";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        $name = $row['FirstName'] . " " . $row['LastName'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>
              alert('This $email is invalid');
            </script>";
         }

        if (mysqli_num_rows($res) > 0) {
            
            $mail = new PHPMailer();

            $mail->SMTPDebug = 2; //Debugging
            $mail->isSMTP(); //Set Mailer to use SMTP
            $mail->Host = "ssl://smtp.gmail.com:465"; //Host Name
            $mail->SMTPAuth = true; //if SMTP Host requires authentication to send email
            $mail->SMTPSecure = "ssl"; //set encryption system
            $mail->mailer = "smtp"; //set Email protocol
            $mail->Port = 465; // set SMTP Port
            $mail->setFrom('cputheolib@gmail.com', 'Central Philippine University');
            $mail->AddReplyTo('cputheolib@gmail.com', 'Central Philippine University');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 
                'verify_peer_name' => false, 'allow_self_signed' => true)); //start connection

            //You must have an unsecured email to perform this
            $mail->Username = "cputheolib@gmail.com"; // set email add
            $mail->Password = "theolibrary"; // set password
            $mail->FromName = 'Exam Administrator';
            $mail->Subject = "Central Philippine University Forgot Exam Code";
            
            //Body of the Email
            $mail->Body = "<h3>Hello ".$name. ", this is your exam code --> '".$row['ExamCode']. "'<br> Goodluck to your online exam. God Bless</h3>";
            $mail->AltBody = "This is the plain text version of the email content";
            if (!$mail->send()) {
                ob_end_clean();
                echo "<script>
                        alert('Failure in sending a Password to email, please check your internet connection'); 
                        </script>". $mail->ErrorInfo;
            } else {
                    ob_end_clean();
                    echo "<script>
                        alert('Exam Code sent succesfully');
                    </script>
                    <meta http-equiv='refresh' content='0; url=index.php'>";
                    return true;
            }
        
        } else {
            echo "<script>
                alert('$email is not existing in the database'); 
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
</html>