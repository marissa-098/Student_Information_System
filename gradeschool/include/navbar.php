<style type="text/css">
    .notif{
        background-color: #B7EEC3 ;
        width:99%;
        padding: 5px;
        border-radius: 5px;
        margin-bottom: 2px;
        }
        .notif:hover{
        background-color: #45C160;
        }
        .logo-img{
            height: 45px;
        }

        @media only screen and (max-width: 736px) {
             .logo-img {
                max-width: 100%;
                height: 45px;
            }
        }

</style>
<nav class="navbar header-navbar pcoded-header">
              <div class="navbar-wrapper">
                  <div class="navbar-logo">
                      <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                          <i class="ti-menu"></i>
                      </a>
                      <div class="mobile-search waves-effect waves-light">
                          <div class="header-search">
                              <div class="main-search morphsearch-search">
                                  <div class="input-group">
                                      <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                      <input type="text" class="form-control" placeholder="Enter Keyword">
                                      <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <a href="index.php">
                          <img  class="img-fluid logo-img" src="../assets/images/logo3.png" alt="Theme-Logo" />
                      </a>
                      <a class="mobile-options waves-effect waves-light">
                          <i class="ti-more"></i>
                      </a>
                  </div>
                  <div class="navbar-container container-fluid">
                      <ul class="nav-left">
                          <li>
                              <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                          </li>
                      </ul>
                      <ul class="nav-right">
                            <li class="header-notification">
                                  <a href="#!" data-toggle="modal" data-target="#desclaimer" class="waves-effect waves-light" data-toggle="tooltip"  data-placement="bottom" title="Desclaimer">
                                     <i class="ti-book "></i>
                                  </a>
                              </li>
                              <li class="header-notification">
                                  <a href="#!" data-toggle="modal" data-target="#inquiries" id="option1" class=" waves-effect waves-light" data-toggle="tooltip"  data-placement="bottom" title="Inquiries">
                                        <i class="ti-help"></i>
                                  </a>
                                  
                              </li>
                             <li class="header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <i class="f-20 ti-bell "></i>
                                    <span style="font-size: 6px;" id="notificationBadge" class="count badge bg-c-red"></span>
                                </a>
                              <ul class="show-notification ">

                                 <li>
                                    <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li>
                                        <div class="dropdown_menu_1 ">
                                        </div>
                                    </li>
                              </ul>
                              </li>
                          <li class="user-profile header-notification">
                              <a href="#!" class="waves-effect waves-light">
                                <?php 
                                  $select_stud = $conn_PDO->prepare (" 
                                  SELECT * FROM tblgradeschool 
                                  WHERE StudNum = '$st_id'");
                                  $select_stud->execute();
                                  if($select_stud->rowCount() > 0){
                                  while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){
                                ?>
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
                                  <img src="<?= $pictureSrc; ?>" class="img-radius" alt="User-Profile-Image">
                                <?php }} ?>
                                  <i class="ti-angle-down"></i>
                              </a>
                              <ul class=" show-notification profile-notification">
                                  
                                  <li class="waves-effect waves-light">
                                      <a href="./index.php?page=profile">
                                          <i class="ti-user"></i> Profile
                                      </a>
                                  </li>
                                  <li class="waves-effect waves-light">
                                      <a href="include/ajax.php?action=logout">
                                          <i class="ti-layout-sidebar-left"></i> Logout
                                      </a>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </div>
              </div>
          </nav>


