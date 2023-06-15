<?php
// session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Service Order</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
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
        <div class="container d-flex flex-column">
            <header>

                <?php
                include "components/header.php";
                if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'resident') {
                } elseif ($_SESSION['role'] == 'worker') {

                    header("location:dashboard_orders.php");
                } elseif (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin') {
                } else {
                ?>
                    <script>
                        alert("Login First");
                        window.location.assign("index.php");
                    </script>
                    <?php
                }



                $id = $_GET['id'];
                if (isset($_POST['submit'])) {
                    $resident_id = $_POST['resident_id'];
                    $category_id = $_POST['category_id'];
                    $date = $_POST['date'];
                    $time = $_POST['time'];
                    $desc = $_POST['desc'];

                    $sql = "INSERT INTO `orders`(`order_date`, `order_time`, `order_problem`, `order_resident_id`, `order_category_id`) VALUES ('$date','$time','$desc','$resident_id','$category_id')";

                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        // header("location:index.php");
                    ?>
                        <script>
                            alert("Order placed successfully!");
                            window.location.assign('index.php');
                        </script>
                <?php
                    }
                }


                ?>
            </header>
            <!-- ========== Start Order Form ========== -->

            <h3 class="text-center m-0 bg-white">Order a service</h3>
            <div class="container  bg-white  ">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="d-flex flex-column align-items-center">
                    <div class="mb-3 col-md-3">
                        <input type="hidden" name="resident_id" value="<?php echo $_SESSION['id'] ?>">
                        <input type="hidden" name="category_id" value="<?php echo $id ?>">
                        <label for="" class="form-label">Enter Date</label>
                        <input type="date" name="date" id="date" class="form-control" placeholder="" aria-describedby="helpId">
                        <!-- <small id="helpId" class="text-muted">Help text</small> -->
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="" class="form-label">Enter Time</label>
                        <input type="time" name="time" id="time" class="form-control" placeholder="" aria-describedby="helpId">
                        <!-- <small id="helpId" class="text-muted">Help text</small> -->
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="" class="form-label">Tell us about problem </label>
                        <textarea name="desc" id="desc" cols="34" rows="5" class="form-control"></textarea>
                        <small id="helpId" class="text-muted">Shortly Define Problem</small>
                    </div>
                    <div class="d-flex col-md-3">
                        <button type="submit" class="btn btn-primary ms-auto" name="submit">Order</button>
                    </div>
                </form>
            </div>

            <!-- ========== End Order Form ========== -->


    </main>


    </div>
    <footer class="fixed-bottom ">
        <?php include "components/footer.php" ?>
    </footer>
    <script src="bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
</body>

</html>