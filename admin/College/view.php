<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<style type="text/css">
		 #updateBtn {
                          background-color: #6AB8E8; /* Background color */
                          color: #fff; /* Text color */
                          padding: 10px 20px; /* Padding around text */
                          font-size: 16px; /* Font size */
                          border: none; /* Remove border */
                          border-radius: 5px; /* Add rounded corners */
                          cursor: pointer; /* Add cursor pointer on hover */
                          transition: background-color 0.3s ease; /* Smooth transition on hover */
                          width: auto;
                      }

                      #updateBtn:hover {
                          background-color:#54CA24; /* Change background color on hover */
                      }
                       #displayResult {
                          background-color: #6AB8E8; /* Background color */
                          color: #fff; /* Text color */
                          padding: 10px 20px; /* Padding around text */
                          font-size: 16px; /* Font size */
                          border: none; /* Remove border */
                          border-radius: 5px; /* Add rounded corners */
                          cursor: pointer; /* Add cursor pointer on hover */
                          transition: background-color 0.3s ease; /* Smooth transition on hover */
                          width: 100%;
                          margin-left: auto;
                          margin-right: auto;
                      }

                      #displayResult:hover {
                          background-color:#54CA24; /* Change background color on hover */
                      }
                      #printGrades {
                          background-color:#22B98E; /* Background color */
                          color: #fff; /* Text color */
                          padding: 10px 20px; /* Padding around text */
                          font-size: 16px; /* Font size */
                          border: none; /* Remove border */
                          border-radius: 5px; /* Add rounded corners */
                          cursor: pointer; /* Add cursor pointer on hover */
                          transition: background-color 0.3s ease; /* Smooth transition on hover */
                         width: 100%;
                      }

                      #printGrades:hover {
                          background-color: #54CA24; /* Change background color on hover */
                      }
	
