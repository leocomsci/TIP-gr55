<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Manager login page" />
    <meta name="keywords" content="" />
    <title>Jobs List</title>
    <link href="style/style.css" rel="stylesheet" />
    <!-- Description: The login page for managers. -->
    
    
</head>
<body>
  
  <div class="container">
    <div class="navbar">
        <a href="index.php">
            <img src="images/icon.png" alt="Icon" class="navbar-logo">
        </a>
        <?php
            if (!isset($_SESSION["username"])) { 
              echo"<a href='index.php'><strong>Home</strong></a>";
              echo"<a href='jobs.php'>Jobs</a>";
              echo"<a href='about.php'>About us</a>";
              echo"<a href='contact.php'>Contact</a>";
              echo"<div class='navbar-right'>";
              echo"  <a href='loginAsMember.php'>Login</a>";
              echo"<a href='register.php'>Signup</a>";
              echo"<a href='loginAsPermanent.php'>Login as Permanent Staff</a>";
              echo"</div>";
            } else{
            // Prevents anyone from entering this page directly.
            $username = $_SESSION["username"];
            $managerId = $_SESSION["managerId"];
            echo"<a href='homepageAsPermanent.php'><strong>Dashboard</strong></a>";
            echo"<a href='jobsAsPermanent.php'>Jobs</a>";
            echo"<div class='navbar-right'>";
            echo "<a>Welcome, $username</a>";
            echo"<a href='logout.php'>Logout</a>";
            echo"</div>";
            
            }
        ?>
    </div>
    
    <div class="card-container">
      <h1 class="title">List of Job</h1>
      <section class="card-container-inner">
        <?php
          require_once("settings.php");
          $connection = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Database connection failure.</p>");
  
          function sanitise_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
          }

          function returnTable($result) {
            echo "<table id='job_table'>\n";

            // Table headers
            echo "<thead>\n"
                . "<tr>\n"
                . "<th>Job Reference Number</th>\n"
                . "<th>Title</th>\n"
                . "<th>Unit</th>\n"
                . "<th>Description</th>\n"
                . "</tr>\n"
                . "</thead>\n";

            // Table content.
            echo "<tbody>\n";
            while ($row = mysqli_fetch_assoc($result)) {
                $jobId = $row["jobId"];
                echo "<tr>\n"
                    . "<td id='reference_number_$jobId'>" . $jobId . "</td>\n"
                    . "<td>" . $row["title"] . "</td>\n"
                    . "<td>" . $row["unit"] . "</td>\n"
                    . "<td>" . $row["description"] . "</td>\n";
                    
                    
            }
            echo "</tbody>\n";
            echo "</table>\n";
            mysqli_free_result($result);
          }

          $query = "SELECT J.jobId, J.unit, J.title, J.description FROM job as J, manage as Ma WHERE Ma.jobId = J.jobId AND Ma.managerId =$managerId;";
          $result = mysqli_query($connection, $query);
          if (!$result || mysqli_num_rows($result) === 0) {
            echo "<p>There are no job applications under this name yet.</p>";
          }
          else {
            returnTable($result);
          }
        ?>
      </section>
    </div>     

    <?php

        require_once("settings.php");
        $connection = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Database connection failure.</p>");

        if(isset($_POST['submit'])){
            $unit = sanitise_input($_POST['unit']);
            $title = sanitise_input($_POST['title']);
            $description = sanitise_input($_POST['description']);

            $sqlTable="job";
            $query = "SELECT * FROM $sqlTable WHERE unit = '$unit' AND title = '$title'";
            $result = mysqli_query($connection, $query);

            $error = "";
            $msg = "";

            if(mysqli_num_rows($result) > 0){

                $error .= "Jobs already exists!";

            }else{
                $queryInsert = "INSERT INTO $sqlTable(unit, title, description) VALUES('$unit','$title','$description')";
                mysqli_query($connection, $queryInsert);
                
                $currentjobId = mysqli_insert_id($connection);
                $queryInsert2 = "INSERT INTO manage(managerId, jobId) VALUES('$managerId', '$currentjobId')";
                mysqli_query($connection, $queryInsert2);
                $msg .= "Job added successfully!";
                header('refresh:1;url=jobsAsPermanent.php');

            }

        };


    ?>
    <div class="card-container">
        <h1 class="title">Add Job</h1>
            <div class="card-container-inner">
                <section class="form">
                    
                <form id="applyform" action="" method="post">
                    <fieldset>
                    <?php
                        if(isset($error)){
                                echo '<span class="error-msg">'.$error.'</span>';
                        };
                        if(isset($msg)){
                            echo '<span class="msg">'.$msg.'</span>';
                    };
                    ?>
                    <p>
                        <label for="unit">Unit</label>
                        <input type="text" name="unit" required placeholder="Enter unit of the new job">
                    </p>
                    <p>
                        <label for="title">Title</label>
                        <input type="text" name="title" required placeholder="Enter title of the new job">
                    </p>
                    <p>
                        <p><label for="description">Description</label><p>
                        <textarea id="description" name="description" rows="30" cols="100" required placeholder="Enter description here"></textarea>
                        
                    </p>
                    
                    </fieldset>
                    <input type="submit" name="submit" value="Add Job" class="apply_button">
                </form>
                </section>
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