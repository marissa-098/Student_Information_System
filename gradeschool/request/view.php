
<style>
.alert {
display: none;
padding: 20px;
background-color: #lime; /* Green background color for success */
color: black; /* White text color */
border-radius: 5px; /* Rounded corners */
margin-bottom: 15px;
}

.alert-danger {
background-color: #f44336; /* Red background color for danger */
}

.close-btn {
float: right;
margin-left: 15px;
color: black;
font-weight: bold;
float: right;
font-size: 22px;
line-height: 20px;
cursor: pointer;
transition: 0.3s;
}

.close-btn:hover {
color: black;
}

.message-popup .date {
    font-size: 12px;
position: absolute;
bottom: 15px;
right: 15px;
color: #666;
}.message-content{
    margin-bottom: 50px;
}

.message-popup {  
width: 100%;
height: 100%;
background-color: rgba(0, 0, 0, 0.5);
align-items: center;
justify-content: center;
}

.popup-content {
height: 50%;
background-color: #185717;
padding: 20px;
position: relative;
}
.update {
background-color: #6AB8E8; /* Background color */
color: #fff; /* Text color */
padding: 10px 20px; /* Padding around text */
font-size: 16px; /* Font size */
border: none; /* Remove border */
border-radius: 5px; /* Add rounded corners */
cursor: pointer; /* Add cursor pointer on hover */
transition: background-color 0.3s ease; /* Smooth transition on hover */
width: 200px;
float: right;
margin-top: 10px;
}

.update:hover {
background-color:#54CA24; /* Change background color on hover */
}
.date1{
    float: right;
    font-size: 12px;
}



body{
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background: url('http://forums.crackberry.com/attachments/blackberry-10-wallpapers-f308/137432d1361639896t-z10-wallpaper-set-z10-music.jpg');
}
.speech-wrapper{
  .bubble{
    height: auto;
    display: block;
    background: #f5f5f5;
    border-radius: 4px;
    box-shadow: 2px 8px 5px #000;
    position: relative;
    margin: 20px 0 25px 10px;
    &.alt{
      margin: 0 0 0 0px;
    }
    .txt{
      padding: 8px;
      .name{
        font-weight: 600;
        font-size: 12px;
        margin: 0 0 4px;
        color: #3498db;
        span{
          font-weight: normal;
          color: #b3b3b3;
        }
        &.alt{
          color: #2ecc71;
        }
      }
      .message{
        font-size: 12px;
        margin: 0;
        color: #2b2b2b;
      }
      .timestamp{
        font-size: 11px;
        position: absolute;
        bottom: 8px;
        right: 10px;
        text-transform: uppercase; color: #999
      }
    }
    .bubble-arrow {
      position: absolute;
      width: 0;
      bottom:42px;
      left: -16px;
      height: 0;
      &.alt{
        right: -2px;      
        bottom: 40px;
        left: auto;
      }
    }
    .bubble-arrow:after {
      content: "";
      position: absolute;
      border: 0 solid transparent;
      border-top: 9px solid #f5f5f5;
      border-radius: 0 20px 0;
      width: 15px;
      height: 30px;
      transform: rotate(145deg);
    }
    .bubble-arrow.alt:after {
      transform: rotate(45deg) scaleY(-1);
    }
	
  }
}

