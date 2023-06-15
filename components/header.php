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
            include "db_connect.php";
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
</script>