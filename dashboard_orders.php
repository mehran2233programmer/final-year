<?php
// session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Orders</title>
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
                if ($_SESSION['role'] == 'resident') {
                    header('location:index.php');
                }
                ?>
                <div class="content col-md-9 ">
                    <h3 class="text-center mt-3">Orders</h3>
                    <hr>
                    <div class="container col-md-12  ">


                        <div class="table-responsive  mt-4 me-5 table">
                            <table class="table col-md-6 table-hover  table-dark text-center shadow">
                                <thead>
                                    <tr>
                                        <th scope="col">SNO#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">time</th>
                                        <th scope="col">Mobile No.</th>
                                        <th scope="col">House No.</th>
                                        <th scope="col">Fullfiled</th>

                                    </tr>
                                </thead>
                                <?php
                                include "components/db_connect.php";
                                include "components/db_connect.php";
                                $limit = 5;
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                } else {
                                    $page = 1;
                                }
                                $offset = ($page - 1) * $limit;
                                $sql = "SELECT*FROM orders LIMIT {$offset},{$limit}";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    $sno = 0;
                                    while ($row = mysqli_fetch_array($result)) {
                                        $id = $row['order_id'];
                                        $date = $row['order_date'];
                                        $time = $row['order_time'];
                                        $problem = $row['order_problem'];
                                        $resident_id = $row['order_resident_id'];
                                        $category_id = $row['order_category_id'];
                                        $sno++;
                                        $sql1 = "SELECT*FROM residents WHERE resident_id=$resident_id";
                                        $result1 = mysqli_query($conn, $sql1);
                                        $row = mysqli_fetch_array($result1);
                                        $fname = $row['resident_fname'];
                                        $lname = $row['resident_lname'];
                                        $mobile = $row['resident_mobile_number'];
                                        $house_no = $row['resident_house_no'];
                                        $sql2 = "SELECT*FROM category WHERE category_id=$category_id";
                                        $result2 = mysqli_query($conn, $sql2);
                                        $row = mysqli_fetch_array($result2);
                                        $category = $row['category_title'];

                                ?>
                                        <tbody>
                                            <tr class="">
                                                <td scope="row"><?php echo $id ?></td>
                                                <td scope="row"><?php echo $fname ?></td>
                                                <td><?php echo $lname ?></td>
                                                <td><?php echo $category ?></td>
                                                <td><?php echo $date ?></td>
                                                <td><?php echo $time ?></td>
                                                <td><?php echo $mobile ?></td>
                                                <td><?php echo $house_no ?></td>
                                                <td><a href="order_done.php?id=<?php echo $id ?>" class="btn btn-success">Done</a>





                                            </tr>

                                        </tbody>
                                <?php
                                    }
                                } else {
                                    echo "<h3 class='text-center'>No Record Found</h3>";
                                }
                                ?>
                            </table>
                        </div>
                        <?php
                        // show pagination
                        $sql1 = "SELECT * FROM orders";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                        if (mysqli_num_rows($result1) > 0) {

                            $total_records = mysqli_num_rows($result1);

                            $total_page = ceil($total_records / $limit);

                            echo '<ul class="pagination admin-pagination d-flex justify-content-center">';
                            if ($page > 1) {
                                echo '<li ><a class="btn btn-outline-primary" href="dashboard_orders.php?page=' . ($page - 1) . '">Prev</a></li>';
                            }
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $page) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                echo '<li class=""><a class="btn ' . $active . ' btn-outline-primary ms-1 text-decoration-none" href="dashboard_orders.php?page=' . $i . '">' . $i . '</a></li>';
                            }
                            if ($total_page > $page) {
                                echo '<li class="ms-1"><a class="btn btn-outline-primary" href="dashboard_orders.php?page=' . ($page + 1) . '">Next</a></li>';
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
</body>

</html>