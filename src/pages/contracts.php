<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent Agency Database</title>
    <link rel="stylesheet" href="/src/navbar/navbarstyles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap">
    <link rel="stylesheet" href="contracts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    


    <script>
        function submitForm() {
            document.getElementById("contractsForm").submit(); // Submit the form when an option is selected
        }
    </script>
</head>
<body>
    <div id="navbar-placeholder"></div> 


    <form method="POST" action="contracts.php">
        <input type="hidden" id="selectQueryRequest" name="selectQueryRequest">
        
        <fieldset class="find-contracts">
            <legend>Find Contracts</legend>
            <div class="checkbox-list">
                <label>
                    ID: <input type="text" name="cid" placeholder="Min. contract ID">
                </label>
                <label>
                    Earliest Date: <input type="text" name="date" placeholder="YYYY-MM-DD">
                </label>
                <label>
                    Duration: <input type="text" name="dura" placeholder="Min. Duration">
                </label>
                <label>
                    Pay: <input type="text" name="pay" placeholder="Min. Pay">
                </label>
            </div>
            <!-- <input type="submit" value="Find" name="selectSubmit" class="button"> -->
            <button type="submit" name="selectSubmit" class="button">
                <i class="fas fa-search"></i> Find
            </button>
        </fieldset>
    </form>




    <h1 class="contracts">Contracts</h1>

    <script src="/src/navbar/navbar.js"></script>
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

        // Need to modify this request
        function handleSelectRequest() {
            global $db_conn;
        
            // Initialize variables with default values of -1
            $c_cid = -1;
            $c_date = '1900-01-01';
            $c_dura = -1;
            $c_pay = -1;
        
            // Check if the POST variables are set and not empty, then update the variables
            if (!empty($_POST['cid'])) {
                $c_cid = $_POST['cid'];
            }
        
            if (!empty($_POST['date'])) {
                $c_date = $_POST['date'];
            }
        
            if (!empty($_POST['dura'])) {
                $c_dura = $_POST['dura'];
            }
        
            if (!empty($_POST['pay'])) {
                $c_pay = $_POST['pay'];
            }
        
            // Build the SQL query with proper date comparison
            $query =
            "SELECT c.contracts_id, c.cDate, c2.duration, c2.pay_rate
             FROM Contracts1 c, Contracts2 c2
             WHERE c.cDate = c2.cDate and c.pay_rate = c2.pay_rate and c.contracts_id > $c_cid  and c2.duration > $c_dura and c2.pay_rate > $c_pay
             and TO_DATE(c2.cDate, 'YYYY-MM-DD') > TO_DATE('$c_date', 'YYYY-MM-DD')";
        
        
            $result = executePlainSQL($query);
        
            echo "<table class=contractsTable>";
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
        ?>
    </div>
</body>
</html>