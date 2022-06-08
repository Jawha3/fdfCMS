<?php
# Script til håndtering af login funktion

require 'database.php';

// Ved tryk på login knappen, køre efterfølgende kode
if (isset($_POST['btn_submit'])) {

  // Input fra login form bliver hentet og gemt i variabler
  $email = $_POST['Email'];
  $pwd = $_POST['Password'];

  // Hvis begge felter bliver udfyldt starter login processen
  if ($email != "" && $pwd != "") {

    // Kun admins (medlemmer med Rolle 2 i databasen), kan logge ind i CMS'et
    // SQL Injections undgås ved hjælp af en Prepared Statement, som tjekker hvorvidt brugeren findes i databasen
    // ved at binde input variablerne til den aktuelle Prepared Statement
    $query = "SELECT * FROM Bruger WHERE Email = ? AND Password = ? AND Rolle=2";
  
    $param = array($email, $pwd);
    $stmt = sqlsrv_prepare($conn, $query, $param);

    if (sqlsrv_execute($stmt)) {

      if (sqlsrv_fetch($stmt)) {
        $id = sqlsrv_get_field($stmt, 0);
        $fornavn = sqlsrv_get_field($stmt, 1);
        $dbEmail = sqlsrv_get_field($stmt, 3);
        $dbPass = sqlsrv_get_field($stmt, 4);

        // Sammenligner login-informationer fra formen med dem i databasen
        // Hvis det stemmer overens gemmes påbegyndes en by session og id, fornavn og mail bliver gemt i SESSION variabler
        if ($pwd === $dbPass && $email === $dbEmail) {
          session_start();
          $_SESSION["id"] = $id;
          $_SESSION["Fornavn"] = $fornavn;
          $_SESSION["mail"] = $dbEmail;

          header("Location: ../../workouts.php");
          exit();
        }

      } 

      // Stemmer informationerne ikke overens får brugeren en fejlbesked på loginformen
      if ($pwd !== $dbPass || $email !== $dbEmail) {
        header("Location: ../../index.php?error=err1");
        exit();
      }
    } 
    else {
      echo "Statement could not be executed. <br />";
      die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

  } 

  else {
    header("Location: ../../index.php?error=err2");
    exit();
  }
} 