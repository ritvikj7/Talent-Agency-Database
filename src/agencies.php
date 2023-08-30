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
    <u>
        <h1 class="agencies">Agencies</h1>
    </u>

    <h2>Show All Tables</h2>
    <form method="GET" action="agencies.php"> <!--refresh page when submitted-->
        <input type="hidden" id="showAllTablesRequest" name="showAllTablesRequest">
        <input type="submit" value="Show" name="showAllTablesSubmit"></p>
    </form>

    <script src="navbar.js"></script>
    <script>
        loadNavbar();
    </script>

    <?php
        include "connect.php";

        function printResultAll() {
            // Print ContentCreators Table
            $cc_table = executePlainSQL("SELECT * FROM ContentCreators");
            echo "<br>ContentCreators Table:<br>";
            echo "<table>";
            echo "<tr><th>Contact</th><th>Status</th><th>Name</th><th>AgencyName</th><th>AgencyFounder</th><th>ContractID</th><th>Handle</th></tr>";
            while ($row = OCI_Fetch_Array($cc_table, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td><tr>"; //or just use "echo $row[0]"
            }
            echo "</table>";

            // Print Youtubers Table
            $cc_table = executePlainSQL("SELECT * FROM Youtubers");
            echo "<br>Youtubers Table:<br>";
            echo "<table>";
            echo "<tr><th>Contact</th><th>Subscriber_count</th></tr>";
            while ($row = OCI_Fetch_Array($cc_table, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><tr>"; //or just use "echo $row[0]"
            }
            echo "</table>";

            // Print Agencies Table
            $agencies_table = executePlainSQL("SELECT * FROM Agencies");
            echo "<br>Agencies Table:<br>";
            echo "<table>";
            echo "<tr><th>Name</th><th>Founder</th><th>EmployeeCount</th></tr>";
            while ($row = OCI_Fetch_Array($agencies_table, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><tr>";
            }
            echo "</table>";

            // Print Contracts1 Table
            $contracts1_table = executePlainSQL("SELECT * FROM Contracts1");
            echo "<br>Contracts1 Table:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Date</th><th>Pay</th></tr>";
            while ($row = OCI_Fetch_Array($contracts1_table, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><tr>";
            }
            echo "</table>";

            // Print Offer Table
            $contracts1_table = executePlainSQL("SELECT * FROM Offer");
            echo "<br>Offer Table:<br>";
            echo "<table>";
            echo "<tr><th>agency_name</th><th>agency_founder</th><th>contracts_id</th></tr>";
            while ($row = OCI_Fetch_Array($contracts1_table, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><tr>";
            }
            echo "</table>";

            // Print MerchandiseSold1 Table
            $ms1_table = executePlainSQL("SELECT * FROM MerchandiseSold1");
            echo "<br>MerchandiseSold1 Table:<br>";
            echo "<table>";
            echo "<tr><th>Item#</th><th>Type</th><th>Manufacturer</th><th>ContentCreatorContact</th></tr>";
            while ($row = OCI_Fetch_Array($ms1_table, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><tr>";
            }
            echo "</table>";

            // Print MerchandiseSold2 Table
            $ms1_table = executePlainSQL("SELECT * FROM MerchandiseSold2");
            echo "<br>MerchandiseSold2 Table:<br>";
            echo "<table>";
            echo "<tr><th>mType</th><th>Manufacturer</th><th>Manufacturer</th><th>price</th></tr>";
            while ($row = OCI_Fetch_Array($ms1_table, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><tr>";
            }
            echo "</table>";
        }

        function handleShowAllTablesRequest() {
            global $db_conn;
            printResultAll();
        }
    ?>
</body>
</html>
