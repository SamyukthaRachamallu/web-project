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
     
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    // Perform the SQL insert query
        $result = $conn->query("SELECT * FROM customer_details where UserID = ".$_SESSION['UserID']."");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $name = $row['Name'];
            $email = $row['Email'];
            $phn = $row['PhoneNumber'];
            $UserID = $_SESSION['UserID'];
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="profile.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: #fff;">
    <a class="navbar-brand px-5"><h3>Pet Care</h3></a>
    <button class="navbar-toggler mx-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a href="homepage.php" class="nav-link"><h4>Home</h4></a></li>
            </ul>
    </div>
</nav>
    <div class="wholeDiv">
        <i class="fa fa-user-circle-o mb-5"></i>

        <form method="post" class="px-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-input" value="<?php echo $name; ?>" disabled>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-input" value="<?php echo $email; ?>" disabled>
                <label for="phn">Phone Number</label>
                <input type="tel" name="phn" id="phn" class="form-input" value="<?php echo $phn; ?>" disabled>
                
                <button type="button" class="btn btn-primary" id="editBtn" onclick="edit()">Edit</button>
                <button type="submit" class="btn btn-success" id="updBtn" name="updBtn" style="display: none">Update</button>

        </form>
        <p class="text text-danger" id="error"></p>

        <?php
                if (isset($_POST['updBtn'])) {
                    $username1 = $_POST['name'];
                    $phn1 = $_POST['phn'];
                    $email1 = $_POST['email'];
                    
                    if ($username1 == $name && $email == $email1 && $phn == $phn1) {
                        echo '<p class="text text-danger">No change in details.</p>';
                    } else {
                        if ($username1 == '' || $email1 == '' || $phn1 == '') {
                            echo '<p class="text text-danger">No field should be empty!</p>';
                        } else {
                            $result2 = $conn->query("UPDATE customer_details SET Name = '$username1', Email = '$email1', PhoneNumber = '$phn1' WHERE UserID = '$UserID'");
                            if($result2) {
                                echo '
                                    <p class="text text-success">Updated Succesfully</p>
                                    <script>
                                        setTimeout(function () {
                                            window.location.href = "profile.php";
                                        }, 2000);
                                    </script>
                                
                                ';
                            } else {
                                echo '<p class="text text-danger">Some error occured. Please try again!</p>';
                            }
                        }
                    }
                }
            ?>

    </div>
</body>
<script>
    function edit() {
        document.getElementById('editBtn').style.display = "none";
        document.getElementById("name").disabled = false;
        document.getElementById("email").disabled = false;
        document.getElementById("phn").disabled = false;
        document.getElementById('updBtn').style.display = "block";
    }
</script>
</html>