.hr{
	border: 0;
    border-top: 1px solid rgba(0, 0, 0, .1);

</style>
  <link rel="stylesheet" href="css/homepagecss.css" />
 <link rel="stylesheet" href="../css/custom.css">  

 <br>
 <br> 
<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
              
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
               
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Request Information   <a href="./index.php?page=request" class="close-btn" onclick="closeMessage()">&times;</a> </h5>
                                <div class="">
                                
                                        <?php

                                     $pn=$_GET['PN'];
                                     $req = $conn_PDO->prepare("SELECT * FROM reqchange WHERE PN = :pn");
                                     $req->bindParam(':pn', $pn, PDO::PARAM_STR);
                                     $req->execute();
                                     if($req->rowCount() > 0){
                                     while($fetch_req = $req->fetch(PDO::FETCH_ASSOC)){ 
                                           $responsedate = new DateTime($fetch_req['responseDate']);
                                           $date = new DateTime($fetch_req['date']);

                                        ?>

                        <div class="message-popup" id="messagePopup">
                            <div class="popup-content">
							
							
							<div class="speech-wrapper">
												  <!--  Speech Bubble alternative -->
												  <div class="col-sm-12">
													  <div class="row">
														  <div class=" col-sm-12 bubble alt">
															<div class="txt">
															   <p class="name alt"><span> ~ You</span> [<?= $fetch_req['StudNum']; ?>] </p>
															  <p class="hr"></p>
															  <p class="message">
																<div class="row">
											<div class="col-sm-3">
											  <h6 class="mb-0">Name:</h6>
											</div>
											<div class="col-sm-9 text-secondary">
											  <?= $fetch_req['Lname']; ?>,
											<?= $fetch_req['Fname']; ?> <?= $fetch_req['Mname']; ?>
											</div>
									  </div>
									  <div class="row">
											<div class="col-sm-3">
												  <h6 class="mb-0">Course:</h6>
												</div>
												<div class="col-sm-9 text-secondary">
												  <?php echo $fetch_req['Course'] == "" ? 'N/A' : $fetch_req['Course']; ?>
											</div>
									  </div>
									   <div class="row">
											<div class="col-sm-3">
												  <h6 class="mb-0">Major:</h6>
												</div>
												<div class="col-sm-9 text-secondary">
												 <?php echo $fetch_req['Major'] == "" ? 'N/A' : $fetch_req['Major']; ?>
											</div>
									  </div>
									  <div class="row">
											<div class="col-sm-3">
												  <h6 class="mb-0">Gender:</h6>
												</div>
												<div class="col-sm-9 text-secondary">
												 <?= $fetch_req['Sex']; ?>
											</div>
									  </div>
									  <div class="row">
											<div class="col-sm-3">
												  <h6 class="mb-0">Address:</h6>
												</div>
												<div class="col-sm-9 text-secondary">
												 <?= $fetch_req['Sitio']; ?> <?= $fetch_req['Brgy']; ?> <?= $fetch_req['Town']; ?> <?= $fetch_req['Province']; ?>
											</div>
									  </div>
									   <div class="row">
											<div class="col-sm-3">
												  <h6 class="mb-0">Birth Place:</h6>
												</div>
												<div class="col-sm-9 text-secondary">
												 <?= $fetch_req['Sitio']; ?> <?= $fetch_req['Brgy']; ?> <?= $fetch_req['Town']; ?> <?= $fetch_req['Province']; ?>
											</div>
									  </div>
									   <div class="row">
											<div class="col-sm-3">
												  <h6 class="mb-0">Contact Number:</h6>
												</div>
												<div class="col-sm-9 text-secondary">
												 <?= $fetch_req['CNumber']; ?>
											</div>
									  </div>
									  <div class="row">
											<div class="col-sm-3">
												  <h6 class="mb-0">Religion:</h6>
												</div>
												<div class="col-sm-9 text-secondary">
												<?= $fetch_req['Religion']; ?>
											</div>
									  </div>
									  <div class="row">
											<div class="col-sm-3">
												  <h6 class="mb-0">Email:</h6>
												</div>
												<div class="col-sm-9 text-secondary">
												<?php echo $fetch_req['EmailAdd'] == "" ? '' : $fetch_req['EmailAdd']; ?>
											</div>
									  </div>
									  <div class="row">
											<div class="col-sm-3">
												  <h6 class="mb-0">Nationality:</h6>
												</div>
												<div class="col-sm-9 text-secondary">
												<?= $fetch_req['Nationality']; ?>
											</div>
									  </div>
									  <div class="row">
											<div class="col-sm-3">
												  <h6 class="mb-0">Father's Name:</h6>
												</div>
												<div class="col-sm-9 text-secondary">
													<?= $fetch_req['Father']; ?>, <?= $fetch_req['FatherFName']; ?> <?= $fetch_req['FatherMName']; ?>
											</div>
									  </div>
									  <div class="row">
											<div class="col-sm-3">
												  <h6 class="mb-0">Mother's Name:</h6>
												</div>
												<div class="col-sm-9 text-secondary">
												<?= $fetch_req['Mother']; ?>, <?= $fetch_req['MotherFname']; ?> <?= $fetch_req['MotherMname']; ?>
											</div>
									  </div>
									  <div class="row">
											<div class="col-sm-3">
												  <h6 class="mb-0">Change Data:</h6>
												</div>
											<div class="col-sm-9 text-secondary">
												<?= $fetch_req['data']?>
											</div>
									  </div>

                                        <br><br>
															 
															  <span class="timestamp"><?= $date->format('F d, Y g:ia'); ?></span>
															</div>
															<div class="bubble-arrow alt"></div>
														  </div>
													  </div>
													  <div class="row">
														  <div class=" col-sm-12 bubble">
															<div class="txt">
															  <p class="name"><img style="width:25px; height:25px;" src="../img/logo.png"> ICST</p>
															  <p class="hr"></p>
															  <p class="message"><?= $fetch_req['response']; ?></p>
															  <br>
															  <span class="timestamp"><?= $responsedate->format('F d, Y g:ia'); ?></span>
															</div>
															<div class="bubble-arrow"></div>
														  </div>
													  </div>
												  </div>
												</div>
                                    
                                    </div>



                            </div>
                        </div>

                                        <?php 
                                            }
                                          }
                                          ?>


                                 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end responsive table -->
                        <!-- ============================================================== -->
                    </div>
               
            </div>
            
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
 
    <script type="text/javascript">
        $(document).ready(function(){
          var firstName = $('#firstName').text();
          var lastName = $('#lastName').text();
          var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
          var profileImage = $('#profileImage').text(intials);
        });
    </script>

