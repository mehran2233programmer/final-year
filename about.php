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

            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">About Us</h1>
                    <p class="col-md-12 fs-4">This web application provides the facility to residents to get different services through the internet. Residents might have to face many issues related to common services like Cable, Internet, house maintenance, and repairs in their housing societies. So, a housing society needs to have a web application that the residents can use to available common services and this app is doing all that work. </p>
                </div>
            </div>

    </main>


    </div>
    <footer class="fixed-bottom ">
        <?php include "components/footer.php" ?>
    </footer>
    <script src="bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
</body>

</html>