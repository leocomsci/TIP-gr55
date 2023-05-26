<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Result </title>
    <link href="styles/style.css" rel="stylesheet" />
    
    <!-- Description: This page gets the manager request and queries or changes the database based on the request. -->
    
</head>

<body>
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

        // function getAllApplications() {
        //     global $connection;
        //     $sortRequest = sanitise_input($_GET["job_sort_request"]);


        //     if ($sortRequest === "none") {
        //         $query = "select * from job";
        //     }
        //     else {
        //         $query = "select * from job order by $sortRequest";

        //         // If first name or last name is picked, then we want to sort by first name first then last name second
        //         // or last name first then first name second respectively.

        //         if ($sortRequest === "name") {
        //             $query .= ", name";
        //         }
        //         else if ($sortRequest === "title") {
        //             $query .= ", title";
        //         }
        //         else if ($sortRequest === "unit") {
        //             $query .= ", unit";
        //         }
        //     }

        //     $result = mysqli_query($connection, $query);

        //     if (!$result || mysqli_num_rows($result) === 0) {
        //         echo "<p>There are no job applications yet.</p>";
        //     }
        //     else {
        //         returnTable($result);
        //     }
        //     mysqli_close($connection);
        // }

        function getJobs() {
            global $connection;

            // $sortRequest = sanitise_input($_GET["job_sort_request"]);
            $jobId = sanitise_input($_GET["jobId"]);
            $unit = sanitise_input($_GET["unit"]);
            $title = sanitise_input($_GET["title"]);

            if ($jobId === "" && $unit === "" && $title === "") {
                $query = "SELECT * FROM `job`";
            }

            $result = mysqli_query($connection, $query);

            // Note: !$result is for when query is invalid.
                if (!$result || mysqli_num_rows($result) === 0) {
                echo "<p>There are no job applications under this name yet.</p>";
            }
            else {
                returnTable($result);}
            // else {
                
            //     // Both first names and last names empty or both first names and last names filled.
            //     if ($jobId !== "" && $unit !== "") {
            //         $query = "select * from job where jobId like '$title' and LastName like '$unit'";
            //     }

            //     // // First name is filled but last name is empty.
            //     // else if ($firstName !== "" && $lastName === "") {
            //     //     $query = "select * from eoi where FirstName like '$firstName%'";
            //     // }

            //     // // First name is empty but last name is filled.s
            //     // else {
            //     //     $query = "select * from eoi where LastName like '$lastName%'";
            //     // }

            //     // if ($sortRequest !== "none") {
            //     //     $query .= " order by $sortRequest";

            //     //     if ($sortRequest === "jobId") {
            //     //         $query .= ", jobId";
            //     //     }

            //     //     if ($sortRequest === "title") {
            //     //         $query .= ", name";
            //     //     }

            //     //     if ($sortRequest === "unit") {
            //     //         $query .= ", unit";
            //     //     }
            //     // }

            //     $result = mysqli_query($connection, $query);

            //      // Note: !$result is for when query is invalid.
            //      if (!$result || mysqli_num_rows($result) === 0) {
            //         echo "<p>There are no job applications under this name yet.</p>";
            //     }
            //     else {
            //         returnTable($result);
            //     }
            // }
            mysqli_close($connection);
        }

        // echo "<script>\n"
        //             . "function storeData() {\n"
        //             . "var name = document.getElementById('reference_number_" . $row["jobId"] . "').value;\n"
        //             . "localStorage.setItem('nameData', name);\n"
        //             . "alert('Data stored successfully!');\n"
        //             . "window.location.href= 'apply.php';\n"
        //             . "}\n" 
        //         . "</script>\n";


        // The manager pressed the button to get eoi's after giving first name and/or last name.
        if (isset($_GET["get_jobs"])) {
            getJobs();
        }
    ?>
    
</body>