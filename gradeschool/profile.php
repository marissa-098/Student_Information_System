 <!-- Page-header start -->
 <div class="page-header">
                          <div class="page-block">
                              <div class="row align-items-center">
                                  <div class="col-md-8">
                                      <div class="page-header-title">
                                          <h3 class="m-b-10"><i class="fa fa-user"></i> PROFILE</h3>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <ul class="breadcrumb-title">
                                          <li class="breadcrumb-item">
                                              <a href="./index.php?page=home"> <i class="fa fa-home"></i> </a>
                                          </li>
                                          <li class="breadcrumb-item"><a href="#!">Profile</a>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <?php 
                           $select_stud = $conn_PDO->prepare (" 
                          SELECT * FROM tblgradeschool 
                          WHERE StudNum = '$st_id'");
                          $select_stud->execute();
                          if($select_stud->rowCount() > 0){
                          while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){

                          
                        ?>
                      <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                          <!-- task, page, download counter  start -->
                                          <!-- Hover table card start -->
                                                    <div style="background-color: rgb(232, 248, 245, 0.1);" class=" col-md-12"> 
                                                    <div class="row p-10">
                                                     <div class="col-xl-4 col-md-6">
                                                            <div class="card">
                                                                <div class=" text-center card-block">
                                                                <?php
                                                                    $databasePic = "../admin/Pictures/" . $fetch_stud['Picture'];
                                                                    // Check if the picture file exists
                                                                    if (file_exists($databasePic)) {
                                                                    // Use the actual image
                                                                    $pictureSrc = $databasePic;
                                                                    } else {
                                                                    // Generate an avatar using the UI Avatars service
                                                                    $firstName = $fetch_stud['FName'];
                                                                    $lastName = $fetch_stud['LName'];
                                                                    $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($lastName . " " . $firstName );
                                                                    // Use the avatar URL
                                                                    $pictureSrc = $avatarUrl;
                                                                    }
                                                                ?>

                                                                <img class="m-b-5 img-100 img-radius" src="<?= $pictureSrc; ?>" alt="User-Profile-Image">

                                                                <div class="user-details">
                                                                    <h4 class="f-18 mb-1">[<?= $fetch_stud['StudNum']; ?>]</h4>
                                                                    <h5 class="f-17"><?= $fetch_stud['LName']; ?>, <br> <?= $fetch_stud['FName']; ?> <?= $fetch_stud['MName']; ?> <br><?= $fetch_stud['ExtensionName'] == "NULL" ? "" : " $fetch_stud[ExtensionName]" ?></h5>
                                                                    <p class=" f-white  f-14"><?= $fetch_stud['LevelKo'] == "Senior High School" 
                                                                            ? "$fetch_stud[GradeLevel] - $fetch_stud[SHSStrand]"
                                                                           : "$fetch_stud[GradeLevel] - $fetch_stud[Sec]"
                                                                                ; ?></p>
                                                                    <p class="form-txt-success">-<?= strtoupper($fetch_stud['Remarks'])?>-</p>
                                                           
                                                                </div>
                                                                </div>
                                                                <div class="card-footer bg-c-green">
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="col-xl-8 col-md-6">
                                                            <div class="card">
                                                                 <div class="card-header">
                                                                    <h3>PERSONAL INFORMATION</h3>
                                                                  </div>
                                                                <div class="card-block">
                                                                   <div class="row">
                                                                          <div class="col-sm-4">
                                                                           <h6 class="mb-0">Gender:</h6>
                                                                            </div>
                                                                           <div class="col-sm-8 text-dark">
                                                                                <?= $fetch_stud['Sex']; ?>
                                                                        </div>
                                                                      </div>
                                                                      <hr>
                                                                      <div class="row">
                                                                          <div class="col-sm-4">
                                                                           <h6 class="mb-0">Date of Birth:</h6>
                                                                            </div>
                                                                           <div class="col-sm-8 text-dark">
                                                                                <?= $fetch_stud['BDate']; ?>
                                                                        </div>
                                                                      </div>
                                                                      <hr>
                                                                      <div class="row">
                                                                          <div class="col-sm-4">
                                                                           <h6 class="mb-0">Place of Birth:</h6>
                                                                            </div>
                                                                           <div class="col-sm-8 text-dark">
                                                                                <?= $fetch_stud['BPlace']; ?>
                                                                        </div>
                                                                      </div>
																	  <hr>
                                                                </div>
                                                                <div class="card-footer bg-c-green">
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>

                                            </div>
                                                    <!-- Hover table card end -->
                                        </div>

                                        <div class="row">
                                          <!-- task, page, download counter  start -->
                                          <!-- Hover table card start -->
                                                    <div style="background-color: rgb(232, 248, 245, 0.1);" class=" col-md-12"> 
                                                    <div class="row p-10">
                                                    <div class="col-xl-12 col-md-12">
                                                            <div class="card">
                                                                <div class="card-block">
                                                                     <div class="row">
                                                                      <div class="col-sm-3">
                                                                       <h6 class="mb-0">Nationality:</h6>
                                                                        </div>
                                                                       <div class="col-sm-9 text-dark">
                                                                            <?= $fetch_stud['Nationality']; ?>
                                                                    </div>
                                                                  </div>
                                                                  <hr>
                                                                  <div class="row">
                                                                      <div class="col-sm-3">
                                                                       <h6 class="mb-0">Religion:</h6>
                                                                        </div>
                                                                       <div class="col-sm-9 text-dark">
                                                                            <?= $fetch_stud['Religion']; ?>
                                                                    </div>
                                                                  </div>
                                                                  <hr>
                                                                  <div class="row">
                                                                          <div class="col-sm-3">
                                                                           <h6 class="mb-0">Address:</h6>
                                                                            </div>
                                                                           <div class="col-sm-9 text-dark">
                                                                                 <?= $fetch_stud['Sitio']; ?>, <?= $fetch_stud['Brgy']; ?>,<?= $fetch_stud['Town']; ?>, <?= $fetch_stud['Province']; ?>
                                                                        </div>
                                                                      </div>
                                                                      <hr>
                                                                      <div class="row">
                                                                          <div class="col-sm-3">
                                                                           <h6 class="mb-0">Contact Number:</h6>
                                                                            </div>
                                                                           <div class="col-sm-9 text-dark">
                                                                                <?= $fetch_stud['ContactNum']; ?>
                                                                        </div>
                                                                      </div>
                                                                      <hr>
                                                                      <div class="row">
                                                                          <div class="col-sm-3">
                                                                           <h6 class="mb-0">Email Address:</h6>
                                                                            </div>
                                                                           <div class="col-sm-9 text-dark">
                                                                                <?= $fetch_stud['EmailAdd']; ?>
                                                                        </div>
                                                                      </div>
                                                                      <hr>
                                                                      <div class="row">
                                                                          <div class="col-sm-3">
                                                                           <h6 class="mb-0">Father's Name:</h6>
                                                                            </div>
                                                                           <div class="col-sm-9 text-dark">
                                                                                <?= $fetch_stud['FatherName']; ?>
                                                                        </div>
                                                                      </div>
                                                                      <hr>
                                                                      <div class="row">
                                                                          <div class="col-sm-3">
                                                                           <h6 class="mb-0">Mother's Name:</h6>
                                                                            </div>
                                                                           <div class="col-sm-9 text-dark">
                                                                                <?= $fetch_stud['MotherName']; ?>
                                                                        </div>
                                                                      </div>
                                                                      <hr>
                                                                </div>
                                                                 <div class="row align-items-center justify-content-center">
                                                                             <div class="col-6">
                                                                                <h6 class="m-15 form-txt-info">Is there anything wrong in your personal information? You may request to change your information.</h6 >
                                                                            </div>
                                                                              <button type="button" data-toggle="modal" data-target="#ShowchangeProfile" class=" mx-4 my-2 btn btn-mat waves-effect waves-light hor-grd btn-grd-success" data-dismiss="modal"><i class="fa fa-telegram"></i> Submit Inquiries</button>
                                                                      </div>
                                                                <div class="card-footer bg-c-green">
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>

                                            </div>
                                                    <!-- Hover table card end -->
                                        </div>
                                        </div>
                                            <!-- task, page, download counter  end -->
                                            <?php }} ?>
                                         
                                                        
                                   </div>
                            </div>
                         </div>
                                            
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
            <div id="styleSelector"> </div>
        </div>

  <form action="change/process.php" method="POST">
          <!-- The modal for change profile -->
       <div class="modal fade" id="ShowchangeProfile" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><i class="fa fa-telegram"></i> SUBMIT CHANGE OF DATA</h5>
                  <button type="button" class="badge badge-danger" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                 <?php 
                          $select_stud = $conn_PDO->prepare (" 
                          SELECT * FROM tblgradeschool 
                          WHERE StudNum = '$st_id'");
                          $select_stud->execute();
                          if($select_stud->rowCount() > 0){
                          while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){

                          
                        ?>
                <div class="modal-body">
                     <div class="row">
                      <!-- task, page, download counter  start -->
                      <!-- Hover table card start -->
                         <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class=" text-center card-block">
                               <?php
                                                            $databasePic = "../admin/Pictures/" . $fetch_stud['Picture'];
                                                            // Check if the picture file exists
                                                            if (file_exists($databasePic)) {
                                                            // Use the actual image
                                                            $pictureSrc = $databasePic;
                                                            } else {
                                                            // Generate an avatar using the UI Avatars service
                                                            $firstName = $fetch_stud['FName'];
                                                            $lastName = $fetch_stud['LName'];
                                                            $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($lastName . " " . $firstName );
                                                            // Use the avatar URL
                                                            $pictureSrc = $avatarUrl;
                                                            }
                                                            ?>

                                <img class="m-b-5 img-100 img-radius" src="<?= $pictureSrc; ?>" alt="User-Profile-Image">

                                <div class="user-details">
                                    <h4 class="f-18 mb-1">[<?= $fetch_stud['StudNum']; ?>]</h4>
                                    <h5 class="f-17"><?= $fetch_stud['LName']; ?>, <br> <?= $fetch_stud['FName']; ?> <?= $fetch_stud['MName']; ?> <br><?= $fetch_stud['ExtensionName'] == "NULL" ? "" : " $fetch_stud[ExtensionName]" ?> </h5>
                                    <p class=" f-white  f-14"><?= $fetch_stud['LevelKo'] == "Senior High School" 
                                                        ? "$fetch_stud[GradeLevel] - $fetch_stud[SHSStrand]"
                                                        : "$fetch_stud[GradeLevel] - $fetch_stud[Sec]"
                                                          ; ?></p>
                                    <p class="form-txt-success">-<?= strtoupper($fetch_stud['Remarks'])?>-</p>
                           
                                </div>
                                </div>
                                <div class="card-footer bg-c-green">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                      <!-- task, page, download counter  start -->
                      <!-- Hover table card start -->
                         <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                     <h6 for="inquiry-type" class="text-c-green">STUDENTS NAME:</h6>
                                </div>
                                <div class="card-block">
                                    <div class="col-sm-9 text-secondary">
                                        <div class="row mb-2">
                                            <div class="col-sm-5"><label for="sitio">Last Name:</label></div>
                                            <div class="col-sm-7"><input  name="fr_Lname" type="text" id="Lname" class="form-control" value="<?= $fetch_stud['LName']; ?>"></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-5"><label for="barangay">First Name:</label></div>
                                            <div class="col-sm-7"><input  name="fr_Fname" type="text" id="Fname" class="form-control" value="<?= $fetch_stud['FName']; ?>"></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-5"><label for="town">Middle Name:</label></div>
                                            <div class="col-sm-7"><input  name="fr_Mname"type="text" id="Mname" class="form-control" value="<?= $fetch_stud['MName']; ?>"></div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="card-header">
                                     <h6 for="inquiry-type" class="text-c-green">GENDER:</h6>
                                      <select id="gender" class="form-control" name="fr_gender" required>
                                            <option value="Male" <?php echo (strtoupper($fetch_stud['Sex']) == "MALE") ? 'selected' : ''; ?>>
                                                                Male
                                            </option>
                                            <option value="Female" <?php echo (strtoupper($fetch_stud['Sex']) == "FEMALE") ? 'selected' : ''; ?>>
                                                                Female
                                            </option>
                                        </select>
                                </div>
								<div class="card-header">
                                     <h6 for="inquiry-type" class="text-c-green">YEAR LEVEL:</h6>
                                </div>
                                 <div class="card-header">
									<?php
										try {
											$query_level = "SELECT DISTINCT GradeLevel FROM tblgradeschool order by GradeLevel";
											$statement_level = $conn_PDO->prepare($query_level);
											$statement_level->execute();
											$result_level = $statement_level->fetchAll();
										} catch (PDOException $e) {
											echo "Error: " . $e->getMessage();
										}
										?>
									<select name="fr_glevel">
										<?php
										foreach ($result_level as $row_level) {
											$selected = ($row_level['GradeLevel'] == $fetch_stud['GradeLevel']) ? 'selected' : '';
											?>
											<option value="<?= $row_level['GradeLevel']; ?>" <?= $selected; ?>>
												<?= $row_level['GradeLevel']; ?>
											</option>
										<?php
										}
										?>
									</select> 
                                </div>
								
                                 <div class="card-header">
                                     <h6 for="inquiry-type" class="text-c-green">BIRTH PLACE:</h6>
                                     <input  class="form-control" name="fr_bplace" type="text" value="<?= $fetch_stud['BPlace']; ?>">
                                </div>
                                 <div class="card-header">
                                     <h6 for="inquiry-type" class="text-c-green">NATIONALITY:</h6>
                                      <input  class="form-control" name="fr_nationality" type="text" value="<?= $fetch_stud['Nationality']; ?>"> 
                                </div>
                                 <div class="card-header">
                                     <h6 for="inquiry-type" class="text-c-green">RELIGION:</h6>
                                     <input class="form-control"  name="fr_religion" type="text" value="<?= $fetch_stud['Religion']; ?>">
                                </div>
                                 <div class="card-header">
                                     <h6 for="inquiry-type" class="text-c-green">ADDRESS:</h6>
                                </div>
                                <div class="card-block">
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
                                 <div class="card-header">
                                     <h6 for="inquiry-type" class="text-c-green">CONTACT NUMBER:</h6>
                                     <input  class="form-control" name="fr_cnumber" type="text" value="<?= $fetch_stud['ContactNum']; ?>">
                                </div>
                                 <div class="card-header">
                                     <h6 for="inquiry-type" class="text-c-green">EMAIL ADDRESS:</h6>
                                     <input class="form-control"  name="fr_email" type="text" value="<?= $fetch_stud['EmailAdd']; ?>">
                                </div>
                                <div class="card-header">
                                     <h6 for="inquiry-type" class="text-c-green">FATHER's NAME:</h6>
									 <input  name="fr_fatherName" type="text" id="fr_fatherName" class="form-control" value="<?= $fetch_stud['FatherName']; ?>">
                                </div>
                                 <div class="card-header">
                                     <h6 for="inquiry-type" class="text-c-green">MOTHER's NAME:</h6>
									<input  name="fr_motherName" type="text" id="fr_motherName" class="form-control" value="<?= $fetch_stud['MotherName']; ?>">
                                </div>

                                 <div class="card-header">
                                     <h6 for="inquiry-type" class="text-c-green">Change data:</h6>
                                </div>
                                <div class="card-block">
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
                                    <div class="row align-items-center justify-content-center">
                                          <button type="Submit" data-toggle="modal" data-target="#ShowchangeProfile" class=" mx-4 my-2 btn btn-mat waves-effect waves-light hor-grd btn-grd-success" ><i class="fa fa-telegram"></i> REQUEST FOR CHANGE</button>
                                    </div>
                                <div class="card-footer bg-c-green">
                                </div>
                            </div>
                        </div>
                    </div>

                        <!-- Hover table card end -->
                    <?php }}?>
                </div>
               </form>
                </div>
            </div>
        </div>
    </div>
    </div>