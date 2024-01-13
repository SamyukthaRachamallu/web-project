<?php
// Check if the serviceIDToDelete is set in the POST request
if (isset($_POST['designationIDToDelete'])) {
    // Retrieve the ServiceID value from the POST request
    $designationIDToDelete = $_POST['designationIDToDelete'];

    // Add your database connection code here
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pets_care";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL DELETE statement
    $sql = "DELETE FROM designation WHERE Id = '$designationIDToDelete'";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful, you can redirect to the original page or display a success message
        header("Location: adminPage.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to an error page or handle the case where serviceIDToDelete is not set
    header("Location: errorPage.php");
    exit;
}
?>
