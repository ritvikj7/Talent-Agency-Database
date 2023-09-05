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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <script>
        // Function to open the modal
        function openModal() {
            document.getElementById('myModal').style.display = 'block';
        }

        function openModal2(contact, name, handle, status, cid) {
        var modal = document.getElementById("myModal2");

        var contactInput = document.querySelector("#myModal2 input[name='CCC']");
        var nameInput = document.querySelector("#myModal2 input[name='nameValue']");
        var handleInput = document.querySelector("#myModal2 input[name='handleValue']");
        var statusInput = document.querySelector("#myModal2 input[name='statusValue']");
        var cidInput = document.querySelector("#myModal2 input[name='idValue']");

        contactInput.value = contact;
        nameInput.value = name;
        handleInput.value = handle;
        statusInput.value = status;
        cidInput.value = cid;

        modal.style.display = "block";
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }

        function closeModal2() {
            document.getElementById('myModal2').style.display = 'none';
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
            echo "<button type='button' class='button' onclick='openModal2(\"" . $row[0] . "\", \"" . $row[2] . "\", \"" . $row[6] . "\", \"" . $row[1] . "\", \"" . $row[5] . "\")'>";
            echo "<i class='fas fa-edit'></i>"; // Font Awesome edit icon
            echo "</button>";
            echo "</td>";

            echo "<td>";
            echo "<form method='POST' action='contentCreators.php'>";
            echo "<input type='hidden' value='" . $row[0] . "' name='deleteQueryRequest'>";
            echo "<button type='submit' class='button' name='deleteSubmit'>";
            echo "<i class='fas fa-trash'></i>"; // Font Awesome trash can icon
            echo "</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
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

    function handleUpdateRequest() {
        global $db_conn;

        $name_val = $_POST['nameValue'];
        $handle_val = $_POST['handleValue'];
        $status_val = $_POST['statusValue'];
        $id_val = $_POST['idValue'];
        $cc_id = $_POST['CCC'];

        executePlainSQL(
            "UPDATE ContentCreators 
            SET content_creator_name='$name_val', handle='$handle_val', cStatus='$status_val', contracts_id='$id_val'
            WHERE content_creator_contact='$cc_id'");

        handleShowAllTablesRequest();

        OCICommit($db_conn);
    }
    ?>

    <button class="button2" onclick="openModal()">
        <i class="fas fa-plus"></i>  Content Creators
    </button>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Add New Creators</h2>
            <p>Enter the Creator Details Below:</p>
            <br>
            <form method="POST" action="contentCreators.php"> <!--refresh page when submitted-->
                <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
                <div class="input-container">
                    <label for="insName">Name:</label>
                    <input type="text" id="insName" name="insName">
                </div>
                <div class="input-container">
                    <label for="insHandle">Handle:</label>
                    <input type="text" id="insHandle" name="insHandle">
                </div>
                <div class="input-container">
                    <label for="insContact">Contact:</label>
                    <input type="text" id="insContact" name="insContact">
                </div>
                <div class="input-container">
                    <label for="insStatus">Status:</label>
                    <input type="text" id="insStatus" name="insStatus">
                </div>
                <div class="input-container">
                    <label for="insAgencyName">Agency Name:</label>
                    <input type="text" id="insAgencyName" name="insAgencyName">
                </div>
                <div class="input-container">
                    <label for="insAgencyFounder">Agency Founder:</label>
                    <input type="text" id="insAgencyFounder" name="insAgencyFounder">
                </div>
                <div class="input-container">
                    <label for="insContractID">Contract ID:</label>
                    <input type="text" id="insContractID" name="insContractID">
                </div>
                <input type="submit" class="button2" value="Insert" name="insertSubmit">
            </form>
        </div>
    </div>

    <div id="myModal2" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal2()">&times;</span>
            <h2>Update Creators</h2>
            <p>Enter the Creator's Details Below:</p>
            <br>
            <form method="POST" action="contentCreators.php" id="updateForm"> <!--refresh page when submitted-->
                <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
                
                <div class="input-container">
                    <label for="CCC">Content Creator Contact:</label>
                    <input type="text" name="CCC" style="color: grey;">
                </div>
                
                <div class="input-container">
                    <label for="nameValue">Name:</label>
                    <input type="text" name="nameValue">
                </div>

                <div class="input-container">
                    <label for="handleValue">Handle:</label>
                    <input type="text" name="handleValue">
                </div>

                <div class="input-container">
                    <label for="statusValue">Status:</label>
                    <input type="text" name="statusValue">
                </div>
                
                <div class="input-container">
                    <label for="idValue">Contract ID:</label>
                    <input type="text" name="idValue">
                </div>

                <input type="submit" class='button2' value="Update" name="updateSubmit"></p>
            </form>
        </div>
    </div>
</body>
</html>