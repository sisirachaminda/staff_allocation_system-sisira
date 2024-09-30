<?php
include 'db-connect.php';

if (isset($_POST['submedium'])) {
    $submedium = $_POST['submedium'];
	$ns=explode('_',$submedium);
	
    $output="<option value=''>- Select Town -</option>";

    $sql = "SELECT * FROM town INNER JOIN markingcenters ON town.town_id=markingcenters.townNo WHERE markingcenters.medium='$ns[0]' AND markingcenters.subjectID='$ns[1]'";
    $result = $conn->query($sql);
    while($rows = $result->fetch_assoc()) {
        $town_id = $rows['town_id'];
        $town_name = $rows['town_name'];
        $output .= "<option value='$town_id'>" . $town_name . "</option>";

    }
	
    echo $output;
}


?>