<!-- The modal for inquiries -->
       <div class="modal fade" id="inquiries" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><i class="ti-help"></i> INQUIRIES</h5>
                  <button type="button" class="badge badge-danger" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                     <h6 class="" >Do you have any concern about your information? feel free to message us.</h6> 
                     <div class="row align-items-center justify-content-center">
                        <button type="button" data-toggle="modal" data-target="#submitInquiry" class=" mx-4 my-2 btn btn-mat waves-effect waves-light hor-grd btn-grd-success" data-dismiss="modal"><i class="fa fa-telegram"></i> Submit Inquiries</button>
                        <button type="button" id="viewInquiry" class="mx-4 my-2 btn btn-mat waves-effect waves-light hor-grd btn-grd-primary"><i class="fa fa-eye"></i> View Inquiries</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The modal for inquiries -->
       <div class="modal fade" id="submitInquiry" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><i class="fa fa-telegram"></i> INQUIRIES</h5>
                  <button type="button" class="badge badge-danger" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <form class="form-material">
                         <div class="form-group row">
                              <div class="col-sm-12">
                                <h6 for="inquiry-type" class="text-c-green">Nature of Inquiry:</h6>
                                  <select id="inquiry-type" class="form-control">
                                      <option disabled selected >Select One Value Only</option>
                                       <option value="Enrollment and Admission">Enrollment and Admission</option>
                                            <option value="Academic Records">Academic Records</option>
                                            <option value="Personal Information">Personal Information</option>
                                            <option value="Financial Information">Financial Information</option>
                                            <option value="Disciplinary Records">Disciplinary Records</option>
                                            <option value="Health and Medical Records">Health and Medical Records</option>
                                            <option value="Events and Extracurricular Activities">Events and Extracurricular Activities</option>
                                            <option value="Graduation and Alumni Services">Graduation and Alumni Services</option>
                                            <option value="Other">Other</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-sm-12">
                                 <h6 for="inquiry-type" class="text-c-green">Message:</h6>
                                 <br>
                                  <div class="form-group form-default form-static-label">
                                      <textarea id="messages" class="form-control" required ></textarea>
                                      <span class="form-bar"></span>
                                      <label class="float-label">Type your message here..."</label>
                                  </div>
                              </div>
                          </div>
                          <div class="row align-items-center justify-content-center">
                              <button type="button" onclick="submitForm()" class=" mx-4 my-2 btn btn-mat waves-effect waves-light hor-grd btn-grd-success" data-dismiss="modal"><i class="fa fa-telegram"></i> Submit Inquiries</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- The modal for -->
    <div class="modal fade" id="desclaimer"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php
					    $select_stud = $conn_PDO->prepare (" 
					    SELECT * FROM tblgradeschool 
					    WHERE StudNum = '$st_id'");
					    $select_stud->execute();
					    if($select_stud->rowCount() > 0){
					    while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){

						?>
							<h5>Welcome Student, <b class="text-c-green"><?= strtoupper($fetch_stud['LName']); ?>, <?= strtoupper($fetch_stud['FName']); ?> <?= strtoupper($fetch_stud['MName']); ?></b></h5>

						<?php
						}}
						?>
                    <button type="button" class="badge badge-danger" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <div class="step active" id="step1">
						<p>DISCLAIMER FOR ICST If you require any more information or have any questions about our site's disclaimer, please feel free to contact us by email at DISCLAIMERS FOR ICST.EDU.PH</p>
						 <div class="row align-items-center justify-content-center">
							<button type="button" onclick="nextStep()" class=" mx-4 my-2 btn btn-mat waves-effect waves-light hor-grd btn-grd-success" ><i class="fa fa-caret-right "></i>Next</button>
					  </div>
					</div>

					<div class="step" id="step2">
						<p>All the information on this website - http://student-portal.icst.edu.ph - is published in good faith and for general information purpose only. ICST does not make any warranties about the completeness, reliability and accuracy of this information. Any action you take upon the information you find on this website (student-portal.icst.edu.ph), is strictly at your own risk. ICST will not be liable for any losses and/or damages in connection with the use of our website.</p>
						 <div class="row align-items-center justify-content-center">
							<button type="button" onclick="prevStep()" class=" mx-4 my-2 btn btn-mat waves-effect waves-light hor-grd btn-grd-success"><i class="fa fa-caret-left "></i>Previous</button>
							<button type="button" onclick="nextStep()" class=" mx-4 my-2 btn btn-mat waves-effect waves-light hor-grd btn-grd-success" ><i class="fa fa-caret-right "></i>Next</button>
					  </div>
					</div>

					<div class="step" id="step3">
						<p>From our website, you can visit other websites by following hyperlinks to such external sites. While we strive to provide only quality links to useful and ethical websites, we have no control over the content and nature of these sites. These links to other websites do not imply a recommendation for all the content found on these sites. Site owners and content may change without notice and may occur before we have the opportunity to remove a link which may have gone 'bad'.</p>
						<div class="row align-items-center justify-content-center">
							<button type="button" onclick="prevStep()" class=" mx-4 my-2 btn btn-mat waves-effect waves-light hor-grd btn-grd-success"><i class="fa fa-caret-left "></i>Previous</button>
							<button type="button" onclick="nextStep()" class=" mx-4 my-2 btn btn-mat waves-effect waves-light hor-grd btn-grd-success" ><i class="fa fa-caret-right "></i>Next</button>
					  </div>
					</div>

					<div class="step" id="step4">
						<p>Please be also aware that when you leave our website, other sites may have different privacy policies and terms which are beyond our control. Please be sure to check the Privacy Policies of these sites as well as their "Terms of Service" before engaging in any business or uploading any information.</p>
						  <div class="row align-items-center justify-content-center">
							<button type="button" onclick="prevStep()" class=" mx-4 my-2 btn btn-mat waves-effect waves-light hor-grd btn-grd-success"><i class="fa fa-caret-left "></i>Previous</button>
							<button type="button" data-backdrop="static" onclick="finish()" class=" mx-4 my-2 btn btn-mat waves-effect waves-light hor-grd btn-grd-success" ><i class="fa fa-check-square-o "></i>Finish</button>
					  </div>
					</div>
                </div>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
