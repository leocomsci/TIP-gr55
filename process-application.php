<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Form submission">
        <meta name="author" content="A Luan Luong">
        <title>Apply Form</title>
        <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
    <div class="container">
        <div class="navbar">
          <a href="index.php">
              <img src="images/icon.png" alt="Icon" class="navbar-logo">
          </a>
          <a href="homepageAsMember.php"><strong>Dashboard</strong></a>
          <a href="jobs.php">Jobs</a>
          <?php
              session_start();
              if (!isset($_SESSION["username"])) { 
                header("location: loginAsMember.php");
              } else{
              // Prevents anyone from entering this page directly.
                $username = $_SESSION["username"];
                $memberId = $_SESSION["memberId"];
                echo"<div class='navbar-right'>";
                echo "<a>Welcome, $username</a>";
                echo"<a href='logout.php'>Logout</a>";
                echo"</div>";

                function sanitise_input($data){
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
            
                function getAge($dateOfBirth) {
                    // Explode the date string into day, month, and year components
                    $dateParts = explode('/', $dateOfBirth);
                    $day = intval($dateParts[0]);
                    $month = intval($dateParts[1]);
                    $year = intval($dateParts[2]);
                
                    // Get the current date components
                    $currentDay = date('d');
                    $currentMonth = date('m');
                    $currentYear = date('Y');
                
                    // Calculate the age
                    $age = $currentYear - $year;
                
                    // Adjust the age if the current date is before the birthdate in the same month
                    if ($currentMonth < $month || ($currentMonth == $month && $currentDay < $day)) {
                        $age--;
                    }
                
                    return $age;
                }   

                function checkPostcode($postcode, $state){
                    $errorMessage = "";

                    $firstNumber = $postcode[0];
                    switch($state) {
                        case "VIC":
                            if ($firstNumber !== "3" && $firstNumber !== "8") {
                                $errorMessage .= "<p>The postcode of suburbs/towns in Victoria start with either a 3 or an 8!</p>\n";
                            }
                            break;
                        case "NSW":
                            if ($firstNumber !== "1" && $firstNumber !== "2") {
                                $errorMessage .= "<p>The postcode of suburbs/towns in New South Wales start with either a 1 or a 7!</p>\n";
                            }
                            break;
                        case "QLD":
                            if ($firstNumber !== "4" && $firstNumber !== "9") {
                                $errorMessage .= "<p>The postcode of suburbs/towns in Queensland start with either a 4 or a 9!</p>\n";
                            }
                            break;
                        case "NT":
                            if ($firstNumber !== "0") {
                                $errorMessage .= "<p>The postcode of suburbs/towns in Northen Territory start with a 0!</p>\n";
                            }
                            break;
                        case "WA":
                            if ($firstNumber !== "6") {
                                $errorMessage .= "<p>The postcode of suburbs/towns in Western Australia start with a 6!</p>\n";
                            }
                            break;
                        case "SA":
                            if ($firstNumber !== "5") {
                                $errorMessage .= "<p>The postcode of suburbs/towns in South Australia start with a 5!</p>\n";
                            }
                            break;
                        case "TAS":
                            if ($firstNumber !== "7") {
                                $validPostcode = false;
                                $errorMessage .= "<p>The postcode of suburbs/towns in Tasmania start with a 7!</p>\n";
                            }
                            break;
                        case "ACT":
                            if ($firstNumber !== "0") {
                                $errorMessage .= "<p>The postcode of suburbs/towns in Australian Capital Territory start with a 0!</p>\n";
                            }
                            break;
                        }
                    return $errorMessage;
                }

                function validateForm() {
                    $valid = true;
                    
        
                    // Check gender.
                    if (!isset($_POST["gender"])) {
                        $valid = false;
                        echo "<p>Please select a gender!</p>\n";
                    }
        
                    // Check street address.
                    if (isset($_POST["street"]) && $_POST["street"] !== "") {
                        $streetAddress = sanitise_input($_POST["street"]);
                        if (strlen($streetAddress) > 40) {
                            $valid = false;
                            echo "<p>Your street address must be less than or equal to 40 characters!</p>\n";
                        }
                    }
                    else {
                        $valid = false;
                        echo "<p>Please enter a street address.</p>\n";
                    }
        
                    // Check suburb.
                    if (isset($_POST["suburb"]) && $_POST["suburb"] !== "") {
                        $suburb = sanitise_input($_POST["suburb"]);
                        if (strlen($suburb) > 40) {
                            $valid = false;
                            echo "<p>Your suburb must be less than or equal to 40 characters!</p>\n";
                        }
                    }
                    else {
                        $valid = false;
                        echo "<p>Please enter a suburb.</p>\n";
                    }
        
                    // Check state.
                    if (isset($_POST["state"]) && $_POST["state"] !== "") {
                        $state = sanitise_input($_POST["state"]);
                    }
                    else {
                        $valid = false;
                        echo "<p>Please select a state.</p>\n";
                    }
        
                    //Check postcode.
                    if (isset($_POST["postcode"]) && $_POST["postcode"] !== "") {
                        $postcode = sanitise_input($_POST["postcode"]);
                        if (!preg_match("/^[0-9]{4}$/", $postcode)) {
                            $valid = false;
                            echo "<p>Your postcode must be 4 digits!</p>\n";
                        }
                        // A state has also been entered.
                        else if (isset($_POST["state"]) && $_POST["state"] !== "") {
                            $state = sanitise_input($_POST["state"]);
                            $postcodeErrorMessage = checkPostcode($postcode, $state);
                            if ($postcodeErrorMessage != "") {
                                $valid = false;
                                echo $postcodeErrorMessage;
                            }
                        }
                    }
                    else {
                        $valid = false;
                        echo "<p>Please enter a postcode.</p>\n";
                    }
        
                    // Check email
                    if (isset($_POST["email"]) && $_POST["email"] !== "") {
                        $email = sanitise_input($_POST["email"]);
        
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $valid = false;
                            echo "<p>Please enter your email in the appropriate format.</p>\n";
                        }
                    }
                    else {
                        $valid = false;
                        echo "<p>Please enter your email.<p>\n";
                    }
        
                    // Check phone number
                    if (isset($_POST["number"]) && $_POST["number"] !== "") {
                        $phoneNumber = sanitise_input($_POST["number"]);
        
                        if (!preg_match("/^[0-9' ']{8,12}$/", $phoneNumber)) {
                            $valid = false;
                            echo "<p>Your phone number must only contain digits and spaces, and must be between 8 and 12 characters.</p>\n";
                        }
                    }
                    else {
                        $valid = false;
                        echo "<p>Please enter your phone number!</p>\n";
                    }
                    
                    return $valid;
                }

                
                require_once("settings.php");
                $connection = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Database connection failure.</p>");

                // All of the data is valid and our connection is working. Thus, we can proceed putting data into database.
                if (validateForm()) {
                    $sqlTable = "application";

                    $jobId = sanitise_input($_POST["reference_number"]);
                    $member= $_SESSION["memberId"];
                    // $classes = isset($_POST['classes']) ? $_POST['classes'] : [];
                    // $availability = isset($_POST['availability']) ? $_POST['availability'] : [];
                    $pdf = $_FILES['pdf']['name'];
                    $pdf_type = $_FILES['pdf']['type'];
                    $pdf_size = $_FILES['pdf']['size'];
                    $pdf_tem_loc= $_FILES['pdf']['tmp_name'];
                    $pdf_store = "files/".$pdf;
                    move_uploaded_file($pdf_tem_loc,$pdf_store);
                    // We still need to check this because other skills is not compulsory for the form to be validated.
                    if (isset($_POST["classes"])) {
                        $classes = "";
                        // Put the skills checked into a string $skills.
                        for ($i = 0; $i < count($_POST["classes"]); $i++) {
                            $classes .= sanitise_input($_POST["classes"][$i]);
                            if ($i != count($_POST["classes"]) - 1) {
                                $classes .= ",";
                            }
                        }
                    } 
                    else {
                        $classes = null;
                    }  
                    if (isset($_POST["availability"])) {
                        $availability = "";
                        // Put the skills checked into a string $skills.
                        for ($i = 0; $i < count($_POST["availability"]); $i++) {
                            $availability .= sanitise_input($_POST["availability"][$i]);
                            if ($i != count($_POST["availability"]) - 1) {
                                $availability .= ",";
                            }
                        }
                    } 
                    else {
                        $availability = null;
                    } 

                    $status = "NEW";
                    $query1 = "SELECT * FROM application WHERE jobId = '$jobId' AND memberId = '$memberId' ";
                    $result1 = mysqli_query($connection, $query1);
                    $error = "";
                    if(mysqli_num_rows($result1) > 0){

                        $error .="You already apply for this job!";
                        echo "</div>";
                            echo "<div class='card-container'>";
                            echo "        <div class='card-container-inner'>";
                                            
                                            echo "<h2> You already apply for this job</h2>";
                                            mysqli_close($connection);
                                        
                            echo"       </div>";
                            echo "</div>";
        
                    } else {
                        $connection = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Database connection failure.</p>");
                        $query = "INSERT INTO $sqlTable (`memberId`,`jobId`,`cv`,`availability`,`preferences`,`status`) 
                        VALUES ('$member','$jobId','$pdf','$availability','$classes','$status')";

                        $result = mysqli_query($connection, $query);

                        if (!$result) {
                            echo"<p>Oh no! Something went wrong!.</p>";

                        }

                        // Display confirmation message.
                        else {
                            echo "</div>";
                            echo "<div class='card-container'>";
                            echo "    <h1 class='title'>Job Application Confirmation</h1>";
                            echo "        <div class='card-container-inner'>";
                                            $currentEoiNumber = mysqli_insert_id($connection);
                                            echo "<h2>Congratulations, your job application was received. Your expression of interest number is
                                            $currentEoiNumber.Redirecting to Login in 10 seconds...
                                            </h2>";
                                            mysqli_close($connection);
                                            header("refresh:5;url=homepageAsMember.php");
                                        
                            echo"       </div>";
                            echo "</div>";
                            
                        }
                    }
                    

                    mysqli_close($connection);
                }
            
            }
          ?>
        
        
    </body>
</html>




