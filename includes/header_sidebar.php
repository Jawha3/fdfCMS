<header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3">Fit Dig Frem</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
</header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-xl-2 col-lg-2 col-md-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky d-flex align-items-start flex-column mb-auto pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">

                        <?php 
                            if($page == 'workouts') {
                               echo "<a class='nav-link active' href='/workouts.php'>
                                    <span data-feather='home'></span>
                                    Træningsplaner
                                </a>";
                            }
                                                     
                            else {
                                echo "<a class='nav-link' href='/workouts.php'>
                                    <span data-feather='home'></span>
                                    Træningsplaner
                                </a>"; 
                            }
                            ?>                             
                        </li>
                        <li class="nav-item ">

                            <?php 
                                if ($page == 'exercises') {
                                   
                                    echo "<a class='nav-link active' href='/exercises.php' >
                                    <span data-feather='file'></span>
                                    Øvelser
                                </a>";
                                }
                                else {
                                    echo "<a class='nav-link ' href='/exercises.php' >
                                    <span data-feather='file'></span>
                                    Øvelser
                                </a>";
                                }
                            
                            ?>                            
                            
                        </li>
                        <li class="nav-item">
                        <?php 
                                if ($page == 'ad_page') {
                                    echo "<a class='nav-link active' href='/ad_page.php' >
                                    <span data-feather='shopping-cart'></span>
                                    Reklamer
                                </a>";
                                }
                                else {
                                    echo "<a class='nav-link ' href='/ad_page.php' >
                                    <span data-feather='shopping-cart'></span>
                                    Reklamer
                                </a>";
                                }
                            
                            ?>                            
                        </li>                  
                    </ul>
                </div>
                <div class="position-sticky d-flex align-items-start flex-column pt-3 logItem">
                    <ul class="nav flex-column">                        
                        <li class="nav-item">                          
                         <?php echo "<p class='nav-link loggedUser'>Logget ind som: ".$_SESSION['Fornavn']."</p>" ?>                            
                        </li>
                        <?php
                            if (isset($_SESSION["id"])) {
                                echo "<li class='nav-item bottom'>
                                <a class='nav-link  logout' href='/assets/connection/logout.php'>
                                    <span data-feather='users'></span>
                                    Log Ud
                                </a>
                            </li> ";
                            }
                            else {
                                header("Location: ../index.php?error=err3");
                                exit;
                            }
                        ?>

                    </ul>
                </div>
            </nav>