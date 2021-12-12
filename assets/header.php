<?php 
$ini = parse_ini_file('app.ini');
include("functions.php");
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <title><?php echo $ini['app_name']; ?></title>
    </head>

    <body style="height: 100%;">
        <nav class="navbar navbar-expand-md bg-light navbar-light">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand" href="index.php"> <i class="fas fa-pound-sign"></i> <?php echo $ini['app_name']; ?></a>

                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <?php 
                        if (!isLoggedIn($_SESSION)){
                            echo '<li class="nav-item"><a class="nav-link" href="register_intrest.php">Join Campaign</a></li>';
                        } 
                        if(isLoggedInAsAdmin($_SESSION)){
                            echo '<li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>';
                        } ?>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                    <?php 
                        if (isLoggedInAsAdmin($_SESSION)){
                            echo '<li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Hello, '. $_SESSION["AdminName"].' </a> <div class="dropdown-menu" aria-labelledby="navbarDropdown"> <a class="dropdown-item" href="logout.php">Logout</a> </div></li>';
                        }if(isLoggedInAsUser($_SESSION)){ 
                            echo '<li class="nav-item"> <a class="nav-link" href="customer_logged_in.php">Application</a> </li><li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Hello, '. $_SESSION["lname"].' </a> <div class="dropdown-menu" aria-labelledby="navbarDropdown"> <a class="dropdown-item" href="logout.php">Logout</a> </div></li>';
                        }elseif(!isLoggedIn($_SESSION)){
                            echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li><li class="nav-item"><a class="nav-link" href="Admin.php">Admin</a></li>';
                        }
                    ?>
                        
                    </ul>
                </div>
            </div>
        </nav>