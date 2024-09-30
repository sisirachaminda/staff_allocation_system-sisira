<?php
include 'db-connect.php';
include 'session_handler.php';
$cddate=date("Y-m-d");
?>

<?php
$selectappcall = "SELECT * FROM info WHERE name = 'appCall'";
$resultappcall = $conn->query($selectappcall);	
while($rows = $resultappcall->fetch_assoc()){
        $appcall_sdate = $rows['sdate'];  
        $appcall_edate = $rows['edate'];   
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
                        <svg class="bi"><use xlink:href="#house-fill"/></svg>
                        Dashboard
                    </a>
                </li>
				<?php
				if($resultmarkingend_sdate<=$cddate && $resultmarkingend_edate>=$cddate){
				?>
						<?php
						if($appcall_sdate<=$cddate && $appcall_edate>=$cddate){
						?>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="registration1.php">
									<svg class="bi"><use xlink:href="#file-earmark"/></svg>
									Registration
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="registration1.php">
									<svg class="bi"><use xlink:href="#file-earmark"/></svg>
									Edit Application
								</a>
							</li>
						<?php
						}
						else{
							$select1 = "SELECT * FROM basicdetails WHERE examiner_id='$ses_ukey' AND year1='$cdyear' AND appStatus='Complete'";
							$result1 = $conn->query($select1);
							if ($result1->num_rows > 0) {
						?>
								<li class="nav-item">
									<a class="nav-link d-flex align-items-center gap-2" href="viewapp1.php">
										<svg class="bi"><use xlink:href="#file-earmark"/></svg>
										View Application
									</a>
								</li>
						
						<?php
							}
						?>
						<?php				
						}
						?>
						<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="notification.php">
									<svg class="bi"><use xlink:href="#file-earmark"/></svg>
									Notification
								</a>
						</li>
				<?php
				}
				?>
                
            </ul>
        </div>
    </div>
</div>