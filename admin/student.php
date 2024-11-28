<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

  <!-- include head.php -->
  <?php include './include/head.php'; ?>
  <!-- end head -->

  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-red-pink" data-col="2-columns">
<div class="d-none" id="student"></div>

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
            <h3 class="content-header-title">Students</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item"><a href="student.php">Students</a>
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
                              <h4 class="card-title">List of Students</h4>
                            </div>
                            <div class="float-right">
                              <a href="" class="btn btn-primary shadow-sm mt-1" data-toggle="modal" data-target="#addnew"><i class="fa-solid fa-plus"></i></a>
                              <a href="" class="btn btn-secondary shadow-sm mt-1" data-toggle="modal" data-target="#importnew"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path fill="currentColor" d="M11.025 18.475q.05.675.213 1.313T11.675 21q-1.075-.025-2.562-.25t-2.85-.7t-2.313-1.225T3 17v-2.5q0 .975.838 1.7t2.05 1.2t2.612.738t2.525.337m1.65-5q-.475.55-.825 1.175t-.55 1.325q-1.125-.05-2.562-.3t-2.713-.725t-2.15-1.2T3 12V9.5q0 1.1 1.025 1.863t2.45 1.237t2.963.688T12 13.5q.15 0 .313-.012t.362-.013M12 11q-3.75 0-6.375-1.175T3 7t2.625-2.825T12 3t6.375 1.175T21 7t-2.625 2.825T12 11m5.5 10h1v-4.1l1.8 1.8l.7-.7l-3-3l-3 3l.7.7l1.8-1.8zm.5 2q-2.075 0-3.537-1.463T13 18t1.463-3.537T18 13t3.538 1.463T23 18t-1.463 3.538T18 23"/></svg></a>
                              <a href="student-archive.php" class="btn btn-outline-secondary shadow-sm mt-1"><i class="fa-solid fa-box-archive mr-1"></i>Archive</a>
                            </div>
                              
                              
                          </div>
                          <div class="card-content collapse show">

                              <div class="card-body pt-0 mt-0">

                                  <div class="table-responsive">
                                      <table class="table nowrap table-hover" id="myTable" width="100%" cellspacing="0">
                                          <thead class="bg-dark text-white">
                                              <tr>   
                                                  <th scope="col">#</th>                                  
                                                  <th scope="col">Card ID</th> 
                                                  <th scope="col">Name</th>
                                                  <th scope="col">Email</th>                                                                                 
                                                                                                                     
                                                  <!-- <th scope="col">Class</th>                                                                                  -->
                                                  <th scope="col" class="text-center">Action</th>                          
                                              </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                              require '../db/dbconn.php';
                                              $display_student = "SELECT st.*, ut.user_id
                                                                    FROM student_tbl st
                                                                    INNER JOIN user_tbl ut ON ut.email = st.email
                                                                    WHERE st.deleted = 0";
                                              $sqlQuery = mysqli_query($conn, $display_student);
                                              $num = 1;

                                             
                                              while($row = mysqli_fetch_array($sqlQuery)){
                                                  $student_id = $row['student_id'];
                                                  $user_id = $row['user_id'];
                                                  $uid = $row['uid'];
                                                  $name = $row['last_name']. ' '.$row['first_name'];
                                                  $first_name = $row['first_name'];
                                                  $middle_name = $row['middle_name'];
                                                  $last_name = $row['last_name'];
                                                  $ext_name = $row['ext_name'];
                                                  $email = $row['email'];
                                                  $contact = $row['contact'];
                                                  $guardian_contact = $row['guardian_contact'];
                                                  $guardian_name = $row['guardian_name'];
                                            ?>
                                            <tr>
                                              <td class=""><?php echo $num; ?></td>          
                                              <td class=""><?php echo $uid; ?></td>
                                              <td class=""><?php echo $name; ?></td>   
                                              <td class=""><?php echo $email; ?></td> 
                                              <td class="text-center">
                                                <a href="" class="btn btn-sm btn-success shadow-sm"
                                                  data-toggle="modal" data-target="#edit_<?php echo $student_id; ?>">
                                                  <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="" class="btn btn-sm btn-danger shadow-sm delete-student-btn"
                                                   data-student-id="<?php echo $student_id; ?>"
                                                   data-user-id="<?php echo $user_id; ?>"
                                                   data-student-name="<?php echo htmlspecialchars($name); ?>">
                                                   <i class="fa-solid fa-trash"></i>
                                                </a>
                                              </td>
                                            </tr>
                                            <?php
                                              include('modal/student_edit_modal.php');
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
          <?php include './modal/student_add_modal.php'; ?>  
          <?php include './modal/student_import_modal.php'; ?>  
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

            // Input Element for Contact Number
            function limitContactInputLength(event) {
                // Remove non-digit characters
                var inputValue = event.target.value.replace(/\D/g, '');

                // Limit the length to 11 digits
                if (inputValue.length > 11) {
                    inputValue = inputValue.slice(0, 11);
                }

                // Update the input value
                event.target.value = inputValue;
            }

            // Contact Input Validation
            var contactInputs = document.querySelectorAll('.contact-input');
            contactInputs.forEach(function(input) {
                input.addEventListener('input', limitContactInputLength);
            });
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
                    url: 'action/check_student.php', // URL to check the database
                    type: 'POST',
                    data: formData.serialize(), // Serialize form data
                    success: function(response) {
                        if (response.exists) {
                            // Highlight the corresponding input fields with red border
                            if (response.exists.uid) {
                                showWarningMessage('Card ID already exists.');
                                formData.find('input[name="uid"]').addClass('input-error');
                            }
                            if (response.exists.email) {
                                showWarningMessage('Email already exists.');
                                formData.find('input[name="email"]').addClass('input-error');
                            }
                            if (response.exists.email && response.exists.uid) {
                                showWarningMessage('Card ID and Email already exists.');
                                formData.find('input[name="uid"]').css('border', '1px solid red'); // Add red border to UID field
                                formData.find('input[name="email"]').css('border', '1px solid red'); // Add red border to email field
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

        $('#importStudents').on('submit',function(e){
            e.preventDefault();
            var formData = new FormData(this); // Create FormData object
            $.ajax({
                url: 'action/import-student-sheet.php', // URL to send the file
                type: 'POST',
                data: formData,
                processData: false,  // Prevent jQuery from processing data
                contentType: false,  // Prevent jQuery from setting content-type
                success: function(response, textStatus, jqXHR){
                    if (jqXHR.status === 200) {
                        let duplicateEntries = JSON.parse(response).duplicateEntries
                        let newEntries = JSON.parse(response).newEntries
                        let successText = ""
                        if(duplicateEntries > 0){
                            successText = `${newEntries} new record${newEntries > 1 ? 's':''} imported.</br> ${duplicateEntries} existing record${duplicateEntries > 1 ? 's':''} excluded from import.</br><strong>Note: Records not reflected may be found on archives.<s/trong>`
                        }else{
                            successText = `${newEntries} new record${newEntries > 1 ? 's':''} imported.</br><strong>Note: Records not reflected may be found on archives.<s/trong>`
                        }
                        Swal.fire({
                            icon: 'success',
                            title: 'Import Success!',
                            html: successText, // Display the success response
                            confirmButtonText: 'Ok'
                        }).then(() => {
                                location.reload();
                            });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Unexpected response status.',
                            confirmButtonText: 'Ok'
                        });
                    }
                }
            });
        })

        $('#addStudent').on('click', function(e) {
            e.preventDefault(); // Prevent default form submission

            var formData = $('#addnew form'); // Select the form element

            const requiredFields = formData.find(':input[required]').not('select');
            let fieldsAreValid = true; // Initialize as true
            console.log(fieldsAreValid);

            // Remove existing error classes
            $('.form-control').removeClass('input-error');

            // Check if department_id is empty or has no selected value
            // const classID = formData.find('select[name="class_id"]').val();
            // if (!classID || classID === '') {
            //     fieldsAreValid = false; // Set to false if department_id is empty
            //     showWarningMessage('Please select a class.');
            //     formData.find('select[name="class_id"]').addClass('input-error');
            // } else {
            //     formData.find('select[name="class_id"]').removeClass('input-error');
            // }

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
            console.log(fieldsAreValid);
            if (fieldsAreValid) {
                checkExistingCardEmail(formData).then(() => {
                    // If department doesn't exist, proceed with form submission
                    $.ajax({
                        url: 'action/add_student.php', // URL to submit the form data
                        type: 'POST',
                        data: formData.serialize(), // Serialize form data
                        success: function(response) {
                            // Handle the success response
                            console.log(response); // Output response to console (for debugging)
                            Swal.fire({
                                icon: 'success',
                                title: 'Student added successfully',
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
                                title: 'Failed to add student',
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

        $(document).on('click', '[id^="updateStudent_"]', function(e) {
            e.preventDefault(); // Prevent default form submission
            var deptId = $(this).attr('id').split('_')[1]; // Extract event ID
            var formData = $('#edit_' + deptId + ' form'); // Get the form data

            // Perform check for UID and email existence
            $.ajax({
                url: 'action/check_student_existence.php', // URL to check if UID and email exist
                type: 'POST',
                data: formData.serialize(), // Form data to be checked
                dataType: 'json', // Specify JSON data type for response
                success: function(response) {
                    // Remove existing error classes
                    $('.form-control').removeClass('input-error');

                    // Check if UID or email exists
                    if (response.uidExists && response.emailExists) {
                        // Both UID and email exist
                        showSweetAlert('error', 'Error', 'UID and email already exist in the database.');
                        $('#uid_' + deptId).addClass('input-error'); // Add red border to UID field
                        $('#email_' + deptId).addClass('input-error'); // Add red border to email field
                    } else if (response.uidExists) {
                        // Only UID exists
                        showSweetAlert('error', 'Error', 'UID already exists in the database.');
                        $('#uid_' + deptId).addClass('input-error'); // Add red border to UID field
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
                            url: 'action/update_student.php', // URL to submit the form data
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
                                showSweetAlert('error', 'Error', 'Failed to update student. Please try again later.');
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error response for existence check
                    console.error(xhr.responseText); // Output error response to console (for debugging)
                    showSweetAlert('error', 'Error', 'Failed to check UID and email existence. Please try again later.');
                }
            });
        });
    });
    </script>
<script>
$(document).ready(function() {
    // Function for deleting event
    $('.delete-student-btn').on('click', function(e) {
        e.preventDefault();
        var deleteBtn = $(this);
        var studID = deleteBtn.data('student-id');
        var userID = deleteBtn.data('user-id');
        var studName = decodeURIComponent(deleteBtn.data('student-name'));

        Swal.fire({
            title: 'Delete Student',
            html: "You are about to delete the following student:<br>" +
                  "<strong>Student Name:</strong> " + studName + "<br>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fa626b',
            cancelButtonColor: '#6b6f80',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'action/delete_student.php', // Adjust the URL to your PHP script for deleting the event
                    type: 'POST',
                    data: {
                        student_id: studID,
                        user_id: userID
                    },
                    success: function(response) {
                        if (response.trim() === 'success') {
                            Swal.fire(
                                'Deleted!',
                                'Student has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete student.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire(
                            'Error!',
                            'Failed to delete student.',
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