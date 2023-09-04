<?php
    $success = True; //keep track of errors so it redirects the page only if there are no errors
    $db_conn = NULL; // edit the login credentials in connectToDB()
    $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

    function debugAlertMessage($message) {
        global $show_debug_alert_messages;

        if ($show_debug_alert_messages) {
            echo "<script type='text/javascript'>alert('" . $message . "');</script>";
        }
    }

    function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
        //echo "<br>running ".$cmdstr."<br>";
        global $db_conn, $success;

        $statement = OCIParse($db_conn, $cmdstr);
        //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

        if (!$statement) {
            echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
            $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
            echo htmlentities($e['message']);
            $success = False;
        }

        $r = OCIExecute($statement, OCI_DEFAULT);
        if (!$r) {
            echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
            $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
            echo htmlentities($e['message']);
            $success = False;
        }

        return $statement;
    }

    function executeBoundSQL($cmdstr, $list) {
        /* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
    In this case you don't need to create the statement several times. Bound variables cause a statement to only be
    parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection.
    See the sample code below for how this function is used */

        global $db_conn, $success;
        $statement = OCIParse($db_conn, $cmdstr);

        if (!$statement) {
            echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
            $e = OCI_Error($db_conn);
            echo htmlentities($e['message']);
            $success = False;
        }

        foreach ($list as $tuple) {
            foreach ($tuple as $bind => $val) {
                //echo $val;
                //echo "<br>".$bind."<br>";
                OCIBindByName($statement, $bind, $val);
                unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
            }

            $r = OCIExecute($statement, OCI_DEFAULT);
            if (!$r) {
                echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
                echo htmlentities($e['message']);
                echo "<br>";
                $success = False;
            }
        }
    }

    function connectToDB() {
        global $db_conn;

        // $db_conn = OCILogon("ora_ritvikj", "a72789472", "dbhost.students.cs.ubc.ca:1522/stu");

        $json = file_get_contents("oracle.json");
        $json_data = json_decode($json,true);

        // Your username is ora_(CWL_ID) and the password is a(student number). For example,
        // ora_platypus is the username and a12345678 is the password.
        $db_conn = OCILogon($json_data["oracle_username"], $json_data["oracle_password"], "dbhost.students.cs.ubc.ca:1522/stu");

        
        if ($db_conn) {
            debugAlertMessage("Database is Connected");
            return true;
        } else {
            debugAlertMessage("Cannot connect to Database");
            $e = OCI_Error(); // For OCILogon errors pass no handle
            echo htmlentities($e['message']);
            return false;
        }
    }

    function disconnectFromDB() {
        global $db_conn;

        debugAlertMessage("Disconnect from Database");
        OCILogoff($db_conn);
    }

    // HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
    function handlePOSTRequest() {
        if (connectToDB()) {
            if (array_key_exists('updateQueryRequest', $_POST)) {
                handleUpdateRequest();
            } else if (array_key_exists('insertQueryRequest', $_POST)) {
                handleInsertRequest();
            } else if (array_key_exists('deleteQueryRequest', $_POST)) {
                handleDeleteRequest();
            } else if (array_key_exists('selectQueryRequest', $_POST)) {
                handleSelectRequest();
            } 

            disconnectFromDB();
        }
    }

    // HANDLE ALL GET ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
    function handleGETRequest() {
        if (connectToDB()) {
            if (array_key_exists('showAllTablesRequest', $_GET)) {
                handleShowAllTablesRequest();
            } else if (array_key_exists('showSponsorsRequest', $_GET)) {
                handleShowSponsorRequest();
            } else if (array_key_exists('aggregationWithGroupByQueryRequest', $_GET)) {
                handleAggregationWithGroupByRequest();
            } else if (array_key_exists('projectionQueryRequest', $_GET)) {
                handleProjectionRequest();
            } else if (array_key_exists('aggregationWithHavingQueryRequest', $_GET)) {
                handleAggregationWithHaving();
            } else if (array_key_exists('nestedAggregationWithGroupByQueryRequest', $_GET)) {
                handleNestedAggregationWithGroupByRequest();
            } else if (array_key_exists('divisionQueryRequest', $_GET)) {
                handleDivisionRequest();
            } else if (array_key_exists('joinQueryRequest', $_GET)) {
                handleJoinRequest();
            }

            disconnectFromDB();
        }
    }

    if (isset($_POST['updateSubmit']) || isset($_POST['insertSubmit']) || isset($_POST['deleteSubmit']) || isset($_POST['selectSubmit'])) {
        handlePOSTRequest();
    } else if (isset($_GET['showAllTablesSubmit']) || isset($_GET['joinQueryRequest']) || isset($_GET['showSponsorsSubmit']) || isset($_GET['aggregationWithGroupBySubmit']) || isset($_GET['projectionSubmit']) || isset($_GET['aggregationWithHavingSubmit']) || isset($_GET['nestedAggregationWithGroupBySubmit']) || isset($_GET['divisionSubmit'])) {
        handleGETRequest();
    }
?>