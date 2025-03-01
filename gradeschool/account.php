 
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
                    <h3 class="m-b-8"><i class="ti-user"></i></i> ACCOUNT</h3>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="./index.php?page=home"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Account</a>
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
                                     <table  class="table table-bordered table-striped">
                                        <tr>
                                              <th width ='7%' >Code</th>
                                              <th width ='12%'>Academic Year</th>
                                              <th width ='25%'>Semester</th>
                                              <th width ='5%'>Accounts</th>
                                              <th width ='15%'>Amount Paid</th>
                                              <th width ='5%'>Balance</th>
                                              <th width ='5%'>Status</th>
                                            </tr>
                                             <?php 
                                                  $select_acc = $conn_PDO->prepare (" 
                                                  SELECT * FROM `tblgradesiacct` WHERE `Studnum`='$st_id' ORDER BY AcadYr Desc LIMIT 1");
                                                  $select_acc->execute();
                                                  if($select_acc->rowCount() > 0){
                                                  while($fetch_acc = $select_acc->fetch(PDO::FETCH_ASSOC)){
                                              ?>
                                                <tr>
                                                  <td><?= $fetch_acc['Code']; ?></td>
                                                  <td><?= $fetch_acc["AcadYr"]?></td>
                                                  <td><?= $fetch_acc["Sem"]?></td>
                                                  <td>&#8369; <?= number_format($fetch_acc["Account"], 2) ?></td>
                                                  <td>&#8369; <?= number_format($fetch_acc["AmountPaid"], 2)?></td>
                                                  <td>&#8369; <?= number_format($fetch_acc["Balance"], 2)?></td>
                                                  <td>
                                                    <div class=" <?= $fetch_acc["Status"] === 'PAID' ? 'form-txt-success' : 'form-txt-danger' ?>"> <?= $fetch_acc["Status"] ?>
                                                    </div>
                                                  </td>
                                                </tr>
                                    </table>
                                </div>
                                </div>
                            </div>
                       </div>
                    <!-- Hover table card end -->
					
					<div class="card">
                                    <div class="card-header">
                                        <h3>Account Details</h3>
                                         <?php
                                            $select_stud = $conn_PDO->prepare (" 
                                            SELECT * FROM tblgradeschool 
                                            WHERE StudNum = '$st_id'");
                                            $select_stud->execute();
                                            if($select_stud->rowCount() > 0){
                                            while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                        <h5><strong>Name:</strong>
                                            <?= $fetch_stud['LName']; ?>,
                                            <?= $fetch_stud['FName']; ?> 
                                            <?= $fetch_stud['MName']; ?></h5><br>
                                        <h5><strong>Student ID:</strong>
                                            [<?= $fetch_stud['StudNum']; ?>]</h5>
                                    </div>
                                    <div class="row p-10">
                                        <div class="col-xl-4 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-5">
                                                                <h6 class="text-muted m-b-0">Miscellaneous Fee</h6>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                 <h4 class="text-c-purple">&#8369; <?= number_format($fetch_acc['MiscFee'], 2); ?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block  bg-c-custom-green">
                                                        <div class="row align-items-center">
                                                            <div class="col-5">
                                                                <h6 class="text-muted m-b-0">Tuition Fee</h6>
                                                            </div>
                                                             <div class="col-6 text-right">
                                                                <h4 class="text-c-purple">&#8369; <?= number_format($fetch_acc['TuitionFee'], 2); ?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-5">
                                                                <h6 class="text-muted m-b-0">Laboratory Fee</h6>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <h4 class="text-c-purple">&#8369; <?= number_format($fetch_acc['BooksFee'], 2); ?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-purple">
                                                    </div>
                                                </div>
                                        </div> 
                                        <div class="col-xl-4 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-5">
                                                                <h6 class="text-muted m-b-0">Practicum Fee</h6>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                               <h4 class="text-c-purple">&#8369; <?= number_format($fetch_acc['NSTP'], 2); ?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block  bg-c-custom-green">
                                                        <div class="row align-items-center">
                                                            <div class="col-5">
                                                                <h6 class="text-muted m-b-0">NSTP Fee</h6>
                                                            </div>
                                                             <div class="col-6 text-right">
                                                               <h4 class="text-c-purple">&#8369; <?= number_format($fetch_acc['Other'], 2); ?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-5">
                                                                <h6 class="text-muted m-b-0">Others</h6>
                                                            </div>
                                                             <div class="col-6 text-right">
                                                               <h4 class="text-c-purple">&#8369; <?= number_format($fetch_acc['SpecialClass'], 2); ?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-purple">
                                                    </div>
                                                </div>
                                        </div> 
                                        <div class="col-xl-4 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-5">
                                                                <h6 class="text-muted m-b-0">Less Discounts</h6>
                                                            </div>
                                                             <div class="col-6 text-right">
                                                               <h4 class="text-c-purple">&#8369; <?= number_format($fetch_acc['AmtDiscount'], 2); ?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block  bg-c-custom-green">
                                                        <div class="row align-items-center">
                                                            <div class="col-5">
                                                                <h6 class="text-muted m-b-0">Amount Due:</h6>
                                                            </div>
                                                             <div class="col-6 text-right">
                                                               <h4 class="text-c-purple">&#8369; <?= number_format($fetch_acc['Account'], 2); ?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-purple">
                                                    </div>
                                                </div>
                                        </div> 
                                       
                                    </div>
                                            
                                        <?php }} ?>
                                    </div>
                    </div>
                    <?php }} ?>
            </div>
            <!-- Page-body end -->
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