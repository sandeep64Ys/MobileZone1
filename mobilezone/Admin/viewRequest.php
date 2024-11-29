<?php
define('TITLE', 'Request Details');
define('PAGE', 'viewRequest');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href='login.php'; </script>";
}

if(isset($_GET['id'])){
    $requestId = $_GET['id'];
    $sql = "SELECT * FROM accepted_requests_tb WHERE request_id = {$requestId}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<div class="col-sm-6 mt-5 mx-3">
    <h3 class="text-center">Request Details</h3>
    <?php if(isset($row)): ?>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Request ID</td>
                <td><?php echo $row['request_id']; ?></td>
            </tr>
            <tr>
                <td>Request Info</td>
                <td><?php echo $row['request_info']; ?></td>
            </tr>
            <tr>
                <td>Request Description</td>
                <td><?php echo $row['request_desc']; ?></td>
            </tr>
            <tr>
                <td>Requester Name</td>
                <td><?php echo $row['requester_name']; ?></td>
            </tr>
            <tr>
                <td>Requester Address 1</td>
                <td><?php echo $row['requester_add1']; ?></td>
            </tr>
            <tr>
                <td>Requester Address 2</td>
                <td><?php echo $row['requester_add2']; ?></td>
            </tr>
            <tr>
                <td>Requester City</td>
                <td><?php echo $row['requester_city']; ?></td>
            </tr>
            <tr>
                <td>Requester State</td>
                <td><?php echo $row['requester_state']; ?></td>
            </tr>
            <tr>
                <td>Requester Zip Code</td>
                <td><?php echo $row['requester_zip']; ?></td>
            </tr>
            <tr>
                <td>Requester Email</td>
                <td><?php echo $row['requester_email']; ?></td>
            </tr>
            <tr>
                <td>Requester Mobile</td>
                <td><?php echo $row['requester_mobile']; ?></td>
            </tr>
            <tr>
                <td>Accepted Date</td>
                <td><?php echo $row['assign_date']; ?></td>
            </tr>
            <!-- Add more fields as necessary -->
        </tbody>
    </table>
    <div class="text-center">
        <form class='d-print-none d-inline mr-3'>
            <input class='btn btn-danger' type='submit' value='Print' onClick='window.print()'>
        </form>
        <form class='d-print-none d-inline' action="accepted_requests.php">
            <input class='btn btn-warning' type='submit' value='Back'>
        </form>
    </div>
    <?php else: ?>
    <div class="alert alert-info" role="alert">
        <h4 class="alert-heading">No Details Found!</h4>
        <p>Sorry, the details for the requested ID could not be found.</p>
    </div>
    <?php endif; ?>
</div>

<?php
include('includes/footer.php'); 
$conn->close();
?>
