<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<?php
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

// Query to retrieve data from the 'services' table
$sql = "SELECT * FROM services";
$result = $conn->query($sql);
?>

<!-- <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">Add Service +</a> -->

<!-- Modal for adding a new service -->
<div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Service details form -->
                <form id="addServiceForm" method="post" action="adminPage.php">
                    <div class="form-group">
                        <label for="serviceName">Service Name:</label>
                        <input type="text" class="form-control" id="serviceName" name="serviceName" required>
                    </div>
                    <div class="form-group">
                        <label for="serviceCategory">Service Category:</label>
                        <select class="form-control" id="serviceCategory" name="serviceCategory" required>
                            <option value="" disabled selected>Select a category</option>
                            <?php
                                // Assuming you have a database connection already established
                                $sql123 = "SELECT DISTINCT(PetType) FROM services";
                                $result123 = $conn->query($sql123);

                                if ($result123->num_rows > 0) {
                                    while ($row123 = $result123->fetch_assoc()) {
                                        $categoryName = $row123["PetType"];
                                        echo "<option value='$categoryName'>$categoryName</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="serviceDescription">Service Description:</label>
                        <textarea class="form-control" id="serviceDescription" name="serviceDescription" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="servicePrice">Service Price:</label>
                        <input type="number" class="form-control" id="servicePrice" name="servicePrice" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="saveService">Add Service</button>
                </form>
            </div>
        </div>
    </div>
</div>

<hr>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Number</th>
            <th>Service</th>
            <th>Subcategory</th>
            <th>Pet Type</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Initialize variables to keep track of category and subcategory
        $currentCategory = "";
        $currentSubcategory = "";

        // Check if there are any rows in the result set
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Check if the category or subcategory has changed
                if ($currentCategory != $row["Service"] || $currentSubcategory != $row["Type"]) {
                    $currentCategory = $row["Service"];
                    $currentSubcategory = $row["Type"];
                    echo "<tr>";
                    echo "<td>{$row["ServiceID"]}</td>";
                    echo "<td>$currentCategory</td>";
                    echo "<td>$currentSubcategory</td>";
                    echo "<td>{$row["PetType"]}</td>";
                    echo "<td>{$row["Amount"]}</td>";
                    echo "<td>";
                    echo "<form method='POST' action='deleteService.php'>";
                    echo "<input type='hidden' name='serviceIDToDelete' value='{$row["ServiceID"]}'>";
                    echo "<button type='submit' class='btn btn-danger'>Delete</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                } else {
                    echo "<tr>";
                    echo "<td></td>"; // Empty cell for category
                    echo "<td></td>"; // Empty cell for subcategory
                    echo "<td>{$row["PetType"]}</td>";
                    echo "<td>{$row["Service"]}</td>";
                    echo "<td>{$row["Amount"]}</td>";
                    echo "</tr>";
                }
            }
        } else {
            echo "<tr><td colspan='6'>No services found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </tbody>
</table>
    </body>
</html>