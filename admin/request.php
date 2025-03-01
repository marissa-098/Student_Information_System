

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
                                        <li class="breadcrumb-item active" aria-current="page"> Request</li>
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
                                <h5 class="card-header">Request Information</h5>
                                <div class="card-body">
                                    <div id="message"></div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Process No.</th>
                                                    <th scope="col">Student ID</th>
                                                    <th scope="col">Student Name</th>
                                                     <th scope="col">Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php 


                                                             $select_stud = $conn_PDO->prepare (" 
                                                              SELECT * FROM reqchange");
                                                              $select_stud->execute();
                                                              if($select_stud->rowCount() > 0){
                                                              while($row = $select_stud->fetch(PDO::FETCH_ASSOC)){
                                                                 $fromDateTime = new DateTime($row['date']);

                                                ?>
                                                <tr>
                                                    <td><?= $row['PN']; ?></td>
                                                    <td><?= $row['StudNum']; ?></td>
                                                     <td><?= $row['Lname']; ?>, <?= $row['Fname']; ?> <?= $row['Mname']; ?></td>
                                                    <td><?= $fromDateTime->format('F d, Y g:ia'); ?></td>
                                                    <td>
                                                     <?php 
                                                       if($row['status'] ==="Pending"){
                                                           echo '<span class="badge bg-info text-white">Pending</span>';
                                                         
                                                         }else if($row['status'] ==="read"){
                                                           echo '<span class="badge bg-success text-white">Receive</span>';
                                                        }
                                                     ?> 
                                                    </td>
                                                    <td class="align-right">
                                                         <a href="./index.php?page=Request/view&PN=<?= $row['PN']; ?>&student-number=<?php echo $row['StudNum']; ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View Request">
                                                          <i class="fa fa-eye"></i>
                                                        </a> |
                                                        <a href="./index.php?page=Request/update&PN=<?= $row['PN']; ?>&student-number=<?php echo $row['StudNum']; ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Request">
                                                            <i class="fa fa-edit"></i>
                                                        </a> 
                                                    </td>
                                                </tr>
                                             <?php } }?>
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

  


