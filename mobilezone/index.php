<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/custom.css">

  <title>MobileZone</title>
</head>

<body>
  <!-- Start Navigation -->
  <nav class="navbar navbar-expand-sm navbar-dark bg-danger pl-5 fixed-top">
    <a href="index.php" class="navbar-brand">MobileZone</a>
    <span class="navbar-text">Customer's Happiness is our Aim</span>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myMenu">
      <ul class="navbar-nav pl-5 custom-nav">
        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="#Services" class="nav-link">Services</a></li>
        <li class="nav-item"><a href="#registration" class="nav-link">Registration</a></li>
        <li class="nav-item"><a href="Requester/RequesterLogin.php" class="nav-link">Login</a></li>
        <li class="nav-item"><a href="#Contact" class="nav-link">Contact</a></li>
      </ul>
    </div>
  </nav> <!-- End Navigation -->

  <header class="jumbotron back-image" style="background-image: url(images/banner.jpg); position:relative;">
  <div style="position:absolute; top:0; left:0; right:0; bottom:0; background-color: rgba(0, 0, 0, 0.6);">
  </div>
  <div class="myclass mainHeading" style="display:flex; justify-content:center; align-items:center; flex-direction:column; margin-top:250px; gap:1rem; position:relative; z-index:1;">
    <h1 class="text-uppercase text-white font-weight-bold" style="text-align:center; background:black; padding:8px; border-radius:20px; border:none;">Welcome to MobileZone</h1>
    <p class="font-italic" style="background:black; padding:6px; color:white; border-radius:20px; border:none;">Customer's Happiness is our Aim</p>
    <a href="Requester/RequesterLogin.php" class="btn btn-success mr-4">Login</a>
    <a href="#registration" class="btn btn-danger mr-4">Sign Up</a>
    <a href="/mobilezone/admin/login.php" class="btn btn-dark mr-4">Admin Login</a>
  </div>
</header>


  <div class="container">
    <!--Introduction Section-->
    <div class="jumbotron">
      <h3 class="text-center">MobileZone Services</h3>
      <p>
      MobileZone Services specializes in mobile phone repairs, offering a wide range of solutions to ensure your phone stays in perfect working condition. We provide services such as screen replacements, battery changes, software troubleshooting, and hardware repairs for all major brands.

Our workshops are equipped with modern tools and staffed by experienced technicians to deliver fast and reliable repairs. You can easily book your service online by completing a quick registration process, ensuring convenience and efficiency.


      </p>
    </div>
  </div>
  <!--Introduction Section End-->

  <!-- Start Services -->
  <div class="container text-center border-bottom" id="Services">
    <h2>Our Services</h2>
    <div class="row mt-4">
      <div class="col-sm-4 mb-4">
        <a href="#"><i class="fas fa-tv fa-8x text-success"></i></a>
        <h4 class="mt-4">Mobile Devices</h4>
      </div>
      <div class="col-sm-4 mb-4">
        <a href="#"><i class="fas fa-sliders-h fa-8x text-primary"></i></a>
        <h4 class="mt-4">Preventive Maintenance</h4>
      </div>
      <div class="col-sm-4 mb-4">
        <a href="#"><i class="fas fa-cogs fa-8x text-info"></i></a>
        <h4 class="mt-4">Fault Repair</h4>
      </div>
    </div>
  </div> <!-- End Services -->

  <!-- Start Registration  -->
  <?php include('userRegistration.php') ?>
  <!-- End Registration  -->

  <!--Start Contact Us-->
  <div class="container" id="Contact">
    <!--Start Contact Us Container-->
    <h2 class="text-center mb-4">Contact Us</h2> <!-- Contact Us Heading -->
    <div class="row">
      <!--Start Contact Us Row-->
      <?php include('contactform.php'); ?>
    </div> <!-- End Contact Us Row-->
  </div> <!-- End Contact Us Container-->
  <!-- End Contact Us -->

  <!-- Start Footer-->
  <footer class="container-fluid bg-dark text-white mt-5" style="border-top: 3px solid #DC3545;">
   <p class="text-center p-4 mt-2"> All rights reserved &copy; 2024.</p>
 
  </footer> <!-- End Footer -->

  <!-- Boostrap JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/all.min.js"></script>
</body>

</html>
