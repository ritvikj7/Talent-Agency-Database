<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent Agency Database</title>
    <link rel="stylesheet" href="navbarstyles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap">
    <link rel="stylesheet" href="agencies.css">
</head>
<body>
    <div id="navbar-placeholder"></div> 
    
    <h1 class="agencies">Agencies</h1>

    <script src="navbar.js"></script>
    <script>
        loadNavbar();
    </script>

    <?php
        include "connect.php";

        function printResultAgencies() {
            // Print Agencies Table
            $agencies_table = executePlainSQL("SELECT * FROM Agencies");
            echo "<table class=agenciesTable>";
            echo "<tr><th>Name:</th><th>Founder:</th><th>Employee Count:</th></tr>";
            while ($row = OCI_Fetch_Array($agencies_table, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>";
            }
            
            echo "</table>";
        }

        function handleShowAllTablesRequest() {
            global $db_conn;
            printResultAgencies();
        }
    ?>


</body>
</html>
