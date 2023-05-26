<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="About Page">
    <meta name="keywords" content="A Luan, Personal Details, Timetable">
    <meta name="author" content="A Luan Luong">
    <title>Contact us</title>
    <link rel="stylesheet" href="style/style.css">
    
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
              <a href="loginAsMember.php">Login</a>
              <a href="register.php">Signup</a>
              <a href="loginAsPermanent.php">Login as Permanent Staff</a>
          </div>
        </div>
        <div class="card-container">
            <h1 class="title">Contact us</h1>
            <section class="card-container-inner">
                <fieldset>
                <legend>Message Us via email</legend>
                    <p><label for="name">Name:</label></p>
                    <input type="text" id="name" name="name" required>
                    <p><label for="email">Email:</label></p>
                    <input type="text" id="email" name="email" required>
                    <p><label for="message">Message:</label>
                    </p>
                    <p><textarea id="message" name="message" rows="20" cols="100"
                     required></textarea></p>
                     
                    <input type="submit" value="Send Message">
                </fieldset>
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
</html>