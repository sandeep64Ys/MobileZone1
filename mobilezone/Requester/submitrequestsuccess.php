<?php
define('TITLE', 'Request Submitted');
include('../dbConnection.php');
session_start();

if (isset($_SESSION['myid'])) {
    // Debugging check
    echo "<!-- Session ID is set: " . $_SESSION['myid'] . " -->";

    // SQL query to retrieve request
    $sql = "SELECT * FROM submitrequest_tb WHERE request_id = {$_SESSION['myid']}";
    $result = $conn->query($sql);

    // Check if the SQL query executed successfully
    if (!$result) {
        echo "<div class='alert alert-danger' role='alert'>SQL Error: " . $conn->error . "</div>";
    }

    // Check if we got any results
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo TITLE; ?></title>
            <!-- Bootstrap CSS -->
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <!-- Custom CSS -->
            <style>
                .content-wrapper {
                    margin: 2rem;
                }
                .card-header, .card-body {
                    background-color: #f8f9fa;
                }
            </style>
        </head>
        <body>
         
            <div class="container content-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="text-center">Request Submitted Successfully</h3>
                        <div class="card mt-4">
                            <div class="card-header">
                                Request Details
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Request ID</td>
                                            <td><?php echo $row['request_id']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td><?php echo $row['requester_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email ID</td>
                                            <td><?php echo $row['requester_email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Request Info</td>
                                            <td><?php echo $row['request_info']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Request Description</td>
                                            <td><?php echo $row['request_desc']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <form class='d-print-none d-inline'>
                                        <input class='btn btn-danger' type='submit' value='Print' onClick='window.print()'>
                                    </form>
                                    <a class='btn btn-warning d-print-none d-inline' href="submitrequest.php">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bootstrap JS and dependencies -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <?php include('includes/footer.php'); ?>
        </body>
        </html>
        <?php
    } else {
        echo "<div class='alert alert-info' role='alert'>
                <h4 class='alert-heading'>No Details Found!</h4>
                <p>Sorry, the details for the requested ID could not be found.</p>
              </div>";
    }
} else {
    echo "<div class='alert alert-warning' role='alert'>Session ID not set.</div>";
}

$conn->close();
?>
