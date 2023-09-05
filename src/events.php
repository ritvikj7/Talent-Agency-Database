<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent Agency Database</title>
    <link rel="stylesheet" href="navbarstyles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap">
    <link rel="stylesheet" href="events.css">
</head>
<body>
    <div id="navbar-placeholder"></div> 
    
    <h1 class="events">Events</h1>

    <script src="navbar.js"></script>
    <script>
        loadNavbar();
    </script>

    <?php
        include "connect.php";

        function printResultEvents() {
            // Print Agencies Table
            $agencies_table = executePlainSQL(
                "SELECT e1.event_name, e2.event_type, e1.eDate, e1.participant_count 
                FROM Event1 e1, Event2 e2 
                WHERE e1.event_name = e2.event_name");
            echo "<table class=eventsTable>";
            echo "<tr><th>Event Name:</th><th>Type:</th><th>Date:</th><th>Participant Count:</th></tr>";
            while ($row = OCI_Fetch_Array($agencies_table, OCI_BOTH)) {
                echo "<tr>";
                echo "<td class='row'>" . $row[0] . "</td>";
                echo "<td class='row'>" . $row[1] . "</td>";
                echo "<td class='row'>" . $row[2] . "</td>";
                echo "<td class='row'>" . $row[3] . "</td>";
                echo "</tr>";            
            }
            
            echo "</table>";
        }

        function printResultSponsors() {
            printResultEvents();

            // Print Events Table
            $sponsors_table = executePlainSQL("SELECT * FROM Sponsors");
            echo "<h1 class=sponsors>Sponsors</h1>";
            echo "<table class=sponsorsTable>";
            echo "<tr><th>Sponsor Name:</th><th>Company Name:</th><th>Service:</th></tr>";
            while ($row = OCI_Fetch_Array($sponsors_table, OCI_BOTH)) {
                echo "<tr>";
                echo "<td class='row'>" . $row[0] . "</td>";
                echo "<td class='row'>" . $row[1] . "</td>";
                echo "<td class='row'>" . $row[2] . "</td>";
                echo "</tr>";           
            }
            
            echo "</table>";
        }

        function handleShowAllTablesRequest() {
            global $db_conn;
            printResultEvents();
        }

        function handleShowSponsorRequest(){
            global $db_conn;
            printResultSponsors();
        }
    ?>

    <form method="GET" action="events.php"> <!--refresh page when submitted-->
        <input type="hidden" id="showSponsorsRequest" name="showSponsorsRequest">
        <input type="submit" class="button" value="Show Sponsors" name="showSponsorsSubmit"></p>
    </form>


</body>
</html>