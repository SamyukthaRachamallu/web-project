<?php
session_start();

if (isset($_SESSION['UserName']) && $_SESSION['UserName'] != '') {
    header('Location: index.php');
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

if (isset($_POST['submitBtn'])) {
    $username1 = $_POST['name'];
    $phn = $_POST['phn'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $designationId = $_POST['designation'];

    try {
        // Use prepared statements to prevent SQL injection
        $stmtCheck = $conn->prepare("SELECT * FROM customer_details WHERE Email=? OR PhoneNumber=?");

        if (!$stmtCheck) {
            throw new Exception('Error preparing statement: ' . $conn->error);
        }

        $stmtCheck->bind_param("ss", $email, $phn);

        if (!$stmtCheck->execute()) {
            throw new Exception('Error executing statement: ' . $stmtCheck->error);
        }

        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            echo '<p class="text text-danger">Email or phone number already in use!</p>';
        } else {
            $stmt = $conn->prepare("INSERT INTO customer_details(Name, Email, PhoneNumber, Password, designation) VALUES(?, ?, ?, ?, ?)");

            if (!$stmt) {
                throw new Exception('Error preparing statement: ' . $conn->error);
            }

            $stmt->bind_param("ssssi", $username1, $email, $phn, $password, $designationId);

            if (!$stmt->execute()) {
                throw new Exception('Error executing statement: ' . $stmt->error);
            }

            $_SESSION['UserID'] = $stmt->insert_id;
            $_SESSION['UserName'] = $username1;
            header('Location: index.php');
            exit();
        }
    } catch (Exception $e) {
        echo '<p class="text text-danger">' . $e->getMessage() . '</p>';
    }
}
?>

<!-- Rest of your HTML code remains unchanged -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Care</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="wholeDiv">
        <div class="sideView">
            <img class="card-img-top" style="width: 90% ; margin-top:10px" src="./Images/mainimage.png" alt="Dog">
        </div>
        <div class="form">
            <h4>Sign Up</h4>
            <span class="span">Welcome to Pet Care</span>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="name">Name</label>
                <input type="text" name="name" id="">
                <label for="email">Email</label>
                <input type="email" name="email" id="">
                <label for="phn">Phone Number</label>
                <input type="tel" name="phn" id="">
                
                <label for="designation">Designation</label>
                <select name="designation" id="">
                    <?php
                    $sqlDesignations = "SELECT Id, dest FROM designation";
                    $resultDesignations = $conn->query($sqlDesignations);

                    if ($resultDesignations) {
                        while ($rowDesignation = $resultDesignations->fetch_assoc()) {
                            echo "<option value='{$rowDesignation["Id"]}'>{$rowDesignation["dest"]}</option>";
                        }
                    } else {
                        echo "Error: " . $conn->error;
                    }
                    ?>
                </select>

                <label for="pass">Password</label>
                <div class="passwordInput">
                    <input type="password" name="pass" id="id_password">
                    <i class="fa fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer; display: inline;"></i>
                </div>
                <button type="submit" class="submitBtn" name="submitBtn">Sign Up</button>
            </form>
            
            <a type="button" class="btn btn-success signUpBtn" href="index.php">Log In</a>
        </div>
    </div>
</body>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#id_password');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>
