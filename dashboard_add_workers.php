<?php

include "components/db_connect.php";
if (isset($_POST['submit'])) {
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $phone = mysqli_real_escape_string($conn, $_POST['pno']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "SELECT*FROM workers where worker_email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        
            <strong>Worker alreay exist</strong>        </div>
        ';
    } elseif ($password == $cpassword) {
        $encpass = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO `workers`(`worker_fname`, `worker_lname`, `worker_email`, `worker_gender`, `worker_mobile_number`, `worker_category`, `worker_password`, `role`) VALUES ('$fname','$lname','$email','$gender','$phone','$category','$encpass','$role')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location:dashboard_add_workers.php");
        }
    } else {
?>
        <script>
            alert("Password are not matching")
            Location("dashboard_add_workers.php")
        </script>
<?php
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Workers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>

<style>
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

    .active {
        background: #4481eb;
        color: white;
    }
</style>

<body>

    <main class="d-flex flex-column align-content-between">
        <div class="title">
            <h1><a href="index.php" class="text-decoration-none text-white">E-Services Facility For a Housing Society</a></h1>
        </div>
        <div class="container-fluid p-0">
            <div class="sidebar main d-flex">

                <?php include "components/sidebar.php" ?>

                <?php
                if ($_SESSION['role'] == "worker") {
                    header("location:dashboard_orders.php");
                } elseif ($_SESSION['role'] == "resident") {
                    header("location:index");
                }
                ?>

                <div class="content col-md-9 ">
                    <h3 class="text-center mt-3">Workers</h3>
                    <hr>
                    <div class="container col-md-12  ">


                        <div class="table-responsive  mt-4 me-5 table">
                            <table class="table col-md-6 table-hover  table-dark text-center shadow">
                                <thead>
                                    <tr>
                                        <th scope="col">SNO#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Mobile No.</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Delete</th>

                                    </tr>
                                </thead>
                                <?php
                                include "components/db_connect.php";
                                $limit = 5;
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                } else {
                                    $page = 1;
                                }
                                $offset = ($page - 1) * $limit;
                                $sql = "SELECT*FROM workers LIMIT {$offset},{$limit}";
                                $result = mysqli_query($conn, $sql);
                                $sno = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                    $id = $row['worker_id'];
                                    $fname = $row['worker_fname'];
                                    $lname = $row['worker_lname'];
                                    $gender = $row['worker_gender'];
                                    $mobile = $row['worker_mobile_number'];
                                    $category = $row['worker_category'];
                                    $sno++;

                                ?>
                                    <tbody>
                                        <tr class="">
                                            <td scope="row"><?php echo  $id ?></td>
                                            <td scope="row"><?php echo $fname ?></td>
                                            <td><?php echo $lname ?></td>
                                            <td><?php echo $gender ?></td>
                                            <td><?php echo $mobile ?></td>
                                            <td><?php echo $category ?></td>
                                            <td><a href="worker_delete.php?id=<?php echo $id ?>" class="btn btn-danger">Delete</a>
                                            </td>



                                        </tr>

                                    </tbody>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                        <?php
                        // show pagination
                        $sql1 = "SELECT * FROM workers";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                        if (mysqli_num_rows($result1) > 0) {

                            $total_records = mysqli_num_rows($result1);

                            $total_page = ceil($total_records / $limit);

                            echo '<ul class="pagination admin-pagination d-flex justify-content-center">';
                            if ($page > 1) {
                                echo '<li ><a class="btn btn-outline-primary" href="dashboard_add_workers.php?page=' . ($page - 1) . '">Prev</a></li>';
                            }
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $page) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                echo '<li class=""><a class="btn ' . $active . ' btn-outline-primary ms-1 text-decoration-none" href="dashboard_add_workers.php?page=' . $i . '">' . $i . '</a></li>';
                            }
                            if ($total_page > $page) {
                                echo '<li class="ms-1"><a class="btn btn-outline-primary" href="dashboard_add_workers.php?page=' . ($page + 1) . '">Next</a></li>';
                            }

                            echo '</ul>';
                        }
                        ?>
                        <!-- ========== Start add workers ========== -->
                        <h3 class="text-center">Add Workers</h3>
                        <hr>

                        <div class="container mb-4 col-md-6">
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                <input type="hidden" name="role" value="worker">
                                <div class="mb-3">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="fname" id="fname" aria-describedby="helpId" placeholder="" Required>
                                    <!-- <small id="helpId" class="form-text text-muted">First Name</small> -->
                                </div>

                                <div class="mb-3">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lname" id="lname" aria-describedby="helpId" placeholder="" Required>
                                    <!-- <small id="helpId" class="form-text text-muted">First Name</small> -->
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="" Required>
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


                                <div class="mb-3">
                                    <label for="pno" class="form-label">Phone No.</label>
                                    <input type="text" class="form-control" name="pno" id="pno" aria-describedby="helpId" placeholder="" Required>
                                    <!-- <small id="helpId" class="form-text text-muted">First Name</small> -->
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Category</label>
                                    <select class="form-select form-select-lg" name="category" id="category" Required>
                                        <option selected>Select</option>
                                        <option value="Plumber">Plumber</option>
                                        <option value="Electrician">Electrician</option>
                                        <option value="Cable Operator">Cable Operator</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" Required>
                                </div>

                                <div class="mb-3">
                                    <label for="cpassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password" Required>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary" name="submit">ADD</button>
                                </div>
                            </form>
                        </div>
                        <!-- ========== End add workers ========== -->
                    </div>
                </div>
            </div>
        </div>

    </main>

    </div>
    <footer class="sticky-bottom">
        <?php include "components/footer.php" ?>
    </footer>
    <script src="bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
</body>

</html>