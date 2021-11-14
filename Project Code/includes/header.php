<?php
  session_start(); //starts session for the whole website as long as webpage connected to header.php
  require_once './src/functions_src.php'
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Group 3 Project</title>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
    <!-- Styles CSS -->
    <link href="assets/css/styles.css" rel="stylesheet"/>
  </head>
  <body>
    <!-- Navigation bar -->
  <nav class="navbar navbar-default navbar-fixed-top navbar-expand-lg navbar-light bg-dark" style="z-index: 1;">
  <!--TODO fix the navbar for mobile devices -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active"><a class="nav-link" href="./index.php">Home <span class="sr-only"></span></a></li>
        <li class="nav-item"><a class="nav-link" href="./about-us.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="./covid-info.php">Covid Info</a></li>
        <li class="nav-item"><a class="nav-link" href="./categories.php">Blog categories</a></li>
        <li class="nav-item"><a class="nav-link" href="./blog-posts.php">Blog posts</a></li>
        <!--php script after login is successful-->
        <?php
          if(isset($_SESSION['username'])){
            echo '<li class="nav-item"><a class="nav-link" href="./src/logout_src.php">Log Out</a></li>'; //a tag redirects to logout.php
            echo '<li class="nav-item"><a class="nav-link" href="./profile.php?username='.$_SESSION['username'].'">My Profile</a></li>';
          }
          else{
            echo '<li class="nav-item"><a class="nav-link" href="./signup.php">Sign Up</a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="./login.php">Log In</a></li>';
          }
          if(isAdmin()){
            echo '<li class="nav-item"><a class="nav-link" href="./admin/dashboard.php">Admin Dashboard</a></li>';
          }
        ?>
      </ul>
    </div>
  </nav>
  <!--Navigation bar end -->