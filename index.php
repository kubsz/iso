<?php
include($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");

$sql = "SELECT CONCAT(staff_first_name, ' ', staff_last_name) as full_name, staff_id FROM staff";
$result = $conn->query($sql);
$count_staff = 0;

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $staff_id[$count_staff] = $row['staff_id'];
        $staff_name[$count_staff] = $row['full_name'];

        $count_staff++;
    }
}

$sql = "SELECT * FROM resources";
$result = $conn->query($sql);
$count_resources = 0;

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $resource_id[$count_resources] = $row['resource_id'];
        $resource_name[$count_resources] = $row['resource_name'];

        $count_resources++;
    }
}

$sql = "SELECT * FROM room";
$result = $conn->query($sql);
$count_rooms = 0;

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $room_id[$count_rooms] = $row['room_id'];
        $room_name[$count_rooms] = $row['room_name'];

        $count_rooms++;
    }
}
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
    <div class="margined">
        <h1>Information Systems Organisations - Hopeville School Database</h1>
        <?php
        for($i = 1; $i <= 10; $i++)
            echo "<div class='button' id='$i'>Task $i</div>";
        ?>

        <div style="clear:both"></div>
    </div>
    <div class="margined" style="border:0;padding:0">
        <div class="resource-hire-sheet">
            <h2 style="transform:translateY(5px)">Resource Hire Sheet</h2>
            <select id="staff">
                <?php
                for($i = 0; $i < $count_staff; $i++) {
                    echo "<option value='$staff_id[$i]'>$staff_name[$i]</option>";
                }
                ?>
            </select>
            <select id="resource" style="margin-right:0">
                <?php
                for($i = 0; $i < $count_resources; $i++) {
                    echo "<option value='$resource_id[$i]'>$resource_name[$i]</option>";
                }
                ?>
            </select>
            <input id="booking-date" type="date" min="2019-03-16" max="2020-12-31">
            <select id='days-out' style="margin-right:0">
                <option value="1">1 Day</option>
                <option value="2">2 Days</option>
                <option value="3">3 Days</option>
                <option value="4">4 Days</option>
                <option value="5">5 Days</option>
                <option value="6">6 Days</option>
                <option value="7">7 Days</option>
            </select>
            <button id="resource-hire">Submit</button>
            <p class="result-text"></p>
        </div>
        <div class="room-booking-sheet">
            <h2 style="transform:translateY(5px)">Room Booking Sheet</h2>
            <select id="staff-room">
                <?php
                for($i = 0; $i < $count_staff; $i++) {
                    echo "<option value='$staff_id[$i]'>$staff_name[$i]</option>";
                }
                ?>
            </select>
            <select id="room" style="margin-right:0">
                <?php
                for($i = 0; $i < $count_rooms; $i++) {
                    echo "<option value='$room_id[$i]'>$room_name[$i]</option>";
                }
                ?>
            </select>
            <input id="room-booking-date" type="date" min="2019-03-16" max="2020-12-31">
            <select id='duration' style="margin-right:0">
                <option value="1">1 Day</option>
                <option value="2">2 Days</option>
                <option value="3">3 Days</option>
                <option value="4">4 Days</option>
                <option value="5">5 Days</option>
                <option value="6">6 Days</option>
                <option value="7">7 Days</option>
            </select>
            <button id="room-booking">Submit</button>
            <p class="result-text"></p>
        </div>
    </div>
    <div class="result margined">

    </div>
</body>
<script src="script.js"></script>
</html>
