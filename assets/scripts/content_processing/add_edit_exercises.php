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
                $page = "exercises";
            ?>

            <main class="ms-sm-auto col-xl-10 col-lg-10 col-md-10 col-sm-12">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <?php 
                        if (isset($_POST['addExercise'])) {
                            echo "<h2>Tilføj øvelse</h2>";
                        }
                        elseif (isset($_POST['editExercise'])){
                            echo "<h2>Redigér øvelse</h2>";
                        }
                    ?>
                                        
                </div> 

                <?php
                    if(isset($_POST['addExercise'])) {

                        echo "<form action='../crud/create_exercise.php' method='post' class='py-3'>
                                <div class='form-row col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth'>       
                                
                                   
                                    <div class='form-group col-xxl-6 col-xl-5 col-lg-6 col-md-6 col-sm-12 fullWidth mx-2'>
                                        <label class='workout-labels' for=''>Navn:</label>
                                        <input class='list-group-item col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth' name='exerciseName' type='text'>                            
                                    </div>             

                                    <div class='form-group col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-12 fullWidth mx-2'>
                                        <label class='workout-labels' for=''>Repetitioner:</label>
                                        <input class='list-group-item col-xxl-3 col-xl-4 col-md-5 col-sm-12 fullWidth' name='exerciseRep' type='text'>                            
                                    </div>   
                                                                        

                                    <div class='form-row col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth'>  

                                    <div class='form-group col-xxl-6 col-xl-5 col-lg-6 col-md-6 col-sm-12 fullWidth mx-2'>
                                        <label class='workout-labels' for=''>Beskrivelse:</label>
                                        <input class='list-group-item col-xxl-12 col-xl-12 col-md-12 col-sm-12 fullWidth' name='exerciseDesc' type='text'>                            
                                    </div>                                                                            

                                    <div class='form-group col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-12 fullWidth mx-2'>
                                        <label class='workout-labels' for=''>Sæt:</label>
                                        <input class='list-group-item col-xxl-3 col-xl-4 col-md-5 col-sm-12 fullWidth' name='exerciseSet' type='text'>                            
                                    </div>   
                                                                             
                                    </div>

                                </div>";                                                             

                            echo "<div class='form-row btns'>
                                    <a href='../../../exercises.php' class='btn btn-danger  btn-lg mx-2 my-5'>Annuller</a>
                                    <button  type='submit' class='btn btn-primary  btn-lg  mx-2 my-5' name='saveExercise' >Gem</button>
                                </div>
                            </form>";    
                    }
                    
                   elseif(isset($_POST['editExercise'])) {
                        
                        echo "<form action='../crud/update_exercise.php' method='post' class='py-3'>";
                                include '../crud/update_exercise.php';
                        
                        echo    "<div class='form-row col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth'>  
                          
                                                                
                                    <div class='form-group col-xxl-6 col-xl-5 col-lg-6 col-md-6 col-sm-12 fullWidth mx-2'>
                                        <label class='workout-labels' for=''>Navn:</label>
                                        <input class='list-group-item col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth' placeholder='".$exerciseName."' name='exerciseName' type='text'>                            
                                    </div>    
                                    
                                    <div class='form-group col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-12 fullWidth mx-2'>
                                            <label class='workout-labels' for=''>Repetitioner:</label>
                                            <input class='list-group-item col-xxl-3 col-xl-4 col-md-5 col-sm-12 fullWidth' placeholder='".$exerciseRep."' name='exerciseRep' type='text'>                            
                                        </div>

                                    <div class='form-row col-xl-12 col-lg-12 col-md-12 col-sm-12 fullWidth'>  

                                       
                                        <div class='form-group col-xxl-6 col-xl-5 col-lg-6 col-md-6 col-sm-12 fullWidth mx-2'>
                                            <label class='workout-labels' for=''>Beskrivelse:</label>
                                            <input class='list-group-item col-xxl-12 col-xl-12 col-md-12 col-sm-12 fullWidth' placeholder='".$exerciseDesc."' name='exerciseDesc' type='text'>                            
                                        </div>

                                       
                                        <div class='form-group col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-12 fullWidth mx-2'>
                                            <label class='workout-labels' for=''>Sæt:</label>
                                            <input class='list-group-item col-xxl-3 col-xl-4 col-md-5 col-sm-12 fullWidth' placeholder='".$exerciseSet."' name='exerciseSet' type='text'>                            
                                        </div>   
                                    
                                    </div>

                                </div>";                                                             

                            echo "<div class='form-row btns'>
                                    <a href='../../../exercises.php' class='btn btn-danger  btn-lg mx-2 my-5'>Annuller</a>
                                    <button  type='submit' value=".$_POST['editExercise']." class='btn btn-primary  btn-lg  mx-2 my-5' name='saveExercise' >Gem</button>
                                </div>
                            </form>";    
                    }
                    

                    ?>