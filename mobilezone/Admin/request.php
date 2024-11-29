<?php
define('TITLE', 'Manage Requests');
define('PAGE', 'request');
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
  <!-- Main Content area start Middle -->
  <?php 
  $sql = "SELECT request_id, request_info, request_desc, request_date FROM submitrequest_tb";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      echo '<div class="card mt-5 mx-5">';
      echo '<div class="card-header">';
      echo 'Request ID: '. $row['request_id'];
      echo '</div>';
      echo '<div class="card-body">';
      echo '<h5 class="card-title">Request Info: ' . $row['request_info'] . '</h5>';
      echo '<p class="card-text">' . $row['request_desc'] . '</p>';
      echo '<p class="card-text">Request Date: ' . $row['request_date'] . '</p>';
      echo '<div class="float-right">';
      echo '<form action="" method="POST">';
      echo '<input type="hidden" name="id" value='. $row["request_id"] .'>';
      echo '<input type="submit" class="btn btn-success mr-3" name="accept" value="Accept">';
      echo '<input type="submit" class="btn btn-danger" name="reject" value="Reject">';
      echo '</form>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }
  } else {
    echo '<div class="alert alert-info mt-5 col-sm-6" role="alert">
    <h4 class="alert-heading">Well done!</h4>
    <p>Aww yeah, you successfully assigned all Requests.</p>
    <hr>
    <h5 class="mb-0">No Pending Requests</h5>
    </div>';
  }

  // Handling request acceptance
  if(isset($_REQUEST['accept'])){
    $sql = "INSERT INTO accepted_requests_tb (request_id, request_info, request_desc,requester_name,requester_add1,requester_add2,requester_city,requester_state,requester_zip,requester_email,requester_mobile,assign_date) 
            SELECT request_id, request_info, request_desc,requester_name,requester_add1,requester_add2,requester_city,requester_state,requester_zip,requester_email,requester_mobile, request_date 
            FROM submitrequest_tb WHERE request_id = {$_REQUEST['id']}";
    if($conn->query($sql) === TRUE){  
      $sql = "DELETE FROM submitrequest_tb WHERE request_id = {$_REQUEST['id']}";
      if($conn->query($sql) === TRUE){
        echo '<meta http-equiv="refresh" content="0;URL=?closed" />';
      }
    } else {
      echo "Unable to accept the request.";
    }
  }

  // Handling request rejection
  if(isset($_REQUEST['reject'])){
    $sql = "DELETE FROM submitrequest_tb WHERE request_id = {$_REQUEST['id']}";
    if($conn->query($sql) === TRUE){
      echo '<meta http-equiv="refresh" content="0;URL=?closed" />';
    } else {
      echo "Unable to reject the request.";
    }
  }
?>
</div> <!-- Main Content area End Middle -->

<?php 
include('includes/footer.php'); 
$conn->close();
?>
