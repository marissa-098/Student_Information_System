
<div class="col-lg-12">
	<style type="text/css">

.container {
    text-align: center;
    max-width: 300px;
    width: 100%;
}

.file-input {
    position: relative;
    overflow: hidden;
    margin-bottom: 20px;
}

#fileInput{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}
#dateFrom,#dateTo{
 width: 100%;
}

#fileinput {
    display: block;
    background-color: #3498db;
    color: #fff;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
}
#fileinput:hover{
    display: block;
    background-color: #323ef4;
    color: #fff;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
}

button {
    background-color: #2ecc71;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    
}
#uploadButton{
 width: 100%;
}

.preview-container {
    margin-top: 20px;
}

.preview {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.preview img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
}
.image-container {
    position: relative;
    display: inline-block;
    margin-right: 10px;
}

.delete-button {
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: #ff0000;
    color: #fff;
    border: none;
    padding: 5px;
    cursor: pointer;
}
.closebtn {
    margin-left: 15px;
    color: black;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
.carousel-control-prev-icon, .carousel-control-next-icon {
        background-color: black;
    }

	</style>

      <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <br>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./index.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="./index.php?page=announcement" class="breadcrumb-link">Announcement</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Update</li>
                                    </ol>
                                </nav>
                            </div>
                      
                    </div>
                </div>

	<div class="card card-outline card-primary">
		 <div class="scroll">
                            <?php
                              // include("modalProfile.php");
                            ?>

                                  <div class="xp-breadcrumbbar text-center">
                                  	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
                                      <h4 class="page-title"><a href="./index.php?page=announcement"class="closebtn">&times;</a></h4>
                                        
                                            
                                           
                                        </div>
                                        <!-- <ol class="breadcrumb text-center">
                                          <<li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                                          <li class="breadcrumb-item active" aria-current="page">Departments</li> 
                                        </ol>                 -->


                                        <br>
                                        <br>
                                        <br>

                                        <?php
                                          $st_id = $_GET['Id'];
                                          $select_stud = $conn_PDO->prepare("SELECT * FROM images WHERE id = :st_id");
                                          $select_stud->bindParam(':st_id', $st_id, PDO::PARAM_INT);
                                          $select_stud->execute();
                                          if($select_stud->rowCount() > 0){
                                          while($row = $select_stud->fetch(PDO::FETCH_ASSOC)){
                                             $images = explode(', ',$row["file_name"]);
                                            $fromDate = new DateTime($row['fromDate']);

                                        ?>

																		<div class="container">
																			    <form id="imageUploadForm" method="post" enctype="multipart/form-data">
                                                                                    <div class="preview-container">
                                                                                   <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                                                                                    <div class="carousel-inner">
                                                                                        <?php
                                                                                        // Loop through the images array and generate carousel items
                                                                                        foreach ($images as $index => $image) {
                                                                                            echo '<div class="carousel-item' . ($index === 0 ? ' active' : '') . '">';
                                                                                            echo '<img class="d-block w-100" src="uploads/' . $image . '" alt="Image">';
                                                                                            echo '</div>';
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                                                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                                        <span class="sr-only">Previous</span>
                                                                                    </a>
                                                                                    <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                                                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                                        <span class="sr-only">Next</span>
                                                                                    </a>
                                                                                </div>

                                                                                </div>

																			        <div class="file-input">
																			            <input value="<?= $row['file_name'];?>" type="file" id="fileInput" name="files[]" multiple accept="image/*">
																			            <label id="fileinput" for="fileInput">Change Images</label>
																			        </div>
                                                                                    <div class="file-input">
                                                                                      <span >Target Date:</span><br> 
                                                                                 <input name="dateFrom" id="dateFrom" type="datetime-local" value="<?= $fromDate->format('Y-m-d\TH:i'); ?>">
                                                                                  <label for="displayDays">Display for (days):</label>
                                                                                      <input type="number" id="displayDays" name="displayDays" min="1" required  value="<?= $row['days']; ?>"><br>
                                                                                    
                                                                                    
                                                                                    
																			        <span for="Descriptions">Image Descriptions:</span>
        															         <textarea id="imageDescriptions" name="descriptions" rows="4">
                                                                                           <?= $row['description']; ?>                                             
                                                                             </textarea><br>
																			        		<button type="submit" name="submit" id="uploadButton">Upload</button>
																			    </form>
                                                                                <?php
                                                                            }
                                                                        }?>

																		
																			</div>
																			
                                  </div>
                                  <br><br>      
                            
                             
                            </div>
	</div>
</div>
<?php 
if (isset($_POST['submit'])) {
    // File upload configuration 
    $st_id =$_GET['Id'];
    $targetDir = "uploads/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    $statusMsg = $errorMsg = $errorUpload = $errorUploadType = '';
    $fileNames = array_filter($_FILES['files']['name']);

    if (!empty($fileNames)) {
        // Get the common description for all images
        $description = $_POST['descriptions'];
        $announcementDate = $_POST['dateFrom'];
         $displayDays = (int)$_POST['displayDays'];

         // Calculate expiration date
         $expirationDate = date('Y-m-d', strtotime($announcementDate . " + $displayDays days"));

        $status = ($announcementDate === date('Y-m-d\TH:i')) ? 1 : 0;

        // Prepare the array to store file names
        $fileNamesArray = array();

        foreach ($_FILES['files']['name'] as $key => $val) {
            // File upload path
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // Add the file name to the array
                    $fileNamesArray[] = $fileName;
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                }
            } else {
                $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
            }
        }

        // Error message
        $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
        $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
        $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;

        if (!empty($fileNamesArray)) {
            // Combine file names into a comma-separated string
            $fileNamesString = implode(', ', $fileNamesArray);
           // Your database update logic
                $update = $conn_PDO->prepare("UPDATE images 
                             SET file_name = :fileNamesString, 
                                 description = :description, 
                                 fromdate = :announcementDate,
                                 expired = :expirationDate,
                                 days = :displayDays,
                                 status = :status
                             WHERE id = :id");

                        $update->bindParam(':fileNamesString', $fileNamesString, PDO::PARAM_STR);
                        $update->bindParam(':description', $description, PDO::PARAM_STR);
                        $update->bindParam(':announcementDate', $announcementDate, PDO::PARAM_STR);
                        $update->bindParam(':expirationDate', $expirationDate, PDO::PARAM_STR);
                        $update->bindParam(':displayDays', $displayDays, PDO::PARAM_INT);
                        $update->bindParam(':status', $status, PDO::PARAM_STR);
                        $update->bindParam(':id', $st_id, PDO::PARAM_INT);

                          
                if ($update->execute()) {  // Use the execute() method here
                    $statusMsg = "Files are uploaded successfully." . $errorMsg;

                    // Display a success alert using JavaScript
                    echo '<script>alert("Upload successful!");</script>';
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";

                    // Display a failure alert using JavaScript
                    echo '<script>alert("Upload failed! Please try again.");</script>';
                }
        } else {
            $statusMsg = "Upload failed! " . $errorMsg;

            // Display a failure alert using JavaScript
            echo '<script>alert("Upload failed! Please try again.");</script>';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
        
        // Display a failure alert using JavaScript
        echo '<script>alert("Upload failed! Please try again.");</script>';
    }
}

?>

<style>
	table td{
		vertical-align: middle !important;
	}



</style>

<script>
	document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('fileInput');
    const uploadButton = document.getElementById('uploadButton');
    const imagePreview = document.getElementById('imagePreview');

    fileInput.addEventListener('change', handleFileSelect);
    uploadButton.addEventListener('click', uploadImages);


				function handleFileSelect() {
				    const files = fileInput.files;
				    imagePreview.innerHTML = '';

				    for (let i = 0; i < files.length; i++) {
				        const file = files[i];
				        const reader = new FileReader();

				        reader.onload = function (e) {
				            const img = document.createElement('img');
				            img.src = e.target.result;

				            // Create a container div for each image
				            const container = document.createElement('div');
				            container.classList.add('image-container');

				            // Add the image to the container
				            container.appendChild(img);

				            // Create a delete button
				            const deleteButton = document.createElement('button');
				            deleteButton.innerHTML = 'x';
				            deleteButton.classList.add('delete-button');

				            // Attach a click event to the delete button
				            deleteButton.addEventListener('click', function () {
				                container.remove(); // Remove the container when the delete button is clicked
				            });

				            // Add the delete button to the container
				            container.appendChild(deleteButton);

				            // Add the container to the preview
				            imagePreview.appendChild(container);
				        };

				        reader.readAsDataURL(file);
				    }
				}

    function uploadImages() {
        const form = document.getElementById('imageUploadForm');
        const formData = new FormData(form);

        // Add your AJAX code to handle image upload using formData
        // For example, using fetch API or jQuery.ajax
        // After successful upload, you can display a success message or update the UI as needed
        // Don't forget to handle the server-side part for image processing and storage
    }
});

</script>