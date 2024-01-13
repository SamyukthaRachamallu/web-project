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
    $result = $conn->query("SELECT * FROM services where ServiceID = ".$_GET['id']."");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="infoPage.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: pink;">
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
    <div class="wholeDiv tab">
        <?php
            $words = explode(" ", $row['Type']);
            $acronym = "";

            foreach ($words as $w) {
                $acronym .= mb_substr($w, 0, 1);
            }
            $word = strtolower($acronym);
            if($row['PetType'] == 'Dog') {
                echo '<img src="./Images/dog/'.$word.'.svg" height="200px" width="200px" alt="Dog">';
            } else if($row['PetType'] == 'Cat') {
                echo '<img src="./Images/cat/'.$word.'.svg" height="200px" width="200px" alt="Cat">';
            }
        ?>
          <h5 id="title">
            <?php
                echo $row['PetType'];
            ?>
          </h5>
        <div>
            <i class="fa fa-star" style="color: #Ffd700"></i>
            <i class="fa fa-star" style="color: #Ffd700"></i>
            <i class="fa fa-star" style="color: #Ffd700"></i>
            <i class="fa fa-star" style="color: #Ffd700"></i>
            <i class="fa fa-star" style="color: #Ffd700"></i>
        </div>
        <p>&#x20b9; 
        <?php
            echo $row['Amount'];
            ?>
        </p>
        <div class="accordion px-5" style="width: 80%" id="accordionExample">
        <h5>About
            <?php
                echo $row['Type'];
            ?>
        </h5>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                Info
            </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <?php echo $row['Info']; ?>
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Cancellation and Refund Policy
            </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
            Cancellations made 2 days or more in advance of the appointment date will receive a 100% refund. Cancellations made within 1 days will receive a 50% refund. Cancellations made within 8 hours will not receive a refund.    
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                How it works
            </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <?php echo $row['Info']; ?>  
            </div>
            </div>
        </div>
        </div>
        <button class="btn btn-primary my-3" onclick="showTab(1)">Add to cart</button>
    </div>

    <div class="wholeDiv tab">
    <?php
            $words = explode(" ", $row['Type']);
            $acronym = "";

            foreach ($words as $w) {
                $acronym .= mb_substr($w, 0, 1);
            }
            $word = strtolower($acronym);
            if($row['PetType'] == 'Dog') {
                echo '<img src="./Images/dog/'.$word.'.svg" height="200px" width="200px" alt="Dog">';
            } else if($row['PetType'] == 'Cat') {
                echo '<img src="./Images/cat/'.$word.'.svg" height="200px" width="200px" alt="Cat">';
            }
        ?>
          <h5 id="title">
            <?php
                echo $row['PetType'];
            ?>
          </h5>

        <h5>Schedule Appointment</h5>

        <div class="mb-2">
            <input type="date" id="dates" class="form-control" name="datepicker" min="<?php echo date('Y-m-d'); ?>">
        </div>

        <div class="dropdown my-2">
        <select class="form-select" aria-label="Default select example" id="time">
            <option selected>Pick a time</option>
            <option value="8AM-11AM">8AM - 11AM</option>
            <option value="4PM-6PM">4PM-6PM</option>
        </select>
        </div>
        <div class="dropdown my-2">
        <select class="form-select" aria-label="Default select example" id="hospital">
            <option selected>Pick hospital location</option>
            <option value="XYZ Hospital">XYZ Hospital</option>
            <option value="ABC Hospital">ABC Hospital</option>
            <option value="UVW Hospital">UVW Hospital</option>
        </select>
        </div>

        <p class="px-2"><i class="fa fa-info-circle"></i>&nbsp;There might be slight change in the session timings due to availability of vendors.</p>
        <p class="text text-danger" id="slotError"></p>
        <button class="btn btn-primary my-3" onclick="timings()">Confirm Slot</button>
    </div>


    <div class="wholeDiv tab">
    <?php
            $words = explode(" ", $row['Type']);
            $acronym = "";

            foreach ($words as $w) {
                $acronym .= mb_substr($w, 0, 1);
            }
            $word = strtolower($acronym);
            if($row['PetType'] == 'Dog') {
                echo '<img src="./Images/dog/'.$word.'.svg" height="200px" width="200px" alt="Dog">';
            } else if($row['PetType'] == 'Cat') {
                echo '<img src="./Images/cat/'.$word.'.svg" height="200px" width="200px" alt="Cat"">';
            }
        ?>
          <h5 id="title">
            <?php
                echo $row['PetType'];
            ?>
          </h5>
        <h5>Select a pet</h5>
        <fieldset id="group1">
            <section class="cards-container">

                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "pets_care";
                    
                $conn = new mysqli($servername, $username, $password, $dbname);
            
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
            
                // Perform the SQL insert query
                $sql = $conn->query("SELECT * FROM pets WHERE UserID = '".$_SESSION['UserID']."'");

