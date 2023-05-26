<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Manager login page" />
    <meta name="keywords" content="" />
    <title>Login as A Permanent Staff</title>
    <link href="style/style.css" rel="stylesheet" />
    <!-- Description: The login page for managers. -->
    
</head>
<body>
    <div class="container">
        <div class="navbar">
          <a href="index.php">
              <img src="images/icon.png" alt="Icon" class="navbar-logo">
          </a>
          <a href="index.php"><strong>Home</strong></a>
          <a href="jobs.php">Jobs</a>
          <a href="about.php">About us</a>
          <a href="contact.php">Contact</a>
          <div class="navbar-right">
              <a href="loginAsMember.php">Login as Member</a>
              <a href="register.php">Signup</a>
          </div>
        </div>
        <div class="card-container">
            <h1 class="title">Login as A Permanent Staff</h1>
            <div class="card-container-inner">
                <section class="form">
                    <form id="applyform" method="get" action="process-staff-login.php">
                        <p><label for="username">Username</label>
                        <input type="text" name="username" id="username" required/>
                        </p>

                        <p><label for="password">Password</label>
                        <input type="password" name="password" id="password" required/>
                        </p>

                        <input class="apply_button" type="submit" value="Login">
                    </form>
                </section>
            </div>
        </div> 
    </div>
    
</body>