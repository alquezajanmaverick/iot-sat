<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

  <!-- include head.php -->
  <?php include './include/head.php'; ?>
  <!-- end head -->

  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-red-pink" data-col="2-columns">
<div class="d-none" id="admin"></div>

    <!-- include navbar -->
    <?php include './include/navbar.php'; ?>
    <!-- end navbar -->
    <!-- include sidebar.php -->
    <?php include './include/sidebar.php'; ?>
    <!-- end sidebar -->

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Admin</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item"><a href="admin.php">Admin</a>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
          <section>
              <!-- Column Card -->
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header">
                            <div class="float-left">
                              <h4 class="card-title">List of Admin</h4>
                            </div>
                            <div class="float-right">
                              <a href="" class="btn btn-primary shadow-sm mt-1" data-toggle="modal" data-target="#addnew"><i class="fa-solid fa-plus"></i></a>
                              <a href="admin-archive.php" class="btn btn-outline-secondary shadow-sm mt-1"><i class="fa-solid fa-box-archive mr-1"></i>Archive</a>
                            </div>
                                    
                          </div>
                          <div class="card-content collapse show">

                              <div class="card-body pt-0 mt-0">

                                  <div class="table-responsive">
                                      <table class="table nowrap table-hover" id="myTable" width="100%" cellspacing="0">
                                          <thead class="bg-dark text-white">
                                              <tr>   
                                                  <th scope="col">#</th>                                  
                                                  <th scope="col">Name</th>
                                                  <th scope="col">Email</th>                                                                          
                                                  <th scope="col" class="text-center">Action</th>                          
                                              </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                              require '../db/dbconn.php';
                                              $display_admin = "SELECT att.*, ut.user_id
                                                                    FROM admin_tbl att
                                                                    INNER JOIN user_tbl ut ON ut.email = att.email
                                                                    WHERE att.deleted = 0";
                                              $sqlQuery = mysqli_query($conn, $display_admin);
                                              $num = 1;

                                             
                                              while($row = mysqli_fetch_array($sqlQuery)){
                                                  $admin_id = $row['admin_id'];
                                                  $user_id = $row['user_id'];
                                                  $name = $row['last_name']. ' '.$row['first_name'];
                                                  $first_name = $row['first_name'];
                                                  $middle_name = $row['middle_name'];
                                                  $last_name = $row['last_name'];
                                                  $ext_name = $row['ext_name'];
                                                  $email = $row['email'];
                                            ?>
                                            <tr>
                                              <td class=""><?php echo $num; ?></td>          
                                              <td class=""><?php echo $name; ?></td>   
                                              <td class=""><?php echo $email; ?></td>  
                                              <td class="text-center">
                                                <a href="" class="btn btn-sm btn-success shadow-sm"
                                                  data-toggle="modal" data-target="#edit_<?php echo $admin_id; ?>">
                                                  <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="" class="btn btn-sm btn-danger shadow-sm delete-admin-btn"
                                                   data-admin-id="<?php echo $admin_id; ?>"
                                                   data-user-id="<?php echo $user_id; ?>"
                                                   data-admin-name="<?php echo htmlspecialchars($name); ?>">
                                                   <i class="fa-solid fa-trash"></i>
                                                </a>
                                              </td>
                                            </tr>
                                            <?php
                                              include('modal/admin_edit_modal.php');
                                              $num++;
                                              } 
                                            ?>
                                        </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
          <?php include './modal/admin_add_modal.php'; ?>  
        </div>
      </div>
    </div>

    <!-- include footer.php -->
    <?php include './include/footer.php' ?>
    <!-- end footer -->

    <!-- include scripts.php -->
    <?php include './include/scripts.php'; ?>
    <!-- end scripts -->
    <script>
        $(document).ready(function(){
            //inialize datatable
            $('#myTable').DataTable({
                scrollX: true
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to show SweetAlert2 warning message
            const showWarningMessage = (message) => {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: message
                });
            };

            // Function to check if department code or name already exists
            const checkExistingCardEmail = (formData) => {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: 'action/check_admin.php', // URL to check the database
                        type: 'POST',
                        data: formData.serialize(), // Serialize form data
                        success: function(response) {
                            if (response.exists) {
                                // Highlight the corresponding input fields with red border
                                if (response.exists.email) {
                                    showWarningMessage('Email already exists.');
                                    formData.find('input[name="email"]').addClass('input-error');
                                }
                                reject(); // Reject the promise if department already exists
                            } else {
                                resolve(); // Resolve the promise if department doesn't exist
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText); // Output error response to console (for debugging)
                            reject(); // Reject the promise if there's an error
                        }
                    });
                });
            };

            $('#addAdmin').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission

                var formData = $('#addnew form'); // Select the form element

                const requiredFields = formData.find(':input[required]').not('select');
                let fieldsAreValid = true; // Initialize as true

                // Remove existing error classes
                $('.form-control').removeClass('input-error');

                // Check if passwords match
                const password = formData.find('input[name="password"]').val().trim();
                const confirmPass = formData.find('input[name="confirm_password"]').val().trim();

                if ((password !== confirmPass) || (password === ''|| confirmPass === '')) {
                    fieldsAreValid = false; // Set to false if passwords do not match
                    showWarningMessage('Passwords do not match');
                    formData.find('input[name="confirm_password"]').addClass('input-error');
                } else {
                    formData.find('input[name="confirm_password"]').removeClass('input-error');
                }

                requiredFields.each(function() {
                    if ($(this).val().trim() === '') {
                        fieldsAreValid = false; // Set to false if any required field is empty
                        showWarningMessage('Please fill-up the required fields.');
                        $(this).addClass('input-error'); // Add red border to missing field
                    } else {
                        $(this).removeClass('input-error'); // Remove red border if field is filled
                    }
                });

                if (fieldsAreValid) {
                    checkExistingCardEmail(formData).then(() => {
                        // If department doesn't exist, proceed with form submission
                        $.ajax({
                            url: 'action/add_admin.php', // URL to submit the form data
                            type: 'POST',
                            data: formData.serialize(), // Serialize form data
                            success: function(response) {
                                // Handle the success response
                                console.log(response); // Output response to console (for debugging)
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Admin added successfully',
                                    showConfirmButton: true, // Show OK button
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                // Handle the error response
                                console.error(xhr.responseText); // Output error response to console (for debugging)
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed to add admin',
                                    text: 'Please try again later.',
                                    showConfirmButton: true, // Show OK button
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
                    }).catch(() => {
                        // If department exists, do nothing (error message already shown)
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to show SweetAlert2 messages
            const showSweetAlert = (icon, title, message) => {
                Swal.fire({
                    icon: icon,
                    title: title,
                    text: message
                });
            };

            $(document).on('click', '[id^="updateAdmin_"]', function(e) {
                e.preventDefault(); // Prevent default form submission
                var deptId = $(this).attr('id').split('_')[1]; // Extract event ID
                var formData = $('#edit_' + deptId + ' form'); // Get the form data

                // Perform check for UID and email existence
                $.ajax({
                    url: 'action/check_admin_existence.php', // URL to check if UID and email exist
                    type: 'POST',
                    data: formData.serialize(), // Form data to be checked
                    dataType: 'json', // Specify JSON data type for response
                    success: function(response) {
                        // Remove existing error classes
                        $('.form-control').removeClass('input-error');

                        // Check if UID or email exists
                        if (response.uidExists && response.emailExists) {
                            // Both UID and email exist
                            showSweetAlert('error', 'Error', 'Email already exist in the database.');
                            $('#email_' + deptId).addClass('input-error'); // Add red border to email field
                        } else if (response.uidExists) {
                            // Only UID exists
                            showSweetAlert('error', 'Error', 'Email already exists in the database.');
                            $('#email_' + deptId).addClass('input-error'); // Add red border to email field
                        } else if (response.emailExists) {
                            // Only email exists
                            showSweetAlert('error', 'Error', 'Email already exists in the database.');
                            $('#email_' + deptId).addClass('input-error'); // Add red border to email field
                        } else {
                            // Check if passwords match
                            const password = $('#password_' + deptId).val().trim();
                            const confirmPass = $('#confirm_password_' + deptId).val().trim();

                            if ((password !== confirmPass) && (password !== '' || confirmPass !== '')) {
                                // Passwords don't match and at least one of them is not empty
                                showSweetAlert('error', 'Error', 'Passwords do not match');
                                $('#confirm_password_' + deptId).addClass('input-error'); // Add red border to confirm password field
                                return; // Stop further processing
                            } else {
                                // Passwords match or both are empty
                                $('#confirm_password_' + deptId).removeClass('input-error'); // Remove red border from confirm password field
                            }
                            // If UID and email do not exist, proceed with updating
                            $.ajax({
                                url: 'action/update_admin.php', // URL to submit the form data
                                type: 'POST',
                                data: formData.serialize(), // Form data to be submitted
                                dataType: 'json',
                                success: function(response) {
                                    // Handle the success response
                                    console.log(response); // Output response to console (for debugging)
                                    if (response.status === 'success') {
                                        Swal.fire(
                                            'Success!',
                                            response.message,
                                            'success'
                                        ).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire(
                                            'Error!',
                                            response.message,
                                            'error'
                                        );
                                    }
                                },
                                error: function(xhr, status, error) {
                                    // Handle the error response
                                    console.error(xhr.responseText); // Output error response to console (for debugging)
                                    showSweetAlert('error', 'Error', 'Failed to update admin. Please try again later.');
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response for existence check
                        console.error(xhr.responseText); // Output error response to console (for debugging)
                        showSweetAlert('error', 'Error', 'Failed to check email existence. Please try again later.');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function for deleting event
            $('.delete-admin-btn').on('click', function(e) {
                e.preventDefault();
                var deleteBtn = $(this);
                var adminID = deleteBtn.data('admin-id');
                var userID = deleteBtn.data('user-id');
                var adminName = decodeURIComponent(deleteBtn.data('admin-name'));

                Swal.fire({
                    title: 'Delete Admin',
                    html: "You are about to delete the following admin:<br>" +
                          "<strong>Admin Name:</strong> " + adminName + "<br>",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#fa626b',
                    cancelButtonColor: '#6b6f80',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'action/delete_admin.php', // Adjust the URL to your PHP script for deleting the event
                            type: 'POST',
                            data: {
                                admin_id: adminID,
                                user_id: userID
                            },
                            success: function(response) {
                                if (response.trim() === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Admin has been deleted.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to delete admin.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete admin.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

  </body>
</html>