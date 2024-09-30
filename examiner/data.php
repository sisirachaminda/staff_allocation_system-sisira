<?php
include 'db-connect.php';

if (isset($_POST['district'])) {
    $district = $_POST['district'];
    $output="<option value=''>- Select Zone -</option>";

    $sql = "SELECT zonal_id, zonal_name FROM zonal WHERE dis_id = '$district'";
    $result = $conn->query($sql);
    while($rows = $result->fetch_assoc()) {
        $zonal_id = $rows['zonal_id'];
        $zonal_name = $rows['zonal_name'];
        $output .= "<option value='$zonal_id'>" . $zonal_name . "</option>";

    }
    echo $output;
}

if (isset($_POST['zone'])) {
    $zone = $_POST['zone'];
    $output="<option value=''>- Select School -</option>";

    $sql = "SELECT * FROM school WHERE zone_id = '$zone'";
    $result = $conn->query($sql);
    while($rows = $result->fetch_assoc()) {
        $sc_id = $rows['sc_id'];
        $schoolname = $rows['schoolname'];
        $output .= "<option value='$sc_id'>" . $schoolname . "</option>";

    }
    echo $output;
}
?>