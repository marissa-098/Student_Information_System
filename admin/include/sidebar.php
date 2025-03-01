
    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                               
                                <div class="main-menu-header">
                                    
                                    <img class="img-80 img-radius" src="../img/admin.jpg" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span id="more-details">
										ADMIN
                                         </span>
                                    </div>
                                </div>
                            </div>
                            <div class="pcoded-navigation-label" data-i18n="nav.category.navigation"></div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="nav-link nav-home">
                                    <a href="./index.php?page=home" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-tachometer"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
								 <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Students</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="nav-link nav-college_list">
                                            <a href="./index.php?page=college_list" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-receipt"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">College List</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="nav-link nav-student_list">
                                            <a href= "./index.php?page=student_list"  id="btnChange" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-key"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Gradeschool List</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-link nav-request">
                                    <a href="./index.php?page=request" class="waves-effect waves-dark ">
                                        <span class="pcoded-micon"><i class="fa fa-comments"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Request</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="nav-link nav-inquiry">
                                    <a href="./index.php?page=inquiry" class="waves-effect waves-dark ">
                                        <span class="pcoded-micon"><i class="ti-receipt"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Inquiries</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="nav-link nav-announcement">
                                    <a href="./index.php?page=announcement" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-pin-alt"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Announcements</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
 
                    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        listItem = $('<div class="notif d-flex align-self-center img-radius"></div>').html('<i class="ti-receipt f-28"></i><a class="message" data-pn="' + notification.PN + '" href="./index.php?page=request/inquiryView&PN=' + notification.PN + '"><b>['+ notification.Id +']</b> -<i>Inquiry</i> <span class="notifDate"><br>Date: <i>' + formatDate(notification.date) + '</span></i></a>');
        } else {
        listItem = $('<div class="notif d-flex align-self-center img-radius"></div>').html('<i class="fa fa-comments f-28 form-txt-inverted"></i><a class="message" data-pn="' + notification.PN + '" href="./index.php?page=request/view&PN=' + notification.PN + '"><b>['+ notification.Id +']</b> - <i>Request To Change Data</i><span class="notifDate"><br>Date: <i>' + formatDate(notification.date) + '</span></i></a>');
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