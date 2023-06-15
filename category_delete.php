<?php

include "components/db_connect.php";
$id=$_GET['id'];
$sql="DELETE FROM category where category_id=$id";
$result=mysqli_query($conn,$sql);
header("location:dashboard_add_category.php");
