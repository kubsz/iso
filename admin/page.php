<?php
include($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");

$option = strtolower($_POST['option']);
$role = $_POST['role'];

include($_SERVER['DOCUMENT_ROOT']."/admin/teacher/$option.php");

?>