</style>
</head>
<body>
	<?php 
	if(isset($_GET['stid'])){
	   $studentId = $_GET['stid'];


    // Fetch student details from the database based on the provided studentId
    $query = "SELECT * FROM tblsi t1
                  INNER JOIN tblsiadd t2 ON t1.StudNum = t2.StudNum
                  WHERE t1.StudNum = :studentId";
    $statement = $conn_PDO->prepare($query);
    $statement->bindParam(':studentId', $studentId, PDO::PARAM_STR);
    $statement->execute();

    $studentDetails = $statement->fetch(PDO::FETCH_ASSOC);

    if ($studentDetails) {

      ?>


	   <div class="container">
    <div class="main-body">
          <!-- Breadcrumb -->
        <div class="row">
		  <div class="page-breadcrumb col-md-4 p-t-20">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="./index.php" class="breadcrumb-link">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="./index.php?page=college_list" class="breadcrumb-link">College</a></li>
					<li class="breadcrumb-item active" aria-current="page">student info</li>
				</ol>
			</nav>
		</div>
	</div>
          <!-- /Breadcrumb -->
    <form  method="post" enctype="multipart/form-data">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">

                      <?php
                           $databasePic = "../admin/Pictures/" . $studentDetails['Picture'];

                         // Check if the picture file exists
                        if (file_exists($databasePic)) {
                         // Use the actual image
                         $pictureSrc = $databasePic;
                         } else {
                         // Generate an avatar using the UI Avatars service
                         $firstName = $studentDetails['Fname'];
                         $lastName = $studentDetails['Lname'];
                         $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($lastName . " " . $firstName );

                         // Use the avatar URL
                         $pictureSrc = $avatarUrl;
                          }
                          ?>

                          <img id="studPic" src="<?= $pictureSrc; ?>" alt="Student" class="rounded-circle" width="150">

    


                    <div class="mt-3">
                      <h4><?= $studentDetails['Lname']; ?>, <br> <?= $studentDetails['Fname']; ?> <?= $studentDetails['Mname']; ?></h4>
                      <p class="text-secondary mb-1">[<?= $studentDetails['StudNum']; ?>]</p>

                      <p class="text-muted font-size-sm"><?= $studentDetails['Course']; ?>-<?= $studentDetails['Major']; ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
               
                 </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <h2><strong>Personal Information</strong></h2>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $studentDetails['Sex']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Date of Birth</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                            <?= $studentDetails['Bdate']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Place of Birth</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                       <?= $studentDetails['BPlace']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nationality</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $studentDetails['Nationality']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Religion</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <?= $studentDetails['Religion']; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      
                    </div>
                  </div>
                </div>
              </div>
             </div>
			 <!-- Bootstrap tab card start -->
		<div class="col-lg-12 col-xl-12">
			<div class="sub-title">OTHER INFORMATION</div>
			<!-- Nav tabs -->
			<ul class="nav nav-tabs  tabs" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#home1" role="tab">>></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#profile1" role="tab">Educational Background</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#messages1" role="tab">Accounts</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#settings1" role="tab">Grades</a>
				</li>
				 <li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#schedule" role="tab">Schedule</a>
				</li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content tabs card-block">
				<div class="tab-pane active" id="home1" role="tabpanel">
				<br>
					<div class="col-md-12">
					  <div class="card mb-3">
						<div class="card-body">
						  <div class="row">
							<div class="col-sm-3">
							  <h6 class="mb-0">Address</h6>
							</div>
							<div class="col-sm-9 text-secondary">
							  <?= $studentDetails['Sitio']; ?>, <?= $studentDetails['Brgy']; ?>,<?= $studentDetails['Town']; ?>, <?= $studentDetails['Province']; ?>
							</div>
						  </div>
						  <hr>
						  <div class="row">
							<div class="col-sm-3">
							  <h6 class="mb-0">Contact Number</h6>
							</div>
							<div class="col-sm-9 text-secondary">
									<?= $studentDetails['CNumber']; ?>
							</div>
						  </div>
						  <hr>
						  <div class="row">
							<div class="col-sm-3">
							  <h6 class="mb-0">Email Address</h6>
							</div>
							<div class="col-sm-9 text-secondary">
							   <?= $studentDetails['EmailAdd']; ?>
							</div>
						  </div>
						  <hr>
						  <div class="row">
							<div class="col-sm-3">
							  <h6 class="mb-0">Fathers Name</h6>
							</div>
							<div class="col-sm-9 text-secondary">
							   <?= $studentDetails['Father']; ?>, <?= $studentDetails['FatherFName']; ?>  <?= $studentDetails['FatherMName']; ?> 
							</div>
						  </div>
						  <hr>
						  <div class="row">
							<div class="col-sm-3">
							  <h6 class="mb-0">Mothers Name</h6>
							</div>
							<div class="col-sm-9 text-secondary">
							 <?= $studentDetails['Mother']; ?>,  <?= $studentDetails['MotherFname']; ?>  <?= $studentDetails['MotherMname']; ?>
							</div>
						  </div>
						  <hr>
						  <div class="row">
							<div class="col-sm-12">
							<a class="btn btn-info" href="./index.php?page=College/editProfile&stid=<?= $studentId ?>">Edit</a>
							</div>
						  </div>
						</div>
					  </div>
					  </div>
					
				</div>
				<div class="tab-pane" id="profile1" role="tabpanel">
				
					<div class="col-md-12">
				  <div class="card mb-3">
					<div class="card-body">
					  <div class="row">
						<div class="col-sm-3">
						  <h6 class="mb-0">Elementary:</h6>
						</div>
						<div class="col-sm-9 text-secondary">
						  <?= $studentDetails['Elem']; ?>
						</div>
					  </div>
					 
					  <div class="row">
						<div class="col-sm-3">
						  <h6 class="mb-0">Address:</h6>
						</div>
						<div class="col-sm-9 text-secondary">
								<?= $studentDetails['Add1']; ?>
						</div>
					  </div>
					   <div class="row">
						<div class="col-sm-3">
						  <h6 class="mb-0">Graduate:</h6>
						</div>
						<div class="col-sm-9 text-secondary">
								<?= $studentDetails['Grad1']; ?>
						</div>
					  </div>
					  <hr>
					  <div class="row">
						<div class="col-sm-3">
						  <h6 class="mb-0">High School:</h6>
						</div>
						<div class="col-sm-9 text-secondary">
						   <?= $studentDetails['High']; ?>
						</div>
					  </div>
					  <div class="row">
						<div class="col-sm-3">
						  <h6 class="mb-0">Address:</h6>
						</div>
						<div class="col-sm-9 text-secondary">
						   <?= $studentDetails['Add2']; ?>
						</div>
					  </div>
					  <div class="row">
						<div class="col-sm-3">
						  <h6 class="mb-0">Graduate:</h6>
						</div>
						<div class="col-sm-9 text-secondary">
								<?= $studentDetails['Grad2']; ?>
						</div>
					  </div>
					  <hr>
					  <div class="row">
						<div class="col-sm-3">
						  <h6 class="mb-0">College:</h6>
						</div>
						<div class="col-sm-9 text-secondary">
						 <?= $studentDetails['College']; ?>
						</div>
					  </div>
					   <div class="row">
						<div class="col-sm-3">
						  <h6 class="mb-0">Address:</h6>
						</div>
						<div class="col-sm-9 text-secondary">
						 <?= $studentDetails['Add3']; ?>
						</div>
					  </div>
					   <div class="row">
						<div class="col-sm-3">
						  <h6 class="mb-0">Graduate:</h6>
						</div>
						<div class="col-sm-9 text-secondary">
						 <?= $studentDetails['Grad3']; ?>
						</div>
					  </div>
					  <hr>
					 
					  </div>
					</div>
				  </div>
				  </div>
				<div class="tab-pane" id="messages1" role="tabpanel">
				
					<div class="col-md-12">
					  <div class="card mb-3">
						<div class="card-body">
						   <h3><strong>Accounts:</strong></h3>
						   <div class="table-wrapper">
											<div id= "displayArea"  >
											  <div class="table-responsive">
												<div class='table-title'></div>
													<table  class="table table-bordered table-striped">
													<tr>
															  <th width ='7%' >Code</th>
															  <th width ='12%'>Academic Year</th>
															  <th width ='25%'>Semester</th>
															  <th width ='5%'>Accounts</th>
															  <th width ='15%'>Amount Paid</th>
															  <th width ='5%'>Balance</th>
															  <th width ='5%'>Status</th>
															</tr>
														<?php 
														  $st_id =$_GET['stid'];
														  $select_acc = $conn_PDO->prepare (" 
														  SELECT * FROM `tblsiacct` WHERE `StudNum`='$st_id' ORDER BY AcadYr ");
														  $select_acc->execute();
														  if($select_acc->rowCount() > 0){
														  while($fetch_acc = $select_acc->fetch(PDO::FETCH_ASSOC)){
														?>
															<tr>
															  <td><?= $fetch_acc['Code']; ?></td>
															  <td><?= $fetch_acc["AcadYr"]?></td>
															  <td><?= $fetch_acc["Sem"]?></td>
															  <td><?= $fetch_acc["Account"]?></td>
															  <td><?= $fetch_acc["AmountPaid"]?></td>
															  <td><?= $fetch_acc["Balance"]?></td>
															  <td><div class="status-container <?= $fetch_acc["Status"] === 'PAID' ? 'paid-status' : 'unpaid-status' ?>"> <?= $fetch_acc["Status"] ?>
														  </div></td>
															  
															</tr>
															<?php
														 }}
															  ?>
													</table>
												</div>
							   </div>
							</div>
						  <hr>
					  </div>
					  </div>
					</div>
				</div>
				<div class="tab-pane" id="settings1" role="tabpanel">
					<!-- Hover table card start -->
                        <div class="card">
						<input id="StudentID" hidden type="text" value="<?php echo $_GET['stid']; ?>">
						<br>
                            <select  id="mySelect" class ="form-control">
							
                                <option value="0" disabled selected > Select Semester/Academic Year</option>
                            <?php
                                
                                    try {
                                        // Create a PDO connection
                                        
                                        $conn_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    
                                        // Query to get table names and creation dates for 'tblsem%'
                                        // Assuming you have a database connection named $conn_PDO and placeholders for :dbname

                                        $sql = "SELECT table_name
                                        FROM information_schema.tables
                                        WHERE table_schema = :dbname AND table_name LIKE 'tblsem%'
                                        ";
                                
                                        $sql1 = "SELECT table_name 
                                        FROM information_schema.tables
                                        WHERE table_schema = :dbname AND table_name LIKE 'tblsubrpt%'
                                        ";
                                        
                                        // Prepare and execute the first query
                                        $stmt = $conn_PDO->prepare($sql);
                                        $stmt->bindParam(':dbname', $dbname, PDO::PARAM_STR);
                                        $stmt->execute();
                                        $results1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        
                                        // Prepare and execute the second query
                                        $stmt = $conn_PDO->prepare($sql1);
                                        $stmt->bindParam(':dbname', $dbname, PDO::PARAM_STR);
                                        $stmt->execute();
                                        $results2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        $maxRowCount = max(count($results1), count($results2));
                                        
                                        for ($i = 0; $i < $maxRowCount; $i++) {
                                            // Column 1 (tblsem)
                                                        if (isset($results1[$i]['table_name']) || isset($results2[$i]['table_name'])) {
                                                            $tblsem = $results1[$i]['table_name'];
                                                            $tblsubrpt = $results2[$i]['table_name'];

																   $checkColumnsSql = "SELECT table_name
																	FROM information_schema.columns
																	WHERE table_schema = :dbname
																	AND table_name = :tableName
																	AND column_name IN ('AcadYr', 'Sem')";

                                                                    $checkColumnsStmt = $conn_PDO->prepare($checkColumnsSql);
                                                                    $checkColumnsStmt->bindParam(':dbname', $dbname, PDO::PARAM_STR);
                                                                    $checkColumnsStmt->bindParam(':tableName', $tblsubrpt, PDO::PARAM_STR);
                                                                    $checkColumnsStmt->execute();
                                                                    $hasColumnsResult = $checkColumnsStmt->fetchAll(PDO::FETCH_ASSOC);

                                                                    if (!empty($hasColumnsResult)) {
                                                                        // Table has 'Acadyr' and 'Sem' columns
                                                                        // Retrieve distinct values
                                                                        $studentId = $_GET['stid'];
                                                                        $distinctValuesSql = "SELECT DISTINCT AcadYr, Sem, YrLevel, Sec
                                                                                                 FROM $tblsubrpt 
                                                                                                 WHERE StudNum = :id";  // Use the actual table name

                                                                        $distinctValuesStmt = $conn_PDO->prepare($distinctValuesSql);
                                                                        $distinctValuesStmt->bindParam(':id',$studentId, PDO::PARAM_STR);
                                                                        $distinctValuesStmt->execute();
                                                                        $distinctValues = $distinctValuesStmt->fetchAll(PDO::FETCH_ASSOC);

                                                                       

                                                                        foreach ($distinctValues as $row) {
                                                                               echo '<option value="'.$tblsem.','.$tblsubrpt.','.$_GET['stid'].','.$row['YrLevel'] .','. $row['Sec'].'">' . $row['Sem'] ." ". $row['AcadYr'] . '</option>';
                                                                        }

                                                                        echo '</table>';
                                                                    } else {
                                                                        // Table does not have both 'Acadyr' and 'Sem' columns
                                                                        echo 'The table does not have both columns named "Acadyr" and "Sem".';
                                                                    }
                                                  }
                                              }
             
                                           } catch (PDOException $e) {
                                               echo "Error: " . $e->getMessage();
                                           } finally {
                                               // Close the database connection
                                               $conn_PDO = null;
                                           }
                                       ?>
                                </select>
                           
                            <div class="d-flex align-self-center">
                                <button id="displayResult" class="my-2 mx-1 btn btn-mat waves-effect waves-light btn-primary ">View</button>
                                <button style="display:none;" id="printGrades" class="m-2 mx-1 btn btn-mat waves-effect waves-light btn-success">Print</button>
                            </div>
						</div>
							<div class="col-md-12">
                                <div class="table-wrapper">
                                    <div id= "displayArea1"  >
                                      <div class="table-responsive">
                                        <div class='table-title'><b>Year Level,</b> Semester AY: 0000-0000</div>
                                                    
                                            <table  class="table table-bordered table-striped">
                                            <tr>
                                                      <th width ='7%' >Code</th>
                                                      <th width ='35%'>Subject Description</th>
                                                      <th width ='5%'>Units</th>
                                                      <th width ='3%'>Grade</th>
                                                      <th width ='3%'>Equivalent</th>
                                                      <th width ='3%'>Re-exam</th>
                                                      <th width ='5%'>Credits</th>
                                                      <th width ='10%'>Remarks</th>
                                                      <th width ='15%'>Instructor</th>
                                                    </tr>
                                                    <tr>
                                                      <td colspan="10">Select Academic and Semester then click "view" to show grade!</td>
                                                    </tr>

                                            </table>
                                            </div>
                                         
                                 </div>
                            </div>
                        </div>
						 <!-- Print RECORDS -->
                          <div  style="display:none;" id="printableContent">
                                <div class="modal-contentP">
                                <div id="registrar">
                                            <img src="../img/logo.png" alt="School Logo" class="school-logo">
                                    <p id="innovative" class="f-mnt-B f-mgreen f-15 f-b f-k1"><b?>INNOVATIVE COLLEGE OF SCIENCE & TECHNOLOGY</b></p>
                                                <p id="locationP" class="f-10 f-mnt">Malitbog, Bongabong, Oriental Mindoro 5211, Philippines</p>
                                                <p id="contact" class="f-10 f-mnt">Tel No. (043) 283-5521 / 283-5561</p>
                                                <hr>
                                        <p  class="office">OFFICE OF THE REGISTRAR</p>
                                        <p  class="report"> STUDENT GRADE REPPORT </p>
									    <p id="YearandSem"></P>
										<br>
										
                                    </div>
							</div>
									
                            <div class="student-info">
                              
                                <div>
                                    <p><strong>Name:</strong> <?= $studentDetails['Lname']; ?>, <?= $studentDetails['Fname']; ?> <?= $studentDetails['Mname']; ?> </p>
                                    <p><strong>Student ID:</strong> <?= $studentDetails['StudNum']; ?></p>
                                </div>
                                <div>
                                    <p><strong>Course & Major:</strong><?= $studentDetails['Course']; ?>-<?= $studentDetails['Major']; ?></p>
                                    <p><strong>YR. & Sec:</strong> <span id="YrandSec" ></span><br></p>
                                </div>
                            </div>
						</div>

<!-- Print RECORDS for schedule-->
                          <div  style="display:none;" id="printableContentSched">
                                <div class="modal-contentP">
                                <div id="registrar">
                                            <img src="../img/logo.png" alt="School Logo" class="school-logo">
                                    <p id="innovative" class="f-mnt-B f-mgreen f-15 f-b f-k1"><b?>INNOVATIVE COLLEGE OF SCIENCE & TECHNOLOGY</b></p>
                                                <p id="locationP" class="f-10 f-mnt">Malitbog, Bongabong, Oriental Mindoro 5211, Philippines</p>
                                                <p id="contact" class="f-10 f-mnt">Tel No. (043) 283-5521 / 283-5561</p>
                                                <hr>
                                        <p  class="office">OFFICE OF THE REGISTRAR</p>
                                        <p  class="report"> STUDENT SCHEDULE REPPORT </p>
									    <p id="YearandSemSched"></P>
										<br>
										
                                    </div>
							</div>
									
                            <div class="student-info">
                              
                                <div>

                                    <p><strong>Name:</strong> <?= $studentDetails['Lname']; ?>, <?= $studentDetails['Fname']; ?> <?= $studentDetails['Mname']; ?> </p>
                                    <p><strong>Student ID:</strong> <?= $studentDetails['StudNum']; ?></p>
                                </div>
                                <div>
                                    <p><strong>Course & Major:</strong><?= $studentDetails['Course']; ?>-<?= $studentDetails['Major']; ?></p>
                                    <p><strong>YR. & Sec:</strong> <span id="YrandSecSched" ></span><br></p>
                                </div>
                            </div>
						</div>
						
				</div>
				<div class="tab-pane" id="schedule" role="tabpanel">
						<div class="card">
						<br>
						  <h5 class="mx-4"><b>Please select Semester/Academic year!</b></h5>
                            <select  id="mySelectSched" class ="form-control">
                                <option value="0" disabled selected > Select Semester/Academic Year</option>
                                </select>
							    <br>
                                <button style="display:none;"  id="printSchedule" class="m-2 mx-1 btn btn-mat waves-effect waves-light btn-success">Print</button>
                          
						</div>
						
							<div class="table-wrapper">
								<div id= "displaysched"  >
								  <div class="table-responsive">
									<div class='table-title'><b>Year Level,</b> Semester AY: 0000-0000</div>
												
										<table  class="table table-bordered table-striped">
										<tr>
												
													<th >Code</th>
													<th>Description</th>
													<th>Instructor</th>
													<th>Lec</th>
													<th>Lab</th>
													<th>Unit</th>
													<th>Days</th>
													<th>Time</th>
													<th>Room</th>
												</tr>
												<tr>
												  
												</tr>

										</table>
									</div>
							 </div>
                        </div>
				</div>
			</div>
		</div>

   <div>
    

                
 <?php
    } else {
        // Handle the case where student details are not found
        echo 'Student details not found.';
    }
} else {
    // Handle the case where the request is not valid
    echo 'Invalid request.';
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
	
	 var stid = document.getElementById('StudentID').value;
  // Make an AJAX request to fetch the options
  $.ajax({
    url: 'College/fetch_option.php', // Replace with the actual URL of the server-side script
    type: 'GET',
    data: { stid: stid }, // Replace 'your_student_id' with the actual student ID
    success: function(response) {
      // Update the select element with the fetched options
      $('#mySelectSched').html(response);
		  var selectedOption = document.getElementById('mySelectSched').value;
			  $('#printSchedule').show();
		 
			// Make an AJAX request to fetch the data
			$.ajax({
			  url: 'students/fetch_data.php', // Replace with the actual URL of the server-side script
			  type: 'GET',
			  data: { selectedOption: selectedOption },
			  success: function(response) {
				$('#displaysched').html(response);
				console.log(response);
			  },
			  error: function(xhr, status, error) {
				console.error(error);
			  }
			});
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });

  // Handle change event of the select element
  $('#mySelectSched').change(function() {
    var selectedOption = $(this).val();
      $('#printSchedule').show();
 
    // Make an AJAX request to fetch the data
    $.ajax({
      url: 'College/fetch_data.php', // Replace with the actual URL of the server-side script
      type: 'GET',
      data: { selectedOption: selectedOption },
      success: function(response) {
        $('#displaysched').html(response);
		console.log(response);
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
     document.getElementById('displayResult').addEventListener('click', function () {
		 event.preventDefault();
    // Get the selected value from the dropdown
    var selectedValue = document.getElementById('mySelect').value;
      if(selectedValue =="0"){
        alert("Please Select Semester/Academic Year ");

      }else{
            $('#printGrades').show();

          // Split the selected value into Sem, Year, and StudentID
            var values = selectedValue.split(',');
            var tblsem = values[0];  // Trim to remove extra spaces
            var tblsubrpt = values[1];
            var stId = values[2];
            var YearLevel = values[3].trim();
            var section = values[4].trim();
            console.log(values);

            // AJAX request to fetch and display information based on Sem, Year, and StudentID
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Display the information in the target area
                    document.getElementById('displayArea1').innerHTML = this.responseText;
                }
            };
           xhttp.open("GET", "College/getGrades.php?tblsem=" + tblsem + "&tblsubrpt=" + tblsubrpt + "&studID=" + stId + "&YearLevel=" + YearLevel + "&section=" + section, true);
            xhttp.send();
                
            }
  
});

 function printInformation() {
    var divToPrint = document.getElementById('gradeTbl');
	var printableContent = document.getElementById('printableContent');
    var printWindow = window.open('', '_blank');
	    printWindow.document.write('<style>');
		 printWindow.document.write('body { font-family: "Arial", sans-serif; }');
		 printWindow.document.write('printableContent2, printableContent{display:block;} .innovative{font-style:bold}   .student-info {display: flex;justify-content: space-between;margin-bottom: 20px;}   .student-info p {margin: 0;}   school-info {display: flex;text-align: center;margin-bottom: 20px;}    .school-logo {max-width: 100px;max-height: 60px;margin-right: 10px;} .school-name {margin: 0;}#locationP{margin-top: -15px;font-style: italic;}#contact{font-style: italic;margin-top: -15px;}.containerTop{align-items:center;}#registrar{text-align: center; margin-bottom:50px;} th{background-color:gray;}');
		printWindow.document.write('table { border-collapse: collapse; width: 100%; border: 0.2px solid #000;}');
		printWindow.document.write('th, td { padding: 5px; text-align: left; font-size:12px; }');
		printWindow.document.write('#YearandSem, .report{ margin-top:-10px; }');		
		printWindow.document.write('th:nth-child(2) { width: 400px; }');
		printWindow.document.write('th { background-color: #f2f2f2; }');
		printWindow.document.write('</style>');
		printWindow.document.write('<html><head><title>Student Portal</title></head><body>');
		printWindow.document.write('<div>' + printableContent.innerHTML + '</div>');
		printWindow.document.write('<div>' + divToPrint.innerHTML + '</div>');
		printWindow.document.write('</body></html>');
		setTimeout(function () {
        printWindow.document.close();
        printWindow.print();
    }, 500);
}

document.getElementById('printGrades').addEventListener('click', function () {
    event.preventDefault();

	 var selectedValue = document.getElementById('mySelectSched').value;
		  if(selectedValue =="0"){
			alert("Please Select Semester/Academic Year and view your grade!");
	}else{
		var acadsem = document.getElementById('AcadSem');
		var acadsemText = acadsem.textContent;
		var YrSem = document.getElementById('YearandSem');
		YrSem.textContent = acadsemText;
		
		var yearSecParagraph = document.getElementById('yearSec');
		var yearSecText = yearSecParagraph.textContent;
		var otherParagraph = document.getElementById('YrandSec');
		otherParagraph.textContent = yearSecText;

		printInformation();
	}
               
});

});



document.getElementById('printSchedule').addEventListener('click', function (event) {
    event.preventDefault();
		var acadsem = document.getElementById('AcadSem');
		var acadsemText = acadsem.textContent;
		var YrSem = document.getElementById('YearandSemSched');
		YrSem.textContent = acadsemText;
		
		var yearSecParagraph = document.getElementById('yearSec');
		var yearSecText = yearSecParagraph.textContent;
		var otherParagraph = document.getElementById('YrandSecSched');
		otherParagraph.textContent = yearSecText;

		printSchedule();
});

function printSchedule() {
    var divToPrint = document.getElementById('scheduleTbl');
	var printableContent = document.getElementById('printableContentSched');
    var printWindow = window.open('', '_blank');
	    printWindow.document.write('<style>');
		 printWindow.document.write('body { font-family: "Arial", sans-serif; }');
		 printWindow.document.write('printableContent2, printableContent{display:block;} .innovative{font-style:bold}   .student-info {display: flex;justify-content: space-between;margin-bottom: 20px;}   .student-info p {margin: 0;}   school-info {display: flex;text-align: center;margin-bottom: 20px;}    .school-logo {max-width: 100px;max-height: 60px;margin-right: 10px;} .school-name {margin: 0;}#locationP{margin-top: -15px;font-style: italic;}#contact{font-style: italic;margin-top: -15px;}.containerTop{align-items:center;}#registrar{text-align: center;} th{background-color:gray;}');
		printWindow.document.write('table { border-collapse: collapse; width: 100%; border: 0.2px solid #000;}');
		printWindow.document.write('th, td { padding: 5px; text-align: left; border: 0.2px solid #000; }');
		printWindow.document.write('#YearandSem, .report{ margin-top:-10px; }');		
		printWindow.document.write('th { background-color: #f2f2f2; }');
		printWindow.document.write('</style>');
		printWindow.document.write('<html><head><title>Student Portal</title></head><body>');
		printWindow.document.write('<div>' + printableContent.innerHTML + '</div>');
		printWindow.document.write('<div>' + divToPrint.innerHTML + '</div>');
		printWindow.document.write('</body></html>');
		setTimeout(function () {
        printWindow.document.close();
        printWindow.print();
    }, 500);
}

</script>
</body>
</html>

