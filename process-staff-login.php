<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Manager login" />
    <meta name="keywords" content="" />
    <title>Login</title>
    <link href="styles/style.css" rel="stylesheet" />
    <!-- Description: This page gets the username and password entered by the manager, and checks if the username and 
    password is valid. -->
    
</head>

<body>
    <?php
        require_once("settings.php");
        $connection = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Database connection failure.</p>");
        $sqlTable = "permanentLogin";
        
        function sanitise_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        // Boolean to check if the username and password entered is valid.
        $valid = false;

        $username = sanitise_input($_GET["username"]);
        $password = sanitise_input($_GET["password"]);

        // If the username exists, then this shall only return one username.
        $checkExistQuery = "SELECT * from $sqlTable where username = '$username'";

        $result = mysqli_query($connection, $checkExistQuery);
        $user = mysqli_fetch_assoc($result);

        // Query successful and username exists.
        if ($user) {
            while ($user) {
                if ($user["password"]===$password) {
                    $valid = true;
                    $managerId = $user["managerId"];
                    break;
                }
            }
            mysqli_free_result($result);
        }

        if ($valid) {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            $_SESSION["managerId"] = $managerId;
            header("location: homepageAsPermanent.php");
        }
        else {
            echo "<p>Invalid username and/or password</p>";
        }
        mysqli_close($connection);
    ?>
</body>