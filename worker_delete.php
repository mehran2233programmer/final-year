<?php

include "components/db_connect.php";
echo '<link rel="stylesheet" href="bootstrap/css/bootstrap.css">';

$id = $_GET['id'];

$sql = "DELETE FROM workers where worker_id=$id";
$result = mysqli_query($conn, $sql);
if ($result) {
    header('location:dashboard_add_workers.php');
}
