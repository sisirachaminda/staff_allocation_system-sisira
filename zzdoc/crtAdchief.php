<?php
session_start();

$date = date("Y-m-d H:i:s");
$user = "Operator";

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Application for Marking</title>

    <style>
        .buttons-excel {
            background-color:green !important;
            border-color:#fff !important;
        }
        .buttons-copy {
            background-color:#0d6efd !important;
            border-color:#fff !important;
        }
    </style>
    <script>
        $(document).ready(function(){
            $("#spinner").hide();
            $("#runpro").click(function(){
                $("#spinner").show();
            });
        });
    </script>
    <?php
    include 'cdn.html';
        include_once '../../DB/db-connect.php';

        // Run create mark process
        $error="";
        if(isset($_POST['runProcess'])) {

            $selectCenter = "SELECT townNo, panelNo, isAstChief FROM markingCenters";
            $resultCenter = $conn->query($selectCenter);
            if ($resultCenter->num_rows > 0) {
                while($row = $resultCenter->fetch_assoc()) {
                    $townNo = $row['townNo'];
                    $panelNo = $row['panelNo'];
                    $isAstChief = $row['isAstChief'];

                    if($isAstChief == '0') {
                        $selectAC = "SELECT * FROM `examinerMark`, `apqualifications` WHERE examinerMark.nic=apqualifications.nic AND examinerMark.`fTownNo`='$townNo' AND examinerMark.`appointedAs` = 'notset' AND apqualifications.accept_adex='1' ORDER BY apqualifications.yearAdCheief DESC, examinerMark.mark DESC LIMIT 1";
                        $resultAC = $conn->query($selectAC);
                        while($row = $resultAC->fetch_assoc()) {
                            $nic = $row['nic'];
                            $mark =  $row['mark'];
                            
                            // Update ad. chief record in mark table
                            $updateMark = "UPDATE examinerMark SET appointedAs='adchief' WHERE nic = '$nic'"; 
                            if ($conn->query($updateMark) === TRUE) {} else{ echo "<br><br>Update Error: " . $updateMark . "<br>" . $conn->error;}

                            // Update ad. chief record in center table
                            $updateCenter = "UPDATE markingCenters SET isAstChief='1' WHERE panelNo = '$panelNo'"; 
                            if ($conn->query($updateCenter) === TRUE) {} else{ echo "<br><br>Update Error: " . $updateCenter . "<br>" . $conn->error;}
                            
                            // insert ad chief details to Allocation table 
                            $insertAllocation = "INSERT INTO allocation (nic, panelNo, appointedAs, method) VALUES ('$nic', '$panelNo', 'AdChief', 'System')";
                            if ($conn->query($insertAllocation) === TRUE) {} else{ echo "Insert Error: " . $insertAllocation . "<br>" . $conn->error;}
                        }
                        // echo $x." --- ".$nic." --- ".$mark." --- ".$panelNo." --- ".$townNo."<br>";                      
                    }
                } 
                echo "<script>alert('Allocation Completed.');</script>";
            } else {
                echo "<script>alert('No marking centers ');</script>";
            }            
        }
        
        // Clear Data
        if(isset($_POST['clrdata'])) {
            $clrCenter = "UPDATE `markingCenters` SET isAstChief='0'";
            if ($conn->query($clrCenter) === TRUE) {} else{ echo "<br><br>Update Error: " . $clrCenter . "<br>" . $conn->error;}

            $clrMark = "UPDATE `examinerMark` SET `appointedAs`='notset' WHERE appointedAs='AdChief'";
            if ($conn->query($clrMark) === TRUE) {} else{ echo "<br><br>Update Error: " . $clrMark . "<br>" . $conn->error;}

            $clrAllocation = "DELETE FROM `allocation` WHERE `appointedAs`='AdChief'";
            if ($conn->query($clrAllocation) === TRUE) {
                echo "<script>alert('Data Clean Completed.');</script>";
            } else{ echo "<br><br>Update Error: " . $clrAllocation . "<br>" . $conn->error;}
        }
        
    ?>
  </head>
  <body>
  <?php include ('header.html'); ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col col-2">
          <?php include ('sidebar.php'); ?>
        </div>
        <div class="col col-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12 col-lg-12">
                            <h2>Create Allocation (Additional Cheif)</h2>
                      </div>
                    </div>
                    <hr style="border-color: black;">
                    <form method="post" enctype="multipart/form-data">
                        <div class='row mt-4'>
                            <?php 
                                $checkData = "SELECT appointedAs FROM allocation WHERE appointedAs='AdChief'";
                                $resultData = $conn->query($checkData);
                                if ($resultData->num_rows > 0) {
                                    echo "
                                        <div class='col col-sm-12 col-lg-2'>
                                            <input type='submit' name='clrdata' value='Clear Data' class='btn btn-danger'>
                                        </div>
                                        ";
                                } else {
                                    echo "
                                        <div class='col col-sm-12 col-lg-2'>
                                            <input type='submit' name='runProcess' value='Run Process' class='btn btn-success' id='runpro'>
                                        </div>
                                        ";
                                }
                            ?>
                            <div class='col col-sm-12 col-lg-4' id="spinner">
                                <button class="btn btn-primary" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Processing...
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="details mt-4">
                        <h4>Allocated Additional Chief Details<hr></h4>
                    </div>
                    <div class="row mt-2">
                        <div class="table-responsive">
                            <table id="example" class="display table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Panel No</th>
                                        <th>Cent No</th>
                                        <th>Town</th>
                                        <th>Subject Name</th>
                                        <th>Subject Code</th>
                                        <th>Medium</th>
                                        <th>Ad.Chief Name</th>
                                        <th>NIC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "select * FROM markingCenters, allocation, town, basicdetails, subjects WHERE markingCenters.panelNo=allocation.panelNo AND markingCenters.townNo=town.town_id AND allocation.nic=basicdetails.nic AND allocation.appointedAs='AdChief' AND markingCenters.subNo=subjects.subject_id";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                        $med = $row['medium'];
                                        if($med == '2') {
                                            $medium = 'Sinhala';
                                        }else if($med == '3') {
                                            $medium = 'Tamil';
                                        }else if($med == '4') {
                                            $medium = 'English';
                                        }
                                   echo "
                                    <tr>
                                        <td>".$row['panelNo']."</td>
                                        <td>".$row['centNo']."</td>
                                        <td>".$row['town_name']."</td>
                                        <td>".$row['subject_name']."</td>
                                        <td>".$row['subject_id']."</td>
                                        <td>".$medium."</td>
                                        <td>".$row['initialName']."</td>
                                        <td>".$row['nic']."</td>
                                    </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <script >
        $(document).ready(function() {
            var table = $('#example').DataTable( {
                lengthChange: false,
                buttons: [ 'copy', 'excel' ]
            });
        
            table.buttons().container()
                .appendTo( '#example_wrapper .col-md-6:eq(0)' );
        });
    </script>
  </body>
</html>