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
$sql = "SELECT * FROM designation";
$result = $conn->query($sql);
?>

<a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDesignationModal">Add Hospital +</a>

<!-- Modal for adding a new service -->
<div class="modal fade" id="addDesignationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Hospital</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Service details form -->
                <form id="addServiceForm" method="post" action="adminPage.php">
                    <div class="form-group">
                        <label for="hospitalname">Hospital Name:</label>
                        <input type="text" class="form-control" id="hospitalname" name="hospitalname" required>
                    </div>
                    <div class="form-group">
                        <label for="hospitalid">Hospital Id:</label>
                        <textarea class="form-control" id="hospitalid" name="hospitalid" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="savehospital">Add Hospital</button>
                </form>
            </div>
        </div>
    </div>
</div>

<hr>
<table class="table table-bordered">
<thead>
        <tr>
            <th>Id</th>
            <th>Designation</th>
            <!-- Add more headers as needed based on your "designation" table columns -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are any rows in the result set
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row["Id"]}</td>";
                echo "<td>{$row["dest"]}</td>";
                // Add more cells as needed based on your "designation" table columns
                echo "<td>";
                echo "<form method='POST' action='deleteDesignation.php'>";
                echo "<input type='hidden' name='designationIDToDelete' value='{$row["Id"]}'>";
                echo "<button type='submit' class='btn btn-danger'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No designations found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </tbody>
</table>
    </body>
</html>