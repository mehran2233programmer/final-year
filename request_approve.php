<?php
include "components/db_connect.php";
echo '<link rel="stylesheet" href="bootstrap/css/bootstrap.css">';
echo '<script src="bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"> </script>';

if (isset($_POST['close'])) {
    header("location:requests.php");
}

// include "bootstrap/css/bootstrap.css";
$id = $_GET['id'];
$sql = "SELECT* FROM requests where resident_id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$fname = $row['resident_fname'];
$lname = $row['resident_lname'];
$email = $row['resident_email'];
$gender = $row['resident_gender'];
$mobile_number = $row['resident_mobile_number'];
$house_no = $row['resident_house_no'];
$gender = $row['resident_gender'];
$payment = $row['resident_payment'];
$password = $row['resident_password'];
$role = $row['role'];
$sql3 = "SELECT*FROM residents where resident_email='$email'";
$result3 = mysqli_query($conn, $sql3);
if (mysqli_num_rows($result3) > 0) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <a href="dashboard_requests.php" class=""><button type="button" class="btn-close" name="close" data-bs-dismiss="alert" aria-label="Close"></button></a>
    
        <strong>This person already registered!</strong> 
    </div>
    ';
} else {

    $sql1 = "INSERT INTO `residents`(`resident_fname`, `resident_lname`, `resident_email`, `resident_gender`, `resident_mobile_number`, `resident_house_no`, `resident_payment`, `resident_password`, `role`) VALUES ('$fname','$lname','$email','$gender','$mobile_number','$house_no','$payment','$password','$role')";
    $result1 = mysqli_query($conn, $sql1);
    if ($result) {
        $sql2 = "DELETE FROM `requests` WHERE `requests`.`resident_id` = $id";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        
            <strong>Approved</strong>
        </div>
        ';
            header('location:dashboard_requests.php');
        }
    }
}
