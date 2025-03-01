
<?php

$servername = "localhost";
$username = "icstitde_admin";
$password = "NS6^y&{*O,&6";
$dbname = "icstitde_sis_db";


$conn_PDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

if (isset($_GET['delete'])) {
    $query = "DELETE FROM images WHERE id = :id";

		$statement = $conn_PDO->prepare($query);
		$success = $statement->execute(
			array(
				'id' => $_GET['delete']
			)
		);

		if ($success) {
			$redirectUrl = "./index.php?page=announcement"; // Replace with your desired target URL
			
			echo '<script>
				Swal.fire({
					title: "Success!",
					text: "Image deleted successfully.",
					icon: "success",
					showConfirmButton: false,
					timer: 3000
				}).then(function() {
					window.location.href = "' . $redirectUrl . '";
				});
			</script>';
		} else {
			// Handle the failure scenario
		}
		   
    exit();
}

?>


<style>
.addAnnounce {
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
	  }

	  .addAnnounce:hover {
		  background-color:#54CA24; /* Change background color on hover */
	  }
	  #img{
		width: 30px;
		height: 30px;
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
									<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page"> announcement</li>
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
                                <h5 class="card-header"> <a href="./index.php?page=announcement/addAnnounce" class="addAnnounce">
                                    <i class="fa fa-plus"></i> Add</a></h5>
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">images</th>
                                                    <th scope="col">Description</th>
                                                     <th scope="col">Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php 


                                                             $select_stud = $conn_PDO->prepare (" 
                                                              SELECT * FROM images Order by uploaded_on");
                                                              $select_stud->execute();
                                                              if($select_stud->rowCount() > 0){
                                                              while($row = $select_stud->fetch(PDO::FETCH_ASSOC)){
                                                                 $images = explode(', ',$row["file_name"]);
                                                                 $announcementDate = new DateTime($row['fromDate']);
                                                                 $currentDateTime = new DateTime(); // current date and time
                                                                 $expirationDate = new DateTime($row['expired']);
                                                              

                                                ?>
                                                <tr>
                                                    <td><?= $row['id']; ?></td>
                                                    <td>
                                                        <?php
                                                        // Loop through the images array and display each image
                                                        foreach ($images as $image) {
                                                            echo '<img id="img" src="uploads/' . $image . '" alt="Image">';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= $row['description']; ?></td>
                                                    <td><?= $announcementDate->format('F d, Y g:ia'); ?></td>
                                                   
                                                    <td>
                                                     <?php 
                                                     if ($currentDateTime < $announcementDate) {
                                                     echo '<span class="badge bg-info text-white">Pending</span>';
                                                     } else if ($currentDateTime <= $expirationDate) {
                                                     echo '<span class="badge bg-success text-white">Uploaded</span>';
                                                     } else {
                                                     echo '<span class="badge bg-warning text-white">Expired</span>';
                                                     }
                                                     ?> 
                                                    </td>
                                                    <td class="align-right">
                                                        <a href="./index.php?page=announcement/updateAnnounce&Id=<?= $row['id']; ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Announcement">
                                                          <i class="fa fa-edit"></i>
                                                        </a> |
                                                       <a href="#" onclick="return showConfirmation('<?php echo $row['id'];?>')" class="text-secondary font-weight-bold text-xs delete" data-toggle="tooltip" data-original-title="Delete Announcement">
														  <i class="fa fa-trash"></i>
														</a>
                                                      </td>
                                                </tr>
                                             <?php } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
<script>
$(document).ready(function() {
  $('table').DataTable();
});

</script>

<script>
function showConfirmation(deleteId) {
  event.preventDefault(); // Prevent the default click behavior of the link

  var deleteUrl = "./index.php?page=announcement&delete=" + deleteId; // Construct the delete URL

  Swal.fire({
    title: 'Are you sure?',
    text: 'Are you sure you want to delete this announcement?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // If confirmed, proceed with the deletion by navigating to the delete URL
      window.location.href = deleteUrl;
	  
    }
  });
}
</script>