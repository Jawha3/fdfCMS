<?php
# Script der håndtere tilføjelse af nye øvelser

// Koden kan kun eksekveres via den grønne 'Gem' knap
if(isset($_POST['saveExercise'])){
    require '../../connection/database.php';

    // Input fra formen bliver gemt i variabler
    $exName = $_POST['exerciseName'];
    $exRep = $_POST['exerciseRep'];
    $exSet = $_POST['exerciseSet'];
    $exDesc = $_POST['exerciseDesc'];

    if(empty($exName) || empty($exRep) || empty($exSet)|| empty($exDesc)) {
        header("Location: ../../../../index.php?error=ceErrEf");
      } 

    // Prepared statement bliver lavet og de overstående variabler bliver benyttet
    $insert = "INSERT INTO Oevelser (Navn, Repetitioner, Saet, OevelseDesc) VALUES (?, ?, ?, ?)"; // SQL-Kommando
    $param = array($exName, $exRep, $exSet, $exDesc); // Brugerleveret data

    $stmt = sqlsrv_prepare($conn, $insert, $param);

    // Hvis ikke at den Prepared Statement kan eksekveres korretk,
    // sendes man tilbage til oversigten over alle øvelser hvor der vil forekomme en fejl-besked
    if(!$result = sqlsrv_execute($stmt)) {
        header("Location: ../../../exercises.php?error=ceErr1");
    }
    // Ved korrekt eksekvering sendes man tilbage til oversigten hvor den nye øvelse kan ses
    else {
        header("Location: ../../../exercises.php");
    }
}

// Forsøger man at aktivere koden ved at skrive den korrekte path i URL'en bliver man henvist til oversigten med en fejlbesked
else {
    header("Location: ../../../exercises.php?error=ceErr2");
}