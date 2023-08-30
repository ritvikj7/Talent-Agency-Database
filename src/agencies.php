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

        function printResultSponsors() {
            printResultAgencies();

            // Print Agencies Table
            $sponsors_table = executePlainSQL("SELECT * FROM Sponsors");
            echo "<h1 class=sponsors>Sponsors</h1>";
            echo "<table class=sponsorsTable>";
            echo "<tr><th>Sponsor Name:</th><th>Company Name:</th><th>Service:</th></tr>";
            while ($row = OCI_Fetch_Array($sponsors_table, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>";
            }
            
            echo "</table>";
        }

        function handleShowAllTablesRequest() {
            global $db_conn;
            printResultAgencies();
        }

        function handleShowSponsorRequest(){
            global $db_conn;
            printResultSponsors();
        }
    ?>

    <form method="GET" action="agencies.php"> <!--refresh page when submitted-->
        <input type="hidden" id="showSponsorsRequest" name="showSponsorsRequest">
        <input type="submit" class="button" value="Show Sponsors" name="showSponsorsSubmit"></p>
    </form>


</body>
</html>
