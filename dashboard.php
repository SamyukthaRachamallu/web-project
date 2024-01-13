<?php
  session_start();
  if(!isset($_SESSION['UserID'])) {
    header('Location: ' . 'index.php', true);
    exit();
  }

  $services = 0;
  $categories = 0;
  $confirmed = 0;
  $cancelled = 0;
  
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
  
  $userId = $_SESSION['UserID'];
  
  // Query to retrieve data from the 'services' table
  $sql1 = "SELECT DISTINCT(PetType) FROM services";
  $result1 = $conn->query($sql1);
  $categories = $result1->num_rows;
  
  // Query to retrieve data from the 'services' table
  $sql2 = "SELECT * FROM services";
  $result2 = $conn->query($sql2);
  $services = $result2->num_rows;
  
  // Fetch user's designation
  $customerDetailsQuery = "SELECT designation FROM customer_details WHERE UserID = $userId LIMIT 1";
  $customerDetailsResult = $conn->query($customerDetailsQuery);
  
  if ($customerDetailsResult->num_rows > 0) {
      $customerDetailsRow = $customerDetailsResult->fetch_assoc();
      $designationValue = $customerDetailsRow['designation'];
  
      // Check if the designation exists in the designation table
      $designationCheckQuery = "SELECT dest FROM designation WHERE Id = '$designationValue' LIMIT 1";
      $designationCheckResult = $conn->query($designationCheckQuery);
  
      if ($designationCheckResult->num_rows > 0) {
          $designationCheckRow = $designationCheckResult->fetch_assoc();
          $destValue = $designationCheckRow['dest'];
  
          // Fetch bookings based on the retrieved dest value
          $sql = "SELECT * FROM bookings WHERE hospital = '$destValue'";
          $result = $conn->query($sql);
  
          // Count confirmed bookings for the specific user and designation
          $sqlConfirmedCount = "SELECT COUNT(*) as confirmed_count FROM bookings WHERE hospital = '$destValue' AND confirmed = 1";
          $resultConfirmedCount = $conn->query($sqlConfirmedCount);
          $rowConfirmedCount = $resultConfirmedCount->fetch_assoc();
          $confirmed = $rowConfirmedCount['confirmed_count'];
  
          // Count cancelled bookings for the specific user and designation
          $sqlCancelledCount = "SELECT COUNT(*) as cancelled_count FROM bookings WHERE hospital = '$destValue' AND confirmed = 0";
          $resultCancelledCount = $conn->query($sqlCancelledCount);
          $rowCancelledCount = $resultCancelledCount->fetch_assoc();
          $cancelled = $rowCancelledCount['cancelled_count'];
  
      } else {
          echo '<p class="text text-danger">Designation not found in the designation table.</p>';
      }
  } else {
      echo '<p class="text text-danger">Designation not found for the user.</p>';
  }
  
  // Close the database connection
  $conn->close();
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

</head>
<body>
<div class="container">
        <div class="card">
            <div class="icon-con bg-primary text-white">
                <i class="fs-1 bi-stack"></i>
            </div>
            <span class="ms-1">Services List</span>
            <p><?php echo $services; ?></p>
        </div>
        <div class="card">
            <div class="icon-con bg-warning text-white">
                <i class="fs-1 bi-card-list"></i>
            </div>
            <span class="ms-1">Categories</span>
            <p><?php echo $categories; ?></p>
        </div>
        <div class="card">
            <div class="icon-con bg-success text-white">
                <i class="fs-1 bi-check-circle"></i>
            </div>
            <span class="ms-1">Confirmed</span>
            <p><?php echo $confirmed; ?></p>
        </div>
        <div class="card">
            <div class="icon-con bg-danger text-white">
                <i class="fs-1 bi-x-circle"></i>
            </div>
            <span class="ms-1">Cancelled</span>
            <p><?php echo $cancelled; ?></p>
        </div>
    </div>

                <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pets_care";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);
$userId = $_SESSION['UserID'];
$customerDetailsQuery = "SELECT designation FROM customer_details WHERE UserID = $userId LIMIT 1";
$customerDetailsResult = $conn->query($customerDetailsQuery);

