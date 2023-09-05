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

    <script>
        // Function to open the modal
        function openModal() {
            document.getElementById('myModal').style.display = 'block';
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }
    </script>
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

        handleShowAllTablesRequest();

        OCICommit($db_conn);
    }
    ?>


    <button class="button2" onclick="openModal()">Add Creators</button>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form method="POST" action="contentCreators.php"> <!--refresh page when submitted-->
                <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
                Name: <input type="text" name="insName"> <br /><br />
                Handle: <input type="text" name="insHandle"> <br /><br />
                Contact: <input type="text" name="insContact"> <br /><br />
                Status: <input type="text" name="insStatus"> <br /><br />
                Agency Name: <input type="text" name="insAgencyName"> <br /><br />
                Agency Founder: <input type="text" name="insAgencyFounder"> <br /><br />
                ContractID: <input type="text" name="insContractID"> <br /><br />
                <input type="submit" class='button2' value="Insert" name="insertSubmit"></p>
            </form>
        </div>
    </div>

</body>
</html>