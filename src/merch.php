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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        function submitForm() {
            document.getElementById("merchForm").submit(); // Submit the form when an option is selected
        }
    </script>


</head>

<body>
    <div id="navbar-placeholder"></div> 

    <form method="GET" action="merch.php" id=1>
        <input type="hidden" id="projectionQueryRequest" name="projectionQueryRequest">
        <fieldset>
            <legend>Select Columns</legend>
            <div class="checkbox-list">
                <label>
                    <input type="checkbox" name="selectAttributes[]" value="m1.itemNumber"> Item#
                </label>
                <label>
                    <input type="checkbox" name="selectAttributes[]" value="c.content_creator_name"> Creators Name
                </label>
                <label>
                    <input type="checkbox" name="selectAttributes[]" value="c.content_creator_contact"> Creators Contact
                </label>
                <label>
                    <input type="checkbox" name="selectAttributes[]" value="m1.mType"> Item/Merch Type
                </label>
                <label>
                    <input type="checkbox" name="selectAttributes[]" value="m1.manufacturer"> Manufacturer
                </label>
                <label>
                    <input type="checkbox" name="selectAttributes[]" value="m2.price"> Price
                </label>
                <!-- <input type="submit" value="Select" name="projectionSubmit" class="button"></p> -->
            </div>
        </fieldset>
        <button type="submit" name="projectionSubmit" class="button">
            <i class="fas fa-eye"></i> Select
        </button>
        <br />
    </form>


    <h1 class="merchandise">Merchandise Sold</h1>

    <script src="navbar.js"></script>
    <script>
        loadNavbar();
    </script>

    <?php
    include "connect.php";
    connectToDB(); // Establish the database connection
    ?>

    <div class="filter-container">
        <h1 class="text">Filter By Content Creator</h1>
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
    </div>


    <div class="contracts-container">
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
                    echo "<tr>";
                    echo "<td class='row'>" . $row[0] . "</td>";
                    echo "<td class='row'>" . $row[1] . "</td>";
                    echo "<td class='row'>" . $row[2] . "</td>";
                    echo "<td class='row'>" . $row[3] . "</td>";
                    echo "<td class='row'>" . $row[4] . "</td>";
                    echo "<td class='row'>" . $row[5] . "</td>";
                    echo "</tr>";                
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
                    WHERE m1.mType = m2.mType and m1.manufacturer = m2.manufacturer and c.content_creator_contact = m1.content_creator_contact and c.content_creator_contact=" . $contact . "");

                    echo "<table class=merchTable>";
                    echo "<tr><th>Item#</th><th>Creators Name</th><th>Creators Contact</th><th>Item Type</th><th>Manufacturer</th><th>Price</th></tr>";
                    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                        echo "<tr>";
                        echo "<td class='row'>" . $row[0] . "</td>";
                        echo "<td class='row'>" . $row[1] . "</td>";
                        echo "<td class='row'>" . $row[2] . "</td>";
                        echo "<td class='row'>" . $row[3] . "</td>";
                        echo "<td class='row'>" . $row[4] . "</td>";
                        echo "<td class='row'>" . $row[5] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";

                }

                OCICommit($db_conn);
            }


            function handleProjectionRequest() {
                global $db_conn;
                $attribute = implode(', ', $_GET['selectAttributes']);
                $query = "SELECT DISTINCT $attribute 
                          FROM MerchandiseSold1 m1, MerchandiseSold2 m2, ContentCreators c
                          WHERE m1.mType = m2.mType and m1.manufacturer = m2.manufacturer and c.content_creator_contact = m1.content_creator_contact";
                $result = executePlainSQL($query);
    
                echo "<table class=merchTable>";
                $field_names = oci_num_fields($result);
                echo "<tr>";
                for ($i = 1; $i <= $field_names; $i++) {
                    $field_name = oci_field_name($result, $i);
                    echo "<th>$field_name</th>";
                }
                echo "</tr>";
            
                while ($row = oci_fetch_array($result, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    echo "<tr>";
                    foreach ($row as $field_value) {
                        echo "<td>$field_value</td>";
                    }
                    echo "</tr>";
                }
            
                echo "</table>";
            
                OCICommit($db_conn);
            }

            function handleAggregationWithHaving() {
                global $db_conn;
                $minValue = $_GET['minValue'];
            
                $result = executePlainSQL(
                    "SELECT m2.manufacturer, MAX(m2.price)
                    FROM MerchandiseSold2 m2
                    GROUP BY m2.manufacturer
                    HAVING MAX(m2.price) > $minValue"
                    );
    
                echo "<table class=merchTable>";
                echo "<tr><th>Manufacturer</th><th>max merch price</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr>";
                    echo "<td class='row'>" . $row[0] . "</td>";
                    echo "<td class='row'>" . $row[1] . "</td>";
                    echo "</tr>"; 
                }
                echo "</table>";
    
                OCICommit($db_conn);
            }
        ?>
    </div>

    <div class=dog>
        <form method="GET" action="merch.php"> 
            <input type="hidden" id="aggregationWithHavingQueryRequest" name="aggregationWithHavingQueryRequest">
            Most Expensive item by Manufacturer: <input type="text" name="minValue" placeholder="Min. Amount">
            <button type="submit" name="aggregationWithHavingSubmit" class="button2">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</body>
</html>
