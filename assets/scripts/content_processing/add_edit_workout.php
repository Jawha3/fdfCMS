<?php
session_start();
require '../../connection/database.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fit Dig Frem</title>

    <!-- Bootstrap core CSS -->
    <link href="../../bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/custom_style.css">
 
    <!-- Custom styles for this template -->
    <link href="../../css/main_layout.css" rel="stylesheet">

    <!-- Media Queries -->
    <link href="../../css/mediaQueries.css" rel="stylesheet">
   
</head>

<body>

            <?php 
                include '../../../includes/header_sidebar.php'; 
                $page = "workouts";                
            ?>

            <main class="ms-sm-auto col-xl-10 col-lg-10 col-md-10 col-sm-12">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <?php 
                        if (isset($_POST['addWorkout'])) {
                            echo "<h2>Tilføj træningsplan</h2>";
                        }
                        elseif (isset($_POST['editWorkout'])){
                            echo "<h2>Redigér træningsplan</h2>";
                        }
                    ?>
                                        
                </div>            
                
                <?php
                    if(isset($_POST['addWorkout'])) {

                        echo "<form action='../crud/create_workout.php' method='post' class='py-3'>
                                <div class='form-row col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth'>

                                <div class='col-xxl-1 col-xl-1 col-lg-1 col-md-1 col-sm-1'></div>

                                <div class='form-group col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 fullWidth'>
                                    <label class='workout-labels' for=''>Navn:</label>
                                    <input class='list-group-item col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth' name='workoutName' type='text'>                            
                                </div>

                                <div class='col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2'></div>

                                <div class='form-group col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 fullWidth'>
                                    <label class='workout-labels' for=''>Beskrivelse:</label>
                                    <input class='list-group-item col-xxl-12 col-xl-12 col-md-12 col-sm-12 fullWidth' name='workoutDesc' type='text'>                            
                                </div>

                                <div class='col-xxl-1 col-xl-1 col-lg-1 col-md-1 col-sm-1'></div>

                                </div>

                                <div class='m-4'>
                                    <h5 class='infoHeadline'>Tryk på øvelser for at tilføje dem til træningsplanen</h5>
                                </div>";

                                include '../crud/create_workout.php';
                                echo $exList;

                            echo "<div class='form-row btns'>
                                    <a href='../../../workouts.php' class='btn btn-danger  btn-lg mx-2 my-5'>Annuller</a>
                                    <button  type='submit' class='btn btn-primary  btn-lg  mx-2 my-5' name='saveWorkout' >Gem</button>
                                </div>
                            </form>";    
                    }

                    elseif (isset($_POST['editWorkout'])) {

                        echo "<form action='../crud/update_workout.php' method='post' class='py-3'>
                                <div class='form-row col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth'>

                                <div class='col-xxl-1 col-xl-1 col-lg-1 col-md-1 col-sm-1'></div>";
                                include '../crud/update_workout.php';

                        echo    "<div class='form-group col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 fullWidth'>
                                    <label class='workout-labels' for=''>Navn:</label>
                                    <input class='list-group-item col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth' type='text' name='workoutName' placeholder='".$workoutName."'>                            
                                </div>

                                <div class='col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2'></div>

                                <div class='form-group col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 fullWidth'>
                                    <label class='workout-labels' for=''>Beskrivelse:</label>
                                    <input class='list-group-item col-xxl-12 col-xl-12 col-md-12 col-sm-12 fullWidth' type='text' name='workoutDesc' placeholder='".$workoutDesc."' >                            
                                </div>

                                <div class='col-xxl-1 col-xl-1 col-lg-1 col-md-1 col-sm-1'></div>

                                </div>";

                                
                                echo "<div class='form-row col-xxl-12 col-xl-12 col-md-12 col-sm-12 fullWidth my-4'>

                                    <div class='listItems col-xxl-6 col-xl-6 col-md-6 col-sm-6 fullWidth'>
                                        <h5 class='infoHeadline'>Tryk på øvelser for at fjerne dem fra træningsplanen</h5>
                                        
                                        <div class='col-xxl-12 col-xl-12 col-md-12 col-sm-12 fullWidth'>
                                             $workoutExList
                                         </div>
                                    </div>";                                    
                                    
                                    echo "<div class='listItems col-xxl-6 col-xl-6 col-md-6 col-sm-6 fullWidth'>
                                            <h5 class='infoHeadline'>Tryk på øvelser for at tilføje dem til træningsplanen</h5>

                                            <div class='col-xxl-12 col-xl-12 col-md-12 col-sm-12 fullWidth'>
                                                $exList
                                            </div>

                                        </div>";                                        

                                        

                                echo "</div>";


                                // echo $exList;

                                
                                // Listen af øvelser der findes i den aktuelle træningsplan bliver appended i update_workout.php og udskrevet her
                                

                            echo "<div class='form-row btns'>
                                    <a href='../../../workouts.php' class='btn btn-danger  btn-lg mx-2 my-5'>Annuller</a>
                                        <button  type='submit' value=".$_POST['editWorkout']." class='btn btn-primary  btn-lg  mx-2 my-5' name='saveWorkout'>Gem</button>
                                    </div>
                                </form>";    
                    }
                ?>                             

            </main>
        </div>
    </div>

    <script src="../../js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
</body>

</html>