while ($row1 = $sql->fetch_assoc()) {
    echo '
    <div class="card" style="width: 18rem;" role="button">
        <input type="radio" name="group1" id="" class="radio" role="button" value="'.$row1['PetID'].'">
        <h4>' . $row1['PetName'] . '</h4>
        <h6>' . $row1['Breed'] . '</h6>
        <img class="card-img-top" src="./Images/' . $row1['PetType'] . '/' . $row1['PetType'] . '.svg" alt="Dog">
    </div>
    ';
}
                ?>
                
                <button class="btn btn-dark mx-3 my-5" style="height: 100px; width 100px" data-bs-toggle="modal" data-bs-target="#addPetModal" id="addPetButton">Add Pet +</button>
            </section>
        </fieldset>
        <p class="text text-danger" id="petError"></p>
        <button class="btn btn-primary my-3" onclick="selectedPet()">Next</button>
    </div>

    <div class="wholeDiv tab">
    <?php
            $words = explode(" ", $row['Type']);
            $acronym = "";

            foreach ($words as $w) {
                $acronym .= mb_substr($w, 0, 1);
            }
            $word = strtolower($acronym);
            if($row['PetType'] == 'Dog') {
                echo '<img src="./Images/dog/'.$word.'.svg" height="200px" width="200px" alt="Dog">';
            } else if($row['PetType'] == 'Cat') {
                echo '<img src="./Images/cat/'.$word.'.svg" height="200px" width="200px" alt="Cat">';
            }
        ?>
          <h5 id="title">
            <?php
                echo $row['PetType'];
            ?>
          </h5>

        <h5>Address</h5>

        <div class="dropdown mb-2" style="width: 30%">
                    <div class="form-group">
                        <label>Pickup address:</label>
                        <textarea name="name" id="pickupAddress" class="form-control" rows="3" style="resize: none"></textarea>
                    </div>
        </div>

        <div class="dropdown my-2">
        </div>

        <p class="px-2"><i class="fa fa-info-circle"></i>&nbsp;There might be slight change in the session timings due to availability of vendors.</p>
        <p class="text text-danger" id="addressError"></p>
        <button class="btn btn-primary my-3" onclick="goToCart()">Go to cart</button>
    </div>

    <!-- Bootstrap Modal for adding a new pet -->
<div class="modal fade" id="addPetModal" tabindex="-1" role="dialog" aria-labelledby="addPetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPetModalLabel">Add a New Pet</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form-group">
                <form id="addPetForm">
                    <div class="form-group">
                        <label class="form-check-label">Type of pet:</label>
                        <div class="d-flex justify-content-between">
                        <div class="type"><img class="" height="20px" width="20px" src="./Images/cat/cat.svg" alt="Cat">&nbsp;<input class="form-check-input" type="radio" name="petType" value="cat">&nbsp;Cat</div>
                        
                        <div class="type"><img class="" height="20px" width="20px" src="./Images/dog/dog.svg" alt="Dog">&nbsp;<input class="form-check-input" type="radio" name="petType" value="dog">&nbsp;Dog</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-check-label">Gender:</label>
                        <div class="d-flex justify-content-between">
                        <div class="type"><input type="radio" class="form-check-input" name="gender" value="male">&nbsp;Male</div>
                        <div class="type"><input type="radio" class="form-check-input" name="gender" value="female">&nbsp;Female</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Breed:</label>
                        <input type="text" name="breed"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Birthday:</label>
                        <input type="date" name="birthday"  class="form-control">
                    </div>

                    <p class="text text-danger" id="addPetError"></p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addPetSubmit" name="addPetBtn">Add Pet</button>
            </div>
        </div>
    </div>
</div>

