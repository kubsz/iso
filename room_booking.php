<?php
include($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");

$room_id = $_POST['room_id'];
$staff_id = $_POST['staff_id'];
$booking_date = strtotime($_POST['booking_date']);
$duration = $_POST['duration'];

$sql = "INSERT INTO room_booking(staff_id, room_id, booking_date, duration) VALUES(?, ?, ?, ?)";

$ps = $conn->prepare($sql);
$ps->bind_param("iiii", $staff_id, $room_id, $booking_date, $duration);
$ps->execute();
$result = $ps->get_result();

echo "Your booking has been placed!";

?>