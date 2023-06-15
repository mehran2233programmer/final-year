<?php

include "components/db_connect.php";
$_SESSION['loggedin'] = false;

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    if ($role == "none" && $password = "admin" && $email = "admin@gmail.com") {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = "1";
        $_SESSION['name'] = "Mehran";
        $_SESSION['role'] = "admin";
        header("location:dashboard_requests.php");
    } elseif ($role == "resident") {
        $sql = "SELECT*FROM residents where resident_email='$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $encpass = $row['resident_password'];

            $decode_pass = password_verify($password, $encpass);
            if ($decode_pass) {

                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['role'] = $row['role'];
                $_SESSION['name'] = $row['resident_fname'];
                $_SESSION['id'] = $row['resident_id'];
                header("location:index.php");
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    <strong>Incorrect password or email</strong>
                </div>
                ';
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            
                <strong>You are not registered first register youself</strong> You should check in on some of those fields below.
            </div>
            ';
        }
    } elseif ($role == "worker") {
        $sql = "SELECT*FROM workers where worker_email='$email'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $encpass = $row['worker_password'];
            $decode_pass = password_verify($password, $encpass);
            if ($decode_pass) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['role'] = $row['role'];
                $_SESSION['name'] = $row['worker_fname'];
                $_SESSION['id'] = $row['worker_id'];
                header("location:dashboard_orders.php");
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        
            <strong>Incorrect email or password</strong> 
        </div>
        ';
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
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

    .carousel {
        height: 300px;
        overflow: hidden;
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
        <a href="signup.php" class="btn btn-primary ms-1 me-3">Signup</a>
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

                <!-- (Optional) - Place this js code after initializing bootstrap.min.js or bootstrap.bundle.min.js -->
                <script>
                    var triggerEl = document.querySelector('#navId a')
                    bootstrap.Tab.getInstance(triggerEl).show() // Select tab by name
                </script> <?php
                            if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'resident') {
                                header("location:index.php");
                            } elseif (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'worker') {
                                header("location:dashboard_orders.php");
                            } elseif (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin') {
                                header("location:dashboard_requests.php");
                            }
                            ?>
            </header>


            <div class="container col-md-5 my-5 p-5 shadow">
                <h3 class="text-center mt-3">Login</h3>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <input type="hidden" name="role">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">Help text</small>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">Help text</small>
                    </div>



                    <div class="mb-3">
                        <label for="" class="form-label">Role</label>
                        <select class="form-select form-select-lg" name="role" id="role">
                            <option selected value="none">Select one</option>
                            <option value="resident">Resident</option>
                            <option value="worker">Service Provider</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" name="login">Login</button>
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