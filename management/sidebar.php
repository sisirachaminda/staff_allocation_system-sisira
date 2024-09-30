<?php
include 'db-connect.php';
include 'session_handler.php';
$cddate=date("Y-m-d");

?>

<?php
$selectevaluationperiod = "SELECT * FROM info WHERE name = 'evaluationperiod'";
$resultevaluationperiod = $conn->query($selectevaluationperiod);	
while($rows = $resultevaluationperiod->fetch_assoc()){
        $evaluationperiod_sdate = $rows['sdate'];  
        $evaluationperiod_edate = $rows['edate'];   
}

$selectmarkingend = "SELECT * FROM info WHERE name = 'markingend'";
$resultmarkingend = $conn->query($selectmarkingend);	
while($rows1 = $resultmarkingend->fetch_assoc()){
        $resultmarkingend_sdate = $rows1['sdate'];  
        $resultmarkingend_edate = $rows1['edate'];   
}
?>

<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="sidebarMenuLabel">Dashboard</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="home.php">
                         <i class="fa fa-send"></i>
                        Dashboard
                    </a>
                </li>
				
				<hr/>
				
				<li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="enterinfo.php">
                        <i class="fa fa-send"></i>
                        Shedule Period
                    </a>
                </li>
				
				<li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="reports.php">
                        <i class="fa fa-send"></i>
                        Reports
                    </a>
                </li>
				
				<?php
				if($resultmarkingend_sdate<=$cddate && $resultmarkingend_edate>=$cddate){
				?>
					<hr/>
					<?php
					if($evaluationperiod_edate>=$cddate){
					?>
						<li class="nav-item">
							<a class="nav-link d-flex align-items-center gap-2" href="markingscheam.php">
								 <i class="fa fa-send"></i>
								Marking Scheam
							</a>
						</li>
					<?php
					}
					?>
					
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center gap-2" href="examinerapplication.php">
							 <i class="fa fa-send"></i>
							View Examiner Application
						</a>
					</li>
					<?php
					if($evaluationperiod_edate>=$cddate){
					?>
					
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="additionalcheifdetails.php">
							 <i class="fa fa-send"></i>
							Additional Chief Details
						</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="allocateexaminers.php">
							 <i class="fa fa-send"></i>
							Allocate Examiners
						</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="rejectedexaminers.php">
							 <i class="fa fa-send"></i>
							Rejected Examiners
						</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="appoinmentlettergen.php">
							 <i class="fa fa-send"></i>
						     Appoinment Letters
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="comments.php">
							 <i class="fa fa-send"></i>
						     View Comments
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="panelmessage.php">
							 <i class="fa fa-send"></i>
						     Panel Messages
						</a>
					</li>
					<?php
					}
					?>
				<?php
				}
				?>
				
				<li class="nav-item">
					<a class="nav-link d-flex align-items-center gap-2" href="resetpassword.php">
						 <i class="fa fa-send"></i>
						Reset Password
					</a>
				</li>
				
            </ul>
        </div>
    </div>
</div>