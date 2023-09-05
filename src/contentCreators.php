<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent Agency Database</title>
    <link rel="stylesheet" href="navbarstyles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap">
    <link rel="stylesheet" href="contentCreators.css">
</head>
<body>
    <div id="navbar-placeholder"></div> 

    <h1 class="contentcreators">Content Creators</h1>

    <script src="navbar.js"></script>
    <script>
        loadNavbar();
    </script>

    <?php
    include "connect.php";

    function printResultContentCreators() {
        // Print ContentCreators Table
        $cc_table = executePlainSQL("SELECT * FROM ContentCreators");
        echo "<table class='creatorsTable'>";
        echo "<tr><th>Contact</th><th>Status</th><th>Name</th><th>Agency Name</th><th>Agency Founder</th><th>Contract ID</th><th>Handle</th></tr>";
        while ($row = OCI_Fetch_Array($cc_table, OCI_BOTH)) {
            echo "<tr>";
            echo "<td class='row'>" . $row[0] . "</td>";
            echo "<td class='row'>" . $row[1] . "</td>";
            echo "<td class='row'>" . $row[2] . "</td>";
            echo "<td class='row'>" . $row[3] . "</td>";
            echo "<td class='row'>" . $row[4] . "</td>";
            echo "<td class='row'>" . $row[5] . "</td>";
            echo "<td class='row'>" . $row[6] . "</td>";
            echo "<td>";
            echo "<form method='POST' action='contentCreators.php'>";
            echo "<input type='hidden' value='" . $row[0] . "' name='deleteQueryRequest'>";
            echo "<input type='submit' class='button' value='Delete' name='deleteSubmit'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";

            // echo "<td><button class='button' onclick='deleteRow(" . $row[0] . ")'>Delete</button></td>";
            // echo "</tr>";
        }
        echo "</table>";
    }

    function handleDeleteRequest() {
        global $db_conn;
        $del_id = $_POST['deleteQueryRequest'];
        executePlainSQL("DELETE FROM ContentCreators WHERE content_creator_contact=" . $del_id . "");
        printResultContentCreators();
        OCICommit($db_conn);
    }

    function handleShowAllTablesRequest() {
        global $db_conn;
        printResultContentCreators();
    }
    ?>


    
</body>
</html>