</body>
<script>

    var petID = null;
    var service = null;
    var type = null;
    var appointmentDate = null;
    var appointmentTime = null;
    var selectedHospital=null;
    var amount = null;
    var address = null;
    var isInCart = 0;


    // var newDate = new Date();
    // var monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];

    // for (var i = 2; i >= 0; i--) {
    //     var d1 = new Date(newDate);
    //     d1.setDate(d1.getDate() - i);
    //     var formattedDate = d1.getDate() + '-' + monthNames[d1.getMonth()] + '-' + d1.getFullYear();
    //     var listItem = document.createElement('option');
    //     listItem.textContent = formattedDate;
    //     listItem.value = d1.getDate() - i;
    //     listItem.classList.add('dropdown-item');
    //     document.getElementById('dates').appendChild(listItem);
    // }


    var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab);

        function showTab(n) {
        var x = document.getElementsByClassName("tab");
        for(var i = 0; i < x.length; i++) {
            if(i != n) {
                x[i].style.display = "none";
            }
        }
        x[n].style.display = "flex";
        }

        function timings() {
    var date = document.getElementById("dates");
    var time = document.getElementById("time");
    selectedHospital = document.getElementById("hospital").value; // Update this line
    if(date.value == '' || time.value == 'Pick a time' || selectedHospital == 'Pick hospital location') {
        document.getElementById('slotError').innerHTML = "Please select all the required fields";
    } else {
        appointmentDate = date.value;
        appointmentTime = time.value;
        showTab(2);
    }
}


        function selectedPet() {
            var radioButtons = document.getElementsByName("group1");
            for (var i = 0; i < radioButtons.length; i++) {
                if (radioButtons[i].checked) {
                    petID = radioButtons[i].value;
                    showTab(3);
                    return;
                }
            }
            document.getElementById('petError').innerHTML = "Please select a pet";

        }

        // Function to handle form submission and add a new card
function addNewCard() {
    var form = document.getElementById('addPetForm');
    var petTypeInput = form.querySelector('input[name="petType"]:checked');
    var genderInput = form.querySelector('input[name="gender"]:checked');
    var nameInput = form.querySelector('input[name="name"]');
    var breedInput = form.querySelector('input[name="breed"]');
    var birthdayInput = form.querySelector('input[name="birthday"]');
    var addPetError = document.getElementById('addPetError');

    if (!petTypeInput || !genderInput || !nameInput || !breedInput || !birthdayInput) {
        addPetError.innerHTML = "Please select all the required fields";
    } else {
        var petType = petTypeInput.value;
        var gender = genderInput.value;
        var name = nameInput.value;
        var breed = breedInput.value;
        var birthday = birthdayInput.value;
        $.ajax({
                type: "POST",
                url: "insert_pet.php", // Replace with the path to your server-side script
                data: {
                    petType: petType,
                    gender: gender,
                    name: name,
                    breed: breed,
                    birthday: birthday
                },
                success: function (response) {
                    if(response == 'Added') {
                        $("#addPetModal").modal("hide");
                        var newCard = document.createElement('div');
                        newCard.className = 'card';
                        newCard.style = 'width: 18rem;';
                        newCard.innerHTML = `
                            <input type="radio" name="group1" id="" class="radio" role="button" value="3">
                                        <h4>${name}</h4>
                                        <h6>${breed}</h6>
                                        <img class="card-img-top" src="./Images/${petType}/${petType}.svg" alt="Dog">
                        `;

                        // Append the new card to the cards-container
                        var cardsContainer = document.querySelector('.cards-container');
                        cardsContainer.insertBefore(newCard, cardsContainer.firstElementChild);
                    } else {
                        document.getElementById('addPetError').innerHTML = "Some problem occured. Please try again!";
                    }
                    
                },
                error: function (xhr, status, error) {
                }
            });
        }
}

// Attach an event listener to the "Add Pet" button to open the modal
document.getElementById('addPetButton').addEventListener('click', function() {
    // Clear the form fields when the modal is opened
    document.getElementById('addPetForm').reset();
});

document.getElementById('addPetSubmit').addEventListener('click', function() {
    addNewCard();
});

function goToCart() {
    var x = document.getElementById('pickupAddress');

    if(x.value == '') {
        document.getElementById('addressError').innerHTML = "Please enter address";
    } else {
        service = "<?php echo $row['Service']; ?>";
        type = "<?php echo $row['Type']; ?>";
        amount = "<?php echo $row['Amount'] ?>";
        address = x.value;
        // Use selectedHospital instead of hospital.value
        $.ajax({
            type: "POST",
            url: "addToCart.php",
            data: {
                petID: petID,
                service:service,
                type:type, 
                appointmentDate:appointmentDate, 
                appointmentTime:appointmentTime,
                amount:amount,
                address:address,
                isInCart : isInCart,
                hospital: selectedHospital // Update this line
            },
            success: function (response) {
                console.log(response)
                if(response == 'Added') {
                    window.location.href = "cart.php";
                } else {
                    document.getElementById('addressError').innerHTML = "Some problem occured. Please try again!";
                }
                
            },
            error: function (xhr, status, error) {
                
            }
        });
    }
}


</script>
</html>