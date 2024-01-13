<?php
// Check if the petTypeToDelete is set in the POST request
if (isset($_POST['petTypeToDelete'])) {
    // Retrieve the PetType value from the POST request
    $petTypeToDelete = $_POST['petTypeToDelete'];

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
    $sql = "DELETE FROM services WHERE PetType = '$petTypeToDelete'";

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
    exit;
}
?>
