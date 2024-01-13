<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

// Query to retrieve data from the 'bookings' table
$sql = "SELECT DISTINCT(PetType) FROM services";
$result = $conn->query($sql);
?>

<!-- <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category +</a> -->
<!-- Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your form elements here -->
                <form method="post" action="adminPage.php" name="catForm" autocomplete="off">
                    <div class="form-group">
                        <label for="categoryName">Category Name:</label>
                        <input type="text" class="form-control" name="categoryName" id="categoryName">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="saveCat">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<table class="table table-bordered">
    <thead>
        <tr>
            <th>Number</th>
            <th>Category</th>
            <!-- <th>Action</th> -->
        </tr>
    </thead>
    <hr>
    <h3>Appointment Requests</h3>
    <tbody>
        <?php
        // Initialize a row count variable
        $rowCount = 1;

        // Check if there are any rows in the result set
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $rowCount . "</td>"; // Display the row count
                echo "<td>" . $row["PetType"] . "</td>"; // Use the column name "PetType"
                // echo "<td>";
                // echo "<form method='POST' action='deleteCategory.php'>";
                // echo "<input type='hidden' name='petTypeToDelete' value='" . $row["PetType"] . "'>";
                // echo "<button type='submit' class='btn btn-danger'>Delete</button>";
                // echo "</form>";
                
                // echo "</td>";
                echo "</tr>";
                
                // Increment the row count
                $rowCount++;
            }
        } else {
            echo "<tr><td colspan='6'>No bookings found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </tbody>
</table>


<!-- Success toast message -->
<?php if (!empty($successMessage)): ?>
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="2000">
        <div class="toast-header">
            <strong class="mr-auto">Success</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            <?php echo $successMessage; ?>
        </div>
    </div>
<?php endif; ?>

<script>
    // Show the success toast message
    $('.toast').toast('show');

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
</script>
</body>
</html>