<html>
    <head>
        <title>CPSC 304 PHP/Content Creator Database</title>
    </head>

    <body>

        <h1>CPSC 304 PHP/Content Creator Database</h1>

        <h2>Insert Content Creators into Table</h2>
        <p>NOTE: A valid/existing ContractID, valid/existing combination of AgencyName and AgencyFounder, and UNIQUE Contact MUST be entered.</p>

        <form method="POST" action="main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            Name: <input type="text" name="insName"> <br /><br />
            Handle: <input type="text" name="insHandle"> <br /><br />
            Contact: <input type="text" name="insContact"> <br /><br />
            Status: <input type="text" name="insStatus"> <br /><br />
            Agency Name: <input type="text" name="insAgencyName"> <br /><br />
            Agency Founder: <input type="text" name="insAgencyFounder"> <br /><br />
            ContractID: <input type="text" name="insContractID"> <br /><br />

            <input type="submit" value="Insert" name="insertSubmit"></p>
        </form>

        <hr />

        <h2>Delete Content Creators from Table</h2>
        <p>NOTE: Any products sold from the deleted Content Creator will also be deleted.</p>

        <form method="POST" action="main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest">
            Content Creator Contact: <input type="text" name="delID"> <br /><br />

            <input type="submit" value="Delete" name="deleteSubmit"></p>
        </form>

        <hr />

        <h2>Update Attributes in ContentCreators Table</h2>
        <p>NOTE: The values are case sensitive and if you enter in the wrong case, the update statement will not do anything.</p>

        <form method="POST" action="main.php" id="atype"> <!--refresh page when submitted-->
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
            <label for="attributes">Choose an attribute to update:</label>
            <select id="attributes" name="atype" form="atype">
                <option value="content_creator_name">Name</option>
                <option value="handle">Handle</option>
                <option value="cStatus">Status</option>
                <option value="contracts_id">ContractID</option>
            </select> <br /><br />
            Content Creator Contact: <input type="text" name="CCC"> <br /><br />
            Old Value: <input type="text" name="oldValue"> <br /><br />
            New Value: <input type="text" name="newValue"> <br /><br />

            <input type="submit" value="Update" name="updateSubmit"></p>
        </form>

        <hr />

        <h2>Select from Tables</h2>

        <form method="POST" action="main.php">
            <input type="hidden" id="selectQueryRequest" name="selectQueryRequest">
            
            <label for="selectTable">Select a Table:</label>
            <select id="selectTable" name="selectTable">
                <option value="ContentCreators">ContentCreators</option>
                <option value="Agencies">Agencies</option>
                <option value="Contracts1">Contracts</option>
                <option value="MerchandiseSold1">Merchandise</option>

                <option value="MerchandiseSold2">Merchandise2</option>
                <option value="Youtubers">Youtubers</option>
                <option value="Offer">Offer</option>
            </select><br /><br />

            <label for="selectAttributes">Select Attribute(s):</label>
            <select id="selectAttributes" name="selectAttributes[]" multiple>
                <option value="content_creator_contact">Content Creator Contact</option>
                <option value="cStatus">Content Creator Status</option>
                <option value="content_creator_name">Content Creator Name</option>
                <option value="handle">Content Creator Handle</option>

                <option value="agency_name">Agency Name</option>
                <option value="agency_founder">Agency Founder</option>
                <option value="employee_count">Agency Employee Count</option>
                <option value="aLocation">Agency Location</option>

                <option value="contracts_id">Contract ID</option>
                <option value="cDate">Contract Date</option>
                <option value="pay_rate">Contract Pay</option>

                <option value="itemNumber">Merchandise Number</option>
                <option value="mType">Manufacturer Type</option>
                <option value="manufacturer">Manufacturer</option>

                <option value="price">Merch Price</option>

                <option value="subscriber_count">Subscriber Count</option>
            </select><br /><br />

            <label for="selectCondition">Condition:</label>
            <select id="selectConditionField" name="selectConditionField1">
                <option value=""></option> <!-- Blank option -->
                <option value="content_creator_contact">Content Creator Contact</option>
                <option value="cStatus">Content Creator Status</option>
                <option value="content_creator_name">Content Creator Name</option>
                <option value="handle">Content Creator Handle</option>
                <option value="agency_name">Agency Name</option>
                <option value="agency_founder">Agency Founder</option>
                <option value="employee_count">Agency Employee Count</option>
                <option value="aLocation">Agency Location</option>
                <option value="contracts_id">Contract ID</option>
                <option value="cDate">Contract Date</option>
                <option value="pay_rate">Contract Pay</option>
                <option value="itemNumber">Merchandise Number</option>
                <option value="mType">Merch Type</option>
                <option value="manufacturer">Manufacturer</option>
                <option value="price">Merch Price</option>
                <option value="subscriber_count">Subscriber Count</option>
            </select>
            =
            <input type="text" id="selectConditionValue" name="selectConditionValue1">
            AND
            <select id="selectConditionField" name="selectConditionField2">
                <option value=""></option> <!-- Blank option -->
                <option value="content_creator_contact">Content Creator Contact</option>
                <option value="employee_count">Agency Employee Count</option>
                <option value="contracts_id">Contract ID</option>
                <option value="pay_rate">Contract Pay</option>
                <option value="itemNumber">Merchandise Number</option>
                <option value="price">Merch Price</option>
                <option value="subscriber_count">Subscriber Count</option>
            </select>
            >
            <input type="text" id="selectConditionValue" name="selectConditionValue2"> <br /><br />


            <input type="submit" value="Select" name="selectSubmit">
        </form>

        <hr />

        <h2>Projection from Creators Table</h2>

        <form method="GET" action="main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="projectionQueryRequest" name="projectionQueryRequest">
            <label for="selectAttributes">Select Attribute(s):</label>
            <select id="selectAttributes" name="selectAttributes[]" multiple>
                <option value="content_creator_contact">Content Creator Contact</option>
                <option value="cStatus">Content Creator Status</option>
                <option value="content_creator_name">Content Creator Name</option>
                <option value="handle">Content Creator Handle</option>
                <option value="agency_name">Agency Name</option>
                <option value="agency_founder">Agency Founder</option>
                <option value="contracts_id">Contract ID</option>
            </select><br /><br />
            <input type="submit" value="Projection" name="projectionSubmit"></p>
        </form>

        <hr />

        <h2>Join ContentCreators With MerchandiseSold1</h2>
        <p>To find all products sold by a particular Content Creator</p>

        <form method="POST" action="main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="joinQueryRequest" name="joinQueryRequest">
            Content Creator Contact: <input type="text" name="ccid"> <br /><br />

            <input type="submit" value="Join" name="joinSubmit"></p>
        </form>

        <hr />

        <h2>Aggregation with Group By from Creators Table</h2>
        <p>To find the pay of the highest earning Content Creator from each Agency</p>

        <form method="GET" action="main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="aggregationWithGroupByQueryRequest" name="aggregationWithGroupByQueryRequest">
            <input type="submit" value="Get" name="aggregationWithGroupBySubmit"></p>
        </form>

        <hr />

        <h2>Aggregation with Having from Merchandise2 Table</h2>
        <p>Aggregate by manufacturer and display its most expensive item if more than $30</p>

        <form method="GET" action="main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="aggregationWithHavingQueryRequest" name="aggregationWithHavingQueryRequest">
            <input type="submit" value="AggregationWithHaving" name="aggregationWithHavingSubmit"></p>
        </form>

        <hr />

        <h2>Nested Aggregation with Group By from Youtubers Table</h2>
        <p>Find largest subscriber average from all agencies</p>

        <form method="GET" action="main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="nestedAggregationWithGroupByQueryRequest" name="nestedAggregationWithGroupByQueryRequest">
            <input type="submit" value="NestedAggregationWithGroupBy" name="nestedAggregationWithGroupBySubmit"></p>
        </form>

        <hr />

        <h2>Division from Agencies Table</h2>
        <p>Find the agencies who can give all types of contracts</p>

        <form method="GET" action="main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="divisionQueryRequest" name="divisionQueryRequest">
            <input type="submit" value="Division" name="divisionSubmit"></p>
        </form>

        <hr />

        <h2>Show All Tables</h2>
        <form method="GET" action="main.php"> <!--refresh page when submitted-->
            <input type="hidden" id="showAllTablesRequest" name="showAllTablesRequest">
            <input type="submit" value="Show" name="showAllTablesSubmit"></p>
        </form>

        <hr />

        <h2>Query Results</h2>

        <?php
        include "connect.php";
		//this tells the system that it's no longer just parsing html; it's now parsing PHP

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






        

        function handleUpdateRequest() {
            global $db_conn;

            $form_type = $_POST['atype'];
            $old_val = $_POST['oldValue'];
            $new_val = $_POST['newValue'];
            $cc_id = $_POST['CCC'];

            executePlainSQL("UPDATE ContentCreators SET " . $form_type . "='" . $new_val . "' WHERE " . $form_type . "='" . $old_val . "' AND content_creator_contact='" . $cc_id . "'");

            // Print ContentCreators Table
            $cc_table = executePlainSQL("SELECT * FROM ContentCreators");
            echo "<br>ContentCreators Table:<br>";
            echo "<table>";
            echo "<tr><th>Contact</th><th>Status</th><th>Name</th><th>AgencyName</th><th>AgencyFounder</th><th>ContractID</th><th>Handle</th></tr>";
            while ($row = OCI_Fetch_Array($cc_table, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td><tr>"; //or just use "echo $row[0]"
            }
            echo "</table>";

            OCICommit($db_conn);
        }

        function handleInsertRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['insContact'],
                ":bind2" => $_POST['insStatus'],
                ":bind3" => $_POST['insName'],
                ":bind4" => $_POST['insAgencyName'],
                ":bind5" => $_POST['insAgencyFounder'],
                ":bind6" => $_POST['insContractID'],
                ":bind7" => $_POST['insHandle']
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("INSERT INTO ContentCreators VALUES (:bind1, :bind2, :bind3, :bind4, :bind5, :bind6, :bind7)", $alltuples);

            // Print ContentCreators Table
            $cc_table = executePlainSQL("SELECT * FROM ContentCreators");
            echo "<br>ContentCreators Table:<br>";
            echo "<table>";
            echo "<tr><th>Contact</th><th>Status</th><th>Name</th><th>AgencyName</th><th>AgencyFounder</th><th>ContractID</th><th>Handle</th></tr>";
            while ($row = OCI_Fetch_Array($cc_table, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td><tr>"; //or just use "echo $row[0]"
            }
            echo "</table>";

            OCICommit($db_conn);
        }

        function handleShowAllTablesRequest() {
            global $db_conn;
            printResultAll();
        }

        function handleDeleteRequest() {
            global $db_conn;
            
            $del_id = $_POST['delID'];

            executePlainSQL("DELETE FROM ContentCreators WHERE content_creator_contact=" . $del_id . "");

            echo "<br>";

            // Print ContentCreators Table
            $cc_table = executePlainSQL("SELECT * FROM ContentCreators");
            echo "<br>ContentCreators Table:<br>";
            echo "<table>";
            echo "<tr><th>Contact</th><th>Status</th><th>Name</th><th>AgencyName</th><th>AgencyFounder</th><th>ContractID</th><th>Handle</th></tr>";
            while ($row = OCI_Fetch_Array($cc_table, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td><tr>"; //or just use "echo $row[0]"
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

            OCICommit($db_conn);
        }

        function handleSelectRequest() {
            global $db_conn;

            $table = $_POST['selectTable'];
            $attribute = $attribute = implode(', ', $_POST['selectAttributes']);
            $c_field1 = $_POST['selectConditionField1'];
            $c_value1 = $_POST['selectConditionValue1'];
            $c_field2 = $_POST['selectConditionField2'];
            $c_value2 = $_POST['selectConditionValue2'];
        
            $query = "SELECT $attribute FROM $table WHERE $c_field1='$c_value1' AND $c_field2>'$c_value2'";
            $result = executePlainSQL($query);
        
            echo "<h3>Query Result:</h3>";
            echo "<table border='1'>";
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

        function handleProjectionRequest() {
            global $db_conn;
            $attribute = $attribute = implode(', ', $_GET['selectAttributes']);
            $query = "SELECT DISTINCT $attribute FROM ContentCreators";
            $result = executePlainSQL($query);

            echo "<h3>Query Result:</h3>";
            echo "<table border='1'>";
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

        function handleJoinRequest() {
            global $db_conn;
        
            $contact = $_POST['ccid'];

            $result = executePlainSQL(
                "SELECT cc.content_creator_contact, cc.content_creator_name, m.itemNumber, m.mType, m.manufacturer
                FROM ContentCreators cc, MerchandiseSold1 m
                WHERE cc.content_creator_contact = m.content_creator_contact AND cc.content_creator_contact=" . $contact . "");

            echo "<table>";
            echo "<tr><th>Contact</th><th>ContentCreatorName</th><th>Item#</th><th>Type</th><th>Manufacturer</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><tr>";
            }
            echo "</table>";

            OCICommit($db_conn);
        }

        function handleAggregationWithGroupByRequest() {
            global $db_conn;

            $result = executePlainSQL(
                "SELECT cc.agency_name, MAX(c.pay_rate)
                FROM ContentCreators cc, contracts1 c
                WHERE cc.contracts_id = c.contracts_id
                GROUP BY cc.agency_name");

            echo "<table>";
            echo "<tr><th>Agency Name</th><th>Pay</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><tr>";
            }
            echo "</table>";

            OCICommit($db_conn);
        }
        
        function handleAggregationWithHaving() {
            global $db_conn;
        
            $result = executePlainSQL(
                "SELECT m2.manufacturer, MAX(m2.price)
                FROM MerchandiseSold2 m2
                GROUP BY m2.manufacturer
                HAVING MAX(m2.price) > 30"
                );

            echo "<table>";
            echo "<tr><th>Merch Manufacturer</th><th>max merch price</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><tr>";
            }
            echo "</table>";

            OCICommit($db_conn);
        }

        function handleNestedAggregationWithGroupByRequest() {
            global $db_conn;
        
            $result = executePlainSQL(
                "SELECT MAX(x.avg)
                FROM (SELECT cc.agency_name as agency_name, AVG(y.subscriber_count) as avg
                    FROM Youtubers y
                    INNER JOIN ContentCreators cc
                    ON cc.content_creator_contact = y.content_creator_contact
                    GROUP BY cc.agency_name) x"
            );
            echo "<table>";
            echo "<tr><th>subscriber count average</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><tr>";
            }
            echo "</table>";

            OCICommit($db_conn);
        }


        // Find the agencies who can give all types of contracts
        function handleDivisionRequest() { // TODO
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
            echo "<table>";
            echo "<tr><th>Agency Name</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><tr>";
            }
            echo "</table>";

            OCICommit($db_conn);
        }
		?>
	</body>
</html>