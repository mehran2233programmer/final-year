<?php

include "components/db_connect.php";
$id = $_GET['id'];


$sql = "DELETE FROM orders where order_id=$id";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("location:dashboard_orders.php");
}
