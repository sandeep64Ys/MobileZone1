<?php
define('TITLE', 'Manage Services');
define('PAGE', 'services');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
} else {
  echo "<script> location.href='login.php'; </script>";
}

// Create services table if it does not exist
$sql = "CREATE TABLE IF NOT EXISTS services (
    service_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(255) NOT NULL UNIQUE
)";

if ($conn->query($sql) !== TRUE) {
    $error = "Error creating table: " . $conn->error;
}

// Add or update service
if(isset($_POST['submit'])) {
    $serviceName = $_POST['service_name'];
    $serviceId = isset($_POST['service_id']) ? $_POST['service_id'] : null;
    
    if (!empty($serviceName)) {
        if (!empty($serviceId)) {
            // Update existing service
            $sql = "UPDATE services SET service_name = ? WHERE service_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $serviceName, $serviceId);
        } else {
            // Add new service
            $sql = "INSERT INTO services (service_name) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $serviceName);
        }
        if ($stmt->execute()) {
            $message = "Service updated successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Please enter a service name.";
    }
}

// Delete service
if(isset($_GET['delete'])) {
    $serviceId = $_GET['delete'];
    if (!empty($serviceId)) {
        $sql = "DELETE FROM services WHERE service_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $serviceId);
        if ($stmt->execute()) {
            $message = "Service deleted successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Invalid service ID.";
    }
}

// Fetch services
$sql = "SELECT * FROM services";
$result = $conn->query($sql);
?>

<!-- Main Content -->
<div class="col-sm-6 mt-5 mx-auto">
    <h3 class="text-center">Manage Services</h3>
    
    <!-- Success/Error Messages -->
    <div class="col-sm-6 mx-auto mt-3">
        <?php if(isset($message)): ?>
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="max-width: 400px; margin: 0 auto;">
                <?= $message ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif(isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert" style="max-width: 400px; margin: 0 auto;">
                <?= $error ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Form to Add/Update Service -->
    <form action="" method="POST" class="mt-4">
        <div class="form-group">
            <label for="service_name">Service Name</label>
            <input type="text" class="form-control" id="service_name" name="service_name" required>
            <input type="hidden" id="service_id" name="service_id">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
    
    <!-- Display Services -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Service ID</th>
                <th>Service Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo '<tr>';
                    echo '<td>'. $row['service_id'] .'</td>';
                    echo '<td>'. $row['service_name'] .'</td>';
                    echo '<td>
                            <a href="#" class="btn btn-info btn-sm edit" data-id="'. $row['service_id'] .'" data-name="'. $row['service_name'] .'">Edit</a>
                            <a href="?delete='. $row['service_id'] .'" class="btn btn-danger btn-sm">Delete</a>
                          </td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="3" class="text-center">No Services Found</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<script>
// Automatically dismiss alert after 3 seconds
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        let alertElement = document.querySelector('.alert');
        if (alertElement) {
            alertElement.style.display = 'none';
        }
    }, 3000); // 3000ms = 3 seconds

    // Edit service
    document.querySelectorAll('.edit').forEach(function(button) {
        button.addEventListener('click', function() {
            const serviceId = this.getAttribute('data-id');
            const serviceName = this.getAttribute('data-name');
            document.getElementById('service_id').value = serviceId;
            document.getElementById('service_name').value = serviceName;
        });
    });
});
</script>

<?php
include('includes/footer.php'); 
$conn->close();
?>
