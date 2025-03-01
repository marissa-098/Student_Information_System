
<?php

if (isset($_GET['delete'])) {
    $query = "DELETE FROM inquiry2324 WHERE PN = :pn";

    $statement = $conn_PDO->prepare($query);
    $success = $statement->execute(
        array(
            'pn' => $_GET['delete']
        )
    );

    if ($success) {
        $_SESSION['alert'] = "Delete Request Successfully!";
    } else {
        $_SESSION['alert'] = "Delete Request Failed!";
    }

    header("location: index.php?page=inquiry");
    exit();
}
?>

<?php
// In your HTML, you can display the alert like this:
if (isset($_SESSION['alert'])) {
    $alertClass = "showalert";
    $message = $_SESSION['alert'];
    unset($_SESSION['alert']);
} else {
    $alertClass = "";
    $message = "";
}
?>








<style>


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
position: absolute;
bottom: 15px;
right: 15px;
color: #666;
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
background-color: white;
padding: 20px;
border-radius: 5px;
position: relative;
}
.name-label {
float: left;
font-weight: bold;
width: 150px; /* Set a width for the label */
clear: left; /* Clear the float after each label-value pair */
}

.name-value {
margin-left: 10px; /* Adjust the margin as needed */
overflow: hidden; /* Prevent content from overflowing */
}
.content{
margin-bottom: 50px;
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



</style>

<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <br>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./index.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="./index.php?page=request" class="breadcrumb-link">Request</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"> view</li>
                                    </ol>
                                </nav>
                            </div>
                        
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
               
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Inquiry Information   <a href="./index.php?page=request" class="close-btn" onclick="closeMessage()">&times;</a> </h5>
                                <div class="card-body">
                                
                                        <?php

                                     $pn=$_GET['PN'];
                                     $req = $conn_PDO->prepare("SELECT * FROM reqchange WHERE PN = :pn");
                                     $req->bindParam(':pn', $pn, PDO::PARAM_STR);
                                     $req->execute();
                                     if($req->rowCount() > 0){
                                     while($fetch_req = $req->fetch(PDO::FETCH_ASSOC)){ 

                                        ?>

                        <div class="message-popup" id="messagePopup">
                            <div class="popup-content">
                                <div class="sender-info">
                                    <h3 class="sender-name">[<?= $fetch_req['StudNum']; ?>] </h3>
                                    <span class="date"><?= $fetch_req['date']; ?></span>
                                </div>
                                <!-- Add data-index attribute to uniquely identify each message -->
                                 <div class="content">
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

                                    </div>
                                             <a  href="./index.php?page=Request/update&PN=<?= $fetch_req['PN']; ?>" class="update center" type="submit" name="submit"><span class="material-symbols-outlined">reply</span> REPLY</a>

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
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/custom-js/jquery.multi-select.html"></script>
    <script src="../assets/libs/js/main-js.js"></script>
    <script src="../assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="../assets/vendor/datatables/js/data-table.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          var firstName = $('#firstName').text();
          var lastName = $('#lastName').text();
          var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
          var profileImage = $('#profileImage').text(intials);
        });
    </script>

