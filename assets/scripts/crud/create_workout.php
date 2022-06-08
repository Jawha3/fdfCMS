<?php
include '../../connection/database.php';
# Script der håndtere tilføjelse af nye træningsplaner

//Normal SELECT statement til at hente alle øvelser
$selectExercises = 'SELECT * FROM Oevelser WHERE UserID is null';
$stmtEx = sqlsrv_query($conn, $selectExercises);

if($stmtEx == false) {
    header("Location: ../../../../workouts.php?error=cwErr1");
}

// Listen af alle øvelser der ikke er lavet af brugere
while ($row = sqlsrv_fetch_array($stmtEx, SQLSRV_FETCH_NUMERIC)) {
               
    $exList.= "<div class='form-group listItems col-xl-6 col-lg-6 col-md-6 col-sm-6 fullWidth'>                
                    <ul class='list-group fullWidth'>
                        <li class='list-group-item d-flex justify-content-between lh-sm p-0'>
                            <div class='listItems col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth p-0'>                                
                                <label class='col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth'> 
                                    <input type='checkbox' name='cb[]' value=".$row[0]."> 
                                    <span class='btn col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth'>".$row[1]."</span> 
                                </label>                                
                            </div>                            
                        </li>
                    </ul>                    
                </div>";

}

sqlsrv_free_stmt($stmtEx);

$result = sqlsrv_query($conn, $selectExercises);

if($result === false) {
    header("Location: ../../../../workouts.php?error=cwErr2");
}

// Følgende kode kan kun eksekveres via 'Gem' knappen
if (isset($_POST['saveWorkout'])) {  
  require '../../connection/database.php';
  
  // Input for navn og beskrivelse af plan bliver hentet og gemt i variabler
  $navn = $_POST['workoutName'];
  $desc = $_POST['workoutDesc'];   

  if(empty($navn) || empty($desc)) {
    header("Location: ../../../../workouts.php?error=cwErrEf");
  } 
  else {
    
    // Prepared statement til at gemme planen
    $insert = "INSERT INTO PreDefineretPlan (PrePlanNavn, [Description]) VALUES(?, ?)";
    $param = array($navn, $desc);
    
    $stmt = sqlsrv_prepare($conn, $insert, $param);
    
      
    if (sqlsrv_execute($stmt)) { 
      // Hvis planen bliver oprettet korrekt hentes id'et for den nye oprettede plan
      $selectid = "SELECT @@IDENTITY AS lastID";
        
      $idstmt = sqlsrv_query($conn, $selectid);
      if ($idstmt === false) {
        header("Location: ../../../../workouts.php?error=cwErr3");
      }
        
      // Id'et bliver her brugt til at indsætte øvelser til planen via en prepared statement
      while ($row = sqlsrv_fetch_array($idstmt, SQLSRV_FETCH_ASSOC)) {
        // Id'et samt id-arrayet af øvelser der er valgt bliver hentet og gemt i variabler
        $lastId = $row['lastID'];
        $arr = $_POST['cb'];
          
        $insertEx = "INSERT INTO PreTraeningsplan (PrePlanID, ExerciseID) VALUES(?, ?)";
    
        // Foreach loop bliver brugt for at itirere igennem arrayet af øvelserne således at alle valgte øvelser tilføjes
        foreach($arr as $checked) {    
            
          $params = array($lastId, $checked);         
            
          $instStmt = sqlsrv_prepare($conn, $insertEx, $params);
    
          // Hvis arrayet af øvelser kan indsættes korrekt videresendes man til oversigten
          // hvis det fejler 
          if (sqlsrv_execute($instStmt)) {    
            header("Location: ../../../../workouts.php");            
          } 
              
          else {            
            header("Location: ../../../../workouts.php?error=cwErr4");
          } 
        }      
      }   
        
      sqlsrv_free_stmt($idstmt);
    
      $idresult = sqlsrv_query($conn, $selectid);
      if ($idresult === false) {
        header("Location: ../../../../workouts.php?error=cwErr5");
      }
        
    } 
    
    else {
      header("Location: ../../../../workouts.php?error=cwErr6");
    } 
      
    sqlsrv_free_stmt($instStmt);          
    sqlsrv_free_stmt($stmt);
    
    sqlsrv_close($conn);

  }
     
} 