
<style type="text/css">
    <style>

/* Loader CSS */
.loader {
display: none;
position: relative;
width: 100vw; /* Use full viewport width */
height: 100vh; /* Use full viewport height */
background-color: rgba(255, 255, 255, 0.7);
justify-content: center;
align-items: center;
z-index: 9999999;
}

.loader img {
width: 50px; /* Adjust the size as needed */
height: 50px; /* Adjust the size as needed */
}
.container{
max-width: 500px;
}

.profileCon{
margin-top: -130px;

}
#studPic{
width: 100px;
margin-right: 50px;
}
.profileCard{
background-color:rgba(61, 58, 58, 0.7);
border-radius: 10px;
max-width: 500px;
margin-left: auto;
margin-right: auto;
}
.flexBox{
display: flex;
}
.slider-container {
position: relative;
max-width: 500px; /* Adjust the max-width as needed */
margin: auto;
}

.mySlides img {
width: 100%;
height: 50%;
}
.caption-container {
text-align: center;
padding: 10px;
background-color: #ddd;
}

.responsive-image {
width: 100%;
height: auto;
}

@media (max-width: 600px) {
.row{
margin-right: 10px;
margin-left: 10px;
}
.announcementBox{
    margin-top: 250px;
}
.profileCon{
height: 100px;
}

.announcement{
margin-top: 40px;
}
.caption{
background-color: rgb(42, 170, 138,0.6);
padding: 10px;
color: white;
font-size: 14px;
}

}
@media (max-width: 500px) {
#studPic{
margin-right: 0px;
}
.flexBox{
display: block;
}
}
.preview-container {
margin-top: 20px;
}

.preview {
display: flex;
flex-wrap: wrap;
gap: 10px;
}
.caption{
background-color: rgb(42, 170, 138,0.6);
padding: 10px;
color: white;
}

.preview img {
max-width: 100%;
height: 400px;
border-radius: 5px;
}
.image-container {
position: relative;
display: inline-block;
margin-right: 10px;
}
.carousel-control-prev-icon, .carousel-control-next-icon {
background-color: black;
}
.announcementBox{
    background-color: rgba(10, 10, 10, 0.7);
}
.course{
    color: #1BD59D;
}
</style>
</style>
 <!-- Page-header start -->
 <div class="page-header">
                          <div class="page-block">
                              <div class="row align-items-center">
                                  <div class="col-md-8">
                                      <div class="page-header-title">
                                        <img  class="img-fluid" src="../assets/images/icstLogo.png" alt="Theme-Logo" />
                                          <h5 class="m-b-10"><i class="fa fa-home"></i> HOME PAGE</h5>
                                          <p class="m-b-0">Welcome to Student Portal</p>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <ul class="breadcrumb-title">
                                        
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
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
                                        <div class="card col-md-12">
                                            <div class="card-header">
                                                <h4>ANNOUNCEMENT</h4>
                                                    <div class="card-header-right">
                                                </div>
                                            </div>

                                        <?php
                                              $st_id = $_SESSION['id'];
                                               $select_stud = $conn_PDO->prepare("SELECT * FROM `images`");
                                               $select_stud->execute();
                                              if ($select_stud->rowCount() > 0) {
                                              while ($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)) {
                                              $images = explode(', ', $fetch_stud["file_name"]);
                                              $announcementDate = new DateTime($fetch_stud['fromDate']);
                                              $currentDateTime = new DateTime(); // current date and time
                                              $expirationDate = new DateTime($fetch_stud['expired']);
                                              $caption =  $fetch_stud["description"];

                                            ?>
                                            <div class="container">
                                                    <div class="preview-container">
                                                        <div id="carouselExample" class="carousel slide" data-ride="carousel">
                                                              <div class="carousel-inner">
                                                                  <?php
                                                                  foreach ($images as $index => $image) {
                                                                  if ($currentDateTime >= $announcementDate && $currentDateTime <= $expirationDate) {
                                                                  echo '<div class="carousel-item' . ($index === 0 ? ' active' : '') . '">';
                                                                  echo '<img class="d-block w-100" src="../admin/uploads/' . $image . '" alt="Image">';
                                                                  echo '<div class="caption ">' . $fetch_stud["description"] . '</div>';
                                                                  echo '</div>';
                                                                  }
                                                                   }
                                                                 ?>
                                                             </div>
                                                        </div>
                                                     </div>                                                              
                                             </div> 

                                          <?php
                                             }
                                             }?>  

                                           
                                        </div>
                                        <!-- Hover table card end -->
                                        </div>
                                    </div>
                                            <!-- task, page, download counter  end -->
    
                                         
                                                        
                                   </div>
                            </div>
                         </div>
                                            
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
            <div id="styleSelector"> </div>
        </div>
    </div>