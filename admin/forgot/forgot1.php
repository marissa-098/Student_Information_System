<?php 
session_start();
$error = array();

require "mail.php";

	if(!$con = mysqli_connect("localhost","root","","icstitde_mis")){

		die("could not connect");
	}

	$mode = "enter_email";
	if(isset($_GET['mode'])){
		$mode = $_GET['mode'];
	}

	//something is posted
	if(count($_POST) > 0){

		switch ($mode) {
			case 'enter_email':
				// code...
				$email = $_POST['email'];
				//validate email
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error[] = "Please enter a valid email";
				}elseif(!valid_email($email)){
					$error[] = "That email was not found";
				}else{

					$_SESSION['forgot']['email'] = $email;
					send_email($email);
					header("Location: forgot1.php?mode=enter_code");
					die;
				}
				break;

			case 'enter_code':
				// code...
				$code = $_POST['code'];
				$result = is_code_correct($code);

				if($result == "the code is correct"){

					$_SESSION['forgot']['code'] = $code;
					header("Location: forgot1.php?mode=enter_password");
					die;
				}else{
					$error[] = $result;
				}
				break;

			case 'enter_password':
				// code...
				$password = $_POST['password'];
				$password2 = $_POST['password2'];

				if($password !== $password2){
					$error[] = "Passwords do not match";
				}elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
					header("Location: forgot1.php");
					die;
				}else{
					
					save_password($password);
					if(isset($_SESSION['forgot'])){
						unset($_SESSION['forgot']);
					}

					  echo '<script>';
                      echo 'alert("Password reset successfully! You can now log in with your new password.");';
                      echo 'window.location.href = "../index.php";';
                      echo '</script>';
					die;
				}
				break;
			
			default:
				// code...
				break;
		}
	}

	function send_email($email){
		
		global $con;

		$expire = time() + (60 * 1);
		$code = rand(10000,99999);
		$email = addslashes($email);

		$query = "insert into codes (email,code,expire) value ('$email','$code','$expire')";
		mysqli_query($con,$query);

		//send email here
		send_mail($email,'Password reset',"Your code is " . $code);
	}
	
  function save_password($password) {
    global $con;

    $password = password_hash($password, PASSWORD_DEFAULT);
    $email = mysqli_real_escape_string($con, $_SESSION['forgot']['email']);

    $found_table = valid_email($email);
    
    if ($found_table == 'tblsiadd') {
       $query = "UPDATE tblsiadd SET user_pass = '$password' WHERE EmailAdd = '$email' LIMIT 1";
        $result = mysqli_query($con, $query);

        if (!$result) {
            echo "Error resetting your password: " . mysqli_error($con);
        }
        
    } elseif ($found_table == 'tblgradeschool') {
        $query = "UPDATE tblgradeschool SET user_pass = '$password' WHERE EmailAdd = '$email' LIMIT 1";
        $result = mysqli_query($con, $query);

        if (!$result) {
            echo "Error resetting your password: " . mysqli_error($con);
        }
        
    }
}


	
	
	function valid_email($email){
    global $con;

    $email = mysqli_real_escape_string($con, $email);

    $query_siadd = "SELECT EmailAdd FROM tblsiadd WHERE EmailAdd = '$email' LIMIT 1";
    $query_gradeschool = "SELECT EmailAdd FROM tblgradeschool WHERE EmailAdd = '$email' LIMIT 1";

    $result_siadd = mysqli_query($con, $query_siadd);
    $result_gradeschool = mysqli_query($con, $query_gradeschool);

    if ($result_siadd && mysqli_num_rows($result_siadd) > 0) {
        return 'tblsiadd'; // Email found in tblsiadd
    } elseif ($result_gradeschool && mysqli_num_rows($result_gradeschool) > 0) {
        return 'tblgradeschool'; // Email found in tblgradeschool
    }

    return false; // Email not found in tblsiadd or tblgradeschool
}

	function is_code_correct($code){
		global $con;

		$code = addslashes($code);
		$expire = time();
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
		$result = mysqli_query($con,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				$row = mysqli_fetch_assoc($result);
				if($row['expire'] > $expire){

					return "the code is correct";

				}else{
					return "the code is expired";
				}
			}else{
				return "the code is incorrect";
			}
		}

		return "the code is incorrect";
	}

	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Forgot</title>
