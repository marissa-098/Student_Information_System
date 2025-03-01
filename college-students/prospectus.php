 <!-- Page-header start -->
 <div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h3 class="m-b-8"><i class="ti-layout-media-overlay-alt-2"></i> PROSPECTUS</h3>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="./index.php?page=home"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Prospectus</a>
                    </li>
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
                        <?php 
                          $select_stud = $conn_PDO->prepare (" 
                          SELECT * FROM tblsi t1
                          INNER JOIN tblsiadd t2 ON t1.StudNum = t2.StudNum
                          WHERE t1.StudNum = '$st_id'");
                          $select_stud->execute();
                          if($select_stud->rowCount() > 0){
                          while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){

                          
                        ?>
                        <!-- Hover table card start -->
                        <div style="background-color: rgb(200, 230, 10, 0.1);" class="card">
                        
                            <div class="">
                                <input style="display: none;" type="text" id="StudNum" value="<?= $fetch_stud['StudNum']; ?>">
                                <input style="display: none;" type="text" id="Course" value="<?= $fetch_stud['Course']; ?>">
                                <input style="display: none;" type="text" id="Major" value="<?= $fetch_stud['Major']; ?>">
                                <input style="display: none;" type="text" id="Curriculum" value="<?= $fetch_stud['Curriculum']; ?>">
                            </div>
                            <div class="d-flex align-self-center">
                                <button id="displayResult" class="my-2 mx-1 btn btn-mat waves-effect waves-light btn-primary ">View Prospectus</button>
                                <button style="display:none;" id="printProspectus" class="m-2 mx-1 btn btn-mat waves-effect waves-light btn-success">Print</button>
                            </div>
                        </div>
                        <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-block table-border-style">
                            <div id= "displayArea1">
                            <div class="table-responsive">
                                 <table  class="table table-bordered table-striped">
                                    <tr>
                                        <th>CODE</th>
                                        <th>DESCRIPTION</th>
                                        <th>UNIT</th>
                                        <th>YEAR LEVEL</th>
                                        <th>SEMESTER / ACADEMIC YEAR</th>
                                        <th>EQUIVALENT</th>
                                        <th>REMARKS</th>
                                        </tr>
                                        <tr>
                                              <td colspan="10"> click "view" to show your prospectus!</td>
                                        </tr>
                                </table>
                            </div>
                            </div>
                        </div>
                        </div>
                    <!-- Hover table card end -->

                     <!-- Print RECORDS -->
                          <div  style="display:none;" id="printableContent">
                                <div class="modal-contentP">
                                <div id="registrar">
                                    <img src="../img/logo.png" alt="School Logo" class="school-logo">
                                    <p id="innovative" class="f-mnt-B f-mgreen f-15 f-b f-k1"><b?>INNOVATIVE COLLEGE OF SCIENCE & TECHNOLOGY</b></p>
                                    <p id="locationP" class="f-10 f-mnt">Malitbog, Bongabong, Oriental Mindoro 5211, Philippines</p>
                                    <p id="contact" class="f-10 f-mnt">Tel No. (043) 283-5521 / 283-5561</p>
                                    <hr>
                                    <p  class=" f-mnt-B f-black f-15 f-b f-k1">OFFICE OF THE REGISTRAR</p>
                                    <p  class=" f-mnt-B f-black f-15 f-b f-k1"> STUDENT PROSPECTUS <br>    
                                </div>
                            <div class="student-info">
                                <div>
                                    <p><strong>Name:</strong> <?= strtoupper($fetch_stud['Lname']); ?>, <?= strtoupper($fetch_stud['Fname']); ?> <?= strtoupper($fetch_stud['Mname']); ?> </p>
                                    <p><strong>Student ID:</strong> <?= $fetch_stud['StudNum']; ?></p>
                                </div>
                                <div>
                                    <p><strong>Course & Major:</strong> <?= $fetch_stud['Course']; ?>-<?= $fetch_stud['Major']; ?></p>
                                    <p><strong>Curriculum:</strong> <?= $fetch_stud['Curriculum']; ?></p>
                                </div> 
                            </div>
                            <?php 
                                  }
                                } 
                            ?>
                        </div>
                    </div>
                         <div style="display:none;" id="printableContent2">
                                    <br>
                                    <br>
                                    <br>
                                 <div>
                             </div>
                         </div>
                         <!-- Print RECORDS -->

            </div>
            <!-- Page-body end -->
        </div>
            <div id="styleSelector"> </div>
            </div>
</div>
 <footer class="form-bg-inverse main-footer">
    <div class="p-t-10 p-b-10 text-center">
        <strong>Online Student Information System</strong>
        <br>
        <p>Develop by CodeNinja &#169; 2023 </p>
        
    </div>
  </footer>

<style type="text/css">
</style>
<script>

// Function to handle the printing of information
function printInformation() {
    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>Prospectus</title></head><body>');
    
         printWindow.document.write('<style>');
		 printWindow.document.write('body { font-family: "Arial", sans-serif; }');
		 printWindow.document.write('printableContent2, printableContent{display:block;} .innovative{font-style:bold}   .student-info {display: flex;justify-content: space-between;margin-bottom: 20px;}   .student-info p {margin: 0;}   school-info {display: flex;text-align: center;margin-bottom: 20px;}    .school-logo {max-width: 100px;max-height: 60px;margin-right: 10px;} .school-name {margin: 0;}#locationP{margin-top: -15px;font-style: italic;}#contact{font-style: italic;margin-top: -15px;}.containerTop{align-items:center;}#registrar{text-align: center;} th{background-color:gray;}');
		printWindow.document.write('table { border-collapse: collapse; width: 100%; border: 0.2px solid #000;}');
		printWindow.document.write('th, td { padding: 5px; text-align: left; font-size:11px; }');
		printWindow.document.write('#YearandSem, .report{ margin-top:-10px; }');		
		printWindow.document.write('th { background-color: #f2f2f2; }');
		printWindow.document.write('</style>');
  // Inject the fetched information into the print window
    printWindow.document.write('<div>' + document.getElementById('printableContent').innerHTML + ' </div><div id="ProspectusTbl">' + document.getElementById('ProspectusTbl').innerHTML + '</div><div>' + document.getElementById('printableContent2').innerHTML + ' </div>');

    printWindow.document.write('</body></html>');

    // Adding a setTimeout to ensure content is loaded before printing
    setTimeout(function () {
        printWindow.document.close();
        printWindow.print();
    }, 500);
}

// Event listener for the display button
document.getElementById('printProspectus').addEventListener('click', function () {
    printInformation();
});
document.getElementById('displayResult').addEventListener('click', function () {
	
    var studnum = document.getElementById('StudNum').value;
    var course = document.getElementById('Course').value;
    var major = document.getElementById('Major').value;
    var curriculum = document.getElementById('Curriculum').value;
    console.log(studnum,course, major, curriculum);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Display the information in the target area
            document.getElementById('displayArea1').innerHTML = this.responseText;
            document.getElementById('printProspectus').style.display = 'block';
        }
    };
     xhttp.open("GET", "prospectus/fetch.php?studID=" + studnum + "&course=" + course + "&major=" + major + "&curriculum=" + curriculum, true);
    xhttp.send();
    });

    </script>