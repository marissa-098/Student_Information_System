<?php
// if (class_exists('PDO')) { echo "installed"; } else { echo "not installed"; } 
?>
<?php 

  include("config/conn.php");
  if(isset($_POST['login'])){


          $_SESSION['id'] = $_POST['fr_studid'];

			$sql =" SELECT 'tblgradeschool' AS studentList
				FROM tblgradeschool
				WHERE tblgradeschool.StudNum = :stud_id
				UNION ALL
				SELECT 'tblsi' AS studentList
				FROM tblsi
				WHERE tblsi.StudNum = :stud_id";

					
				


				$stmt = $conn_PDO->prepare($sql);
							$stmt->execute(
							array( 
								'stud_id'=> $_POST['fr_studid']
							)
							);
							$count0 = $stmt->rowCount();
							if($count0 > 0 ){
							$res = $stmt->fetchAll();
							foreach ($res as $newRes) {


								//if the stud number is from tblsi
								if($newRes["studentList"] == "tblsi"){   

									$queryCollege ="
									SELECT * FROM tblsi t1
									INNER JOIN tblsiadd t2 ON t1.StudNum = t2.StudNum
									WHERE t1.StudNum = :stud_id
									";

									$statement = $conn_PDO->prepare($queryCollege);
									$statement->execute(
									  array( 
										'stud_id'=> $_POST['fr_studid']
									  )
									);
									$count = $statement->rowCount();
									if($count > 0 ){
									  $result = $statement->fetchAll();
									  foreach ($result as $row) {
										
						
								
                
								  $raw_password = strtoupper($_POST["fr_studPass"]);
								  $hash_password = strtoupper($row["user_pass"]);
								  $password = $_POST["fr_studPass"];
								  $HASHpassword = $row["user_pass"];

								 
									if (password_verify($password, $HASHpassword) || ($raw_password == $hash_password)) {
									    
									    	function get_client_ip()
									{
										foreach (array(
													'HTTP_CLIENT_IP',
													'HTTP_X_FORWARDED_FOR',
													'HTTP_X_FORWARDED',
													'HTTP_X_CLUSTER_CLIENT_IP',
													'HTTP_FORWARDED_FOR',
													'HTTP_FORWARDED',
													'REMOTE_ADDR') as $key) {
											if (array_key_exists($key, $_SERVER)) {
												foreach (explode(',', $_SERVER[$key]) as $ip) {
													$ip = trim($ip);
													if ((bool) filter_var($ip, FILTER_VALIDATE_IP,
																	FILTER_FLAG_IPV4 |
																	FILTER_FLAG_NO_PRIV_RANGE |
																	FILTER_FLAG_NO_RES_RANGE)) {
														return $ip;
													}
												}
											}
										}
										
									}


									$ip = get_client_ip();
									$loc = file_get_contents("http://ip-api.com/json/$ip");

									$data = json_decode($loc);

									$city = $data->city;
									$region = $data->regionName;
									$country = $data->country;
									$zip =  $data->zip;
									$timezone =  $data->timezone;

									$location = $timezone ." " . $country  ." " .$region  ." " .$city ." " .$zip;

									$_SESSION["location"] = $location;

											// Example usage
										$userAgent = $_SERVER['HTTP_USER_AGENT'];
										$insert_active_query = "
											INSERT INTO logs (Id, Device, location, last_login_activity)
											VALUES (:user_id, :device, :location, :last_activity)";
										$insert_statement = $conn_PDO->prepare($insert_active_query);
										date_default_timezone_set('Asia/Manila');
										$insert_statement->execute(
											array(
												'user_id' =>  $_POST['fr_studid'],
													'location' => $_SESSION["location"],
													'device' => $_SERVER['HTTP_USER_AGENT'],
													'last_activity' => date('Y-m-d H:i:s')
													
											)
										);

									

										?>
										<script>
											alert("Login Success!");
											setTimeout((window.location.href="college-students/index.php"), 1000);
										</script>
										<?php
				   
				   	   
							 // go to home.php
								   
								   header('Location:college-students/index.php');
								   
								 }
									  else{
										
										  $_SESSION['alert'] = "0";
										  ?>
										 <script>
											 alert("Login Failed!");
										 </script>    
						
										 <?php
						
										 }
						
									  }
									  
									}else{
									 
									$_SESSION['alert'] = "0";
								    }

									



								}else{   //if the student number is in tblgradeschool


									$queryGradeschool ="
										SELECT * FROM tblgradeschool 
										WHERE StudNum = :stud_id
										";


									$statement = $conn_PDO->prepare($queryGradeschool);
									$statement->execute(
									  array( 
										'stud_id'=> $_POST['fr_studid']
									  )
									);
									$count = $statement->rowCount();
									if($count > 0 ){
									  $result = $statement->fetchAll();
									  foreach ($result as $row) {
										
						
										  
										  
								  //check the password from form 

								  $raw_password = strtoupper($_POST["fr_studPass"]);
								  $hash_password = strtoupper($row["user_pass"]);
								  $password = $_POST["fr_studPass"];
								  $HASHpassword = $row["user_pass"];
								


										if (password_verify($password, $HASHpassword) || ($raw_password == $hash_password)) {

									

													function get_client_ip()
													{
														foreach (array(
																	'HTTP_CLIENT_IP',
																	'HTTP_X_FORWARDED_FOR',
																	'HTTP_X_FORWARDED',
																	'HTTP_X_CLUSTER_CLIENT_IP',
																	'HTTP_FORWARDED_FOR',
																	'HTTP_FORWARDED',
																	'REMOTE_ADDR') as $key) {
															if (array_key_exists($key, $_SERVER)) {
																foreach (explode(',', $_SERVER[$key]) as $ip) {
																	$ip = trim($ip);
																	if ((bool) filter_var($ip, FILTER_VALIDATE_IP,
																					FILTER_FLAG_IPV4 |
																					FILTER_FLAG_NO_PRIV_RANGE |
																					FILTER_FLAG_NO_RES_RANGE)) {
																		return $ip;
																	}
																}
															}
														}
														
													}


													$ip = get_client_ip();
													$loc = file_get_contents("http://ip-api.com/json/$ip");

													$data = json_decode($loc);

													$city = $data->city;
													$region = $data->regionName;
													$country = $data->country;
													$zip =  $data->zip;
													$timezone =  $data->timezone;

													$location = $timezone ." " . $country  ." " .$region  ." " .$city ." " .$zip;

													$_SESSION["location"] = $location;



						
											// Insert an activity log
											$insert_active_query = "
											INSERT INTO logs (Id, Device, location, last_login_activity)
											VALUES (:user_id, :device, :location, :last_activity)";
											$insert_statement = $conn_PDO->prepare($insert_active_query);
											date_default_timezone_set('Asia/Manila');
											$insert_statement->execute(
											array(
												'user_id' =>  $_POST['fr_studid'],
													'location' => $_SESSION["location"],
													'device' => $_SERVER['HTTP_USER_AGENT'],
													'last_activity' => date('Y-m-d H:i:s')
											)
										);
						
						
		
										 ?>
										<script>
											 alert("Login Success!");
											 setTimeout((window.location.href="gradeschool/index.php"),1000);
										 </script>   
						
										   
										 <?php
						
								  // go to home.php
										
										header('Location:gradeschool/index.php');
										
									  }
									  else{
										
										  $_SESSION['alert'] = "0";
										  ?>
										 <script>
											 alert("Login Failed!");
										 </script>    
						
										 <?php
						
										 }
						
									  }
									  
									}else{
									 
									$_SESSION['alert'] = "0";
								    }
								}

							}
							
							}


        else{
                
                  $_SESSION['alert'] = "0";
                 }

           }
          ?>


