 
 <?php 
if(!$_SESSION['id'])
{ 
    header("location:../login.php");
}
else
{
    $st_id = $_SESSION['id'];
}

?>
<!-- Page-header start -->
 <div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h3 class="m-b-8"><i class="ti-receipt"></i></i> REQUEST & INQUIRIES</h3>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="./index.php?page=home"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Request & Inquiries</a>
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
                 <!-- Bootstrap tab card start -->
                    <div class="card">
                        <div class="card-block">
                            <!-- Row start -->
                            <div class="row">
                                 <div class="col-sm-12">
                                            <!-- Material tab card start -->
                                                    <!-- Row start -->
                                                    <div class="row m-b-30">
                                                        <div class="col-lg-12 col-xl-12">
                                                            <!-- Nav tabs -->
                                                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">INQUIRIES</a>
                                                                    <div class="slide"></div>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">REQUESTS</a>
                                                                    <div class="slide"></div>
                                                                </li>
                                                            </ul>
                                                            <!-- Tab panes -->
                                                            <div class="tab-content card-block">
                                                                <div class="tab-pane active" id="home3" role="tabpanel">
                                                                    <div class="table-responsive">
                                                                     <table  class="table table-bordered table-striped">
                                                                        <tr>
                                                                              <th width ='5%'>PN</th>
                                                                              <th width ='20%' >Type</th>
                                                                              <th width ='35%'>Message</th>
                                                                              <th width ='15%'>Date</th>
                                                                              <th width ='10%'>Status</th>
                                                                              <th width ='15%'>Action</th>
                                                                            </tr>
                                                                             <?php 
                                                                                  $select_stud = $conn_PDO->prepare (" 
                                                                                  SELECT * FROM inquiry2324
                                                                                  WHERE Id = '$st_id' ORDER by date DESC");
                                                                                  $select_stud->execute();
                                                                                  if($select_stud->rowCount() > 0){
                                                                                  while($fetch_inquiry = $select_stud->fetch(PDO::FETCH_ASSOC)){
                                                                                     $date = new DateTime($fetch_inquiry['date']);
                                                                              ?>
                                                                                <tr>
                                                                                  <td> <?= $fetch_inquiry['PN']; ?> </td>
                                                                                    <td> <?= $fetch_inquiry['inquiryType']; ?> </td>
                                                                                    <td> <?= $fetch_inquiry['message']; ?> </td>
                                                                                    <td class="inquiry-date"><?= $date->format('F d, Y g:ia'); ?></td>
                                                                                    <td ><?php 
                                                                                    if($fetch_inquiry['status'] ==="Pending"){
                                                                                       echo '<span class="badge  form-txt-warning">Pending</span>';
                                                                                     } else if($fetch_inquiry['status'] ==="read"){
                                                                                       echo '<span class="badge  form-txt-success">Receive</span>';
                                                                                    }
                                                                                    ?> 
                                                                                    </td>
                                                                                  <td> 
                                                                                    <?php 
                                                                                    if($fetch_inquiry['status'] ==="Pending"){
                                                                                       echo ' <a  href="#"class="badge bg-warning form-txt-info">No reply</a>';
                                                                                     } else if($fetch_inquiry['status'] ==="read"){
                                                                                      echo '<a href="./index.php?page=request/inquiryView&PN=' . $fetch_inquiry['PN'] . '" class="badge bg-success text-white">view reply</a>';
                                                                                    }
                                                                                    ?> 
                                                                                  </td>
                                                                                </tr>
                                                                            <?php }} ?>
                                                                    </table>
                                                                </div>
                                                                </div>
                                                                <div class="tab-pane" id="profile3" role="tabpanel">
                                                                    <div class="table-responsive">
                                                                         <table  class="table table-bordered table-striped">
                                                                            <tr>
                                                                                  <th>PN</th>
                                                                                  <th>Date</th>
                                                                                  <th>Status</th>
                                                                                  <th>Action</th>
                                                                                </tr>
                                                                                 <?php 
                                                                                     $select_stud = $conn_PDO->prepare (" 
                                                                                      SELECT * FROM reqchange
                                                                                      WHERE StudNum = '$st_id' ORDER by date DESC");
                                                                                      $select_stud->execute();
                                                                                      if($select_stud->rowCount() > 0){
                                                                                      while($fetch_inquiry = $select_stud->fetch(PDO::FETCH_ASSOC)){
                                                                                         $date = new DateTime($fetch_inquiry['date']);
                                                                                  ?>
                                                                                    <tr>
                                                                                        <td> <?= $fetch_inquiry['PN']; ?> </td>
                                                                                        <td><?= $date->format('F d, Y g:ia'); ?></td>
                                                                                        <td class="inquiry-date"><?php 
                                                                                        if($fetch_inquiry['status'] ==="Pending"){
                                                                                           echo '<span class="badge  form-txt-warning">Pending</span>';
                                                                                         } else if($fetch_inquiry['status'] ==="read"){
                                                                                           echo '<span class="badge  form-txt-success">Receive</span>';
                                                                                        }
                                                                                        ?> 
                                                                                        </td>
                                                                                      <td >
                                                                                      <?php 
                                                                                        if($fetch_inquiry['status'] ==="Pending"){
                                                                                           echo ' <a  href="#"class="badge bg-warning text-white">No reply</a>';
                                                                                         } else if($fetch_inquiry['status'] ==="read"){
                                                                                          echo '<a href="./index.php?page=request/view&PN=' . $fetch_inquiry['PN'] . '" class="badge bg-info text-white">view reply</a>';
                                                                                        }
                                                                                        ?> 
                                                                                      </td>
                                                                                    </tr>
                                                                                <?php }} ?>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Row end -->
                                            <!-- Material tab card end -->
                                        </div>
                            </div>
                            <!-- Row end -->
                        </div>
                    </div>
                 <!-- Bootstrap tab card end -->
            </div>
            <!-- Page-body end -->
        </div>
    </div>
</div>
 <footer class="form-bg-inverse ">
    <div class="p-t-10 p-b-10 text-center">
        <strong>Online Student Information System</strong>
        <br>
        <p>Develop by Marissa Manrique &#169; 2023 </p>
        
    </div>
  </footer>

<style type="text/css">
</style>

<script>
 </script>