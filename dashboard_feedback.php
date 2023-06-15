<?php
// session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <title>Requests</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="Fonts/all.css">
</head>

<style>
    footer {
        background-image: linear-gradient(to top, #4481eb 0%, #04befe 100%);
        text-align: center;
        padding: 10px;
        color: white;
    }

    .active {
        background: blue;
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
                if ($_SESSION['role'] == 'resident') {
                    header('location:index.php');
                }
                ?>

                <div class="content col-md-9 ">
                    <h3 class="text-center mt-3">Feedback</h3>
                    <hr>
                    <div class="container col-md-12  ">
                        <!-- ========== Read full comment ========== -->
                        <?php


                        if (isset($_GET['id'])) {
                            include "components/db_connect.php";
                            $id = $_GET['id'];
                            // echo $id;
                            $sql = "SELECT*FROM feedback where feedback_id=$id";
                            $resuslt = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_array($resuslt)) {
                                $feedback_resident_id = $row['feedback_resident_id'];
                                $feedback = $row['feedback'];
                                $sql1 = "SELECT*FROM residents where resident_id=$feedback_resident_id";
                                $resuslt1 = mysqli_query($conn, $sql1);
                                $row = mysqli_fetch_array($resuslt1);
                                $fname = $row['resident_fname'];
                                $lname = $row['resident_lname'];
                        ?>
                                <div class="row align-items-md-stretch mb-3">
                                    <div class="col-md-6 d-grid justify-items-center">
                                        <div class="col-md-12 h-100 p-5 text-white bg-primary border rounded-3">
                                            <h3 class="text-center"><?php echo strtoupper($fname) . " " . strtoupper($lname) ?></h3>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="h-100 p-5 bg-primary border rounded-3 text-white">
                                            <h2></h2>
                                            <p><?php echo $feedback ?></p>

                                        </div>
                                    </div>
                                </div>


                        <?php }
                        } else {
                        } ?>

                        <div class="table-responsive  mt-4 me-5 table">
                            <table class="table col-md-6 table-hover  table-dark text-center shadow">
                                <thead>
                                    <tr>
                                        <th scope="col">SNO#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Feedback</th>
                                        <th scope="col">Rating</th>


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
                                $sql = "SELECT*FROM feedback LIMIT {$offset},{$limit}";

                                $resuslt = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($resuslt) > 0) {
                                    $sno = 0;
                                    while ($row = mysqli_fetch_array($resuslt)) {
                                        $sno++;
                                        $feedback_id = $row['feedback_id'];
                                        $feedback = $row['feedback'];
                                        $rating = $row['rating'];
                                        $feedback_resident_id = $row['feedback_resident_id'];
                                        $feedback_category_id = $row['feedback_category_id'];
                                        $sql1 = "SELECT*FROM residents where resident_id=$feedback_resident_id";
                                        $resuslt1 = mysqli_query($conn, $sql1);
                                        $row = mysqli_fetch_array($resuslt1);
                                        $fname = $row['resident_fname'];
                                        $lname = $row['resident_lname'];

                                        $sql2 = "SELECT*FROM category where category_id=$feedback_category_id";
                                        $resuslt2 = mysqli_query($conn, $sql2);
                                        $row = mysqli_fetch_array($resuslt2);
                                        $category = $row['category_title'];




                                ?>
                                        <tbody>
                                            <tr class="">
                                                <td scope="row"><?php echo $feedback_id ?></td>
                                                <td scope="row"><?php echo strtoupper($fname) ?></td>
                                                <td><?php echo strtoupper($lname) ?></td>
                                                <td><?php echo $category ?></td>
                                                <td><?php echo substr($feedback, 0, 20) ?>...
                                                    <a type="" href="dashboard_feedback.php?id=<?php echo $feedback_id ?>" data-bs-target="#modalId">
                                                        Read
                                                    </a>
                                                </td>
                                                <td><i class="fa fa-star bg-warning p-1 rounded"> <?php echo $rating ?></td>
                                            </tr>

                                        </tbody>
                                <?php

                                    }
                                } else {
                                    echo '<h3 class="text-center">No Record Found</h3>';
                                }
                                ?>
                            </table>

                        </div>


                        <?php
                        // show pagination
                        $sql1 = "SELECT * FROM feedback";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                        if (mysqli_num_rows($result1) > 0) {

                            $total_records = mysqli_num_rows($result1);

                            $total_page = ceil($total_records / $limit);

                            echo '<ul class="pagination admin-pagination d-flex justify-content-center">';
                            if ($page > 1) {
                                echo '<li ><a class="btn btn-outline-primary" href="dashboard_feedback.php?page=' . ($page - 1) . '">Prev</a></li>';
                            }
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $page) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                echo '<li class=""><a class="btn ' . $active . ' btn-outline-primary ms-1 text-decoration-none" href="dashboard_feedback.php?page=' . $i . '">' . $i . '</a></li>';
                            }
                            if ($total_page > $page) {
                                echo '<li class="ms-1"><a class="btn btn-outline-primary text-decoration-none" href="dashboard_feedback.php?page=' . ($page + 1) . '">Next</a></li>';
                            }

                            echo '</ul>';
                        }
                        ?>


                    </div>
                </div>
            </div>
        </div>

    </main>


    </div>
    <footer class="fixed-bottom">
        <?php include "components/footer.php" ?>
    </footer>
    <script src="bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <script>
        
    </script>
</body>

</html>