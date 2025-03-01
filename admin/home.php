<style>
.info-box-icon {
    border-radius: .25rem;
    -ms-flex-align: center;
    align-items: center;
    display: -ms-flexbox;
    display: flex;
    font-size: 1.875rem;
    -ms-flex-pack: center;
    justify-content: center;
    text-align: center;
	padding:10px;
}
.bg-lime{
    color: #1f2d3d !important;
}
.elevation-1 {
    box-shadow: 0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24)!important;
}

.clockdate-wrapper {
    background-color: #333;
    padding:25px;
    max-width:350px;
    width:100%;
    text-align:center;
    border-radius:5px;
    margin:0 auto;
  
}
#clock{
    background-color:#333;
    font-family: sans-serif;
    font-size:30px;
    text-shadow:0px 0px 1px #fff;
    color:#fff;
}
#clock span {
    color:#888;
    text-shadow:0px 0px 1px #333;
    font-size:40px;
    position:relative;
    top:-5px;
    left:10px;
}
#date {
    letter-spacing:3px;
    font-size:14px;
    font-family:arial,sans-serif;
    color:#fff;
}


</style>
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
                                                <h4>ADMIN DASHBOARD</h4>
                                                    <div class="card-header-right">
                                                </div>
                                            </div>
                                            <div class="card-block">
												<div class="row">
													<div class="col-xl-4 col-md-6">
														<div class="card">
															<div class="card-block">
																<div class="row align-items-center">
																	<div class="col-8">
																	<?php 
																		$select_stud = $conn_PDO->prepare ("
																			SELECT COUNT(*) AS total_students
																			FROM (
																				SELECT StudNum FROM tblgradeschool
																				UNION
																				SELECT StudNum FROM tblsi
																			) AS combined_table");
																			$select_stud->execute();
																		  if($select_stud->rowCount() > 0){
																		  while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){
																		   ?>
																		<h4 class="text-c-purple"><?php echo $fetch_stud['total_students']; ?></h4>
																		<?php }} ?>
																		
																		<p class="text-muted m-b-0">Total Students</p>
																	</div>
																	<div class="col-4 text-right">
																		<span class="info-box-icon bg-lime elevation-1">
																		<i class="fa fa-users f-28"></i>
																		</span>
																	</div>
																</div>
															</div>
															<div class="card-footer bg-c-green">
																<div class="row align-items-center">
																
																</div>
					
															</div>
														</div>
													</div>
													 <div class="col-xl-4 col-md-6">
														<div class="card">
															<div class="card-block">
																<div class="row align-items-center">
																	<div class="col-8">
																	<?php
																		  $select_stud = $conn_PDO->prepare ("
																		  SELECT COUNT(*) AS total_students
																		  FROM (
																			  SELECT Active, LevelKo,StudNum FROM tblgradeschool
																			 
																		  ) AS combined_table
																		  
																		  WHERE LevelKo ='Elementary' and Active='Yes'
																		  ");
																		  $select_stud->execute();
																		  if($select_stud->rowCount() > 0){
																		  while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){
																			?>
																		<h4 class="text-c-purple"><?php echo $fetch_stud['total_students']; ?></h4>
																		<?php }} ?>
																		<p class="text-muted m-b-0">Elementary</p>
																	</div>
																	<div class="col-4 text-right">
																		<span class="info-box-icon bg-lime elevation-1">
																		<i class="fa fa-th-list f-28"></i>
																		</span>
																	</div>
																</div>
															</div>
															<div class="card-footer bg-c-green">
																<div class="row align-items-center">
																	
																</div>
															</div>
														</div>
													</div>
													<div class="col-xl-4 col-md-6">
														<div class="card">
															<div class="card-block">
																<div class="row align-items-center">
																	<div class="col-8">
																	 <?php 
																		  $select_stud = $conn_PDO->prepare ("
																		  SELECT COUNT(*) AS total_students
																		  FROM (
																			  SELECT Active, LevelKo,StudNum FROM tblgradeschool
																			 
																		  ) AS combined_table
																		  
																		  WHERE LevelKo = 'Junior High School' OR LevelKo = 'Senior High School' and Active='Yes'
																		  ");
																		  $select_stud->execute();
																		  if($select_stud->rowCount() > 0){
																		  while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){
																		?>
																		<h4 class="text-c-purple"><?php echo $fetch_stud['total_students']; ?></h4>
																		<?php }} ?>
																		<p class="text-muted m-b-0">Junior & Senior High School</p>
																	</div>
																	<div class="col-4 text-right">
																		<span class="info-box-icon bg-lime elevation-1">
																		<i class="fa fa-book f-28"></i>
																		</span>
																	</div>
																</div>
															</div>
															<div class="card-footer bg-c-green">
																<div class="row align-items-center">
																	
																</div>
															</div>
														</div>
													</div>
												
													<div class="col-xl-3 col-md-6">
														<div class="card">
															<div class="card-block">
																<div class="row align-items-center">
																	<div class="col-8">
																	<?php 
																		  $select_stud = $conn_PDO->prepare ("
																		  SELECT COUNT(*) AS total_students
																		  FROM (  
																		  SELECT Active FROM tblsi
																		  ) AS combined_table
																		  WHERE Active ='Yes'
																		  ");
																		  $select_stud->execute();
																		  if($select_stud->rowCount() > 0){
																		  while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){
																		?>
																		<h4 class="text-c-blue"><?php echo $fetch_stud['total_students']; ?></h4>
																		<?php }} ?>
																		<h6 class="text-muted m-b-0">College</h6>
																	</div>
																	<div class="col-4 text-right">
																		<span class="info-box-icon bg-lime elevation-1">
																		<i class="fa fa-graduation-cap f-28"></i>
																		</span>
																	</div>
																</div>
															</div>
															<div class="card-footer bg-c-green">
																<div class="row align-items-center">
																	
																</div>
															</div>
														</div>
													</div>

													<div class="col-xl-3 col-md-6">
														<div class="card">
															<div class="card-block">
																<div class="row align-items-center">
																	<div class="col-8">
																	 <?php 
																		  $select_stud = $conn_PDO->prepare ("
																		  SELECT COUNT(*) AS total_request
																		  FROM (
																		  SELECT * FROM reqchange
																		  ) AS subquery");
																		  $select_stud->execute();
																		  if($select_stud->rowCount() > 0){
																		  while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){
																		?>
																		<h4 class="text-c-green"><?php echo $fetch_stud['total_request']; ?></h4>
																		
																		<?php }} ?>
																		<h6 class="text-muted m-b-0">No. of Request</h6>
																	</div>
																	<div class="col-4 text-right">
																		<span class="info-box-icon bg-lime elevation-1">
																		<i class="fa fa-comments f-28"></i>
																		</span>
																	</div>
																</div>
															</div>
															<div class="card-footer bg-c-blue">
																<div class="row align-items-center">
																	
																</div>
															</div>
														</div>
													</div>
													<div class="col-xl-3 col-md-6">
														<div class="card">
															<div class="card-block">
																<div class="row align-items-center">
																	<div class="col-8">
																	<?php 
																		 $select_stud = $conn_PDO->prepare ("
																		  SELECT COUNT(*) AS total_inquiry
																		  FROM (
																		  SELECT * FROM inquiry2324
																		  ) AS subquery");
																		  $select_stud->execute();
																		  if($select_stud->rowCount() > 0){
																		  while($fetch_stud = $select_stud->fetch(PDO::FETCH_ASSOC)){
																		?>
																		<h4 class="text-c-green"><?php echo $fetch_stud['total_inquiry']; ?></h4>
																		<?php }} ?>
																		<h6 class="text-muted m-b-0">No. of Inquiries</h6>
																	</div>
																	<div class="col-4 text-right">
																		<span class="info-box-icon bg-lime elevation-1">
																		<i class="ti-receipt f-28"></i>
																		</span>
																	</div>
																</div>
															</div>
															<div class="card-footer bg-c-blue">
																<div class="row align-items-center">
																	
																</div>
															</div>
														</div>
													</div>
													<div class="col-xl-3 col-md-6">
														<div class="card">
															<div class="">
																<div id="clockdate">
																  <div class="clockdate-wrapper">
																	<div id="clock"></div>
																	<div id="date"></div>
																  </div>
																</div>
															
															</div>
															
														</div>
													</div>
												</div>
                                             </div> 


                                        </div>
                                        <!-- Hover table card end -->
                                        </div>
                                    </div>
                                            <!-- task, page, download counter  end -->
    
                                         
                                                        
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
                                            
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
            <div id="styleSelector"> </div>
        </div>
    </div>

<script type="text/javascript">
function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
    
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var curWeekDay = days[today.getDay()];
    var curDay = today.getDate();
    var curMonth = months[today.getMonth()];
    var curYear = today.getFullYear();
    var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
    document.getElementById("date").innerHTML = date;
    
    var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
</script>