document.getElementById("viewInquiry").addEventListener("click", function() {
window.location.href = "./index.php?page=request";
});

// submit of form for inquiries
     function submitForm() {
         // Get form data
            var formData = {
             Itype: $('#inquiry-type').val(),
             Imessages: $('#messages').val()
                                    };
              console.log(formData);

            // AJAX request to submit data to the server
                $.ajax({
               type: 'POST',
               url: 'inc/process_form.php', // PHP script to handle form submission
               data: formData,
               success: function (response) {
               response = JSON.parse(response);
						if (response.success) {
							Swal.fire({
								html: '<div class="containerNotif"><div><img class="checkmark" src="../assets/icon/success.png" alt="Checkmark Image"></div><div class="textDiv">' + response.message + '</div></div>',
								position: 'top-end',
								showConfirmButton: false,
								customClass: {
									popup: 'swal-wide',
									icon: 'icon-class'
								}
							});
						} else {
							Swal.fire({
								html: '<div class="containerNotif"><div><img class="checkmark" src="../assets/icon/warnning.png" alt="Checkmark Image"></div><div class="textDiv">' + response.message + '</div></div>',
								position: 'top-end',
								showConfirmButton: false,
								customClass: {
									popup: 'swal-wide',
									icon: 'icon-class'
								}
							});
						}
                },
               error: function () {
               alert('Error submitting the form');
                }
              });
         }

  </script>
  <script type="text/javascript">
      // steps for desclaimer
         var currentStep = 1;
        function showStep(stepNumber) {
            var steps = document.querySelectorAll('.step');
            steps.forEach(function(step) {
                step.classList.remove('active');
            });

            document.getElementById('step' + stepNumber).classList.add('active');
        }

        function nextStep() {
            if (currentStep < 4) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        }
        function finish() {
            document.querySelector('#desclaimer').style.display = 'none';
           Swal.fire({
                 html: '<div class="containerNotif"><div><img class="checkmark" src="../assets/icon/success.png" alt="Checkmark Image"></div><div class="textDiv">Thank you for reviewing desclaimer for ICST!</div></div>',
                 position: 'top-end',
                 showConfirmButton: false,
                 customClass: {
                 popup: 'swal-wide',
                 icon: 'icon-class'
                 }
                }).then(function() {
                   var backdrop = document.querySelector('.modal-backdrop');
                   if (backdrop) {
                        backdrop.remove();
                       }
                 });
            // You can redirect the user or perform other actions after finishing the guidelines.
        }
  </script>
 
