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

            $result = $conn->query("SELECT * FROM pets WHERE UserID = '". $_SESSION['UserID'] ."'");
            $pets = $result;
            
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
    <link rel="stylesheet" href="mypets.css">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
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
        <section class="cards-container">
            <?php
                while ($pet = $result->fetch_assoc()) {
                    echo "
                        <div class='card' style='width: 18rem;'>
                            <h4 class='text text-success'>{$pet['PetName']}</h4>
                            <h5>Breed : {$pet['Breed']}</h5>
                            <h5>Gender : {$pet['PetGender']}</h5>
                            <h5>Birthday : {$pet['BirthDay']}</h5>
                            <img src='./Images/{$pet['PetType']}/{$pet['PetType']}.svg' alt='Card image cap'>
                        </div>";
                }
            ?>
        </section>
    </div>
</body>

</html>