<!DOCTYPE html>
<html lang="en">



<head>
    <title>ICST | Student-Portal </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="author" content="codedthemes" />
      <!-- Favicon icon -->

      <link rel="icon" href="assets/images/logo_trans.png" type="image/x-icon">
      <!-- Google font-->     
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
      <!-- waves.css -->
      <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
	  <link rel="preconnect" href="https://fonts.googleapis.com">
	  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
	  </head>
  <style>
  	/* Coded with love by Mutiullah Samim */
		body,
		html {
			margin: 0;
			padding: 0;
			background: linear-gradient(45deg,  transparent 50%,white 50%),
				  url('img/backgroundG.jpg');
			background-repeat: no-repeat;
			background-size: cover;
			
		}
		.dm-sans-20 {
		  font-family: "DM Sans", sans-serif;
		  font-optical-sizing: auto;
		  font-weight:1000;
		  font-style: normal;
		}
		.dm-sans-10 {
		  font-family: "DM Sans", sans-serif;
		  font-optical-sizing: auto;
		  font-weight:500;
		  font-size:11px;
		  font-style: normal;
		}
			.hr{
						margin-top: 1rem;
						margin-bottom: 1rem;
						border: 0;
						border-top: 4px solid rgb(23 255 245 / 30%);
					}
		.user_card {
			height: auto;
			width: auto;
			margin-top: 90px;
			margin-bottom: 20px;
			background: green;
			position: relative;
			display: flex;
			color:white;
			justify-content: center;
			flex-direction: column;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;

		}
		.brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			background: white;
			padding: 10px;
			text-align: center;
		}
		.brand_logo {
			height: 190px;
			width: auto;
			margin-top: -40px;
		}
		.form_container {
			margin-top: 100px;
		}
		.login_btn {
			width: 100%;
			background: #c0392b !important;
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		#145b0d {
			background: #c0392b !important;
			color: white !important;
			border: 0 !important;
			border-radius: 0.25rem 0 0 0.25rem !important;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: #c0392b !important;
		}
        #NameICST768,
		#welcome{
			display:none;
		}

		 @media (max-width: 767px) {
			 body,
				html {
					margin: 0;
					padding: 0;
					background: linear-gradient(45deg,  transparent 50%,white 50%),
						  grey;
					background-repeat: no-repeat;
					background-size: cover;
					
				}
			#welcome{
			display:block;
			margin-bottom:30px;
			
		}#particles-js,
		#NameICST,
		#welcome1{
			display:none;
		}
}

		@media (min-width: 768px) and (max-width: 1200px) {
			#NameICST,
            #welcome
			{
				display:none;
			}
			 #NameICST768{
              display:block;
			}
		}
		
		
	}
		</style>

  <body>
  <!-- Pre-loader start -->
  <div class="theme-loader">
      <div class="loader-track">
          <div class="preloader-wrapper">
              <div class="spinner-layer spinner-blue">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
              <div class="spinner-layer spinner-red">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
            
              <div class="spinner-layer spinner-yellow">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
            
              <div class="spinner-layer spinner-green">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Show Captcha Modal -->
  <div class="modal fade" id="sliderCapchaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
              <span>Please complete security verification!</span>
              </div>
              <div class="modal-body">
                    <div class="card-body">
                        <div id="captcha"></div>
                    </div>
              </div>
              <br>
              <br>
          </div>
      </div>
  </div>



 <div id="NameICST" style="position:absolute; right:0;  " class="  mx-4 text-right "><p  class="dm-sans-20 form-txt-success f-70 f-b f-k1">INNOVATIVE COLLEGE </p>
	<p style="margin-top:-40px; color:black;" id="ofScience" class=" dm-sans-20 f-40"> OF SCIENCE &amp; TECHNOLOGY</p>
	<hr>
	<span class="dm-sans-20">			(+63) 9382354345 </span> |
	<span class="dm-sans-20">			(043) 748 - 9015 </span> |
	<span class="dm-sans-20">			icst2004@icst.edu.ph </span>
