<?php     
# Script der håndtere sletning af træningsplaner

// Koden kan kun eksekveres via den røde 'Fjern' knap
if(isset($_POST['removeWorkout'])) {
  require '../../connection/database.php';

  // Træningsplan id'et hentes fra 'Fjern' knappen
  $pid = $_POST['removeWorkout'];

  // Hvis id'et kan hentes eksekveres en prepared delete statement
  if(isset($pid)) { 
    
    $delete = "DELETE FROM PreDefineretPlan WHERE PrePlanID = ?";
    $param = array($pid);

    // Hvis ikke at den Prepared Statement kan eksekvere korrekt,
    // sendes man tilbage til oversigten over alle træningsplaner hvor der vil forekomme en fejlbesked
    $stmt = sqlsrv_query($conn, $delete, $param);
    if ($stmt === false) {      
      header("Location: ../../../index.php?error=dwErr1");
    }
    // Ved korrekt eksekvering sendes man tilbage til oversigten hvor den nye øvelse kan ses  
    else {
        header("Location: ../../../workouts.php");
    }

  }
}
// Forsøger man at aktivere koden ved at skrive den korrekte path i URL'en bliver man henvist til oversigten med en fejlbesked
else {
    header("Location: ../../../workouts.php?error=dwErr2");
  exit();
}
    