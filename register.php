<?php

    require_once("settings.php");
    $connection = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Database connection failure.</p>");

    function sanitise_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    if(isset($_POST['submit'])){
        $name = sanitise_input($_POST['name']);
        $email = sanitise_input($_POST['email']);
        $phone = sanitise_input($_POST['phone']);
        $username = sanitise_input($_POST['username']);
        $password = password_hash(sanitise_input($_POST['password']), PASSWORD_DEFAULT);
        $passwordConfirmation = sanitise_input($_POST['passwordConfirmation']);

        $sqlTable="memberLogin";
        $query = "SELECT * FROM $sqlTable WHERE username = '$username' AND name = '$name'";
        $result = mysqli_query($connection, $query);

        $error = "";

        if(mysqli_num_rows($result) > 0){

            $error .= "User already exists!";

        }else{
            
            if($_POST["password"] !== $_POST["passwordConfirmation"]){
                $error .= "\nPassword is not matched!";
            }else{
                $queryInsert = "INSERT INTO $sqlTable(name, email, phone, username, password) VALUES('$name','$email','$phone','$username','$password')";
                mysqli_query($connection, $queryInsert);
                echo"<script> alert('Your Account is succesfully created!') </script>";
                header('refresh:1;url=loginAsMember.php');
            }
        }

    };


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style/style.css">
   <!-- <link rel="stylesheet" href="style/register.css"> -->

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
              <a href="loginAsPermanent.php">Login as Permanent Staff</a>
          </div>
        </div>
        <div class="card-container">
            <h1 class="title">Be a apart of our team</h1>
            <div class="card-container-inner">
                <section class="form">
                    
                <form id="applyform" action="" method="post">
                    <fieldset>
                    <?php
                        if(isset($error)){
                                echo '<span class="error-msg">'.$error.'</span>';
                        };
                    ?>
                    <p>
                        <label for="name">Your Name</label>
                        <input type="text" name="name" required placeholder="Enter your name">
                    </p>
                    <p>
                        <label for="username">Username</label>
                        <input type="text" name="username" required placeholder="Enter your username">
                    </p>
                    <p>
                        <label for="password">Password</label>
                        <input type="password" name="password" required placeholder="Enter your password">
                        
                    </p>
                    <p>
                        <label for="passwordConfirmation">Confirm Password</label>
                        <input type="password" name="passwordConfirmation" required placeholder="Confirm your password">
                        
                    </p>
                    <p>
                        <label for="email">Your Email</label>
                        <input type="email" name="email" required placeholder="Enter your email">
                    </p>
                    <p>
                        <label for="phone">Your Phone</label>
                        <input type="tel" name="phone" required placeholder="Enter your phone number">
                    </p>
                    
                    </fieldset>
                    <input type="submit" name="submit" value="Register now" class="apply_button">
                    <p>Already have an account? <a href="loginAsMember.php">Login now</a></p>
                </form>
                </section>
            </div>
        </div> 
    </div>
    <div class="footer">
            <hr>
            <span>
                &copy; 
                Studz   
            </span>
            <span style="padding-left: 5cm;">
                Contact us
                <a href="mailto:104479251@student.swin.edu.au">via this click</a>  
            </span>
    </div>
</body>
</html>