<p id="location" class="dm-sans-20 f-15 f-mnt">Malitbog, Bongabong, Oriental Mindoro 5211, Philippines</p>          
			
	</div>
<div id="NameICST768" style=" position:absolute; right:0; " class=" dm-sans-20 mx-4 text-right "><p style="letter-spacing: 3px;"  class="dm-sans-20 form-txt-success f-34 f-b f-k1">INNOVATIVE COLLEGE</p>
	<p style="margin-top:-25px; color:black;" id="ofScience" class="dm-sans-20 f-30"> OF SCIENCE &amp; TECHNOLOGY</p>
	<hr style="color: #2bf120;"  class="hr">
<p class="f-12 f-mnt">
	<span class="dm-sans-20">			(+63) 9382354345 </span> |
	<span class="dm-sans-20">			(043) 748 - 9015 </span> |<br>
	<span class="dm-sans-20">			icst2004@icst.edu.ph </span></p>
<p style="margin-top: -20px;" id="location" class="f-12 f-mnt">Malitbog, Bongabong, Oriental Mindoro <br> 5211, Philippines</p>          
			
	</div>
  <!-- Pre-loader end -->
    <section class="login-block">
	
        <!-- Container-fluid starts -->
        <div style=" max-width:900px;"class="container">
			<div style="background-color:green;" id="welcome"class=" text-center card-header">
				<p style="color: white;"  class="dm-sans-20 f-20 f-b f-k1">INNOVATIVE COLLEGE OF</p>
	            <p style="margin-top:-20px; color:#2bf120;" id="ofScience" class="dm-sans-20 f-18"> SCIENCE &amp; TECHNOLOGY</p>
			<hr class="hr">
			<p style="color: white;"  class="dm-sans-10 ">(+63) 9382354345 | (043) 748 - 9015 | icst2004@icst.edu.ph </p>
            <p style="color: white; margin-top: -20px;" class=" dm-sans-10">Malitbog, Bongabong, Oriental Mindoro 5211, Philippines</p>
			
			</div>
            
			<div id="welcome"class="text-center">
				<h5  class="dm-sans-20 mx-4 "> WELCOME TO STUDENT PORTAL</h5>
			</div>
		
		
              <div class="row">
                <div class=" col-sm-12">
                   
                    <div  class="row">
						<div class="col-md-6">
						 <!-- Authentication card start -->
                                <div class=" card user_card">
									<div class="d-flex justify-content-center">
										<div class="brand_logo_container">
											<img src="assets/images/logo_trans.png" class="brand_logo" alt="Logo">
										</div>
									</div>
									<div class="d-flex justify-content-center form_container">
								<form class="" method="post">
                           
                                    <div class="">
                                        <div  class="card-block">
                                            <div class=" text-center form-primary">
                                                <h6 class="dm-sans-20 form-bar ">ALREADY HAVE A STUDENT ID OR SP NO.?</h6>
                                                <span class="f-10">( HERE ARE SOME EXAMPLES: “20-0XXXX”, “SHS20-00XXXX”, “SP20-0XXXX”. )</span>
                                            </div>
                                            <?php
												  if (isset($_SESSION['alert'])) {
													$alert = "showalert";
													$errorMessage = "Try Again: Wrong username or password.";
													session_unset();
												  }
												  ?>
												  <?php if (!empty($alert)): ?>
														<div class="error-message <?php echo $alert; ?>">
															<i class="fa fa-exclamation-circle"></i>
															<span class="message f-10"><?php echo $errorMessage; ?></span>
														</div>
													<?php endif; ?>
                                                <br>
                                            <div class="form-group form-primary">
											<span style="font-size:11px;">Student ID Or SP No.</spana>
                                                <input placeholder="Student ID Or SP No." type="text" name="fr_studid" class="form-control" required autocomplete="off">
                                                <span class="form-bar"></span>
                                                
                                            </div>
                                            <div class="form-group form-primary">
											<span  style="font-size:11px;">Password</span>
                                                <input placeholder="Password" type="password" id="password" name="fr_studPass" class="form-control" required autocomplete="off">
                                                <span class="form-bar"></span>
                                                
                                            </div>
                                            <div class="row text-left">
                                                <div class="col-12">
                                                    <div class="checkbox-fade fade-in-primary d-">
                                                        <label>
                                                            <input type="checkbox" id="show">
                                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                            <span>Show Password</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button style="background:#032902;" name="login" id="btnSubmit" type="submit" class="btn btn-success btn-md btn-block waves-effect waves-light text-center">Sign in</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
									</div>
									<div class="my-2">
										<div class="d-flex justify-content-center links">
											<a style="color:white; text-decoration:none;" href="forgot/forgot1.php" >Forgot your password?</a>
										</div>
									</div>
								</div>
								
						
                        </div>
        
                           <div  class="col-md-6">
						   <div class="">
								<div style="margin-top:240px;" id="welcome1" class=" text-center card-header">
									<h3 class="dm-sans-20"> WELCOME TO STUDENT PORTAL</h3>
								</div>
								<div style="background-color: rgba(33, 111, 50, 0.5); padding:10px;">
									<div style=" text-align: justify; color:white; justify;"class="form-group form-primary ">
										<br>
										   <b class="dm-sans-20" style=" font-size: 15px;">Read Me!</b>
										   <br >
												To prevent unauthorized use, you shall keep your password confidential
												and shall not share it with any third party or use it to access third
												party websites or services.
												<br>
											<hr>
										</div>
										<div style=" color:white; text-align: justify;" class=" form-group form-primary">
											 <b class="dm-sans-20" style=" font-size: 15px;">New Here!</b>
										   <br >
												Please use your Student ID and Password given to you by the MIS Office.
												Immediately report any issues or problems encountered while using the
												portal.
												<br>
										</div>
										</div>
								</div>
							</div>								
                        </div>
                        <!-- end of col-sm-12 -->
                    </div>
                </div>
                
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
	
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<![endif]-->
<!-- Warning Section Ends -->
<!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>     <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>     <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>     <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
<!-- waves js -->
<script src="assets/pages/waves/js/waves.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
<!-- modernizr js -->
    <script type="text/javascript" src="assets/js/SmoothScroll.js"></script>     <script src="assets/js/jquery.mCustomScrollbar.concat.min.js "></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<script type="text/javascript" src="assets/js/common-pages.js"></script>
 <!-- Slider Captcha -->

  
 <script>
    document.getElementById("show").addEventListener("change", function() {
        var passwordInput = document.getElementById("password");
        passwordInput.type = this.checked ? "text" : "password";
    });
	

</script>
</body>
<footer class="form-bg-inverse ">
    <div class="p-t-10 p-b-10 text-center">
        <strong>Online Student Information System</strong>
        <br>
        <p>Develop by Marissa Manrique &#169; 2023 </p>
        
    </div>
  </footer>
</html>
