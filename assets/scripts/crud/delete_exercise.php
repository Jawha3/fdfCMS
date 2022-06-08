<?php
# Script der håndtere sletning af øvelser

// Koden kan kun eksekveres via den røde 'Fjern' knap
if(isset($_POST['removeExercise'])) {
  require '../../connection/database.php';

  // Øvelses id'et hentes fra 'Fjern' knappen
  $eid = $_POST['removeExercise'];
  
  // Hvis id'et kan hentes eksekveres en prepared delete statement
  if(isset($eid)) {      
    
    $delete = "DELETE FROM Oevelser WHERE ExerciseID = ?";  
    $param = array($eid);
  
    $stmt = sqlsrv_query($conn, $delete, $param);

    // Hvis ikke at den Prepared Statement kan eksekvere korrekt,
    // sendes man tilbage til oversigten over alle øvelser hvor der vil forekomme en fejlbesked
    if ($stmt === false) {      
      header("Location: ../../../exercises.php?error=deErr1");
    }
    // Ved korrekt eksekvering sendes man tilbage til oversigten hvor den nye øvelse kan ses  
    else {
      header("Location: ../../../exercises.php");
    }
  }
}
// Forsøger man at aktivere koden ved at skrive den korrekte path i URL'en bliver man henvist til oversigten med en fejlbesked
else {
    header("Location: ../../../exercises.php?error=deErr2");
  exit();
}   
