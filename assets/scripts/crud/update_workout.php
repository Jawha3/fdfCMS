<?php 

# Script til håndtering af opdatering af træningsplaner

 // Koden eksekveres kun via den grønne 'Rediger' knap
if (isset($_POST['editWorkout'])) {
  // Træningsplan id'et overføres via knappen og bliver her gemt i en variabel
    $pid = $_POST['editWorkout'];       
   
     // Helt normal select statement til at hente oplysninger forbundet til det aktuelle træningsplans id
    $select = "SELECT o.ExerciseID, Navn, Repetitioner, PrePlanNavn, [Description] FROM PreDefineretPlan pdp INNER JOIN PreTraeningsplan ptp ON pdp.PrePlanID = ptp.PrePlanID INNER JOIN Oevelser o ON ptp.ExerciseID = o.ExerciseID WHERE pdp.PrePlanID=?";
    
    $param = array($pid);
    $stmt = sqlsrv_prepare($conn, $select, $param);
  
    if (sqlsrv_execute($stmt)) {
      
    }
    else {
      header("Location: ../../../workouts.php?error=uwErr1");
    }
  
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
      $exerciseID = $row['ExerciseID'];
      $exerciseName = $row['Navn'];    
      $workoutName = $row['PrePlanNavn'];
      $workoutDesc = $row['Description'];    
  
      $workoutExList .= "<div class='form-group listItems col-xl-8 col-lg-8 col-md-10 col-sm-10 fullWidth'>                
                      <ul class='list-group fullWidth'>
                          <li class='list-group-item d-flex justify-content-between lh-sm p-0 my-1'>
                              <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth p-0'>                                
                                  <label class='col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth'> 
                                      <input type='checkbox' name='cb_w[]' value=".$exerciseID."> 
                                      <span class='btn col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth'>".$exerciseName."</span> 
                                  </label>                                
                              </div>                            
                          </li>
                      </ul>                    
                  </div>";
  
     }
    sqlsrv_free_stmt($stmt);    

    $selectExercises ="SELECT * FROM Oevelser WHERE UserID is null";
    $stmtEx = sqlsrv_query($conn, $selectExercises);

    if ($stmtEx === false) {
      header("Location: ../../../workouts.php?error=uwErr2");
    }

    while ($row = sqlsrv_fetch_array($stmtEx, SQLSRV_FETCH_ASSOC)) {
      $id = $row['ExerciseID'];
      $e = $row['Navn'];
      
      // Tilføj træningsplan liste af øvelser
      $exList .= "<div class='form-group listItems col-xl-8 col-lg-8 col-md-10 col-sm-10 fullWidth'>                
                      <ul class='list-group fullWidth'>
                          <li class='list-group-item d-flex justify-content-between lh-sm p-0 my-1'>
                              <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth p-0'>                                
                                  <label class='col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth'> 
                                      <input type='checkbox' name='cb[]' value=".$id."> 
                                      <span class='btn col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth'>".$e."</span> 
                                  </label>                                
                              </div>                            
                          </li>
                      </ul>                    
                  </div>";                 
    }

    sqlsrv_free_stmt($stmtEx);

    $result = sqlsrv_query($conn, $selectExercises);

    if ($result === false) {
      header("Location: ../../../workouts.php?error=uwErr3");
    }   
}

elseif (isset($_POST['saveWorkout'])) {
  require '../../connection/database.php';

    //Begin transaction
    if(sqlsrv_begin_transaction($conn) === false) {
      header("Location: ../../../workouts.php?error=uwErr4");
    }

    // Initialize parameter values
    $pid = $_POST['saveWorkout'];
    $wName = $_POST['workoutName'];
    $wDesc = $_POST['workoutDesc'];
    $editEx = $_POST['cb_w'];
    $addEx = $_POST['cb'];

    if(!empty($workoutName) && !empty($workoutDesc)) {
       // Set up and execute update query
      $update = "UPDATE PreDefineretPlan SET PrePlanNavn = ?, [Description] = ? WHERE PrePlanID = ?";
      $updateParams = array($wName, $wDesc, $pid);
      $updateStmt = sqlsrv_query($conn, $update, $updateParams);
    }
    elseif(!empty($wName)) {
       // Set up and execute update query
       $update1 = "UPDATE PreDefineretPlan SET PrePlanNavn = ? WHERE PrePlanID = ?";
       $updateParams1 = array($wName, $pid);
       $updateStmt1 = sqlsrv_query($conn, $update1, $updateParams1);
    }
    elseif (!empty($wDesc)) {
       // Set up and execute update query
       $update2 = "UPDATE PreDefineretPlan SET [Description] = ? WHERE PrePlanID = ?";
       $updateParams2 = array($wDesc, $pid);
       $updateStmt2 = sqlsrv_query($conn, $update2, $updateParams2);
    }
 
    // Set up and execute insert query
    $insert = "INSERT INTO PreTraeningsplan (PrePlanID, ExerciseID) VALUES(?, ?)";

    foreach($addEx as $checked) {
      $insertParams = array($pid, $checked);
      $insertStmt = sqlsrv_query($conn, $insert, $insertParams); 
    }    

    // Set up and execute delete query
    $delete = "DELETE FROM PreTraeningsplan WHERE ExerciseID = ?";

    foreach ($editEx as $check) {
      $deleteParams = array($check);
      $deleteStmt = sqlsrv_query($conn, $delete, $deleteParams);
    }
  
    // If all queries are successful, commit the transaction
    // Otherwise, rollback the transaction
    if($updateStmt || $insertStmt || $deleteStmt || $updateStmt || $updateStmt1 || $updateStmt2) {
      sqlsrv_commit($conn);
      header("Location: ../../../workouts.php");
    }
    else {
      sqlsrv_rollback($conn);
      header("Location: ../../../workouts.php?error=uwErrEf");
    }

    // Free statement and connection resources
    sqlsrv_free_stmt($updateStmt);
    sqlsrv_free_stmt($updateStmt1);
    sqlsrv_free_stmt($updateStmt2);
    sqlsrv_free_stmt($insertStmt);
    sqlsrv_free_stmt($deleteStmt);
    sqlsrv_close($conn);   
}