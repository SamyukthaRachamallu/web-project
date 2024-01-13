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

// Initialize a variable to store the category name
$categoryName = "";

// Check if the form is submitted
if (isset($_POST['saveCat'])) {

    $_SESSION['form_submitted'] = true;
    // Get the category name from the form
    $categoryName = $_POST["categoryName"];

    // Insert the category name into the 'services' table
    $sql = "INSERT INTO services (PetType) VALUES ('$categoryName')";
    if ($conn->query($sql) === TRUE) {
        // Category added successfully, show toast message and redirect

        echo <<<EOL
        <script>
            // Show toast message
            var toast = document.createElement("div");
            toast.className = "toast";
            toast.setAttribute("role", "alert");
            toast.setAttribute("aria-live", "assertive");
            toast.setAttribute("aria-atomic", "true");
            toast.setAttribute("data-autohide", "true");
            toast.setAttribute("data-delay", "2000");
            toast.innerHTML = `
                <div class="toast-header">
                    <strong class="mr-auto">Success</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Category added successfully!
                </div>
            `;
            document.body.appendChild(toast);

            // Reload the parent page after 2 seconds
            setTimeout(function() {
                window.opener.location.href = "adminPage.php";
                window.close(); // Closes the modal
            }, 2000);

            // Show the toast
            $('.toast').toast('show');
        </script>
EOL;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
