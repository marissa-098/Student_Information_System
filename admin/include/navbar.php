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
                                <a href="#!" class="waves-effect waves-light">
                                    <i class="f-20 ti-bell "></i>
                                    <span style="font-size: 8px;" id="notificationBadge" class="count badge bg-c-red"></span>
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
							  <img src="../img/admin.jpg" class="img-radius" alt="User-Profile-Image">
                                  <i class="ti-angle-down"></i>
                              </a>
                              <ul class=" show-notification profile-notification">
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
document.getElementById("viewInquiry").addEventListener("click", function() {
window.location.href = "./index.php?page=request";
});

    // Rest of your code...
 load_unseen_notification();

 $(document).on('click', '.message', function(){
  var pn = $(this).data('pn'); // Assuming you set data-pn attribute in the HTML
  $('.count').html('');
  load_unseen_notification(pn);
});
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
// Script for notification 
$(document).ready(function(){
 
 function load_unseen_notification(view = '') {
  $.ajax({
    url: "notif/fetch.php",
    method: "POST",
    data: { view: view },
    dataType: "json",
    success: function (data) {
      console.log('Data Notification:', data.notification);

      // Clear existing content
      $('.dropdown_menu_1').empty();

      if (data.unseen_notification > 0) {
        $('.count').html(data.unseen_notification);
      }

      // Check if there are notifications
      if (data.notification.length > 0) {
        // Create a list of notifications
        var notificationList = $('<ul class="notification-list"></ul>');

        // Loop through the notifications and append them to the list
        $.each(data.notification, function (index, notification) {
          function formatDate(dateString) {
         var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true };
         var formattedDate = new Date(dateString).toLocaleString('en-US', options);
         return formattedDate;
         }

          var listItem;
    
       if (notification.source === "inquiry2324") {

        listItem = $('<div class="media notif"></div>').html('<img class="d-flex align-self-center img-radius" src="../assets/images/logo_trans.png"><a class="f-20" data-pn="' + notification.PN + '" href="./index.php?page=request/inquiryView&PN=' + notification.PN + '"><h3>[ICST]-<i>Inquiry</i><h3><span class="notifDate"><br>Date: <i>' + formatDate(notification.responseDate) + '</span></i></a><br>');
        } else {
        listItem = $('<div class="media"></div>').html('<img class="d-flex align-self-center img-radius" src="../assets/images/logo.png"><a class="message" data-pn="' + notification.PN + '" href="./index.php?page=request/view&PN=' + notification.PN + '">[ICST]- <i>Request To Change Data</i></a><span class="notifDate"><br>Date: <i>' + formatDate(notification.responseDate) + '</span></i>');
        }

       notificationList.append(listItem);
      });

        // Append the list to the container
        $('.dropdown_menu_1').append(notificationList);
      } else {
        // If no notifications, display a message
        $('.dropdown_menu_1').html('<li class="notif">No Notification Found!</li>');
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error('AJAX Error:', textStatus, errorThrown);
    }
  });
}


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
               alert(response); // Show a success message
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
 
