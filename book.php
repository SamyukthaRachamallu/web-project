<?php
  session_start();
  if(!isset($_SESSION['UserID'])) {
    header('Location: ' . 'index.php', true);
    exit();
  }
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "pets_care";
                
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform the SQL insert query
    $sql = "UPDATE bookings SET IsInCart = 0 WHERE UserID = " . $id;


    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error";
    }

    $conn->close();
} else {
    echo "Invalid request method";
}
?>
