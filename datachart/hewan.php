<?php
header('Content-Type: application/json');

//$conn = mysqli_connect("localhost","root","","phppot");
$conn = mysqli_connect("localhost","root","","pakanternak");
//$sqlQuery = "SELECT student_id,student_name,marks FROM tbl_marks ORDER BY student_id";
//$sqlQuery = "SELECT item_id,item_name,amount FROM pakan ORDER BY item_id";
$sqlQuery = "SELECT item_id,item_name,amount FROM hewan ORDER BY item_id";
$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>