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
        .select {
            background-color: #9eeaf9;
            padding: 10px 10px 0px 10px;
        }
        .reject {
            background-color: #f1aeb5;
            padding: 10px 10px 0px 10px;
        }
    </style>
    <script>
      $(document).ready(function(){

      });
    </script>
    <?php
    include 'cdn.html';
        include_once '../../DB/db-connect.php';

        // Run create mark process
        $error="";
        if(isset($_POST['runProcess'])) {
            $sql = "SELECT * FROM basicdetails, apqualifications, declaration, servicedetails WHERE basicdetails.nic=apqualifications.nic AND basicdetails.nic=declaration.nic AND basicdetails.nic=servicedetails.nic AND sit_exam='2'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $subject = $row["subject"];
                    $medium = $row["medium"];
                    $firstTown = $row["firstTown"];
                    $secondTown = $row["secondTown"];
                    $inirialName = $row["inirialName"];
                    $nic = $row["nic"];
                    $degree_type = $row["degree_type"];
                    $degree_follow = $row["degree_follow"];
                    $Grade_degree = $row["Grade_degree"];
                    $diplom_follow = $row["diplom_follow"];
                    $courseType = $row["courseType"];
                    $courseFollow = $row["courseFollow1"];
                    $pdegree_follow = $row["pdegree_follow"];
                    $sp_activity = $row["sp_activity"];
                    $serviceAsGraduate = $row["serviceAsGraduate"];
                    $Grade12 = $row["Grade12"];
                    $Grade13 = $row["Grade13"];
                    $student_pass = $row["student_pass"];
                    $student_sat = $row["student_sat"];
                    $ass_experince = $row["ass_experince"];
                    $yearAdCheief = $row["yearAdCheief"];
                    $accept_adex = $row["accept_adex"];

                    //1.1.1 / 1.1.2 check
                    if($degree_follow!="NULL") {
                        if($degree_type=="1") {
                            $mark1 = 20;
                        } else if($degree_type=="2") {
                            $mark1 = 15;
                        } else {
                            $mark1 = 0;
                        }
                        if($Grade_degree=="1") {
                            $mark2 = 5;
                        } else if($Grade_degree=="2"){
                            $mark2 = 3;
                        } else {
                            $mark2 = 0;
                        }
                    }

                    //1.1.3 check
                    if($diplom_follow!="NULL") {
                        if($pdegree_follow=="NULL") {
                            $mark3 = 5;
                        } else {
                            $mark3 = 0;
                        }
                    } else {
                        $mark3 = 0;
                    }

                    //1.1.4 check
                    if($degree_follow=="NULL") {
                        if($courseType=="1") {
                            $mark4=15;
                        } else if($courseType=="2") {
                            $mark4=10;
                        } else {
                            $mark4=0;
                        }
                    } else {
                        $mark4=0;
                    }

                    // 1.1.5. check
                    if($pdegree_follow!="NULL") {
                        $mark5 = 15;
                    } else {
                        $mark5 = 0;
                    }
                    
                    //1.2 check
                    if($sp_activity!="Null") {
                        $mark6 = 10;
                    } else {
                        $mark6 = 0;
                    }

                    // 2.1 check
                    if($serviceAsGraduate <= 25) {
                        $mark7 = $serviceAsGraduate;
                    } else {
                        $mark7 = 25;
                    }
                    

                    // 3.1 check
                    $subCount = $Grade12 + $Grade13;
                    if($subCount >= 1 && $subCount <= 10) {
                        $mark8 = 5;
                    } else if($subCount >= 11 && $subCount <= 20) {
                        $mark8 = 10;
                    } else if($subCount >= 21) {
                        $mark8 = 15;
                    } else {
                        $mark8 = 0;
                    }

                    // 4.1 check
                    $passPercentage = ($student_pass / $student_sat) * 100;
                    if($passPercentage >= 25 && $passPercentage <= 49) {
                        $mark9 = 5;
                    } else if($passPercentage >= 50 && $passPercentage <= 74) {
                        $mark9 = 8;
                    } else if($passPercentage >= 75) {
                        $mark9 = 10;
                    } else {
                        $mark9 = 0;
                    }

                    $finalMark = $mark1 + $mark2 + $mark3 + $mark4 + $mark5 + $mark6 + $mark7 + $mark8 + $mark9;
                    $descript = " A ".$mark1." B ".$mark2." C ".$mark3." D ".$mark4." E ".$mark5." F ".$mark6." G ".$mark7." H ".$mark8." I ".$mark9;

                    // Update data to examinerMark table
                    $sql = "INSERT INTO examinerMark (nic, mark, fTownNo, sTownNo, descript) VALUES('$nic', '$finalMark', '$firstTown', '$secondTown', '$descript')";
                    if ($conn->query($sql) === TRUE) {
                        // echo "<script>alert('Inserted');</script>";
                    } else {
                        $error = "->> Error inserting record: " . $conn->error."<br>";
                        echo $error;
                        $_SESSION['error'] = $error;
                        echo "<script>window.location('error.php');</script>";
                    }
                    $finalMark=0;
                }
            } else {
                echo "<script>alert('No Record');</script>";
            }
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
                            <h2>Create Marks for Markers</h2>
                      </div>
                    </div>
                    <hr style="border-color: black;">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row mt-4" >
                            <div class="col col-sm-12 col-lg-4">
                                <input type="submit" name="runProcess" value="Run Process" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                    <div class="select mt-4">
                        <h4>Selected Marker's Details<hr></h4>
                    </div>
                    <div class="row mt-2">
                        <div class="table-responsive">
                            <table id="selected" class="display table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>NIC</th>
                                        <th>Subject Code</th>
                                        <th>Medium</th>
                                        <th>1st Choice</th>
                                        <th>2nd Choice</th>
                                        <th>Mark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM examinerMark, basicdetails WHERE examinerMark.nic=basicdetails.nic ORDER BY mark DESC";
                                    $result = $conn->query($sql);
                                    $x=1;
                                    while($row = $result->fetch_assoc()) {
                                        echo "
                                        <tr>
                                            <td>".$x."</td>
                                            <td>".$row['initialName']."</td>
                                            <td>".$row['nic']."</td>
                                            <td>".$row['subject']."</td>
                                            <td>".$row['medium']."</td>
                                            <td>".$row['firstTown']."</td>
                                            <td>".$row['secondTown']."</td>
                                            <td>".$row['mark']."</td>
                                        </tr>";
                                        $x++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="reject mt-4">
                        <h4>Rejected Applicant's Details<hr></h4>
                    </div>
                    <div class="row mt-2">
                        <div class="table-responsive">
                            <table id="rejected" class="display table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>NIC</th>
                                        <th>Subject Code</th>
                                        <th>Medium</th>
                                        <th>1st Choice</th>
                                        <th>2nd Choice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM declaration, basicdetails WHERE basicdetails.nic=declaration.nic AND sit_exam='1' ORDER BY basicdetails.id ASC";
                                    $result = $conn->query($sql);
                                    $x=1;
                                    while($row = $result->fetch_assoc()) {
                                        echo "
                                        <tr>
                                            <td>".$x."</td>
                                            <td>".$row['initialName']."</td>
                                            <td>".$row['nic']."</td>
                                            <td>".$row['subject']."</td>
                                            <td>".$row['medium']."</td>
                                            <td>".$row['firstTown']."</td>
                                            <td>".$row['secondTown']."</td>
                                        </tr>";
                                        $x++;
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
            var table = $('#selected').DataTable( {
                lengthChange: false,
                buttons: [ 'copy', 'excel' ]
            });
                    
            table.buttons().container()
            .appendTo( '#selected_wrapper .col-md-6:eq(0)' );

            var table = $('#rejected').DataTable( {
                lengthChange: false,
                buttons: [ 'copy', 'excel' ]
            });
            table.buttons().container()
            .appendTo( '#rejected_wrapper .col-md-6:eq(0)' );
        });
    </script>
  </body>
</html>