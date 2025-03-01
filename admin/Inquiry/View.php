
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
                                        <li class="breadcrumb-item"><a href="./index.php?page=inquiry" class="breadcrumb-link">Inquiry</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"> Inquiry</li>
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
                                <h5 class="card-header">Inquiry Information   <a href="./index.php?page=inquiry" class="close-btn" onclick="closeMessage()">&times;</a> </h5>
                                
                                
                                        <?php

                                             $pn=$_GET['PN'];
                                             $req = $conn_PDO->prepare("SELECT * FROM inquiry2324 WHERE PN = :pn");
                                             $req->bindParam(':pn', $pn, PDO::PARAM_STR);
                                                  $req->execute();
                                                  if($req->rowCount() > 0){
                                                  while($fetch_req = $req->fetch(PDO::FETCH_ASSOC)){
                                                     $fromDateTime = new DateTime($fetch_req['date']);

                                        ?>
                                        <div class="message-popup" id="messagePopup">
                                        <div class="popup-content">
													<!--  Speech Bubble alternative -->
											    <div class="speech-wrapper">
												  <div class="col-sm-12">
													  <div class="row">
														  <div class=" col-sm-12 bubble">
															<div class="txt">
															  <p class="name"><img style="width:25px; height:25px;" src="../img/logo.png"> <strong>[<?= $fetch_req['Id']; ?>] --<?= $fetch_req['inquiryType'];?> </p>
                                                               </strong><?= $fetch_req['LName']; ?>, <?= $fetch_req['FName']; ?> <?= $fetch_req['MName']; ?>
															  <p class="hr"></p>
															  <p class="message"><?= $fetch_req['message'];?> </p>
															  <br>
															  <span class="timestamp"><?= $fromDateTime->format('F d, Y g:ia'); ?></span>
															</div>
															<div class="bubble-arrow"></div>
														  </div>
													  </div>
												  </div>
												</div>
                                            
                                          </div>
                                         </div>
                                            


                                 
                                    </div>
									 <a  href="./index.php?page=Inquiry/update&PN=<?= $fetch_req['PN']; ?>" class="update" type="submit" name="submit"><span class="material-symbols-outlined">reply</span> REPLY</a>

                                </div><?php }} ?>
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

