<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Manager login page" />
    <meta name="keywords" content="" />
    <title>Apply</title>
    <link href="style/style.css" rel="stylesheet" />
    <script src="scripts/apply.js"></script>
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
          <?php
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
              
              }
          ?>
      </div>
      <div class="card-container">
        <h1 class="title">Application Form</h1>
        <p id="timer"></p>
          <div class="card-container-inner">
            <section class="form">
              <h2>Please fill out the form below to apply now</h2>
              <form id="applyform" method="post" action="process-application.php" novalidate enctype="multipart/form-data">
                <fieldset>
                  <legend>Personal Details:</legend>
                  <p>
                    <label for="reference_number">Ref No.</label>
                    <input type="text" name="reference_number" id="reference_number" pattern="^[a-zA-Z0-9]{5}$" required>
                  </p>
                  <p>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required maxlength="40">
                    
                  </p>
                  <p>
                    <span id="empty_dob" class="error_message"></span>
                    <span id="invalid_dob" class="error_message"></span>
                    <span id="invalid_age" class="error_message"></span>
                  </p>
                </fieldset>

                <fieldset id="gender">
                  <legend>Gender:</legend>
                  <p>
                    <label for="Male">Male</label>
                    <input type="radio" name="gender" id="male" value="Male" checked >
                    <label for="Female">Female</label>
                    <input type="radio" name="gender" id="female" value="Female" >
                    <label for="neutral">Prefer not to say</label>
                    <input type="radio" name="gender" id="neutral" value="Neutral" >
                  </p>
                </fieldset>
                <fieldset>
                  <legend>Address Details:</legend>
                  <p>
                    <label for="street">Street Address</label>
                    <input type="text" name="street" id="street" pattern="^[a-zA-Z0-9]{1,40}$" required maxlength="40">
                  </p>

                  <p>
                    <label for="suburb">Suburb/Town</label>
                    <input type="text" name="suburb" id="suburb" pattern="^[a-zA-Z0-9]{1,40}$" required maxlength="40">
                  </p>
                  <p>
                    <label for="state">Your state</label>
                    <select name="state" id="state" required>
                      <option value="">Please Select</option>
                      <option value="VIC">VIC</option>
                      <option value="NSW">NSW</option>
                      <option value="QLD">QLD</option>
                      <option value="NT">NT</option>
                      <option value="WA">WA</option>
                      <option value="SA">SA</option>
                      <option value="VIC">VIC</option>
                      <option value="TAS">TAS</option>
                      <option value="ACT">ACT</option>
                    </select>
                  </p>
                  <p>
                    <label for="postcode">Postcode</label>
                    <input type="text" name="postcode" id="postcode" pattern="^[0-9]{4}$" required>
                    <span id="empty_postcode" class="error_message"></span>
                    <span id="invalid_postcode" class="error_message"></span>
                  </p>
                </fieldset>

                <fieldset>
                  <legend>Contact Details:</legend>
                  <p>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" pattern="^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$" required>
                  </p>
                  <p>
                    <label for="number">Phone Number</label>
                    <input type="text" name="number" id="number" pattern="^[0-9\s]{8,12}$" required>
                  </p>
                </fieldset>

                <fieldset id="classes">
                  <legend>Preferences:</legend>
                  <p>
                    <label for="class_1">Class 1</label>
                    <input type="checkbox"  name="classes[]" value="Class 1">
                    <label for="class_2">Class 2</label>
                    <input type="checkbox"  name="classes[]" value="Class 2">
                    <label for="class_3">Class 3</label>
                    <input type="checkbox" id="class_3" name="classes[]" value="Class 3">
                  </p>
                </fieldset>
                <fieldset>
                  <legend>Availability:</legend>
                  <table>
                    <tr>
                      <th></th>
                      <th>Monday</th>
                      <th>Tuesday</th>
                      <th>Wednesday</th>
                      <th>Thursday</th>
                      <th>Friday</th>
                    </tr>
                    <tr>
                      <td>Morning</td>
                      <td><input type="checkbox" name="availability[]" value="monday_morning"></td>
                      <td><input type="checkbox" name="availability[]" value="tuesday_morning"></td>
                      <td><input type="checkbox" name="availability[]" value="wednesday_morning"></td>
                      <td><input type="checkbox" name="availability[]" value="thursday_morning"></td>
                      <td><input type="checkbox" name="availability[]" value="friday_morning"></td>
                    </tr>
                    <tr>
                      <td>Afternoon</td>
                      <td><input type="checkbox" name="availability[]" value="monday_afternoon"></td>
                      <td><input type="checkbox" name="availability[]" value="tuesday_afternoon"></td>
                      <td><input type="checkbox" name="availability[]" value="wednesday_afternoon"></td>
                      <td><input type="checkbox" name="availability[]" value="thursday_afternoon"></td>
                      <td><input type="checkbox" name="availability[]" value="friday_afternoon"></td>
                    </tr>
                    <tr>
                      <td>Evening</td>
                      <td><input type="checkbox" name="availability[]" value="monday_evening"></td>
                      <td><input type="checkbox" name="availability[]" value="tuesday_evening"></td>
                      <td><input type="checkbox" name="availability[]" value="wednesday_evening"></td>
                      <td><input type="checkbox" name="availability[]" value="thursday_evening"></td>
                      <td><input type="checkbox" name="availability[]" value="friday_evening"></td>
                    </tr>
                  </table>
                </fieldset>

                <fieldset>
                  <legend>Upload Resume (PDF):</legend>
                  <p>
                    <input type="file" name="pdf" id="pdf" required>
                  </p>
                </fieldset>
                <input type="submit" name="submit" value="Apply">
                <input type="reset" value="Reset form">
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