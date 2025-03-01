 <!-- Page-header start -->
 <div class="page-header">
                          <div class="page-block">
                              <div class="row align-items-center">
                                  <div class="col-md-8">
                                      <div class="page-header-title">
                                          <h5 class="m-b-10">Activity Logs</h5>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <ul class="breadcrumb-title">
                                          <li class="breadcrumb-item">
                                              <a href="index.html"> <i class="fa fa-home"></i> </a>
                                          </li>
                                          <li class="breadcrumb-item"><a href="#!">Activity Logs</a>
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
                                         <div class="card">
                                            <div class="card-header">
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div id= "displayArea1">
                                                <div class="table-responsive">
                                                   <table  id="myTable" class="table table-bordered table-striped"><thead></thead>
													<tbody>
                                                        <tr>
                                                             <th width ='5%'>Date & Time</th>
                                                             <th width ='20%'>Type of Device</th>
                                                             <th width ='20%'>Browsers</th>
                                                             <th width ='45%'>Location</th>
                                                        </tr>
                                                        <?php 
                                                             $select_logs = $conn_PDO->prepare (" 
                                                              SELECT * FROM logs
                                                              WHERE Id = '$st_id'
                                                              ORDER By last_login_activity DESC limit 10");
                                                              $select_logs->execute();
                                                              if($select_logs->rowCount() > 0){
                                                              while($fetch_logs = $select_logs->fetch(PDO::FETCH_ASSOC)){
                                                                $Date = new DateTime($fetch_logs['last_login_activity']);
                                                                $userAgentFromDatabase = $fetch_logs['Device'];
                                                        ?>
                                                        <tr>
                                                          <td><?= $Date->format('F d, Y g:ia'); ?></td>
                                                              <td>
                                                                    <?php
                                                                    if (strpos($userAgentFromDatabase, 'Mobile') !== false ) {
                                                                         echo "Mobile";

                                                                    } else if(strpos($userAgentFromDatabase, 'Android') !== false ){
                                                                        echo "Android";

                                                                    } else if(strpos($userAgentFromDatabase, 'iPhone') !== false ) {
                                                                        echo "iPhone";

                                                                    } else if(strpos($userAgentFromDatabase, 'iPad') !== false) {
                                                                        echo "iPad";
                                                                    } else {
                                                                        // Laptop or PC
                                                                        echo "Laptop or PC";
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                   if (strpos($userAgentFromDatabase, 'MSIE') !== false || strpos($userAgentFromDatabase, 'Trident') !== false) {
                                                                        echo "Internet Explorer";
                                                                    } elseif (strpos($userAgentFromDatabase, 'Firefox') !== false) {
                                                                        echo "Mozilla Firefox";
                                                                    } elseif (strpos($userAgentFromDatabase, 'Chrome') !== false) {
                                                                        echo "Google Chrome";
                                                                    } elseif (strpos($userAgentFromDatabase, 'Safari') !== false) {
                                                                        echo "Apple Safari";
                                                                    } elseif (strpos($userAgentFromDatabase, 'Opera') !== false || strpos($userAgentFromDatabase, 'OPR') !== false) {
                                                                        echo "Opera";
                                                                    } else {
                                                                        echo "Unknown browser";
                                                                    }
                                                                    ?>
                                                                </td>
                                                              <td><?= $fetch_logs['Location']; ?></td>
                                                        </tr>
                                                         <?php }} ?>
														<tbody>
                                                    </table>
                                                    
                                                </div>
                                                </div>
                                            </div>
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

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
  $('#myTable').dataTable();
});

</script>