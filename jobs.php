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
            $memberId = $_SESSION["memberId"];
            echo"<a href='homepageAsMember.php'><strong>Dashboard</strong></a>";
            echo"<a href='jobs.php'>Jobs</a>";
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
        <!-- <form id="get_jobs" method="get" action="job-search-request.php">
          <fieldset class="request">
                  <label for="jobId">Job Reference Number</label>
                  <input type="text" name="jobId" id="jobId" />
                  <label for="unit">Unit</label>
                  <input type="text" name="unit" id="unit" />
                  <label for="title">Title</label>
                  <input type="text" name="title" id="tile" />
                  <input class="form_action" type="submit" name="get_jobs" value="Search">
          </fieldset>
        </form> -->
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
                . "<th>Apply</th>\n"
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
                    . "<td>" . $row["description"] . "</td>\n"
                    . "<td> <a class='apply_button' onclick='storeData(" . $jobId . ")'> Apply </a> </td>\n"
                    . "<script>\n"
                    . "function storeData(data) {\n"
                    // . "var name = document.getElementById('reference_number_" . $row["jobId"] . "').value;\n"
                    . "localStorage.setItem('nameData', data);\n"
                    . "alert('Data stored successfully!');\n"
                    . "window.location.href= 'apply.php';\n"
                    . "}\n" 
                . "</script>\n";
                    
            }
            echo "</tbody>\n";
            echo "</table>\n";
            mysqli_free_result($result);
          }

          $query = "SELECT * FROM `job`";
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
  </div>
</body>