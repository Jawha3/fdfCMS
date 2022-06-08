<?php
session_start();
require 'assets/connection/database.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fit Dig Frem</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/custom_style.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/main_layout.css" rel="stylesheet">

    <!-- Media Queries -->
    <link href="assets/css/mediaQueries.css" rel="stylesheet">
   

</head>

<body>

            <?php 
                $page = "ad_page";
                include 'includes/header_sidebar.php';                 
            ?>

            <main class="ms-sm-auto col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Reklamer</h2>
                    <form action="assets/scripts/content_processing/add_edit_exercises.php" method="post">
                        <!-- <button type="submit" name='addExercise' class="btn btn-primary btn-lg col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">Tilføj reklame</button> -->
                    </form>
                </div>

                <h3>Under udvikling..</h3>                

            </main>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
</body>

</html>