</head>
<body>
<style type="text/css">
	
	*{
		font-family: tahoma;
		font-size: 13px;
	}

	form{
		width: 100%;
		max-width: 200px;
		margin: auto;
		border: solid thin #ccc;
		padding: 10px;
	}

	.textbox{
		padding: 5px;
		width: 180px;
	}
</style>

		<?php 

			switch ($mode) {
				case 'enter_email':
					// code...
					?>
					<?php 
					// include("../../header.php");

					 ?>
						<form method="post" action="forgot1.php?mode=enter_email"> 
							<h1>Forgot Password</h1>
							<h3>Enter your email below</h3>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>
							<input class="textbox" type="email" name="email" placeholder="Email"><br>
							<br style="clear: both;">
							<input  class="next"  type="submit" value="Next">
							<br><br>
							<div><a href="../index.php">Login</a></div>
						</form>
					<?php				
					break;

				case 'enter_code':
					// code...
					?><?php 
					// include("../../header.php");

					 ?>
						<form method="post" action="forgot1.php?mode=enter_code"> 
							<h1>Forgot Password</h1>
							<h3>Enter your the code sent to your email</h3>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>

							<input class=" " type="text" name="code" placeholder="12345"><br>
							<br style="clear: both;">
							<input class="next" type="submit" value="Next" style="float: right;">
							<a href="forgot.php">
								<input type="button" value="Start Over">
							</a>
							<br><br>
							<div><a href="../index.php">Login</a></div>
						</form>
					<?php
					break;

				case 'enter_password':
					// code...
					?>
					<?php 
					// include("../../header.php");
					 ?>
					<div class="confirm">
						<form method="post" action="forgot1.php?mode=enter_password"> 
							<h1>Forgot Password</h1>
							<h3>Enter your new password</h3>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>

							<input class="" type="text" name="password" placeholder="Password"><br>
							<input class="" type="text" name="password2" placeholder="Retype Password"><br>
							<br style="clear: both;">
							<input class="next" type="submit" value="Next" style="float: right;">
							<a href="forgot1.php">
							<input class="next" type="button" value="Start Over">
							</a>
							<br><br>
							<div><a href="../index.php">Login</a></div>
						</form>
						</div>
					<?php
					break;
				
				default:
					// code...
					break;
			}

		?>


</body>

<style type="text/css">
	*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}
body{
	font-family: ubuntu;
	  background-image: url('../../img/background.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    height: 2018px;
}
.next{
	background: darkgreen;
	color: white;
	font-size: 20px;
	
}

h1{
	text-align: center;
	margin-top: 50px;
	font-size: 25px;
	margin-bottom: 30px;
}

form{
	max-width: 400px;
	margin: 50px auto 200px auto;
	border:  thin solid #e4e4e4;
	padding: 20px;
	background: white;
	box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
}

form label{
	display: block;
	margin-bottom: 10px;
	padding-left: 5px;
}

input, .textbox {

	width:  100%;
	padding: 10px;	
	margin-bottom: 10px;
	font-size: 16px;
	border:  thin solid #e4e4e4;
	margin-bottom: 30px;
}



form input:focus,
form select:focus,
form textarea
{
	outline: none;
}

form input::placeholder{
	font-size: 16px;
}

form button{
	background: #32749a;
	color: white;
	border: none;	
	padding: 15px;
	width:  100%;
	font-size: 16px;
	margin-top: 20px;
	cursor: pointer;
}

form button:active{
	background-color: green;
}

.error{
	margin-top: 30px;
	color: #af0c0c;
}

.success{
	margin-top: 30px;
	color: green;
}
</style>
</html>