<?php
include 'db-connect.php';
include 'session_handler.php';
$cddate=date("Y-m-d");

?>

<?php
$selectmarkingperiod = "SELECT * FROM info WHERE name = 'markingperiod'";
$resultmarkingperiod = $conn->query($selectmarkingperiod);	
while($rows = $resultmarkingperiod->fetch_assoc()){
        $markingperiod_sdate = $rows['sdate'];  
        $markingperiod_edate = $rows['edate'];   
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
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="attendance.php">
                        <i class="fa fa-send"></i>
                        Enter Attendance
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="assignpapers.php">
                        <i class="fa fa-send"></i>
                        Assign Papers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="markingprogress.php">
                        <i class="fa fa-send"></i>
                        Marking Progress
                    </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="appoinmentletters.php">
                        <i class="fa fa-send"></i>
                        Appoinment Letters
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="comments.php">
                        <i class="fa fa-send"></i>
                        Comments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="reports.php">
                        <i class="fa fa-send"></i>
                        Reports
                    </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="notification.php">
                        <i class="fa fa-send"></i>
                        Notification
                    </a>
                </li>
            </ul>   
        </div>
    </div>
</div>