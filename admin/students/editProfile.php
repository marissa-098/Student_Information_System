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
	
</style>
</head>
<body>
	<?php 
	
	if (isset($_GET['stud_Id'])){
	   $stud_Id = $_GET['stud_Id'];


    // Fetch student details from the database based on the provided studentId
   // Fetch student details from the database based on the provided studentId
    $query = "SELECT * FROM tblgradeschool WHERE StudNum = :studentId";
    $statement = $conn_PDO->prepare($query);
    $statement->bindParam(':studentId', $stud_Id, PDO::PARAM_STR);
    $statement->execute();

    $studentDetails = $statement->fetch(PDO::FETCH_ASSOC);

    if ($studentDetails) {




    	 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle form submission

            // Get data from the form
            $fr_Lname = $_POST['fr_LName'];
            $fr_Fname = $_POST['fr_FName'];
            $fr_Mname = $_POST['fr_MName'];
            $fr_gradelevel = $_POST['fr_gradelevel'];
            $fr_strand = $_POST['fr_strand'];
            $fr_sec = $_POST['fr_sec'];
            $fr_sex = $_POST['fr_sex'];
            $fr_bplace = $_POST['fr_bplace'];
            $fr_nationality = $_POST['fr_nationality'];
            $fr_religion = $_POST['fr_religion'];
            $fr_sitio = $_POST['fr_sitio'];
            $fr_brgy = $_POST['fr_brgy'];
            $fr_town = $_POST['fr_town'];
            $fr_province = $_POST['fr_province'];
            $fr_cnumber = $_POST['fr_cnumber'];
            $fr_email = $_POST['fr_email'];
            $fr_Father = $_POST['fr_Father'];
            $fr_Mother = $_POST['fr_Mother'];

            // Update student information in the database
            $updateQuery = "UPDATE tblgradeschool  SET 
                  Lname = :fr_Lname,
                  Fname = :fr_Fname,
                  Mname = :fr_Mname,
                  GradeLevel = :fr_gradelevel,
                  SHSStrand = :fr_strand,
                  Sec = :fr_sec,
                  Sex = :fr_sex,
                  BPlace = :fr_bplace,
                  Nationality = :fr_nationality,
                  Religion = :fr_religion,
                  Sitio = :fr_sitio,
                  Brgy = :fr_brgy,
                  Town = :fr_town,
                  Province = :fr_province,
                  ContactNum = :fr_cnumber,
                  EmailAdd = :fr_email,
                  FatherName = :fr_Father,
                  MotherName = :fr_Mother
                  WHERE StudNum = :studentId";

                            
                  $updateStatement = $conn_PDO->prepare($updateQuery);
                  $updateStatement->bindParam(':fr_Lname', $fr_Lname, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_Fname', $fr_Fname, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_Mname', $fr_Mname, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_gradelevel', $fr_gradelevel, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_strand', $fr_strand, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_sec', $fr_sec, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_sex', $fr_sex, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_bplace', $fr_bplace, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_nationality', $fr_nationality, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_religion', $fr_religion, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_sitio', $fr_sitio, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_brgy', $fr_brgy, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_town', $fr_town, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_province', $fr_province, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_cnumber', $fr_cnumber, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_email', $fr_email, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_Father', $fr_Father, PDO::PARAM_STR);
                  $updateStatement->bindParam(':fr_Mother', $fr_Mother, PDO::PARAM_STR);
                  $updateStatement->bindParam(':studentId', $stud_Id, PDO::PARAM_STR);

            
                  // Check if a file was uploaded
                  if ($_FILES['files']['name'][0] !== '') {
                      $uploadDir = 'Pictures/';
                      $uploadedFiles = [];
                      
                      // Iterate over uploaded files
                      for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
                          $fileName = $_FILES['files']['name'][$i];
                          $tempName = $_FILES['files']['tmp_name'][$i];
                          $targetFilePath = $uploadDir . $fileName;

                          // Move the uploaded file to the target directory
                          if (move_uploaded_file($tempName, $targetFilePath)) {
                              $uploadedFiles[] = $fileName;
                          }
                      }

                // Update the 'Picture' column in the database with the new file name
                if (!empty($uploadedFiles)) {
                    $updatePictureQuery = "UPDATE tblgradeschool SET Picture = :picture WHERE StudNum = :studentId";
                    $updatePictureStatement = $conn_PDO->prepare($updatePictureQuery);
                    $updatePictureStatement->bindParam(':picture', $uploadedFiles[0]); // Assuming you want to update with the first uploaded file
                    $updatePictureStatement->bindParam(':studentId', $stud_Id);
                    $updatePictureStatement->execute();
                   
                    
                }
            }

            if ($updateStatement->execute()) {
               echo '<script>Swal.fire({
				  html: \'<div class="containerNotif"><div><img class="checkmark" src="../assets/icon/success.png" alt="Checkmark Image"></div><div class="textDiv">Student information updated successfully.</div></div>\',
				  position: \'top-end\',
				  showConfirmButton: false,
				  customClass: {
					popup: \'swal-wide\',
					icon: \'icon-class\'
				  }
				});</script>';
            } else {
                echo '<script>Swal.fire({
				  html: \'<div class="containerNotif"><div><img class="checkmark" src="../assets/icon/warning.png" alt="Checkmark Image"></div><div class="textDiv">Error updating student information.</div></div>\',
				  position: \'top-end\',
				  showConfirmButton: false,
				  customClass: {
					popup: \'swal-wide\',
					icon: \'icon-class\'
				  }
				});</script>';
            }
        }

      ?>


	   <div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
         <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <br>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./index.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="./index.php?page=student_list" class="breadcrumb-link">Grade school</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"> Edit Students</li>
                                    </ol>
                                </nav>
                            </div>
                        
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
                         $firstName = $studentDetails['FName'];
                         $lastName = $studentDetails['LName'];
                         $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($lastName . " " . $firstName);

                         // Use the avatar URL
                         $pictureSrc = $avatarUrl;
                          }
                          ?>

                          <img id="studPic" src="<?= $pictureSrc; ?>" alt="Student" class="rounded-circle" width="150">
                 
    


                     <div class="mt-3">
                      <h4><?= $studentDetails['LName']; ?>, <br> <?= $studentDetails['FName']; ?> <?= $studentDetails['MName']; ?> <br><?= $studentDetails['ExtensionName'] == "NULL" ? "" : " $studentDetails[ExtensionName]" ?> </h4>
                      <p class="text-secondary mb-1">[<?= $studentDetails['StudNum']; ?>]</p>
                      <p class="text-muted font-size-sm"><?= $studentDetails['LevelKo'] == "Senior High School" 
                                                        ? "$studentDetails[GradeLevel] - $studentDetails[SHSStrand]"
                                                        : "$studentDetails[GradeLevel] - $studentDetails[Sec]"
                                                          ; ?></p>
                       <input value="<?= $studentDetails['Picture'];?>" type="file" id="fileInput" name="files[]" >
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
                	<div class="row">
	                    <div class="col-sm-3">
	                      <h6 class="mb-0">Student's Name:</h6>
	                    </div>
	                    	<div class="col-sm-9 text-secondary"> 
		                    <input class="my-2 form-control" name="fr_LName" placeholder="Last Name" type="text" value="<?= $studentDetails['LName']; ?>">
		                    <input class="my-2 form-control"  name="fr_FName" placeholder="First Name" type="text" value="<?= $studentDetails['FName']; ?>">
		                    <input class="my-2 form-control"  name="fr_MName" placeholder="Middle Name"type="text" value="<?= $studentDetails['MName']; ?>">
                      </div>
                    </div>
                  <hr>
                   <div class="row">
	                    <div class="col-sm-3">
	                      <h6 class="mb-0">GRADE LEVEL:</h6>
	                    </div>
	                    	<div class="col-sm-9 text-secondary">
                        <?php
                      try {
                          $query_instructor = "SELECT DISTINCT GradeLevel FROM tblgradeschool";
                          $statement_instruc = $conn_PDO->prepare($query_instructor);
                          $statement_instruc->execute();
                          $result_instruc = $statement_instruc->fetchAll();
                      } catch (PDOException $e) {
                          echo "Error: " . $e->getMessage();
                      }
                      ?>
                      <select name="fr_gradelevel" id="" class="form-control">
                          <?php
                          foreach ($result_instruc as $row_instruc) {
                              $selected = $row_instruc['GradeLevel'] == $studentDetails['GradeLevel'] ? 'selected' : '';
                              ?>
                              <option value="<?= $row_instruc['GradeLevel'];?>" <?= $selected; ?>>
                                  <?= $row_instruc['GradeLevel'];?>
                              </option>
                          <?php
                          }
                          ?>
                      </select> 
                      </div>
                    </div>
                   <hr>
                   <div class="row">
	                    <div class="col-sm-3">
	                      <h6 class="mb-0">STRAND:</h6>
	                    </div>
	                    	<div class="col-sm-9 text-secondary">
                         <?php
                      try {
                          $query_instructor = "SELECT DISTINCT SHSStrand FROM tblgradeschool";
                          $statement_instruc = $conn_PDO->prepare($query_instructor);
                          $statement_instruc->execute();
                          $result_instruc = $statement_instruc->fetchAll();
                      } catch (PDOException $e) {
                          echo "Error: " . $e->getMessage();
                      }
                      ?>
                      <select name="fr_strand" id="" class="form-control">
                          <?php
                          foreach ($result_instruc as $row_instruc) {
                              $selected = $row_instruc['SHSStrand'] == $studentDetails['SHSStrand'] ? 'selected' : '';
                              ?>
                              <option value="<?= $row_instruc['SHSStrand'];?>" <?= $selected; ?>>
                                  <?= $row_instruc['SHSStrand'];?>
                              </option>
                          <?php
                          }
                          ?>
                      </select> 
		                   
                      </div>
                    </div>
                   <hr>
                   <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">SECTION:</h6>
                      </div>
                        <div class="col-sm-9 text-secondary"> 
                        <input class="form-control" name="fr_sec" placeholder="Last Name" type="text" value="<?= $studentDetails['Sec']; ?>">
                      </div>
                    </div>
                  
               
                 
                </div>
              </div>
              </div>


            </div>

             <div class="col-md-12">
              <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary"> 
                    <input  class="form-control" name="fr_sex" type="text" value="<?= $studentDetails['Sex']; ?>">
                    </div>
                  </div>
                   <hr>
   
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Place of Birth</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <input  class="form-control" name="fr_bplace" type="text" value="<?= $studentDetails['BPlace']; ?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nationality</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input  class="form-control" name="fr_nationality" type="text" value="<?= $studentDetails['Nationality']; ?>"> 
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Religion</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input  class="form-control" name="fr_religion" type="text" value="<?= $studentDetails['Religion']; ?>">
                    </div>
                  </div>
                  <hr>
                 <div class="row">
				    <div class="col-sm-3">
				        <h6 class="mb-0">Address</h6>
				    </div>
				    <div class="col-sm-9 text-secondary">
				        <div class="row mb-2">
				            <div class="col-sm-3"><label for="sitio">Sitio:</label></div>
				            <div class="col-sm-9"><input  name="fr_sitio" type="text" id="sitio" class="form-control" value="<?= $studentDetails['Sitio']; ?>"></div>
				        </div>
				        <div class="row mb-2">
				            <div class="col-sm-3"><label for="barangay">Barangay:</label></div>
				            <div class="col-sm-9"><input  name="fr_brgy" type="text" id="barangay" class="form-control" value="<?= $studentDetails['Brgy']; ?>"></div>
				        </div>
				        <div class="row mb-2">
				            <div class="col-sm-3"><label for="town">Town:</label></div>
				            <div class="col-sm-9"><input  name="fr_town"type="text" id="town" class="form-control" value="<?= $studentDetails['Town']; ?>"></div>
				        </div>
				        <div class="row">
				            <div class="col-sm-3"><label for="province">Province:</label></div>
				            <div class="col-sm-9"><input  name="fr_province" type="text" id="province" class="form-control" value="<?= $studentDetails['Province']; ?>"></div>
				        </div>
				    </div>
				</div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Contact Number</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    	 <input  class="form-control" name="fr_cnumber" type="text" value="<?= $studentDetails['ContactNum']; ?>">
                           
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    	 <input class="form-control"  name="fr_email" type="text" value="<?= $studentDetails['EmailAdd']; ?>">
                      
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Fathers Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    	 <input  class="form-control" name="fr_Father" placeholder="Father's Last Name" type="text" value="<?= $studentDetails['FatherName']; ?>">
                      </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mothers Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    	 <input class="form-control" name="fr_Mother" placeholder="Mother's Last Name" type="text" value="<?= $studentDetails['MotherName']; ?>">
                     
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                   <button id ="updateBtn" type="submit" name="SUBMIT">UPDATE</button>
                    </div>
                  </div>
                </div>
              </div>
              </div>

          </div>

        </div>
    </div>
    </form>

                
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

</body>
</html>