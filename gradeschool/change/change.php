<!-- Modal 1 -->

 <style>

.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 9999; /* Sit on top */
top: 0%;
left: 0%;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.6); /* Black w/ opacity */
}


.modal-content {
background-color: #fefefe;
margin: 100px auto; /* 15% from the top and centered */
padding: 20px;
height: auto;
border: 1px solid #888;
width: 60%; /* Could be more or less, depending on screen size */
}
.btnSubmit {
width: 100%;
padding: 10px;
background-color:#22B98E;
color: #fff;
border: none;
border-radius: 4px;
cursor: pointer;
font-size: 16px;
}
.btnSubmit:hover{
background-color: #54CA24;
}
.flexBox{
display: flex;
}

@media only screen   and (max-width: 768px) {
.modal-content {
margin:150px auto; /* 15% from the top and centered */
width: 90% /* Could be more or less, depending on screen size */
}
.modal{
z-index: 9999;
}

#studPic{
width: 100px;
}
#StudNum{
font-size: 17px;
}
#name{
font-size: 14px;
}
#course, #status{
font-size: 13px;
}
}

@media (max-width: 425px) {
.flexBox{
display: block;
}

}

.modal-btn {
cursor: pointer;
padding: 10px 20px;
font-size: 16px;
margin: 5px;
background-color: #4caf50;
color: white;
border: none;
border-radius: 5px;
}

.close-btn {
cursor: pointer;
position: absolute;
top: 10px;
right: 10px;
font-size: 18px;
}
#transparent{
background-color: transparent;
}
.mx-auto{
margin-top: 5px;
text-align:justify;
font-size: 14px;
}
.course{
    color: #1BD59D;
}

