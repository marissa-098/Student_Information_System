 <!-- Page-header start -->
 <div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h3 class="m-b-8"><i class="fa fa-calendar"></i> SCHEDULE</h3>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="./index.php?page=home"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Schedule</a>
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
                          SELECT * FROM tblgradeschool 
                          WHERE StudNum = '$st_id'");
                          $select_stud->execute();
                          if($select_stud->rowCount() > 0){
                          while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){
                          
                        ?>
                        <!-- Hover table card start -->
                        <div class="card">
                        
                            <div class="">
                            <select  id="mySelect" class ="form-control">
                                <option value="0" disabled selected > Select Semester/Academic Year</option>
                             <?php     
                                           try {
                                               // Create a PDO connection
                                              
                                               $conn_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                           
                                               // Query to get table names and creation dates for 'tblsem%'
                                              // Assuming you have a database connection named $conn_PDO and placeholders for :dbname

                                                $sql = "SELECT table_name
                                                FROM information_schema.tables
                                                WHERE table_schema = :dbname AND table_name LIKE 'tblsem%' AND table_name NOT LIKE 'tblsemsummer%'
                                                ";
                                      
                                               $sql1 = "SELECT table_name 
                                               FROM information_schema.tables
                                               WHERE table_schema = :dbname AND table_name LIKE 'tblsubrpt%' AND table_name NOT LIKE 'tblsubrptsummer%'
                                               ";
                                      
                                              // Prepare and execute the first query
                                              $stmt = $conn_PDO->prepare($sql);
                                              $stmt->bindParam(':dbname', $dbname, PDO::PARAM_STR);
                                              $stmt->execute();
                                              $results1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                              
                                              // Prepare and execute the second query
                                              $stmt = $conn_PDO->prepare($sql1);
                                              $stmt->bindParam(':dbname', $dbname, PDO::PARAM_STR);
                                              $stmt->execute();
                                              $results2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                              
                                              $maxRowCount = max(count($results1), count($results2));
                                              
                                      for ($i = 0; $i < $maxRowCount; $i++) {
                                                        if (isset($results1[$i]['TABLE_NAME']) || isset($results2[$i]['TABLE_NAME'])) {
                                                            $tblsem = $results1[$i]['TABLE_NAME'];
                                                            $tblsubrpt = $results2[$i]['TABLE_NAME'];

                                                                                       $checkColumnsSql = "SELECT table_name
                                                                                        FROM information_schema.columns
                                                                                        WHERE table_schema = :dbname
                                                                                          AND table_name = :tableName
                                                                                          AND column_name IN ('AcadYr', 'Sem')";

                                                                    $checkColumnsStmt = $conn_PDO->prepare($checkColumnsSql);
                                                                    $checkColumnsStmt->bindParam(':dbname', $dbname, PDO::PARAM_STR);
                                                                    $checkColumnsStmt->bindParam(':tableName', $tblsubrpt, PDO::PARAM_STR);
                                                                    $checkColumnsStmt->execute();
                                                                    $hasColumnsResult = $checkColumnsStmt->fetchAll(PDO::FETCH_ASSOC);

                                                                    if (!empty($hasColumnsResult)) {
                                                                        // Table has 'Acadyr' and 'Sem' columns
                                                                        // Retrieve distinct values
                                                                         $studentId = $_SESSION['id'];
                                                                       $distinctValuesSql = "SELECT DISTINCT AcadYr, Sem, YrLevel, Sec
                                                                                                 FROM $tblsubrpt 
                                                                                                 WHERE StudNum = :id";   // Use the actual table name

                                                                        $distinctValuesStmt = $conn_PDO->prepare($distinctValuesSql);
                                                                        $distinctValuesStmt->bindParam(':id',$studentId, PDO::PARAM_STR);
                                                                        $distinctValuesStmt->execute();
                                                                        $distinctValues = $distinctValuesStmt->fetchAll(PDO::FETCH_ASSOC);
                                                                        foreach ($distinctValues as $row) {
                                                                               echo '<option value="'.$tblsem.','.$tblsubrpt.','.$_SESSION['id'].','.$row['YrLevel'] .','. $row['Sec'].'">' . $row['Sem'] ." ". $row['AcadYr'] . '</option>';
                                                                        }

                                                                        echo '</table>';
                                                                    } else {
                                                                        // Table does not have both 'Acadyr' and 'Sem' columns
                                                                        echo 'The table does not have both columns named "Acadyr" and "Sem".';
                                                                    }
                                             
                                                  }
                                        
                                                }
              
                                           } catch (PDOException $e) {
                                               echo "Error: " . $e->getMessage();
                                           } finally {
                                               // Close the database connection
                                               $conn_PDO = null;
                                           }
                                           ?>
                                </select>
                            </div>
                            <div class="d-flex align-self-center">
                                <button id="displayResult" class="my-2 mx-1 btn btn-mat waves-effect waves-light btn-primary ">View</button>
                                <button id="printGrades" class="m-2 mx-1 btn btn-mat waves-effect waves-light btn-success">Print</button>
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
                                            <th width ='7%' >Code</th>
                                            <th width ='30%'>Description</th>
                                            <th width ='12%'>Instructor</th>
                                            <th width ='3%'>Lec</th>
                                            <th width ='3%'>Lab</th>
                                            <th width ='3%'>Unit</th>
                                            <th width ='5%'>Days</th>
                                            <th width ='15%'>Time</th>
                                            <th width ='5%'>Room</th>
                                    </tr>
                                    <tr>
                                      <td colspan="10">Select Academic and Semester then click "view" to show schedule!</td>
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
                                    <p  class=" f-mnt-B f-black f-15 f-b f-k1"> STUDENT SCHEDULE <br>
									<p id="YearandSem"></P>    
                                </div>
                            <div class="student-info">
                                 <div>
                                    <p><strong>Name:</strong> <?= $fetch_stud['LName']; ?>, <?= $fetch_stud['FName']; ?> <?= $fetch_stud['MName']; ?> </p>
                                    <p><strong>Student ID:</strong> <?= $fetch_stud['StudNum']; ?></p>
                                </div>
                                <div>
                                    <p><strong>STRAND:</strong><?= $fetch_stud['SHSStrand']; ?></p>
                                    <p><strong>YR. & Sec:</strong> <span id="YrandSec" ></span></p>
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

<style type="text/css">
</style>
<script>
// Function to handle the AJAX request and display information
function displayInformation1(selectedValue) {
    if (selectedValue == "0") {
        Swal.fire({
              html: '<div class="containerNotif"><div><img class="checkmark" src="../assets/icon/warning.png" alt="Checkmark Image"></div><div class="textDiv">Please Select Semester/Academic Year!</div></div>',
              position: 'top-end',
              showConfirmButton: false,
              customClass: {
                popup: 'swal-wide',
                icon: 'icon-class'
              }
            });
    } else {
       // Split the selected value into Sem, Year, and StudentID
       var values = selectedValue.split(',');
        var tblsem = values[0].trim();
        var tblsubrpt = values[1].trim();
        var stId = values[2].trim();
        var YearLevel = values[3].trim();
        var section = values[4].trim();

        console.log(values);

        // AJAX request to fetch and display information based on Sem, Year, and StudentID
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Display the information in the target area
                document.getElementById('displayArea1').innerHTML = this.responseText;

                // Call the function to handle printing
                printInformation();
            }
        };
        xhttp.open("GET", "schedule/fetch.php?tblsem=" + tblsem + "&tblsubrpt=" + tblsubrpt + "&studID=" + stId + "&YearLevel=" + YearLevel + "&section=" + section, true);
        xhttp.send();
                
            }
        }

