<?php
include($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");

$first_name = substr($_POST['username'], 0, -1);
$last_name = substr($_POST['username'], -1, 1);
$phone_number = $_POST['password'];

$sql = "SELECT role_id FROM staff WHERE staff_first_name = ? AND SUBSTRING(staff_last_name, 1, 1) = ? AND staff_phone_number = ?";

$ps = $conn->prepare($sql);
$ps->bind_param("sss", $first_name, $last_name, $phone_number);
$ps->execute();
$result = $ps->get_result();

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row['role_id'];
    }
} else {
    echo "error";
}

?>