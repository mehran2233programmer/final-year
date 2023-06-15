<?php

include "components/db_connect.php";
$id = $_GET['id'];
$sql = "DELETE FROM requests where resident_id=$id";

$result = mysqli_query($conn, $sql);
header("location:dashboard_requests.php");