</style>
           
     <form id ="transparent" action="change/process.php" method="POST">
                    <div id="changeModal" class="modal">
                        <div class="modal-content">
                        <span class="close-btn" onclick="closeModal('changeModal')">&times;</span>
                      
                            <div class=" editchange container ">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <div class=" profileCard">
                                                <div class=" card-body">
                                                    <div class=" flexBox align-items-center text-center">
                                                      <?php
                                                      $databasePic = "../admin/Pictures/" . $fetch_stud['Picture'];

                                                       // Check if the picture file exists
                                                      if (file_exists($databasePic)) {
                                                       // Use the actual image
                                                       $pictureSrc = $databasePic;
                                                       } else {
                                                       // Generate an avatar using the UI Avatars service
                                                       $firstName = $fetch_stud['Fname'];
                                                       $lastName = $fetch_stud['Lname'];
                                                       $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($lastName . " " . $firstName);

                                                       // Use the avatar URL
                                                       $pictureSrc = $avatarUrl;
                                                        }
                                                        ?>
                                                        <img id="studPic" src="<?= $pictureSrc; ?>" alt="Admin" class="rounded-circle" width="150">
                                                    
                                                        <div class=" mt-6 ">
                                                            <h4  id="StudNum" class=" f-white f-18 mb-1">[<?= $fetch_stud['StudNum']; ?>]</h4>
                                                            <h5 id="name" class="f-green f-17"><?= $fetch_stud['Lname']; ?>,
                                                             <?= $fetch_stud['Fname']; ?> <?= $fetch_stud['Mname']; ?> </h5>
                                                            
                                                            <p id="course" class=" f-white  font-size-sm">COLLEGE-<span class="course"><?= $fetch_stud['Course']; ?></span></p>
                                                            <p id="status" class="text-wrapper-5">-<?= strtoupper($fetch_stud['Remarks'])?>-</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mx-auto">Please make sure the information below is accurte as it appears on official documents.</h5>
                                <br><hr>


                               

                            <div class=" f-dgreen col-md-8 mx-auto">
                                        <!-- ... Rest of your form content ... -->


                                
                                             <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Student's Name:</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3"><label for="sitio">Last Name:</label></div>
                                                        <div class="col-sm-9"><input  name="fr_Lname" type="text" id="Lname" class="form-control" value="<?= $fetch_stud['Lname']; ?>"></div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3"><label for="barangay">First Name:</label></div>
                                                        <div class="col-sm-9"><input  name="fr_Fname" type="text" id="Fname" class="form-control" value="<?= $fetch_stud['Fname']; ?>"></div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3"><label for="town">Middle Name:</label></div>
                                                        <div class="col-sm-9"><input  name="fr_Mname"type="text" id="Mname" class="form-control" value="<?= $fetch_stud['Mname']; ?>"></div>
                                                    </div>
                                                </div>
                                            </div>


                                               <hr>
                                               <div class="row">
                                                <div class="col-sm-3">
                                                  <h6 class="mb-0">Gender</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary"> 
                                                      <select class="form-control" id="gender" name="fr_gender" required>
                                                            <option value="" disabled>Select One</option>
                                                            <option value="Male" <?php echo (strtoupper($fetch_stud['Sex']) == "MALE") ? 'selected' : ''; ?>>
                                                                Male
                                                            </option>
                                                            <option value="Female" <?php echo (strtoupper($fetch_stud['Sex']) == "FEMALE") ? 'selected' : ''; ?>>
                                                                Female
                                                            </option>
                                                           
                                                        </select>
                                                </div>
                                              </div>
                                              <hr>


                                               <div class="row">
                                                    <div class="col-sm-3">
                                                      <h6 class="mb-0">COURSE:</h6>
                                                    </div>
                                                        <div class="col-sm-9 text-secondary">
                                                         <?php
                                                            try {
                                                                $query_instructor = "SELECT * FROM tblcourse";
                                                                $statement_instruc = $conn_PDO->prepare($query_instructor);
                                                                $statement_instruc->execute();
                                                                $result_instruc = $statement_instruc->fetchAll();
                                                            } catch (PDOException $e) {
                                                                echo "Error: " . $e->getMessage();
                                                            }
                                                            ?>
                                                            <select class="form-control" name="fr_course" id="courseSelect">
                                                                <?php
                                                                foreach ($result_instruc as $row_instruc) {
                                                                    $selected = ($row_instruc['abv'] == $fetch_stud['Course']) ? 'selected' : '';
                                                                    ?>
                                                                    <option value="<?= $row_instruc['abv']; ?>" <?= $selected; ?>>
                                                                        <?= $row_instruc['abv']; ?>
                                                                    </option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select> 
                                                        <br>
                                                  </div>
                                                </div>
                                               <hr>
                                               <div class="row">
                                                    <div class="col-sm-3">
                                                      <h6 class="mb-0">MAJOR:</h6>
                                                    </div>
                                                        <div class="col-sm-9 text-secondary"> 
                                                             <?php
                                                            try {
                                                                $query_instructor = "SELECT DISTINCT Major FROM tblsubject";
                                                                $statement_instruc = $conn_PDO->prepare($query_instructor);
                                                                $statement_instruc->execute();
                                                                $result_instruc = $statement_instruc->fetchAll();
                                                            } catch (PDOException $e) {
                                                                echo "Error: " . $e->getMessage();
                                                            }
                                                            ?>
                                                            <select class="form-control" name="fr_major" id="courseSelect">
                                                                <?php
                                                                foreach ($result_instruc as $row_instruc) {
                                                                    $selected = ($row_instruc['Major'] == $fetch_stud['Major']) ? 'selected' : '';
                                                                    ?>
                                                                    <option value="<?= $row_instruc['Major']; ?>" <?= $selected; ?>>
                                                                        <?= $row_instruc['Major']; ?>
                                                                    </option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select> 
                                                
                                                     <br>
                                                  </div>
                                                </div>
                                               <hr>
                                              
                                               <div class="row">
                                                <div class="col-sm-3">
                                                  <h6 class="mb-0">Place of Birth</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                 <input  class="form-control" name="fr_bplace" type="text" value="<?= $fetch_stud['BPlace']; ?>">
                                                </div>
                                              </div>
                                              <hr>
                                              <div class="row">
                                                <div class="col-sm-3">
                                                  <h6 class="mb-0">Nationality</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                <input  class="form-control" name="fr_nationality" type="text" value="<?= $fetch_stud['Nationality']; ?>"> 
                                                </div>
                                              </div>
                                              <hr>
                                              <div class="row">
                                                <div class="col-sm-3">
                                                  <h6 class="mb-0">Religion</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                <input class="form-control"  name="fr_religion" type="text" value="<?= $fetch_stud['Religion']; ?>">
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
                                                        <div class="col-sm-9"><input  name="fr_sitio" type="text" id="sitio" class="form-control" value="<?= $fetch_stud['Sitio']; ?>"></div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3"><label for="barangay">Barangay:</label></div>
                                                        <div class="col-sm-9"><input  name="fr_brgy" type="text" id="barangay" class="form-control" value="<?= $fetch_stud['Brgy']; ?>"></div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3"><label for="town">Town:</label></div>
                                                        <div class="col-sm-9"><input  name="fr_town"type="text" id="town" class="form-control" value="<?= $fetch_stud['Town']; ?>"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-3"><label for="province">Province:</label></div>
                                                        <div class="col-sm-9"><input  name="fr_province" type="text" id="province" class="form-control" value="<?= $fetch_stud['Province']; ?>"></div>
                                                    </div>
                                                </div>
                                            </div>
                                               <hr>
                                              <div class="row">
                                                <div class="col-sm-3">
                                                  <h6 class="mb-0">Contact Number</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                     <input  class="form-control" name="fr_cnumber" type="text" value="<?= $fetch_stud['CNumber']; ?>">
                                                       
                                                </div>
                                              </div>
                                              <hr>
                                              <div class="row">
                                                <div class="col-sm-3">
                                                  <h6 class="mb-0">Email Address</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                     <input class="form-control"  name="fr_email" type="text" value="<?= $fetch_stud['EmailAdd']; ?>">
                                                  
                                                </div>
                                              </div>
                                              <hr>
                                              <hr>
                                               <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Father's Name</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3"><label for="sitio">Last Name:</label></div>
                                                        <div class="col-sm-9"><input  name="fr_FlastName" type="text" id="FlastName" class="form-control" value="<?= $fetch_stud['Father']; ?>"></div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3"><label for="barangay">First Name:</label></div>
                                                        <div class="col-sm-9"><input  name="fr_FfirstName" type="text" id="FfirstName" class="form-control" value="<?= $fetch_stud['FatherFName']; ?>"></div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3"><label for="town">Middle Name:</label></div>
                                                        <div class="col-sm-9"><input  name="fr_FMiddleName"type="text" id="FMiddleName" class="form-control" value="<?= $fetch_stud['FatherMName']; ?>"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Mother's Name</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3"><label for="sitio">Last Name:</label></div>
                                                        <div class="col-sm-9"><input  name="fr_MlastName" type="text" id="MlastName" class="form-control" value="<?= $fetch_stud['Mother']; ?>"></div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3"><label for="barangay">First Name:</label></div>
                                                        <div class="col-sm-9"><input  name="fr_MfirstName" type="text" id="MfirstName" class="form-control" value="<?= $fetch_stud['MotherFname']; ?>"></div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3"><label for="town">Middle Name:</label></div>
                                                        <div class="col-sm-9"><input  name="fr_MmiddleName"type="text" id="MmiddleName" class="form-control" value="<?= $fetch_stud['MotherMname']; ?>"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Change data:</h6>
                                                </div>
                                                <div class="col-sm-5 text-secondary">
                                                    <input type="checkbox" name="data[]" value="Students Name">Student's Name <br>
                                                     <input type="checkbox" name="data[]" value="Gender">Gender <br>
                                                      <input type="checkbox" name="data[]" value="Course">Course <br>
                                                      <input type="checkbox" name="data[]" value="Major">Major<br>
                                                      <input type="checkbox" name="data[]" value="Place of Birth">Place of Birth<br>
                                                      <input type="checkbox" name="data[]" value="Nationality">Nationality<br>
                                                      <input type="checkbox" name="data[]" value="Religion">Religion<br>
                                                      <input type="checkbox" name="data[]" value="Address">Address<br>
                                                      <input type="checkbox" name="data[]" value="Contact Number">Contact Number<br>
                                                      <input type="checkbox" name="data[]" value="Email">Email<br>
                                                      <input type="checkbox" name="data[]" value="Fathers Name">Fathers Name<br>
                                                      <input type="checkbox" name="data[]" value="Mothers Name">Mothers Name<br>


                                                </div>
                                               
                                            </div>

                                              <hr>
                                              <button class="btnSubmit" onclick="submitRequest()">Request for Change</button>

                                            </div>
                                        </div>
                                    </div>

                            <?php

                           
                            ?>

                           
                        </div>
                    </div>
                </form>


<script>
 
</script>