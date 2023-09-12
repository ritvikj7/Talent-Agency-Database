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

    <!-- What is left to add is Agregation with GroupBy, Nested Agregation with Group By, Divison -->

    <?php
        include "connect.php";

        function printResultAgencies() {
            // Print Agencies Table
            $agencies_table = executePlainSQL("SELECT * FROM Agencies");
            echo "<table class=agenciesTable>";
            echo "<tr><th>Name:</th><th>Founder:</th><th>Employee Count:</th></tr>";
            while ($row = OCI_Fetch_Array($agencies_table, OCI_BOTH)) {
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
            printResultAgencies();
        }

        function handleAggregationWithGroupByRequest() {
            handleShowAllTablesRequest();
            global $db_conn;

            $result = executePlainSQL(
                "SELECT cc.agency_name, MAX(c.pay_rate)
                FROM ContentCreators cc, contracts1 c
                WHERE cc.contracts_id = c.contracts_id
                GROUP BY cc.agency_name");
            echo "<h1 class=title2>Aggregation With Group By</h1>";
            echo "<h4 class=title>find the pay of the highest earning Content Creator from each Agency</h4>";
            echo "<table class=secondTable>";
            echo "<tr><th>Agency Name:</th><th>Pay:</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr>";
                echo "<td class='row'>" . $row[0] . "</td>";
                echo "<td class='row'>" . $row[1] . "</td>";
                echo "</tr>";
                }
            echo "</table>";

            OCICommit($db_conn);
        }


        function handleDivisionRequest() {
            handleShowAllTablesRequest();
            global $db_conn;
        
            $result = executePlainSQL(
                "SELECT a.agency_name
                FROM Agencies a
                WHERE NOT EXISTS
                        (
                            SELECT c.contracts_id
                            FROM Contracts1 c
                            MINUS
                            SELECT o.contracts_id
                            FROM Offer o
                            WHERE o.agency_name = a.agency_name
                        )"
                );
            echo "<h1 class=title2>Division</h1>";
            echo "<h4 class=title>Finds agencies that can give all types of possible contracts</h4>";
            echo "<table class=secondTable>";
            echo "<tr><th>Agency Name:</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr>";
                echo "<td class='row'>" . $row[0] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            OCICommit($db_conn);
        }

        function handleNestedAggregationWithGroupByRequest() {
            handleShowAllTablesRequest();
            global $db_conn;
        
            $result = executePlainSQL(
                "SELECT agency_name, MAX(avg_subscriber_count) as max_avg_subscriber_count
                FROM (
                    SELECT cc.agency_name as agency_name, AVG(y.subscriber_count) as avg_subscriber_count
                    FROM Youtubers y
                    INNER JOIN ContentCreators cc ON cc.content_creator_contact = y.content_creator_contact
                    GROUP BY cc.agency_name
                )
                GROUP BY agency_name"
            );
            echo "<h1 class=title2>Nested Aggregation</h1>";
            echo "<h4 class=title>Finds average youtube subscriber count for all agencies</h4>";

            echo "<table class='secondTable'>";
            echo "<tr><th>Agency Name:</th><th>subscriber count average:</th></tr>";
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

    <div class="button-container">
        <!-- What is left to add is Agregation with GroupBy, Nested Agregation with Group By, Divison -->
        <form method="GET" action="agencies.php" class="inline-form"> <!--refresh page when submitted-->
            <input type="hidden" id="aggregationWithGroupByQueryRequest" name="aggregationWithGroupByQueryRequest">
            <button type="submit" name="aggregationWithGroupBySubmit" class="button">
                <i class="fas fa-eye"></i> Aggregation With Group By
            </button>
        </form>

        <form method="GET" action="agencies.php" class="inline-form"> <!--refresh page when submitted-->
            <input type="hidden" id="divisionQueryRequest" name="divisionQueryRequest">
            <button type="submit" name="divisionSubmit" class="button">
                <i class="fas fa-eye"></i> Division
            </button>
        </form>

        <form method="GET" action="agencies.php" class="inline-form"> <!--refresh page when submitted-->
            <input type="hidden" id="nestedAggregationWithGroupByQueryRequest" name="nestedAggregationWithGroupByQueryRequest">
            <button type="submit" name="nestedAggregationWithGroupBySubmit" class="button">
                <i class="fas fa-eye"></i> Nested Aggregation
            </button>
        </form>
    </div>

</body>
</html>
