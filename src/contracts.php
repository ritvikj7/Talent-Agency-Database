<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent Agency Database</title>
    <link rel="stylesheet" href="navbarstyles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap">
    <link rel="stylesheet" href="contracts.css">

    <script>
        function submitForm() {
            document.getElementById("contractsForm").submit(); // Submit the form when an option is selected
        }
    </script>
</head>
<body>
    <div id="navbar-placeholder"></div> 

    <h1 class="contracts">Contracts</h1>

    <script src="navbar.js"></script>
    <script>
        loadNavbar();
    </script>

    <?php
    include "connect.php";
    connectToDB(); // Establish the database connection
    ?>

    <div class="filter-container">
        <h1 class="text">Filter By Agency</h1>
        <form method="GET" action="contracts.php" id="contractsForm">
            <input type="hidden" id="selectContractsRequest" name="selectContractsRequest">
                <?php
                $agenciesQuery = executePlainSQL("SELECT agency_name, agency_founder FROM Agencies");
                echo "<select id='selectAgency' name='offer' onchange='submitForm()'>";
                    echo "<option value='' selected disabled>SELECT AGENCY</option>";
                    echo "<option value='Default'>All Agencies</option>";
                    while ($row = OCI_Fetch_Array($agenciesQuery, OCI_BOTH)) {
                        $value = $row[0] . "-" . $row[1];
                        echo "<option value='" . $value . "'>" . $row[0] . "</option>";
                        // echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
                    }
                echo "</select><br /><br />";
                ?>
        </form>
    </div>

    <div class="contracts-container">
        <?php
        function printContracts() {
            // Print Contracts Table
            $contracts_table = executePlainSQL("
            SELECT c.contracts_id, c.cDate, c2.duration, c2.pay_rate 
            FROM Contracts1 c, Contracts2 c2 
            WHERE  c.cDate = c2.cDate and c.pay_rate = c2.pay_rate");

            echo "<table class='contractsTable'>";
            echo "<tr><th>Contract ID</th><th>Start Date</th><th>Duration (in Months)</th><th>Pay ($)</th></tr>";
            while ($row = OCI_Fetch_Array($contracts_table, OCI_BOTH)) {
                echo "<tr>";
                echo "<td class='row'>" . $row[0] . "</td>";
                echo "<td class='row'>" . $row[1] . "</td>";
                echo "<td class='row'>" . $row[2] . "</td>";
                echo "<td class='row'>" . $row[3] . "</td>";
                echo "</tr>";            
            }
            echo "</table>";
        }

        function handleShowAllTablesRequest() {
            global $db_conn;
            printContracts();
        }

        function handleContractsRequest(){
            global $db_conn;
        
            $offer = $_GET['offer'];

            if($offer == 'Default'){
                printContracts();
            } else {
                list($agencyName, $agencyFounder) = explode('-', $offer);
                $result = executePlainSQL(
                    "SELECT c.contracts_id, c.cDate, c2.duration, c2.pay_rate , o.agency_name
                    FROM Contracts1 c, Contracts2 c2, Offer o
                    WHERE c.cDate = c2.cDate and c.pay_rate = c2.pay_rate and c.contracts_id = o.contracts_id and o.agency_name='$agencyName' and o.agency_founder='$agencyFounder'");

                echo "<table class=contractsTable>";
                echo "<tr><th>Contract ID</th><th>Start Date</th><th>Duration (in Months)</th><th>Pay ($)</th><th>Agency</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr>";
                    echo "<td class='row'>" . $row[0] . "</td>";
                    echo "<td class='row'>" . $row[1] . "</td>";
                    echo "<td class='row'>" . $row[2] . "</td>";
                    echo "<td class='row'>" . $row[3] . "</td>";
                    echo "<td class='row'>" . $row[4] . "</td>";
                    echo "</tr>";                 
                }
                echo "</table>";
            }

            OCICommit($db_conn);
        }
        ?>
    </div>
    
</body>
</html>