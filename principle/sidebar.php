<?php
include 'db-connect.php';
include 'session_handler.php';
$cddate=date("Y-m-d");

?>

<?php
$selectprincipleapprove = "SELECT * FROM info WHERE name = 'principleapprove'";
$resultprincipleapprove = $conn->query($selectprincipleapprove);	
while($rows = $resultprincipleapprove->fetch_assoc()){
        $principleapprove_sdate = $rows['sdate'];  
        $principleapprove_edate = $rows['edate'];   
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
                        <i class="fa fa-home"></i>
                        Dashboard
                    </a>
                </li>
				<?php
				if($resultmarkingend_sdate<=$cddate && $resultmarkingend_edate>=$cddate){
				?>
					<?php
					if($principleapprove_sdate<=$cddate && $principleapprove_edate>=$cddate){
					?>
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center gap-2" href="reqapprove.php">
							<i class="fa fa-send"></i>
							Approve Requests
						</a>
					</li>
					<?php
					}
					?>
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center gap-2" href="examinerlist.php">
							<i class="fa fa-send"></i>
							Examiner List
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center gap-2" href="rejectedlist.php">
							<i class="fa fa-send"></i>
							Rejected List
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center gap-2" href="appoinmentletters.php">
							<i class="fa fa-send"></i>
							Appoinment Letters
						</a>
					</li>
					
				<?php
				}
				?>
				
            </ul>
        </div>
    </div>
</div>