<?php
session_start();
?>
<div class="side  col-md-3 bg-white text-white" style="border: 1px solid grey;">
    <h3 class="text-center text-white bg-dark p-3 m-0"><strong>
            <div class="dropdown open">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['name'] ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="triggerId">
                    <button class="dropdown-item" href="#"><a href="logout.php" class="text-decoration-none text-black">Logout</a></button>

                </div>
            </div>
        </strong></h3>

    <!-- Hover added -->
    <?php
    if ($_SESSION['role'] == "admin") {

        echo '<div class="list-group ">
        <a href="dashboard_requests.php" class="list-group-item list-group-item-action ">Joining Requests</a>
        <a href="dashboard_add_workers.php" class="list-group-item list-group-item-action">Add Service Provider</a>
        <a href="dashboard_orders.php" class="list-group-item list-group-item-action">Orders</a>
        <a href="dashboard_residents.php" class="list-group-item list-group-item-action">Residents</a>
        <a href="dashboard_add_category.php" class="list-group-item list-group-item-action">Add Category</a>
        <a href="dashboard_feedback.php" class="list-group-item list-group-item-action">Feedback</a>
    </div>
';
    } elseif ($_SESSION['role'] == "worker") {
        echo '<div class="list-group "><a href="dashboard_orders.php" class="list-group-item list-group-item-action">Orders</a> 
        <a href="dashboard_feedback.php" class="list-group-item list-group-item-action">Feedback</a> </div>';
    } else {
        header('location:index.php');
    }
    ?>
    <?php
    echo '</div>';
    ?>