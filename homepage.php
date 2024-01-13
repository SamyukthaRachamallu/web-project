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

            $isAdmin = false;
            
            $conn = new mysqli($servername, $username, $password, $dbname);

            $bill = 0;

            $res = $conn->query("SELECT isAdmin FROM customer_details WHERE UserID = '" . $_SESSION['UserID'] . "'");
            if ($res) {
                $row = $res->fetch_assoc(); // Fetch the first row as an associative array
                if ($row) {
                    $isAdmin = $row['isAdmin'];
                }
                $res->close(); // Close the result set
            }

            $result = $conn->query("SELECT * FROM bookings WHERE IsInCart = 1 AND UserID = '". $_SESSION['UserID'] ."'");
            $cartItems = $result->num_rows;
            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg" style="background-color: pink;">
    <a class="navbar-brand px-5"><h3>Pet Care</h3></a>
    <button class="navbar-toggler mx-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto px-5">
            <li class="nav-item"><a href="#" class="nav-link active"><h4>Home</h4></a></li>
            <li class="nav-item"><a href="myPets.php" class="nav-link"><h4>Pets</h4></a></li>
            <li class="nav-item"><a href="myBookings.php" class="nav-link"><h4>Bookings</h4></a></li>
            <li class="nav-item">
              <form action="" method="post" class="nav-link">
                <button class="btn btn-info" name="logoutBtn">Logout</button>
              </form>
            </li>
            <li class="nav-item"><a href="cart.php" class="nav-link"><h4><i class="fa fa-shopping-cart" aria-hidden="true"></i><div class="position-absolute translate-middle badge rounded-pill bg-info" style="height: 20px; width: font-size: 5px; text-align: center">
              <p style="font-size: 10px;"><?php echo $cartItems ?></p><span class="visually-hidden">unread messages</span></div></h4></a></li>
            <li class="nav-item"><a href="profile.php" class="nav-link"><h4><i class="fa fa-user-circle-o" aria-hidden="true"></i></h4></a></li>
            <?php
            // Check if the user is an admin (assuming $isAdmin contains the isAdmin value)
            if ($isAdmin) {
                echo '<li class="nav-item"><a href="adminPage.php" class="nav-link"><h4>Admin</h4></a></li>';
            }
            ?>

        </ul>
    </div>
</nav>
    <div class="wholeDiv">
        <div class="mb-4">
          <h5>Hi <span class="text text-warning"><?php echo $_SESSION['UserName']; ?></span>. What are you looking for?</h5>
        </div>
        <section class="cards-container">
            <div class="card" style="width: 18rem;" role="button" onclick="service('Veterinary')">
                <h4>Veterinary</h4>
                <img class="card-img-top" src="./Images/dog/veterinary.svg" alt="Dog">
                <button class="bookBtn" id="vet">Book Now</button>
              </div>
    
              <div class="card" style="width: 18rem;" role="button" onclick="service('Training')">
                <h4>Training</h4>
                <img class="card-img-top" src="./Images/dog/training.svg" alt="Dog">
                <button class="bookBtn" id="tr">Book Now</button>
              </div>
    
              <div class="card" style="width: 18rem;" role="button" onclick="service('Grooming')">
                <h4>Grooming</h4>
                <img class="card-img-top" src="./Images/dog/grooming.svg" alt="Dog">
                <button class="bookBtn" id="gr">Book Now</button>
              </div>
    
              <div class="card" style="width: 18rem;" role="button" onclick="service('Walking')">
                <h4>Walking</h4>
                <img class="card-img-top" src="./Images/dog/walking.svg" alt="Dog">
                <button class="bookBtn" id="wlk">Book Now</button>
              </div>
        </section>
    </div>

    <?php
      if(isset($_POST['logoutBtn'])) {
        $_SESSION['UserName'] = '';
        unset($_SESSION);
        session_destroy();
        header('Location: ' . 'index.php', true);
        exit();
      }
            ?>

<script>
  function service(service) {
    window.location.href = "serviceTypes.php?service="+service;
  }
</script>
</body>

</html>