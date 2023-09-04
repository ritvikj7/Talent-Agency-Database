<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent Agency Database</title>
    <link rel="stylesheet" href="navbarstyles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap">
    <link rel="stylesheet" href="merch.css">

    <script>
        function submitForm() {
            document.getElementById("merchForm").submit(); // Submit the form when an option is selected
        }
    </script>
</head>
<body>
    <div id="navbar-placeholder"></div> 

    <h1 class="merchandise">Merchandise Sold</h1>

    <script src="navbar.js"></script>
    <script>
        loadNavbar();
    </script>

    <?php
    include "connect.php";
    connectToDB(); // Establish the database connection
    ?>

    <form method="GET" action="merch.php" id="merchForm">
        <input type="hidden" id="joinQueryRequest" name="joinQueryRequest">
            <?php
            $contentCreatorsQuery = executePlainSQL("SELECT content_creator_contact, content_creator_name FROM ContentCreators");

            echo "<select id='selectCreators' name='ccid' onchange='submitForm()'>";
                echo "<option value='' selected disabled>SELECT CREATOR</option>";
                echo "<option value='Default'>All Creators</option>";
                while ($row = OCI_Fetch_Array($contentCreatorsQuery, OCI_BOTH)) {
                    echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                }
            echo "</select><br /><br />";
            ?>
    </form>


    <?php
        function printResultMerch() {
            // Print MerchandiseSold Table
            $ms_table = executePlainSQL(
                "SELECT m1.itemNumber, c.content_creator_name, c.content_creator_contact, m1.mType, m1.manufacturer, m2.price
                FROM MerchandiseSold1 m1, MerchandiseSold2 m2, ContentCreators c 
                WHERE m1.mType = m2.mType and m1.manufacturer = m2.manufacturer and m1.content_creator_contact = c.content_creator_contact");
            
            echo "<table class=merchTable>";
            echo "<tr><th>Item#</th><th>Creators Name</th><th>Creators Contact</th><th>Item Type</th><th>Manufacturer</th><th>Price</th></tr>";
            while ($row = OCI_Fetch_Array($ms_table, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td></tr>";
            }
            echo "</table>";
        }

        
        function handleShowAllTablesRequest() {
            global $db_conn;
            printResultMerch();
        }

        function handleJoinRequest() {
            global $db_conn;
        
            $contact = $_GET['ccid'];

            if($contact == 'Default'){
                printResultMerch();
            } else {
                $result = executePlainSQL(
                "SELECT m1.itemNumber, c.content_creator_name, c.content_creator_contact, m1.mType, m1.manufacturer, m2.price
                FROM MerchandiseSold1 m1, MerchandiseSold2 m2, ContentCreators c
                WHERE m1.mType = m2.mType and m1.manufacturer = m2.manufacturer and c.content_creator_contact = m1.content_creator_contact AND c.content_creator_contact=" . $contact . "");

                echo "<table class=merchTable>";
                echo "<tr><th>Item#</th><th>Creators Name</th><th>Creators Contact</th><th>Item Type</th><th>Manufacturer</th><th>Price</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td></tr>";
                }
                echo "</table>";

            }

            OCICommit($db_conn);
        }
    ?>


</body>
</html>