if ($customerDetailsResult->num_rows > 0) {
    $customerDetailsRow = $customerDetailsResult->fetch_assoc();
    $designationValue = $customerDetailsRow['designation'];

    // Check if the designation exists in the designation table
    $designationCheckQuery = "SELECT dest FROM designation WHERE Id = '$designationValue' LIMIT 1";
    $designationCheckResult = $conn->query($designationCheckQuery);

    if ($designationCheckResult->num_rows > 0) {
        $designationCheckRow = $designationCheckResult->fetch_assoc();
        $destValue = $designationCheckRow['dest'];

        // Fetch bookings based on the retrieved dest value
        $sql = "SELECT *
                FROM bookings
                WHERE hospital = '$destValue'";

        $result = $conn->query($sql);

        // Now you have $result containing the bookings for the designated hospital
        // Proceed with displaying the data as needed
    } else {
        echo '<p class="text text-danger">Designation not found in the designation table.</p>';
    }
} else {
    echo '<p class="text text-danger">Designation not found for the user.</p>';
}
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Number</th>
            <th>Booked User ID</th>
            <th>Service</th>
            <th>Address</th>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <hr>
    <h3>Appointment Requests</h3>
    <tbody>
<?php 
        // Check if there are any rows in the result set
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["BookingID"] . "</td>";
                echo "<td>" . $row["UserID"] . "</td>";
                echo "<td>" . $row["Service"] . "/" . $row["Type"] . "</td>";
                echo "<td>" . $row["PickupAddress"] . "</td>";
                echo "<td>" . $row["AppointmentDate"] . "</td>";
                echo "<td>" . $row["AppointmentTime"] . "</td>";
                echo "<td>";
                
                // Check the confirmed and display accordingly
                if ($row["confirmed"] === null) {
                    echo "<span class='text-warning'>Pending<span>";
                } elseif ($row["confirmed"]) {
                    echo "<span class='text-success'>Confirmed<span>";
                } elseif (!$row["confirmed"]) {
                    echo "<span class='text-danger'>Cancelled<span>";
                }
                
                echo "</td>";
                echo "<td>";
                // Always display action buttons
                if ($row["confirmed"] === null) {
                    echo "<form method='POST' action='confirmBooking.php'>";
                        echo "<input type='hidden' name='bookingIDToConfirm' value='{$row["BookingID"]}'>";
                        echo "<button type='submit' class='btn btn-success'>Confirm</button>";
                    echo "</form>";
                    echo "<form method='POST' action='cancelBooking.php'>";
                        echo "<input type='hidden' name='bookingIDToCancel' value='{$row["BookingID"]}'>";
                        echo "<button type='submit' class='btn btn-danger'>Cancel</button>";
                    echo "</form>";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No bookings found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </tbody>
</table>

<script>
$(document).ready(function() {
    // Attach click event handlers to elements with the class 'confirm-booking'
    $(".confirm-booking").click(function() {
        updateBookingStatus($(this).data("booking-id"), 1); // 1 for Confirm
    });

    // Attach click event handlers to elements with the class 'cancel-booking'
    $(".cancel-booking").click(function() {
        updateBookingStatus($(this).data("booking-id"), 0); // 0 for Cancel
    });

    function updateBookingStatus(bookingId, status) {
        // Send an AJAX request to update the 'confirmed' column
        $.ajax({
            url: "adminPage.php", // Change to the correct PHP script URL
            method: "POST",
            data: { booking_id: bookingId, status: status },
            success: function(response) {
                // Handle the response from the server
                if (response === "success") {
                    // Update the button or perform any other action as needed
                    if (status === 1) {
                        alert("Booking confirmed successfully!");
                    } else {
                        alert("Booking cancelled successfully!");
                    }
                } else {
                    alert("Failed to update booking status. Please try again.");
                }
            },
            error: function() {
                alert("An error occurred while updating the booking status.");
            }
        });
    }
});
</script>


</body>
</html>








