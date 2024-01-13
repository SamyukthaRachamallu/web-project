<?php
    session_start();
  if(!isset($_SESSION['UserID'])) {
    header('Location: ' . 'index.php', true);
    exit();
  }
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $petType = $_POST['petType'];
    $gender = $_POST['gender'];
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $birthday = $_POST['birthday'];

    $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "pets_care";
                
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform the SQL insert query
    $sql = "INSERT INTO Pets (UserID, PetType, PetGender, PetName, Breed, BirthDay) 
            VALUES ('".$_SESSION['UserID']."','$petType', '$gender', '$name', '$breed', '$birthday')";

    if ($conn->query($sql) === TRUE) {
        echo "Added";
    } else {
        echo "Error";
    }

    $conn->close();
} else {
    echo "Invalid request method";
}
?>
