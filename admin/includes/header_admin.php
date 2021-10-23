<?php
  session_start(); //starts session for the whole website as long as webpage connected to header.php
  require_once './src/functions_admin.php';
  if(!isAdmin()){ //check if user is admin
    header('Location: ../index.php');
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Admin Section</title>
    <!-- Styles CSS -->
    <link href="../assets/css/admin.css" rel="stylesheet"/>
  </head>
  <body>
    <!-- Navigation bar -->
  <nav class="navbar navbar-default navbar-fixed-top navbar-expand-lg navbar-light bg-primary" style="z-index: 1;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Admin Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active"><a class="nav-link" href="../index.php">Exit Dashboard</a></li>
          <!--php script after login is successful-->
          <?php
            if(isset($_SESSION['username'])){
              echo '<li class="nav-item"><a class="nav-link" href="../src/logout_src.php">Log Out</a></li>';
            }
            else{
              echo '<li class="nav-item"><a class="nav-link" href="./signup.php">Sign Up</a></li>';
              echo '<li class="nav-item"><a class="nav-link" href="./login.php">Log In</a></li>';
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <!--Navigation bar end -->