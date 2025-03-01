    <?php 
if(!$_SESSION['id'])
{
    header("location:../index.php");
}
else
{
    $st_id = $_SESSION['id'];
}
?>
    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <?php 
                                   $select_stud = $conn_PDO->prepare (" 
                                  SELECT * FROM tblgradeschool 
                                  WHERE StudNum = '$st_id'");
                                  $select_stud->execute();
                                  if($select_stud->rowCount() > 0){
                                  while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <div class="main-menu-header">
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
                                           $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($lastName . " " . $firstName);

                                           // Use the avatar URL
                                           $pictureSrc = $avatarUrl;
                                        }
                                        ?>
                                    <img class="img-80 img-radius" src="<?= $pictureSrc; ?>" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span id="more-details">
                                             <?= $fetch_stud['LName']; ?>, <?= $fetch_stud['FName']; ?> 
                                             <i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>
                                <?php }}?>
            
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details nav-link nav-profile">
                                            <a href="./index.php?page=profile"><i class="fa fa-user-o"></i>View Profile</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Menu</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="nav-link nav-home">
                                    <a href="./index.php?page=home" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Home</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="nav-link nav-schedule">
                                    <a href="./index.php?page=schedule" class="waves-effect waves-dark ">
                                        <span class="pcoded-micon"><i class="fa fa-calendar"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Schedule</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="nav-link nav-grade">
                                    <a href="./index.php?page=grade" class="waves-effect waves-dark ">
                                        <span class="pcoded-micon"><i class="fa fa-graduation-cap"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Grade</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="nav-link nav-account">
                                    <a href="./index.php?page=account" class="waves-effect waves-dark ">
                                        <span class="pcoded-micon"><i class="fa fa-university"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Accounts</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="nav-link nav-request">
                                    <a href="./index.php?page=request" class="waves-effect waves-dark ">
                                        <span class="pcoded-micon"><i class="fa fa-comments "></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Requests & Inquiries</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <div class="pcoded-navigation-label" data-i18n="nav.category.other">Other</div>
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-settings"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Settings</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="nav-link nav-logs">
                                            <a href="./index.php?page=logs" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-receipt"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Activity logs</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="nav-link nav-logout">
                                            <a href= "./index.php?page=changepassword"  id="btnChange" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-key"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Change Password</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
 
                    
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
  		var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  		if($('.nav-link.nav-'+page).length > 0){
  			$('.nav-link.nav-'+page).addClass('active')
          console.log($('.nav-link.nav-'+page).hasClass('tree-item'))
  			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
          $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
  				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
  			}
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

  		}
      $('.manage_account').click(function(){
        uni_modal('Manage Account','manage_user.php?id='+$(this).attr('data-id'))
      })
  
  </script>



<!-- Script for notification -->
  <script>
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
        listItem = $('<div class="notif d-flex align-self-center img-radius"></div>').html('<img class="notifImg" src="../img/logo.png"><a class="message m-t-10 f-16" data-pn="' + notification.PN + '" href="./index.php?page=request/inquiryView&PN=' + notification.PN + '">[ICST]-<i>Inquiry</i> <span class=" f-10 notifDate"><br>Date: <i>' + formatDate(notification.responseDate) + '</span></i></a>');
        } else {
       listItem = $('<div class="notif d-flex align-self-center img-radius"></div>').html('<img class="notifImg" src="../img/logo.png"><a class="message m-t-10 f-16" data-pn="' + notification.PN + '" href="./index.php?page=request/inquiryView&PN=' + notification.PN + '">[ICST]-<i>Request to change Data</i> <span class="f-10 notifDate"><br>Date: <i>' + formatDate(notification.responseDate) + '</span></i></a>');
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
 
});
</script>