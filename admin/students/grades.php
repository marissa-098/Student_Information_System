
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="icon" href="./../img/logo_trans.png" type="image/x-icon">

        <title>Grade</title>


        <!----css3---->
      
       <link rel="stylesheet" href="css/homepagecss.css" />
       <link rel="stylesheet" href="../css/custom.css">    
        <!--google fonts -->
    
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    
    <!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">
<style> printableContent2, printableContent{display:block;} .innovative{font-style:bold}   .student-info {display: flex;justify-content: space-between;margin-bottom: 20px;}   .student-info p {margin: 0;}   school-info {display: flex;text-align: center;margin-bottom: 20px;}    .school-logo {max-width: 100px;max-height: 60px;margin-right: 10px;} .school-name {margin: 0;}#locationP{margin-top: -15px;font-style: italic;}#contact{font-style: italic;margin-top: -15px;}.containerTop{align-items:center;}#registrar{text-align: center;} table{width: 100%; border-collapse: collapse; margin-bottom: 20px;} th{background-color:gray;} th, td {border: 1px solid #ddd;text-align: center;} </style>
      <style>


                 #topgreen{
                      margin-bottom: 150px;
                      width: 100%;
                      height: 20px;
                      background-color: green;
                    }
                     #displayResult {
                          background-color: #6AB8E8; /* Background color */
                          color: #fff; /* Text color */
                          padding: 10px 20px; /* Padding around text */
                          font-size: 16px; /* Font size */
                          border: none; /* Remove border */
                          border-radius: 5px; /* Add rounded corners */
                          cursor: pointer; /* Add cursor pointer on hover */
                          transition: background-color 0.3s ease; /* Smooth transition on hover */
                          width: 200px;
                      }

                      #displayResult:hover {
                          background-color:#54CA24; /* Change background color on hover */
                      }
                      #printGrades {
                          background-color:#22B98E; /* Background color */
                          color: #fff; /* Text color */
                          padding: 10px 20px; /* Padding around text */
                          font-size: 16px; /* Font size */
                          border: none; /* Remove border */
                          border-radius: 5px; /* Add rounded corners */
                          cursor: pointer; /* Add cursor pointer on hover */
                          transition: background-color 0.3s ease; /* Smooth transition on hover */
                         width: 200px;
                      }

                      #printGrades:hover {
                          background-color: #54CA24; /* Change background color on hover */
                      }
                      .select-container {
                                position: relative;
                                display: inline-block;
                            }

                            /* Style for the select element on hover */
                            select:hover {
                                border-color: #2980b9; /* Change border color on hover */
                            }

                            /* Style for the select element when focused */
                            select:focus {
                                border-color: #2980b9; /* Change border color on focus */
                            }

                            /* Style for the dropdown icon */
                            .dropdown-icon {
                                position: absolute;
                                top: 50%;
                                right: 10px;
                                transform: translateY(-50%);
                                pointer-events: none;
                            }


                            @media (max-width: 600px) {
                                #printGrades{
                                    margin: auto;
                                    width: 260px;

                                }
                                .select-container, .searchTop{
                                     width: 520px;
                                     margin: auto;
                                }
                                #displayResult{
                                     margin: auto;
                                     width: 260px;
                                }
                                .overlap-3{
                                    margin-bottom: 50px;
                                    margin: auto;
                                }

                            }
                          


  
         .responsive-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .select-wrapper {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .label {
            font-size: 16px;
            margin-bottom: 8px;
        }

        select {
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        .button-container {
            display: flex;
            gap: 8px; /* Adjust the gap between buttons */
        }

        .button {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button-primary {
            background-color: #4caf50;
            color: #fff;
        }

        .button-secondary {
            background-color: #aaa;
            color: #fff;
        }

        @media only screen and (max-width: 480px) {
            select {
                font-size: 14px;
            }
        }
    </style>

  </head>
  <body>
  <div class="body-overlay"></div>  
  <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                             <h2 class="pageheader-title"><span class="material-symbols-outlined">school</span>Student's Grade </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./index.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="./index.php?page=student_list" class="breadcrumb-link">Gradeschool</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"> student grades</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div> 
   


                     <?php 
                     include('db_connect.php');
                     $st_id =$_GET["studentId"];
                           $select_stud = $conn_PDO->prepare (" 
                          SELECT * FROM tblgradeschool 
                          WHERE StudNum = '$st_id'");
                          $select_stud->execute();
                          if($select_stud->rowCount() > 0){
                          while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){

                          
                        ?>
 

                   <div class="student-info">
                              
                                <div>

                                    <p><strong>Name:</strong> <?= $fetch_stud['LName']; ?>, <?= $fetch_stud['FName']; ?> <?= $fetch_stud['MName']; ?> </p>
                                    <p><strong>Student ID:</strong> <?= $fetch_stud['StudNum']; ?></p>
                                </div>
                                <div>
                                    <p><strong>STRAND:</strong><?= $fetch_stud['SHSStrand']; ?></p>
                                    <p><strong>YR. & Sec:</strong> <?= $fetch_stud['GradeLevel']; ?>-<?= $fetch_stud['Sec']; ?></p>
                                </div>
                            </div>
                  
           <!--------main-content------------->
           
           <div  class="main-content">
              <div class="row">

                            <div class="responsive-container">
                            <div class="select-wrapper">
                                <div class="label">Semester/Academic Year:</div>
                                <select id="mySelect">
                                    <option value="0" disabled selected >Semester/Academic Year</option>
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
                                                
                                          
                                                 // Column 1 (tblsem)
                                         
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
                                                                    $checkColumnsStmt->bindParam(':tableName', $tblsem, PDO::PARAM_STR);
                                                                    $checkColumnsStmt->execute();
                                                                    $hasColumnsResult = $checkColumnsStmt->fetchAll(PDO::FETCH_ASSOC);

                                                                    if (!empty($hasColumnsResult)) {
                                                                        // Table has 'Acadyr' and 'Sem' columns
                                                                        // Retrieve distinct values
                                                                        $studentId = $_GET["studentId"];
                                                                        $distinctValuesSql = "SELECT DISTINCT AcadYr, Sem, YrLevel, Sec
                                                                                                 FROM $tblsubrpt 
                                                                                                 WHERE StudNum = :id";  // Use the actual table name

                                                                        $distinctValuesStmt = $conn_PDO->prepare($distinctValuesSql);
                                                                         $distinctValuesStmt->bindParam(':id',$studentId, PDO::PARAM_STR);
                                                                        $distinctValuesStmt->execute();
                                                                        $distinctValues = $distinctValuesStmt->fetchAll(PDO::FETCH_ASSOC);

                                                                       

                                                                        foreach ($distinctValues as $row) {
                                                                              echo '<option value="'.$tblsem.','.$tblsubrpt.','. $studentId.','.$row['YrLevel'] .','. $row['Sec'].'">' . $row['Sem'] ." ". $row['AcadYr'] . '</option>';
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

                            <div class="button-container">
                                <button id="displayResult" class="button button-primary" >View</button>
                                <button id="printGrades" class="button button-secondary" >Print</button>
                            </div>
                        </div>

                            <div class="col-md-12">
                                <div class="table-wrapper">
                                    <div id= "displayArea1"  >
                                      <div class="table-responsive">
                                        <div class='table-title'><b>Year Level,</b> Semester AY: 0000-0000</div>
                                                    
                                            <table  class="table table-bordered table-striped">
                                            <tr>
                                                      <th width ='5%'>ID</th>
                                                      <th width ='7%' >Code</th>
                                                      <th width ='35%'>Subject Description</th>
                                                      <th width ='5%'>Units</th>
                                                      <th width ='3%'>Grade</th>
                                                      <th width ='3%'>Equivalent</th>
                                                      <th width ='3%'>Re-exam</th>
                                                      <th width ='5%'>Credits</th>
                                                      <th width ='10%'>Remarks</th>
                                                      <th width ='15%'>Instructor</th>
                                                    </tr>
                                                    <tr>
                                                      <td colspan="10">Select Academic and Semester then click "view" to show grade!</td>
                                                    </tr>

                                            </table>
                                            </div>
                                         
                                 </div>
                            </div>
                        </div>

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
                                        <p  class=" f-mnt-B f-black f-15 f-b f-k1"> STUDENT GRADE REPPORT <br>
                    
                                            
                                    </div>

                             <div class="student-info">
                              
                                <div>

                                    <p><strong>Name:</strong> <?= $fetch_stud['LName']; ?>, <br> <?= $fetch_stud['FName']; ?> <?= $fetch_stud['MName']; ?> </p>
                                    <p><strong>Student ID:</strong> <?= $fetch_stud['StudNum']; ?></p>
                                </div>
                                <div>
                                    <p><strong>STRAND:</strong><?= $fetch_stud['SHSStrand']; ?></p>
                                    <p><strong>YR. & Sec:</strong> <?= $fetch_stud['GradeLevel']; ?>-<?= $fetch_stud['Sec']; ?></p>
                                </div>
                            </div>
                            <?php }
                                   } 
                                ?>
                        </div>
                    </div>
                             <div style="display:none;" id="printableContent2">

                                            <!-- <div style="justify-content: space-between;"  class="flex student-info">
                                                <div>
                                                <p><strong>Total # of Units: </strong> Computer Science</p>
                                                </div>
                                                <div>
                                                <p><strong>Total Credits:</strong> Computer Science</p>
                                                </div>
                                                <div>
                                                <p><strong>Gen. Weighted Ave.: </strong> Computer Science</p>
                                                </div>
                                            </div> -->

                                            <br><br><br>

                                            <div>
                                                <p>Note: This report of grades is computer generated. Any query on the accuracy of data presented shall be coursed through the corresponding Registrar’s Office. </p>
                                            </div>


                         </div>


<!-- script to display schedule -->

<script>


// Function to handle the AJAX request and display information
function displayInformation1(selectedValue) {
    if (selectedValue == "0") {
        alert("Please Select Semester/Academic Year");
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
        xhttp.open("GET", "students/getGrades.php?tblsem=" + tblsem + "&tblsubrpt=" + tblsubrpt + "&studID=" + stId + "&YearLevel=" + YearLevel + "&section=" + section, true);
        xhttp.send();
                
            }
}

// Function to handle the printing of information
function printInformation() {
    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>Printable Schedule</title></head><body>');

    // Include your external stylesheets here if any
    printWindow.document.write('<style> printableContent2, printableContent{display:block;} .innovative{font-style:bold}   .student-info {display: flex;justify-content: space-between;margin-bottom: 20px;}   .student-info p {margin: 0;}   school-info {display: flex;text-align: center;margin-bottom: 20px;}    .school-logo {max-width: 100px;max-height: 60px;margin-right: 10px;} .school-name {margin: 0;}#locationP{margin-top: -15px;font-style: italic;}#contact{font-style: italic;margin-top: -15px;}.containerTop{align-items:center;}#registrar{text-align: center;} table{width: 100%; border-collapse: collapse; margin-bottom: 20px;} th{background-color:gray;} th, td {border: 1px solid #ddd;text-align: center;} </style>');
  // Inject the fetched information into the print window
    printWindow.document.write('<div>' + document.getElementById('printableContent').innerHTML + ' </div><div id="displayArea1">' + document.getElementById('displayArea1').innerHTML + '</div><div>' + document.getElementById('printableContent2').innerHTML + ' </div>');

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
    var selectedValue = document.getElementById('mySelect').value;

    // Call the function to handle the AJAX request and display information
    displayInformation1(selectedValue);
});


     document.getElementById('displayResult').addEventListener('click', function () {
    // Get the selected value from the dropdown
    var selectedValue = document.getElementById('mySelect').value;


      if(selectedValue =="0"){
        alert("Please Select Semester/Academic Year ");

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
           xhttp.open("GET", "students/getGrades.php?tblsem=" + tblsem + "&tblsubrpt=" + tblsubrpt + "&studID=" + stId + "&YearLevel=" + YearLevel + "&section=" + section, true);
            xhttp.send();
                
            }
  
});

    </script>



<!----------html code compleate----------->


  
  <script type="text/javascript">

</script>
        

  




  </body>
  
  </html>


