<?php
  
?>
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
          <a href="homepageAsPermanent.php"><strong>Dashboard</strong></a>
          <a href="jobsAsPermanent.php">Jobs</a>
          <?php
              session_start();
              if (!isset($_SESSION["username"])) { 
                header("location: loginAsPermanent.php");
              } else{
              // Prevents anyone from entering this page directly.
                $username = $_SESSION["username"];
                $managerId = $_SESSION["managerId"];
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
                      . "<th>Name</th>\n"
                      . "<th>Unit</th>\n"
                      . "<th>Title</th>\n"
                      . "<th>Phone</th>\n"
                      . "<th>Email</th>\n"
                      . "<th>Resume</th>\n"
                      . "<th>Preferences</th>\n"
                      . "<th>Availability</th>\n"
                      . "<th>Status</th>\n"
                      . "</tr>\n"
                      . "</thead>\n";
      
                  // Table content.
                  echo "<tbody>\n";
                  while ($row = mysqli_fetch_assoc($result)) {
                      $jobId = $row["jobId"];
                      echo "<tr>\n"
                          . "<td>" . $row["applicationId"] . "</td>\n"
                          . "<td>" . $row["name"] . "</td>\n"
                          . "<td>" . $row["unit"] . "</td>\n"
                          . "<td>" . $row["title"] . "</td>\n"
                          . "<td>" . $row["phone"] . "</td>\n"
                          . "<td>" . $row["email"] . "</td>\n"
                          . "<td>" . $row["cv"] . "</td>\n"
                          . "<td>" . $row["preferences"] . "</td>\n"
                          . "<td>" . $row["availability"] . "</td>\n"
                          . "<td>" . $row["status"] . "</td>\n";
                          
                  }
                  echo "</tbody>\n";
                  echo "</table>\n";
                  mysqli_free_result($result);
                }  
                
                $query = "SELECT A.applicationId,N.name,J.unit, J.title, N.phone,N.email, A.cv, A.preferences, A.status, A.availability 
                  FROM manage as M, application as A, job as J, memberLogin as N 
                  WHERE J.jobId = M.jobId AND J.jobId = A.jobId AND M.managerId = $managerId AND N.memberId = A.memberId;";
                $result = mysqli_query($connection, $query);
                
              
              }
          ?>
      </div>
      <div class="card-container1" >
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
      
        <h2>Visualization</h2>
        <div class="card-container-inner">
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['Unit', 'Applications'],
                <?php
                  $connection = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Database connection failure.</p>");
                  $query1 = "SELECT J.unit, COUNT(A.applicationId) as number 
                              FROM application as A, job as J, manage as Ma 
                              WHere A.jobId = J.jobId and Ma.managerId = $managerId and Ma.jobId = J.jobId 
                              GROUP BY J.unit;";
                  $result1 = mysqli_query($connection, $query1);
                  while ($row1 = mysqli_fetch_assoc($result1)) {
                    $unit = $row1["unit"];
                    $number = $row1["number"];
                  ?>
                  ['<?php echo $unit; ?>', <?php echo $number; ?>],
                  <?php
                  }
                ?>
              ]);

              var options = {
                chart: {
                  title: 'The number of Application for each unit',
                },
                width: 600,
                height: 400,
                bar: {groupWidth: "95%"},
                bars: 'vertical' // Required for Material Bar Charts.
              };

              var chart = new google.charts.Bar(document.getElementById('barchart_material'));

              chart.draw(data, google.charts.Bar.convertOptions(options));
            }
          </script>
          <div id="barchart_material" style="width: 900px; height: 500px;"></div>
        </div>
      </div>
    </div>
    
    
  </body>
</html>