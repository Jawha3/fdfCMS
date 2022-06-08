<?php
# Script til visning af oversigten over alle træningsplaner

// Da der ikke er noget brugerinput er det ikke nødvendigt med en prepared statement
// istedet benyttes en select statement til at hente øvelserne
// Hvis det ikke kan lade sig gøre bliver man henvist til oversigten med en fejlbesked

$select = "SELECT * FROM PreDefineretPlan";
$stmt = sqlsrv_query($conn, $select);
if ($stmt === false) {  
  header("Location: workouts.php?error=rwErr1");
}

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
  $pid = $row['PrePlanID'];
  $workoutName = $row['PrePlanNavn'];
  $desc = $row['Description'];
  
  echo 
  "<form>                                      
    <div class='form-row'>                                            
        
    <div class='col-xxl-2 col-xl-2 col-lg-1 col-md-2 col-xs-1'></div>
      <div class='form-group col-xxl-6 col-xl-6 col-lg-8 col-md-5 col-sm-6 col-xs-6 mx-2 fullWidth'>
        <ul class='list-group fullWidth'>
            <li class='list-group-item d-flex justify-content-between lh-sm'>
                <div>
                    <h6 class='my-0'>".$workoutName."</h6>
                    <small class='text-muted'>".$desc."</small>
                </div>
            </li>
        </ul>                        
      </div>";  

      // Rediger og fjern knappen
      echo "<div class='form-group col-xxl-1 col-xl-1 col-lg-1 col-md-2 col-sm-2 col-xs-2 halfWidth m-2'>    
          <form>
            <button type='submit' formmethod='post' value='".$pid."' name='editWorkout' formaction='assets/scripts/content_processing/add_edit_workout.php?pid=".$pid."' class='btn btn-primary btn-lg col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 fullWidth smallerFont'>Rediger</button>                                                  
          </form>
      </div> 
      
      <div class='form-group col-xxl-1 col-xl-1 col-lg-1 col-md-2 col-sm-2 col-xs-2 halfWidth m-2'>
        <form>
          <button type='submit' name='removeWorkout' value='".$pid."' value='".$eid."' formmethod='post' formaction='assets/scripts/crud/delete_workout.php' class='btn btn-danger btn-lg col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 fullWidth smallerFont'>Fjern</button>                                                  
        </form>
      </div>
      <div class='col-xxl-2 col-xl-2 col-lg-1 col-md-1 col-sm-1 col-xs-1'></div>

    </div>                    
 
  </form>";

}

sqlsrv_free_stmt($stmt);

$result = sqlsrv_query($conn, $select);
if ($result === false) {  
  header("Location: workouts.php?error=rwErr2");
}
