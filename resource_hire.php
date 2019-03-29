<?php
include($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");

$resource_id = $_POST['resource_id'];
$staff_id = $_POST['staff_id'];
$booking_date = strtotime($_POST['booking_date']);
$days_out = $_POST['days_out'];

$sql = "INSERT INTO resource_booking(resource_id, staff_id, date_out, number_of_days) VALUES(?, ?, ?, ?)";

$ps = $conn->prepare($sql);
$ps->bind_param("iiii", $resource_id, $staff_id, $booking_date, $days_out);
$ps->execute();
$result = $ps->get_result();

echo "Your booking has been placed!";

?>