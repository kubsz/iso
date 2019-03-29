<?php
include($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");

$task = $_POST['task'];
$count = 0;

switch($task) {
    case 1:
        $sql = "SELECT pfa_id, CONCAT(carer_first_name, ' ', carer_last_name) AS full_name, pfa_join_date, contributions
            FROM pfa INNER JOIN carer WHERE pfa.CARER_ID = carer.CARER_ID ORDER BY carer.carer_last_name ASC";

        $ps = $conn->prepare($sql);
        $ps->bind_param();
        $ps->execute();
        $result = $ps->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $pfa_id[$count] = $row["pfa_id"];
                $full_name[$count] = $row["full_name"];
                $pfa_join_date[$count] = gmdate("d-m-Y", $row["pfa_join_date"]);
                $contributions[$count] = $row["contributions"];

                $count++;
            }
        }
        $output = "<h2>PFA Members</h2><table><tr><th>PFA ID</th><th>Full Name</th><th>PFA Join Date</th><th>Contributions</th></tr>";
        for($i = 0; $i <  $count; $i++) {
            $output = $output."<tr>";
            $output = $output."<td>$pfa_id[$i]</td>";
            $output = $output."<td>$full_name[$i]</td>";
            $output = $output."<td>$pfa_join_date[$i]</td>";
            $output = $output."<td>£$contributions[$i]</td>";
            $output = $output."</tr>";
        }
        $output = $output."</table>";


        break;
    case 2:
        $sql = "SELECT staff_id, CONCAT(staff_first_name, ' ', staff_last_name) as staff_full_name, role_name, staff_date_hired, staff_hourly_salary, staff.line_manager_id, CONCAT(line_manager_first_name, ' ', line_manager_last_name) as line_manager_full_name FROM ((staff
                INNER JOIN role ON role.role_id = staff.role_id)
                INNER JOIN line_manager ON staff.line_manager_id = line_manager.line_manager_id)
                ORDER BY staff_date_hired DESC";

        $ps = $conn->prepare($sql);
        $ps->bind_param();
        $ps->execute();
        $result = $ps->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $staff_id[$count] = $row["staff_id"];
                $full_name[$count] = $row["staff_full_name"];
                $role[$count] = $row["role_name"];
                $date_hired[$count] = gmdate("d-m-Y", $row["staff_date_hired"]);
                $hourly_salary[$count] = $row["staff_hourly_salary"];
                $line_manager_id[$count] = $row["line_manager_id"];
                $line_manager_full_name[$count] = $row["line_manager_full_name"];

                $count++;
            }
        }

        $output = "<h2>All Staff Members</h2><table><tr><th>Staff ID</th><th>Full Name</th><th>Job Title</th><th>Date Hired</th><th>Hourly Salary</th><th>Line Manager ID</th><th>Line Manager Name</th></tr>";
        for($i = 0; $i <  $count; $i++) {
            $output = $output."<tr>";
            $output = $output."<td>$staff_id[$i]</td>";
            $output = $output."<td>$full_name[$i]</td>";
            $output = $output."<td>$role[$i]</td>";
            $output = $output."<td>$date_hired[$i]</td>";
            $output = $output."<td>£$hourly_salary[$i]</td>";
            $output = $output."<td>$line_manager_id[$i]</td>";
            $output = $output."<td>$line_manager_full_name[$i]</td>";
            $output = $output."</tr>";
        }
        $output = $output."</table>";
        break;
    case 3:
        $sql = "SELECT resource_booking_id, resource_booking.resource_id, resource_name, resource_booking.staff_id, CONCAT(staff_first_name, ' ', staff_last_name) as staff_full_name, date_out, number_of_days FROM ((resources
                INNER JOIN resource_booking ON resource_booking.resource_id = resources.resource_id)
                INNER JOIN staff ON resource_booking.staff_id = staff.staff_id)
                ORDER BY date_out DESC";

        $ps = $conn->prepare($sql);
        $ps->bind_param();
        $ps->execute();
        $result = $ps->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resource_booking_id[$count] = $row["resource_booking_id"];
                $resource_name[$count] = $row["resource_name"];
                $staff_id[$count] = $row["staff_id"];
                $staff_full_name[$count] = $row["staff_full_name"];
                $number_of_days[$count] = $row["number_of_days"];
                $date_out[$count] = gmdate("d-m-Y", $row["date_out"]);

                $count++;
            }
        }

        $output = "<h2>Resource Booking Sheet</h2><table><tr><th>Resource Booking ID</th><th>Resource Name</th><th>Staff ID</th><th>Staff Name</th><th>Date Out</th><th>Number of Days</th></tr>";
        for($i = 0; $i <  $count; $i++) {
            $output = $output."<tr>";
            $output = $output."<td>$resource_booking_id[$i]</td>";
            $output = $output."<td>$resource_name[$i]</td>";
            $output = $output."<td>$staff_id[$i]</td>";
            $output = $output."<td>$staff_full_name[$i]</td>";
            $output = $output."<td>$date_out[$i]</td>";
            $output = $output."<td>$number_of_days[$i]</td>";
            $output = $output."</tr>";
        }
        $output = $output."</table>";
        break;
    case 4:
        $sql = "SELECT faculty.faculty_id, subject_link.subject_id, subject.subject_name, staff.staff_id, CONCAT(staff_first_name, ' ', staff_last_name) as full_name, faculty.faculty_name FROM subject_link
                INNER JOIN staff ON staff.STAFF_ID = subject_link.staff_id
                INNER JOIN subject ON subject.SUBJECT_ID = subject_link.subject_id
                INNER JOIN faculty ON faculty.faculty_id = subject.faculty_id";

        $ps = $conn->prepare($sql);
        $ps->bind_param();
        $ps->execute();
        $result = $ps->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $subject_id[$count] = $row["subject_id"];
                $faculty_id[$count] = $row["faculty_id"];
                $subject_name[$count] = $row["subject_name"];
                $staff_id[$count] = $row["staff_id"];
                $full_name[$count] = $row["full_name"];
                $faculty_name[$count] = $row["faculty_name"];

                $count++;
            }
        }

        $output = "<h2>Faculty Teacher Listing</h2><table><tr><th>Faculty ID</th><th>Faculty Name</th><th>Staff ID</th><th>Staff Name</th><th>Subject ID</th><th>Subject Name</th></tr>";
        for($i = 0; $i <  $count; $i++) {
            $output = $output."<tr>";
            $output = $output."<td>$faculty_id[$i]</td>";
            $output = $output."<td>$faculty_name[$i]</td>";
            $output = $output."<td>$staff_id[$i]</td>";
            $output = $output."<td>$full_name[$i]</td>";
            $output = $output."<td>$subject_id[$i]</td>";
            $output = $output."<td>$subject_name[$i]</td>";
            $output = $output."</tr>";
        }
        $output = $output."</table>";
        break;
    case 5:
        $sql = "SELECT faculty.faculty_id, faculty.faculty_name, staff.staff_id, CONCAT(staff_first_name, ' ', staff_last_name) as full_name, faculty_link.date_joined FROM faculty_link
                INNER JOIN staff ON staff.staff_id = faculty_link.staff_id
                INNER JOIN faculty ON faculty.faculty_id = faculty_link.faculty_id";

        $ps = $conn->prepare($sql);
        $ps->bind_param();
        $ps->execute();
        $result = $ps->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $staff_id[$count] = $row["staff_id"];
                $full_name[$count] = $row["full_name"];
                $faculty_id[$count] = $row["faculty_id"];
                $faculty_name[$count] = $row["faculty_name"];
                $date_joined[$count] = gmdate("d-m-Y", $row["date_joined"]);

                $count++;
            }
        }

        $output = "<h2>Faculty Member Listing</h2><table><tr><th>Staff ID</th><th>Staff Name</th><th>Faculty ID</th><th>Faculty Name</th><th>Date Joined</th></tr>";
        for($i = 0; $i <  $count; $i++) {
            $output = $output."<tr>";
            $output = $output."<td>$staff_id[$i]</td>";
            $output = $output."<td>$full_name[$i]</td>";
            $output = $output."<td>$faculty_id[$i]</td>";
            $output = $output."<td>$faculty_name[$i]</td>";
            $output = $output."<td>$date_joined[$i]</td>";
            $output = $output."</tr>";
        }
        $output = $output."</table>";
        break;
    case 6:
        $sql = "SELECT room_booking_id, room_booking.room_id, room_name, room_booking.staff_id, CONCAT(staff_first_name, ' ', staff_last_name) as staff_full_name, booking_date, duration FROM ((room
                INNER JOIN room_booking ON room_booking.room_id = room.room_id)
                INNER JOIN staff ON room_booking.staff_id = staff.staff_id)
                ORDER BY duration DESC";

        $ps = $conn->prepare($sql);
        $ps->bind_param();
        $ps->execute();
        $result = $ps->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $room_booking_id[$count] = $row["room_booking_id"];
                $room_name[$count] = $row["room_name"];
                $staff_id[$count] = $row["staff_id"];
                $staff_full_name[$count] = $row["staff_full_name"];
                $duration[$count] = $row["duration"];
                $booking_date[$count] = gmdate("d-m-Y", $row["booking_date"]);

                $count++;
            }
        }

        $output = "<h2>Room Booking Sheet</h2><table><tr><th>Room Booking ID</th><th>Room Name</th><th>Staff ID</th><th>Staff Name</th><th>Date Booked</th><th>Number of Days</th></tr>";
        for($i = 0; $i <  $count; $i++) {
            $output = $output."<tr>";
            $output = $output."<td>$room_booking_id[$i]</td>";
            $output = $output."<td>$room_name[$i]</td>";
            $output = $output."<td>$staff_id[$i]</td>";
            $output = $output."<td>$staff_full_name[$i]</td>";
            $output = $output."<td>$booking_date[$i]</td>";
            $output = $output."<td>$duration[$i]</td>";
            $output = $output."</tr>";
        }
        $output = $output."</table>";
        break;
    case 7:
        $sql = "SELECT staff_family_link.family_id, staff_family_link.staff_id, CONCAT(staff_first_name, ' ', staff_last_name) as staff_name, COUNT(student_family_link.family_id) as number_of_students FROM staff
                INNER JOIN staff_family_link ON staff_family_link.staff_id = staff.staff_id
                INNER JOIN family ON family.family_id = staff_family_link.family_id
                INNER JOIN student_family_link ON student_family_link.family_id = staff_family_link.family_id
                GROUP BY staff_family_link.family_id";

        $ps = $conn->prepare($sql);
        $ps->bind_param();
        $ps->execute();
        $result = $ps->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $family_id[$count] = $row["family_id"];
                $staff_id[$count] = $row["staff_id"];
                $staff_name[$count] = $row["staff_name"];
                $number_of_students[$count] = $row["number_of_students"];

                $count++;
            }
        }

        $output = "<h2>Staff that are also parents</h2><table><tr><th>Family ID</th><th>Staff ID</th><th>Staff Name</th><th>Number of Students</th></tr>";
        for($i = 0; $i <  $count; $i++) {
            $output = $output."<tr>";
            $output = $output."<td>$family_id[$i]</td>";
            $output = $output."<td>$staff_id[$i]</td>";
            $output = $output."<td>$staff_name[$i]</td>";
            $output = $output."<td>$number_of_students[$i]</td>";
            $output = $output."</tr>";
        }
        $output = $output."</table>";
        break;
    case 8:
        $sql = "SELECT resources.resource_id, resources.resource_name, COUNT(resource_booking.resource_id) AS times_hired FROM resources
                INNER JOIN resource_booking ON resource_booking.resource_id = resources.resource_id
                GROUP BY resource_booking.resource_id HAVING COUNT(resource_booking.resource_id) < 3
                ORDER BY COUNT(resource_booking.resource_id) DESC";

        $ps = $conn->prepare($sql);
        $ps->bind_param();
        $ps->execute();
        $result = $ps->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resource_id[$count] = $row["resource_id"];
                $resource_name[$count] = $row["resource_name"];
                $times_hired[$count] = $row["times_hired"];

                $count++;
            }
        }

        $output = "<h2>Resources that have been booked less than 3 times</h2><table><tr><th>Resource ID</th><th>Resource Name</th><th>Times Hired</th></tr>";
        for($i = 0; $i <  $count; $i++) {
            $output = $output."<tr>";
            $output = $output."<td>$resource_id[$i]</td>";
            $output = $output."<td>$resource_name[$i]</td>";
            $output = $output."<td>$times_hired[$i]</td>";
            $output = $output."</tr>";
        }
        $output = $output."</table>";
        break;
    case 9:
        $sql = "SELECT  department_link.staff_id,
                        CONCAT(staff_first_name, ' ', staff_last_name) 
                        AS staff_name, 
                        COUNT(DISTINCT department_id) 
                        AS number_of_departments 
                FROM    department_link
                INNER   JOIN staff 
                        ON staff.staff_id = department_link.staff_id
                GROUP   BY department_link.staff_id
                HAVING  COUNT(DISTINCT department_id) = (SELECT COUNT(DISTINCT department_id) FROM department)";

        $ps = $conn->prepare($sql);
        $ps->bind_param();
        $ps->execute();
        $result = $ps->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $staff_id[$count] = $row["staff_id"];
                $staff_name[$count] = $row["staff_name"];
                $number_of_departments[$count] = $row["number_of_departments"];

                $count++;
            }
        }

        $output = "<h2>Staff that have worked in all departments</h2><table><tr><th>Staff ID</th><th>Staff Name</th><th>Number of Departments Worked In</th></tr>";
        for($i = 0; $i <  $count; $i++) {
            $output = $output."<tr>";
            $output = $output."<td>$staff_id[$i]</td>";
            $output = $output."<td>$staff_name[$i]</td>";
            $output = $output."<td>$number_of_departments[$i]</td>";
            $output = $output."</tr>";
        }
        $output = $output."</table>";
        break;
    case 10:
        $sql = "SELECT staff_id, CONCAT(staff_first_name, ' ', staff_last_name) as staff_name, staff_date_hired, staff_hourly_salary, staff_address, staff_phone_number FROM staff
                WHERE SUBSTRING(staff_last_name, 1, 1) = (SELECT SUBSTRING(staff_last_name, 1, 1) FROM meeting_attendee
                INNER JOIN staff ON staff.staff_id = meeting_attendee.staff_id
                GROUP BY meeting_attendee.staff_id	
                ORDER BY COUNT(meeting_attendee.staff_id) DESC
                LIMIT 1);";

        $ps = $conn->prepare($sql);
        $ps->bind_param();
        $ps->execute();
        $result = $ps->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $staff_id[$count] = $row["staff_id"];
                $staff_name[$count] = $row["staff_name"];
                $staff_date_hired[$count] = gmdate("d-m-Y", $row["staff_date_hired"]);
                $staff_hourly_salary[$count] = "£".number_format($row["staff_hourly_salary"], 2, '.', '');
                $staff_address[$count] = $row["staff_address"];
                $staff_phone_number[$count] = $row["staff_phone_number"];

                $count++;
            }
        }

        $output = "<h2>Details of Teachers With Same Starting Surname Letter as Meeting Master</h2><table><tr><th>Staff ID</th><th>Staff Name</th><th>Staff Date Hired</th><th>Staff Hourly Salary</th><th>Staff Address</th><th>Staff Phone Number</th></tr>";
        for($i = 0; $i <  $count; $i++) {
            $output = $output."<tr>";
            $output = $output."<td>$staff_id[$i]</td>";
            $output = $output."<td>$staff_name[$i]</td>";
            $output = $output."<td>$staff_date_hired[$i]</td>";
            $output = $output."<td>$staff_hourly_salary[$i]</td>";
            $output = $output."<td>$staff_address[$i]</td>";
            $output = $output."<td>$staff_phone_number[$i]</td>";
            $output = $output."</tr>";
        }
        $output = $output."</table>";
        break;
}

echo $output;

?>