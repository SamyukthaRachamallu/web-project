<?php
  session_start();
  if(!isset($_SESSION['UserID'])) {
    header('Location: ' . 'index.php', true);
    exit();
  }     

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pets_care";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


  $categoryName = "";

// Check if the form is submitted
if (isset($_POST['saveCat'])) {
    // Get the category name from the form
    $categoryName = $_POST["categoryName"];

    // Insert the category name into the 'services' table
    $sql = "INSERT INTO services (PetType) VALUES ('$categoryName')";
    if ($conn->query($sql)) {

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Include your database connection code if it's not already included

if (isset($_POST['saveService'])) {// Get the form data
        $serviceName = $_POST["serviceName"];
        $serviceCategory = $_POST["serviceCategory"];
        $serviceDescription = $_POST["serviceDescription"];
        $servicePrice = $_POST["servicePrice"];

        // SQL query to insert data into the table (assuming you have a table named 'services')
        $sql1234 = "INSERT INTO services (PetType, `Service`, `Type`, Amount, rating, info) VALUES ('$serviceCategory', '$serviceName','$serviceDescription', '$servicePrice', '4', '$serviceDescription')";
        
        // Use prepared statements to prevent SQL injection
        $stmt1 = $conn->query($sql1234);

        if ($stmt1) {
            // Data inserted successfully
        } else {
            echo "Error: " . $sql1234 . "<br>" . $conn->error;
        }
} else {
    echo "Invalid request method.";
}

// Establish a database connection (similar to your existing code)

if (isset($_POST['booking_id']) && isset($_POST['status'])) {
    $bookingId = $_POST['booking_id'];
    $status = $_POST['status'];

    // Update the 'confirmed' column to the specified status (1 for Confirm, 0 for Cancel)
    $sql12345 = "UPDATE bookings SET confirmed = $status WHERE BookingID = $bookingId";

    if ($conn->query($sql12345) === TRUE) {
    } else {
        echo "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: #fff;">
    <a class="navbar-brand px-5"><h3>Pet Care</h3></a>
    <button class="navbar-toggler mx-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
        <form action="" method="post" class="nav-link">
                <button class="btn btn-info" name="logoutBtn">Logout</button>
              </form>
            </ul>
    </div>
    <!-- <li class="nav-item">
              <form action="" method="post" class="nav-link">
                <button class="btn btn-info" name="logoutBtn">Logout</button>
              </form>
            </li> -->
</nav>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-black text-decoration-none">
                            <i class="fs-4 bi-person-circle"></i>
                            <span class="d-none d-sm-inline mx-1"><?php echo strtoupper($_SESSION['UserName']); ?>
</span>
                        </a>
                    </div>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="#" id="dashboard" class="nav-link align-middle">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>
                        <hr>
                        
                        <span class="fs-5 d-none d-sm-inline text-black">Maintenance</span>

                        <li class="nav-item">
                            <a href="#" id="categories" class="nav-link align-middle">
                                <i class="fs-4 bi-card-list"></i> <span class="ms-1 d-none d-sm-inline">Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="services" class="nav-link align-middle">
                                <i class="fs-4 bi-stack"></i> <span class="ms-1 d-none d-sm-inline">Services List</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col py-3">
                <h2>Welcome to Pet Care - Admin Panel</h2>
                <hr>
                <div id="maincontent">

                </div>
            </div>
        </div>
    </div>

    
</body>

<script type="text/javascript">
    $('#dashboard').click(function(){
        $("#maincontent").load("dashboard.php");
        $("#dashboard").addClass("active");
        $("#categories").removeClass("active");
        $("#services").removeClass("active");

        return false;
    });

    $('#categories').click(function(){
        $("#maincontent").load("categories.php");
        $("#categories").addClass("active");
        $("#dashboard").removeClass("active");
        $("#services").removeClass("active");

        return false;
    });

    $('#services').click(function(){
        $("#maincontent").load("services.php");
        $("#services").addClass("active");
        $("#categories").removeClass("active");
        $("#dashboard").removeClass("active");

        return false;
    });


    <?php
      if(isset($_POST['logoutBtn'])) {
        $_SESSION['UserName'] = '';
        unset($_SESSION);
        session_destroy();
        header('Location: ' . 'index.php', true);
        exit();
      }
            ?>

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $( document ).ready(function() {
        $( "#dashboard" ).trigger( "click" );
    });
</script>
</html>