// Function to handle the printing of information
function printInformation() {
    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>Printable Schedule</title></head><body>');

    // Include your external stylesheets here if any
   printWindow.document.write('<style>');
		 printWindow.document.write('body { font-family: "Arial", sans-serif; }');
		 printWindow.document.write('printableContent2, printableContent{display:block;} .innovative{font-style:bold}   .student-info {display: flex;justify-content: space-between;margin-bottom: 20px;}   .student-info p {margin: 0;}   school-info {display: flex;text-align: center;margin-bottom: 20px;}    .school-logo {max-width: 100px;max-height: 60px;margin-right: 10px;} .school-name {margin: 0;}#locationP{margin-top: -15px;font-style: italic;}#contact{font-style: italic;margin-top: -15px;}.containerTop{align-items:center;}#registrar{text-align: center;  margin-bottom:50px;} th{background-color:gray;}');
		printWindow.document.write('table { border-collapse: collapse; width: 100%; border: 0.2px solid #000;}');
		printWindow.document.write('th, td { padding: 5px; text-align: left; font-size:12px; }');
		printWindow.document.write('#YearandSem, .report{ margin-top:-10px; }');		
		printWindow.document.write('th { background-color: #f2f2f2; }');
		printWindow.document.write('</style>');
  // Inject the fetched information into the print window
    printWindow.document.write('<div>' + document.getElementById('printableContent').innerHTML + ' </div><div id="schedTbl">' + document.getElementById('schedTbl').innerHTML + '</div><div>' + document.getElementById('printableContent2').innerHTML + ' </div>');

    printWindow.document.write('</body></html>');

    // Adding a setTimeout to ensure content is loaded before printing
    setTimeout(function () {
        printWindow.document.close();
        printWindow.print();
    }, 500);
}
// Event listener for the display button
document.getElementById('printGrades').addEventListener('click', function () {
    // Get the selected value from the dropdown
// Get the selected value from the dropdown
    var selectedValue = document.getElementById('mySelect').value;
		var acadsem = document.getElementById('AcadSem');
		var acadsemText = acadsem.textContent;
		var YrSem = document.getElementById('YearandSem');
		YrSem.textContent = acadsemText;
		
		var yearSecParagraph = document.getElementById('yearSec');
		var yearSecText = yearSecParagraph.textContent;
		var otherParagraph = document.getElementById('YrandSec');
		otherParagraph.textContent = yearSecText;

    // Call the function to handle the AJAX request and display information
    displayInformation1(selectedValue);
});


     document.getElementById('displayResult').addEventListener('click', function () {
    // Get the selected value from the dropdown
    var selectedValue = document.getElementById('mySelect').value;
      if(selectedValue =="0"){
            Swal.fire({
              html: '<div class="containerNotif"><div><img class="checkmark" src="../assets/icon/warning.png" alt="Checkmark Image"></div><div class="textDiv">Please Select Semester/Academic Year!</div></div>',
              position: 'top-end',
              showConfirmButton: false,
              customClass: {
                popup: 'swal-wide',
                icon: 'icon-class'
              }
            });
      }else{
          // Split the selected value into Sem, Year, and StudentID
            var values = selectedValue.split(',');
            var tblsem = values[0];  // Trim to remove extra spaces
            var tblsubrpt = values[1];
            var stId = values[2];
            var YearLevel = values[3].trim();
            var section = values[4].trim();
        
            console.log(values);

            // AJAX request to fetch and display information based on Sem, Year, and StudentID
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Display the information in the target area
                    document.getElementById('displayArea1').innerHTML = this.responseText;
                }
            };
           xhttp.open("GET", "schedule/fetch.php?tblsem=" + tblsem + "&tblsubrpt=" + tblsubrpt + "&studID=" + stId + "&YearLevel=" + YearLevel + "&section=" + section, true);
            xhttp.send();
                
            }
});

    </script>