<?php

include "components/db_connect.php";

if (isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $mobile_no = mysqli_real_escape_string($conn, $_POST['mobile_no']);
    $house_no = mysqli_real_escape_string($conn, $_POST['house_no']);
    $payment_plan = mysqli_real_escape_string($conn, $_POST['payment_plan']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = "SELECT*FROM requests where resident_email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        
            <strong>Your request already exixst</strong> Please wait for approvel Thank you!
        </div>
        ';
    } elseif ($password == $cpassword) {
        if (empty($gender)) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            
                <strong>Plese select gender</strong>
            </div>
            ';
        } else {
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO `requests`(`resident_fname`, `resident_lname`, `resident_email`, `resident_gender`, `resident_mobile_number`, `resident_house_no`, `resident_payment`, `resident_password`, `role`) VALUES ('$fname','$lname','$email','$gender','$mobile_no','$house_no','$payment_plan','$encpass','$role')";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            
                <strong>Your request submitted successfully!</strong> please wait for approvel.
            </div>
            ';
            }
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        
            <strong>Password is not matching</strong> please refill the form.
        </div>
        ';
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="Fonts/all.css">

</head>

<style>
    /* body {
        background: #eee;
    } */

    footer {
        background-image: linear-gradient(to top, #4481eb 0%, #04befe 100%);
        text-align: center;
        padding: 10px;
        color: white;
    }

    footer p {
        margin: 0;

    }

    .title {
        text-align: center;
        background-image: linear-gradient(to top, #4481eb 0%, #04befe 100%);
        padding: 10px;
        color: white;
    }

    .title h1 {
        margin-bottom: 0;
    }
</style>

<body>

    <main class="d-flex flex-column align-content-between">
        <div class="title">
            <h1><a href="index.php" class="text-decoration-none text-white">E-Services Facility For a Housing Society</a></h1>
        </div>
        <div class="container d-flex flex-column bg-white">
            <header>

                <?php
                session_start();
                ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs py-2 bg-white" id="navId" role="tablist">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link" aria-current="page">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Services</a>
                        <div class="dropdown-menu">


                            <!-- ========== Start Fetch category ========== -->

                            <?php
                            include "components/db_connect.php";
                            $sql = "SELECT * FROM category";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $title = $row['category_title'];
                                $cat_id = $row['category_id'];
                                echo '<a class="dropdown-item" href="feedback_rating.php?id=' . $cat_id . '">' . $title . '</a>';
                            }
                            ?>
                        </div>
                    </li>


                    <li class="nav-item" role="presentation">
                        <a href="about.php" class="nav-link">About us</a>
                    </li>
                    <?php
                    if (isset($_SESSION['loggedin'])) {
                        echo '<li class="ms-auto">';
                        if ($_SESSION['role'] == 'resident') {

                            echo '<a href="index.php" class="btn btn-outline-primary ms-1 me-3">' . $_SESSION['name'] . '</a>';
                        } else {
                            echo '<a href="dashboard_requests.php" class="btn btn-outline-primary ms-1 me-3">' . $_SESSION['name'] . '</a>';
                        }
                        echo '<a href="logout.php" class="btn btn-primary ms-1 me-3">Logout</a>
    </li>';
                    ?>
                    <?php
                    } else {
                        echo '<li class="ms-auto">
        <a href="login.php" class="btn btn-primary">Login</a>
    </li>';
                    }
                    ?>


                </ul>



                <!-- Tab panes -->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1Id" role="tabpanel"></div>
                    <div class="tab-pane fade" id="tab2Id" role="tabpanel"></div>
                    <div class="tab-pane fade" id="tab3Id" role="tabpanel"></div>
                    <div class="tab-pane fade" id="tab4Id" role="tabpanel"></div>
                    <div class="tab-pane fade" id="tab5Id" role="tabpanel"></div>
                </div>

                <?php
                if (isset($_SESSION['loggedin'])) {
                    header("location:index.php");
                }
                ?>
            </header>


            <div class="form container col-md-5 my-5 p-5 shadow">
                <h3 class="text-center mt-3">Sign Up</h3>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <input type="hidden" name="role" value="resident">
                    <div class="mb-3">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="fname" id="fname" aria-describedby="helpId" placeholder="" Required>
                        <small id="helpId" class="form-text text-muted">Help text</small>
                    </div>

                    <div class="mb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lname" id="lname" aria-describedby="helpId" placeholder="" Required>
                        <small id="helpId" class="form-text text-muted">Help text</small>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="textemail" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="" Required>
                        <small id="helpId" class="form-text text-muted">Help text</small>
                    </div>


                    <label for="gender">Gender </label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="Male" value="Male">
                        <label class="form-check-label" for="Male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="Female" value="Female">
                        <label class="form-check-label" for="Female">Female</label>
                    </div>


                    <div class="mb-3 mt-2">
                        <label for="mobile_no" class="form-label">Mobile No.</label>
                        <input type="text" class="form-control" name="mobile_no" id="mobile_no" aria-describedby="helpId" placeholder="" Required>
                        <small id="helpId" class="form-text text-muted">Help text</small>
                    </div>


                    <div class="mb-3">
                        <label for="house_no" class="form-label">House No.</label>
                        <input type="number" class="form-control" name="house_no" id="house_no" aria-describedby="helpId" placeholder="" Required>
                        <small id="helpId" class="form-text text-muted">Help text</small>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Payment Plan</label>
                        <select class="form-select form-select-lg" name="payment_plan" id="" Required>
                            <option selected disabled>Select one</option>
                            <option value="Monthly" a>30$/Monthly</option>
                            <option value="Weekly">10$/Weekly</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="" Required>
                    </div>

                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="" Required>
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>

    </main>


    </div>
    <footer class="sticky-bottom ">
        <?php include "components/footer.php" ?>
    </footer class="fixed-bottom">
    <script src="bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
</body>

</html>