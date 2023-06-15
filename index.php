<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
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

    .item1 {
        position: relative;
        top: -500px;
    }

    .item2 {
        position: relative;
        top: -280px;
    }

    .item3 {
        position: relative;
        top: -110px;
    }

    .img {
        height: 158px;
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

                <?php include "components/header.php" ?>
            </header>
            <!-- ==========Carousel Start ========== -->


            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item item1 active">
                        <img src="images/carousel1.jpg" class="w-100 d-block" alt="First slide">
                    </div>
                    <div class="carousel-item item2">
                        <img src="images/carousel2.jpg" class="w-100 d-block" alt="Second slide">
                    </div>
                    <div class="carousel-item item3">
                        <img src="images/carousel3.jpg" class="w-100 d-block" alt="Third slide">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- ==========Carousel End ========== -->
            <h3 class="text-center mt-4 mb-4">Services</h3>
            <!-- ========== Start Cards ========== -->


            <div class="container">
                <div class="cards row justify-content-center mb-5">

                    <!-- ========== Start Fetch category for cards ========== -->

                    <?php
                    $limit = 6;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;

                    $sql = "SELECT * FROM category LIMIT {$offset},{$limit}";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cat_id = $row['category_id'];
                        $title = $row['category_title'];
                        $cat_desc = $row['category_description'];


                    ?>

                        <div class="card col-md-3 ms-3 p-2  my-2">
                            <div class="img">
                                <img class="card-img-top" src="images/<?php echo $title ?>.jpg" alt="Title">
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h4 class="card-title"><?php echo $title ?></h4>
                                <p class="card-text"><?php echo substr($cat_desc, 0, 30),  "..."; ?></p>
                                <div class="d-flex ">
                                    <a href="order_service.php?id=<?php echo $cat_id ?>" class="btn btn-primary me-1">Oreder</a>
                                    <a href="feedback_rating.php?id=<?php echo $cat_id ?>" class="btn btn-primary">Read more</a>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

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
                        echo '<li ><a class="btn btn-outline-primary" href="index.php?page=' . ($page - 1) . '">Prev</a></li>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i == $page) {
                            $active = "active";
                        } else {
                            $active = "";
                        }
                        echo '<li class="' . $active . '"><a class="btn btn-outline-primary ms-1 text-decoration-none" href="index.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                    if ($total_page > $page) {
                        echo '<li class="ms-1"><a class="btn btn-outline-primary" href="index.php?page=' . ($page + 1) . '">Next</a></li>';
                    }

                    echo '</ul>';
                }
                ?>
            </div>



            <!-- ========== End Cards ========== -->
    </main>


    </div>
    <footer class="sticky-bottom ">
        <?php include "components/footer.php" ?>
    </footer>
    <script src="bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
</body>

</html>