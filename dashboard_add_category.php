<?php
// session_start();
include "components/db_connect.php";
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $sql = "SELECT*FROM category where category_title='$title'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        //     <strong>Category Already exist</strong>
        // </div>
        // ';

?>
        <script>
            alert("Category already exist");
            window.location.assign('dashboard_add_category.php');
        </script>
<?php
    } else {
        $sql1 = "INSERT INTO `category`(`category_title`, `category_description`) VALUES ('$title','$desc')";
        $result1 = mysqli_query($conn, $sql1);
        header("location:dashboard_add_category.php");
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <title>Categories</title>
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
                <d class="content col-md-9 ">




                    <h3 class="text-center mt-3">Categories</h3>
                    <hr>
                    <div class="container col-md-12  ">


                        <div class="table-responsive  mt-4 me-5 table">
                            <table class="table col-md-6 table-hover  table-dark text-center shadow">
                                <thead>
                                    <tr>
                                        <th scope="col">SNO#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Accept/Reject</th>

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
                                $sql = "SELECT*FROM category LIMIT {$offset},{$limit}";
                                $result = mysqli_query($conn, $sql);
                                $num = mysqli_num_rows($result);
                                if ($num > 0) {
                                    $sno = 0;
                                    while ($row = mysqli_fetch_array($result)) {
                                        $sno++;
                                        $id = $row['category_id'];
                                        $title = $row['category_title'];
                                        $desc = $row['category_description'];


                                ?>
                                        <tbody>
                                            <tr class="">
                                                <td scope="row"><?php echo $id ?></td>
                                                <td><?php echo $title ?></td>
                                                <td><?php echo substr($desc, 0, 45) ?></td>
                                                <td><a href="category_delete.php?id=<?php echo $id ?>" class="btn btn-danger">Delete</a>
                                                </td>



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
                        $sql1 = "SELECT * FROM category";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                        if (mysqli_num_rows($result1) > 0) {

                            $total_records = mysqli_num_rows($result1);

                            $total_page = ceil($total_records / $limit);

                            echo '<ul class="pagination admin-pagination d-flex justify-content-center">';
                            if ($page > 1) {
                                echo '<li><a  class="btn btn-outline-primary" href="dashboard_add_category.php?page=' . ($page - 1) . '">Prev</a></li>';
                            }
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $page) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                echo '<li class=""><a class="btn ' . $active . ' btn-outline-primary ms-1 text-decoration-none" href="dashboard_add_category.php?page=' . $i . '">' . $i . '</a></li>';
                            }
                            if ($total_page > $page) {
                                echo '<li class="ms-1"><a class="btn btn-outline-primary" href="dashboard_add_category.php?page=' . ($page + 1) . '">Next</a></li>';
                            }

                            echo '</ul>';
                        }
                        ?>
                    </div>


                    <h3 class="text-center mt-3">Add Category</h3>
                    <hr>
                    <div class="container col-md-12  ">


                        <div class="table-responsive  mt-4 me-5 table">
                            <!-- ========== Start Add category ========== -->
                            <div class="container col-md-6 shadow">
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" id="cat_title" aria-describedby="helpId" placeholder="">
                                        <!-- <small id="helpId" class="form-text text-muted">Help text</small> -->
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Description</label>
                                        <textarea class="form-control" name="desc" id="cat_desc" rows="3"></textarea>
                                        <button type="submit" class="btn btn-primary mt-3" name="submit">ADD</button>

                                    </div>

                                </form>
                            </div>
                            <!-- ========== End Add category ========== -->


                        </div>

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