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

    <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3">Fit Dig Frem</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    </header>

        <main>           

        <div class="container-fluid">
      <div class="row">
        <div class="col-xs-0 col-sm-1 col-md-2 col-lg-4"></div>

        <?php include 'assets/connection/database.php'; ?>
        <!-- Form start -->
        <div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 form">
          <form class="form-container" method="POST" action="assets/connection/login.php">
            <h1 class="formH1">Login</h1>

            <div class="form-group">
              <label class="labelEmail" for="Email">Email <span>*</span> </label>
              <input type="email" class="form-control" id="email" name="Email" placeholder="Email...">
            </div>
            <div class="form-group">
              <label class="labelPwd" for="labelPwd">Password <span>*</span></label>
              <input type="password" class="form-control" id="password" name="Password" placeholder="Password..." >
            </div>

            <button id="btnLogin" type="submit" name="btn_submit" class="btn btn-block">Login</button>

            <?php

                if (isset($_GET["error"])) {
                  if ($_GET["error"] == "err1") {
                    echo "<p class='errMessage' style='color:red; margin-top:2vh; font-size: 21px; text-align: center;'> Email eller password er forkert. </p>";
                  }
                  else if ($_GET["error"] == "err2") {
                    echo "<p class='errMessage' style='color:red; margin-top:2vh; font-size: 21px; text-align: center;'> Udfyld begge felter! </p>";
                  }
                  else if ($_GET["error"] == "err3") {
                    echo "<p class='errMessage' style='color:red; margin-top:2vh; font-size: 21px; text-align: center;'> Log ind for at tilgå CMS'et. </p>";
                  }
                }
            ?>

        </form>
        </div>
        <!-- Form end -->

        <div class="col-xs-0 col-sm-1 col-md-2 col-lg-4"></div>


        </main>
    
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
</body>

</html>