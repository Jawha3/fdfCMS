<?php    
# Script til håndtering af opdatering af øvelser

// Koden eksekveres kun via den grønne 'Rediger' knap
if (isset($_POST['editExercise'])) {

    // Øvelses id'et overføres via knappen og bliver her gemt i en variabel
    $exId = $_POST['editExercise'];

    // Helt normal select statement til at hente oplysninger forbundet til det aktuelle øvelses id
    $select = "SELECT ExerciseID, Navn, Repetitioner, Saet, OevelseDesc FROM Oevelser WHERE ExerciseID = ?";
    $param = array($exId);

    $stmt = sqlsrv_prepare($conn, $select, $param);

    if (sqlsrv_execute($stmt)) {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $eid = $row['ExerciseID'];
            $exerciseName = $row['Navn'];
            $exerciseRep = $row['Repetitioner'];
            $exerciseSet = $row['Saet'];
            $exerciseDesc = $row['OevelseDesc'];
        }       
    }
    else {
        header("Location: ../../../exercises.php?error=ueErr1");
    }        
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);    
   
}

// Følgende kode kan kun eksekveres via den grønne 'Gem' knap
elseif (isset($_POST['saveExercise'])) {  
    require '../../connection/database.php'; 
    
    //Begin transaction
    if(sqlsrv_begin_transaction($conn) === false) {
        header("Location: ../../../exercises.php?error=ueErr2");
      }

    // Input fra formen hentes og gemmes i variabler til brug i efterfølgende prepared statement
    $id = $_POST['saveExercise'];
    $exerciseName = $_POST['exerciseName'];
    $exerciseRep = $_POST['exerciseRep'];
    $exerciseSet = $_POST['exerciseSet'];
    $exerciseDesc = $_POST['exerciseDesc'];

    if(!empty($exerciseName) && !empty($exerciseRep) && !empty($exerciseSet) && !empty($exerciseDesc)) {
        // Prepared statement
        $updateEx = "UPDATE Oevelser SET Navn = ?, Repetitioner = ?, Saet = ?, OevelseDesc = ? WHERE ExerciseID = ?";
        $exParam = array($exerciseName, $exerciseRep, $exerciseSet, $exerciseDesc, $id);

        $stmt1 = sqlsrv_query($conn, $updateEx, $exParam);
    }
    
    elseif(!empty($exerciseName)) {

        // Prepared statement
        $updateName = "UPDATE Oevelser SET Navn = ? WHERE ExerciseID = ?";
        $nameParam = array($exerciseName, $id);

        $stmt2 = sqlsrv_query($conn, $updateName, $nameParam);

    }

    elseif(!empty($exerciseRep)) {
        // Prepared statement
        $updateRep = "UPDATE Oevelser SET Repetitioner = ? WHERE ExerciseID = ?";
        $repParam = array($exerciseRep, $id);

        $stmt3 = sqlsrv_query($conn, $updateRep, $repParam);
    }

    elseif(!empty($exerciseSet)) {
        // Prepared statement
        $updateSet = "UPDATE Oevelser SET Saet = ? WHERE ExerciseID = ?";
        $setParam = array($exerciseSet, $id);

        $stmt4 = sqlsrv_query($conn, $updateSet, $setParam);
    }    

    elseif(!empty($exerciseDesc)) {
        // Prepared statement
        $updateDesc = "UPDATE Oevelser SET OevelseDesc = ? WHERE ExerciseID = ?";
        $descParam = array($exerciseDesc, $id);

        $stmt5 = sqlsrv_query($conn, $updateDesc, $descParam);
    }   
    
    // If all queries are successful, commit the transaction
    // Otherwise, rollback the transaction
    if($stmt1 || $stmt2 || $stmt3 || $stmt4 || $stmt5) {
        sqlsrv_commit($conn);
        header("Location: ../../../exercises.php");
      }
    else {
        sqlsrv_rollback($conn);
        header("Location: ../../../exercises.php?error=ueErrEf");
    }

    sqlsrv_free_stmt($stmt1);
    sqlsrv_free_stmt($stmt2);
    sqlsrv_free_stmt($stmt3);
    sqlsrv_free_stmt($stmt4);
    sqlsrv_free_stmt($stmt5);
    sqlsrv_close($conn);    

}
