<?php
require_once "function/check_session.php";
// Check if user_id and role sessions are already set
redirectToDashboard();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>iSAT - Login</title>

      <link rel="apple-touch-icon" href="./theme-assets/images/ico/apple-icon-120.png">
      <link rel="shortcut icon" type="image/x-icon" href="./theme-assets/images/ico/favicon.ico">
      <!-- CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

      <link href="./theme-assets/css/login.css" rel="stylesheet">
      <!-- FONT -->

      <link href="https://fonts.gstatic.com" rel="preconnect">
      <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">


      <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

<!-- Your existing HTML code here -->

<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

   </head>
   <body class="">
      <!-- display error messages -->
      <?php displaySessionErrorMessage(); ?>
      <!-- CONTAINER -->
      <div class="container d-flex align-items-center min-vh-100 justify-content-center">
         <div class="row g-0 justify-content-center">

            <!-- TITLE -->
            <div class="col-lg-4 offset-lg-1 mx-0 px-0">
               <div id="title-container">
                  <img class="pcb-image" src="./theme-assets/images/pcb.webp" alt="PCB Logo">
                  <h2>"iSAT"</h2>
                  <h3>IoT-Based Student Attendance Tracker</h3>
                  <p>Welcome to PCB IOT-Based Student Attendance Tracker!</p>
               </div>
            </div>

            <!-- FORMS -->
            <div class="col-lg-7 mx-0 px-0">
               <div id="qbox-container" class="">
                  <form class="needs-validation" id="form-wrapper" method="post" name="form-wrapper" novalidate="" method="POST">
                     <div id="steps-container">
                        <div class="step col-12">
                           <h3>Login your account to get started!</h3>
                           <div class="mt-5">
                              <label for="emailID" class="form-label">Email:</label><span class="text-danger">*</span> 
                              <input class="form-control" id="emailID" name="email" type="email" required>
                           </div>
                           <div class="mt-4">
                              <label for="passwordID" class="form-label">Password:</label><span class="text-danger">*</span> 
                              <input class="form-control" id="passwordID" name="password" type="password" required>
                           </div>
                        </div>
                     </div>
                     <div id="q-box__buttons">
                        <button id="login-btn" type="submit">Login</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <div id="preloader-wrapper">
         <div id="preloader"></div>
         <div class="preloader-section section-left"></div>
         <div class="preloader-section section-right"></div>
      </div>

      <script src="./theme-assets/js/login.js"></script>
   </body>
</html>