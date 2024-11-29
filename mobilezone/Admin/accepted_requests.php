<?php
define('TITLE', 'Accepted Requests');
define('PAGE', 'accepted');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();

if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href='login.php'; </script>";
}
?>

<div class="col-sm-4 mb-5">
   <h3 class="text-center mt-4">Accepted Requests</h3>
  <?php 
  // Fetch the accepted requests with the updated column names
  $sql = "SELECT request_id, request_info, request_desc, requester_name, assign_date FROM accepted_requests_tb";
  $result = $conn->query($sql);
  
  // If there are records available, display them
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      echo '<div class="card mt-5 mx-5">';
      echo '<div class="card-header">';
      echo 'Request ID : '. $row['request_id'];
      echo '</div>';
      echo '<div class="card-body">';
      echo '<h5 class="card-title">Request Info : ' . $row['request_info'] . '</h5>';
      echo '<p class="card-text">' . $row['requester_name'] . '</p>';
      echo '<p class="card-text">' . $row['request_desc'] . '</p>';
      echo '<p class="card-text">Assigned Date: ' . $row['assign_date'] . '</p>';
      echo '<div class="float-right">';
      
      // Separate forms for "View" and "Close"
      // View Request Form
      echo '<form action="viewRequest.php" method="GET" style="display:inline-block">';
      echo '<input type="hidden" name="id" value='. $row["request_id"] .'>';
      echo '<input type="submit" class="btn btn-danger mr-3" name="view" value="View">';
      echo '</form>';
      
      // Close Request Form
      echo '<form action="" method="POST" style="display:inline-block">';
      echo '<input type="hidden" name="id" value='. $row["request_id"] .'>';
      echo '<input type="submit" class="btn btn-secondary" name="close" value="Close">';
      echo '</form>';
      
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }
  } else {
    // If no accepted requests are found, display a message
    echo '<div class="alert alert-info mt-5 col-sm-6" role="alert">';
    echo '<h4 class="alert-heading">No Accepted Requests Found!</h4>';
    echo '<p>Currently, there are no accepted requests available.</p>';
    echo '</div>';
  }

  // Handle closing (deleting) the request
  if(isset($_POST['close'])){
    $id = $_POST['id'];  // Use POST for ID value
    $sql = "DELETE FROM accepted_requests_tb WHERE request_id = {$id}";
    if($conn->query($sql) === TRUE){
      // Refresh the page after deleting the record
      echo '<meta http-equiv="refresh" content= "0;URL=?closed" />';
    } else {
      echo "Unable to Delete Data";
    }
  }
?>
</div>

<?php 
include('includes/footer.php'); 
$conn->close();
?>
