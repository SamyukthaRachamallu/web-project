<?php
// Check if the serviceIDToDelete is set in the POST request
if (isset($_POST['bookingIDToConfirm'])) {
    // Retrieve the ServiceID value from the POST request
    $bookingIDToConfirm = $_POST['bookingIDToConfirm'];

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
    $sql = "UPDATE bookings SET confirmed = 1 WHERE BookingID = '$bookingIDToConfirm'";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful, you can redirect to the original page or display a success message
        header("Location: doctorpage.php");
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
