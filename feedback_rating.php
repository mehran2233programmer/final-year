 <!doctype html>
 <html lang="en">

 <head>
     <title>Rating</title>
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

     .active {
         background: #4481eb;
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
                    include "components/header.php";
                    ?>
                 <?php
                    // session_start();
                    include "components/db_connect.php";
                    // $_SESSION['fid'] = $_GET['id'];
                    if (isset($_POST['submit'])) {


                        $_SESSION['id'];
                        $cat_id = $_POST['cat_id'];
                        $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);
                        $rating = mysqli_real_escape_string($conn, $_POST['rating']);
                        $sql = "INSERT INTO `feedback`(`feedback`, `rating`, `feedback_resident_id`, `feedback_category_id`) VALUES ('$feedback','$rating','{$_SESSION['id']}','$cat_id')";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            //         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                            //     <strong>Feedback added!</strong>
                            // </div>
                            // ';



                            header("location:feedback_rating.php?id=$cat_id");
                        }
                    }
                    ?>
             </header>
             <div class="container">
                 <!-- ========== Start Jumbotron ========== -->

                 <?php

                    include "components/db_connect.php";
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM category where category_id=$id";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($result)) {
                        $title = $row['category_title'];
                        $cat_desc = $row['category_description'];
                    }
                    ?>

                 <div class="p-5 mb-4 bg-light rounded-3 shadow">
                     <div class="container-fluid py-5">
                         <h1 class="display-5 fw-bold"> <?php echo $title ?></h1>
                         <p class="col-md-8 fs-4"><?php echo $cat_desc ?>.</i></p>
                         <a href="order_service.php?cat_id=<?php echo $id ?>" class="btn btn-primary">ORDER NOW</a>
                     </div>
                 </div>

                 <!-- ========== End Jumbotron ========== -->
                 <!-- ========== Start Feedback and ratings ========== -->
                 <h3 class="text-center my-4">Feedback</h3>
                 <div class="container">

                     <?php
                        $limit = 5;
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $offset = ($page - 1) * $limit;
                        $sql = "SELECT * FROM feedback where feedback_category_id=$id LIMIT {$offset},{$limit}";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $feedback = $row['feedback'];
                            $rating = $row['rating'];
                            $resident_id = $row['feedback_resident_id'];
                            $sql1 = "SELECT*FROM residents where resident_id=$resident_id";
                            $result1 = mysqli_query($conn, $sql1);
                            $row = mysqli_fetch_assoc($result1);
                            $name = $row['resident_fname'];
                            $lname = $row['resident_lname'];



                        ?>

                         <div class="d-flex shadow mt-4 p-3">
                             <div class="flex-shrink-0">
                                 <!-- <img src="" alt="" width="70"> -->
                             </div>
                             <div class="flex-grow-1 ms-3">
                                 <h5 class="mt-0"><?php echo $name, " ", $lname, "." ?>

                                 </h5>
                                 <p>Rating: <i class="fa fa-star-half-stroke" style="color:gold"></i> <?php echo $rating ?></p>
                                 <p><?php echo $feedback ?></p>


                             </div>
                         </div>
                     <?php
                        }
                        // show pagination
                        $sql1 = "SELECT * FROM feedback";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                        if (mysqli_num_rows($result1) > 0) {

                            $total_records = mysqli_num_rows($result1);

                            $total_page = ceil($total_records / $limit);

                            echo '<ul class="pagination admin-pagination d-flex justify-content-center my-5">';
                            if ($page > 1) {
                                echo '<li ><a class="btn btn-outline-primary" href="feedback_rating.php?page=' . ($page - 1) . '&id=' . $id . '">Prev</a></li>';
                            }
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $page) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                echo '<li class=""><a class="btn ' . $active . ' btn-outline-primary ms-1 text-decoration-none" href="feedback_rating.php?page=' . $i .  '&id=' . $id . '">' . $i . '</a></li>';
                            }
                            if ($total_page > $page) {
                                echo '<li class="ms-1"><a class="btn btn-outline-primary" href="feedback_rating.php?page=' . ($page + 1) . '&id=' . $id . '">Next</a></li>';
                            }

                            echo '</ul>';
                        }

                        ?>

                     <hr>
                     <!-- ========== Start Form ========== -->
                     <?php
                        if (isset($_SESSION['loggedin'])) {
                            if ($_SESSION['role'] == 'resident' || $_SESSION['role'] == 'admin') {
                        ?>

                             <h3 class="text-center mt-3">Give a feedback</h3>
                             <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="shadow">
                                 <div class="container col-md-6 p-3 mb-3">
                                     <div class="mb-3 ">
                                         <label for="" class="form-label">Write Feedback</label>
                                         <input type="hidden" name="cat_id" value="<?php echo $id ?>">
                                         <textarea class="form-control" name="feedback" id="feedback" rows="3" Required></textarea>
                                     </div>
                                     <div class="mb-3 col-md-3">
                                         <label for="" class="form-label">Rate us</label>
                                         <select class="form-select form-select-lg" name="rating" id="" Required>
                                             <option selected>Select</option>
                                             <option value="5">5 Star</option>
                                             <option value="4">4 Star</option>
                                             <option value="3">3 Star</option>
                                             <option value="2">2 Star</option>
                                             <option value="1">1 Star</option>
                                         </select>
                                     </div>
                                     <div class="d-flex">
                                         <button type="submit" class="btn btn-primary ms-auto" name="submit">Submit</button>
                                     </div>
                                 </div>
                             </form>

                     <?php
                            }
                        }
                        ?>
                     <!-- ========== End Form ========== -->

                 </div>
                 <!-- ========== End Feedback and ratings ========== -->

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