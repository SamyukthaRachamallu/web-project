<?php
// Check if the serviceIDToDelete is set in the POST request
if (isset($_POST['bookingIDToCancel'])) {
    // Retrieve the ServiceID value from the POST request
    $bookingIDToCancel = $_POST['bookingIDToCancel'];

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
    $sql = "UPDATE bookings SET confirmed = 0 WHERE BookingID = '$bookingIDToCancel'";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful, you can redirect to the original page or display a success message
        header("Location: adminPage.php");
        exit;
    } else {
        echo "Error canceling : " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    exit;
}
?>
