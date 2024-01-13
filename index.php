

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
            <h4>Login</h4>
            <span class="span">Welcome to Pet Care</span>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="loginForm" autocomplete="off">
                <label for="uname">Email</label>
                <input type="text" name="uname" id="" value="">
                <label for="pass">Password</label>
                <div class="passwordInput">
                    <input type="password" name="pass" id="id_password" value="">
                    <i class="fa fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer; display: inline;"></i>
                </div>
                <button type="submit" class="submitBtn" name="submitBtn">Login</button>
               
            </form>
            <?php
    session_start();
    if(isset($_SESSION['UserName']) && $_SESSION['UserName'] != '') {
        header('Location: ' . 'homepage.php', true);
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pets_care";
                
    $conn = new mysqli($servername, $username, $password, $dbname);

    if (isset($_POST['submitBtn'])) {
        $email = $_POST['uname'];
        $password = $_POST['pass'];

        $result = $conn->query("SELECT * FROM customer_details WHERE Email='$email' AND Password= '$password'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['UserID'] = $row['UserID'];
            $_SESSION['UserName'] = $row['Name'];

            // Check isAdmin and designation for redirection
            if ($row['isAdmin'] == 1) {
                header('Location: ' . 'adminPage.php', true);
                exit();
            } elseif ($row['designation'] == 1 || $row['designation'] == 2 || $row['designation'] == 3) {
                header('Location: ' . 'doctorpage.php', true);
                exit();
            } else {
                header('Location: ' . 'homepage.php', true);
                exit();
            }
        } else {
            echo '<p class="text text-danger">User not found. Please try again!</p>';
        }
    }
?>

            <a href="" class="forgotPass">Forgot password?</a>
            <a type="button" class="btn btn-success signUpBtn" href="sign-up.php">Sign Up</a>
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