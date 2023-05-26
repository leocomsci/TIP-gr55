
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Home page ">
    <meta name="author" content="A Luan Luong">
    <title>Dashboard</title>
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
                require_once("settings.php");
                $connection = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Database connection failure.</p>");
                function returnTable($result) {
                  echo "<table id='job_table'>\n";
      
                  // Table headers
                  echo "<thead>\n"
                      . "<tr>\n"
                      . "<th>Application Number</th>\n"
                      . "<th>Job Number</th>\n"
                      . "<th>Title</th>\n"
                      . "<th>Unit</th>\n"
                      . "<th>Status</th>\n"
                      . "</tr>\n"
                      . "</thead>\n";
      
                  // Table content.
                  echo "<tbody>\n";
                  while ($row = mysqli_fetch_assoc($result)) {
                      $jobId = $row["jobId"];
                      echo "<tr>\n"
                          . "<td>" . $row["applicationId"] . "</td>\n"
                          . "<td>" . $row["jobId"] . "</td>\n"
                          . "<td>" . $row["title"] . "</td>\n"
                          . "<td>" . $row["unit"] . "</td>\n"
                          . "<td>" . $row["status"] . "</td>\n";
                          
                  }
                  echo "</tbody>\n";
                  echo "</table>\n";
                  mysqli_free_result($result);
                }  
                
                $query = "SELECT A.applicationId, A.status, J.title, J.unit, J.jobId FROM `application` as A,`job`as J WHERE memberId LIKE '$memberId' AND 
                A.jobId = J.jobId";
                $result = mysqli_query($connection, $query);
              
              }
          ?>
      </div>
      <div class="card-container" >
        <h2>List of Application</h2>
        <div class="card-container-inner">
          <?php
            if (!$result || mysqli_num_rows($result) === 0) {
              echo "<p>There are no job applications under this name yet.</p>";
            }
            else {
                returnTable($result);
            }
          ?>
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