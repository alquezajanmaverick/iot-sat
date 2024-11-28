<?php return false; ?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

  <!-- include head.php -->
  <?php include './include/head.php'; ?>
  <!-- end head -->

  <body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-red-pink" data-col="2-columns">
<div class="d-none" id="class"></div>
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
            <h3 class="content-header-title">Class</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item"><a href="class.php">Class</a>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
          <section id="">
              <!-- Column Card -->
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header">
                            <div class="float-left">
                              <h4 class="card-title">List of Class</h4>
                            </div>
                            <div class="float-right">
                              <a href="" class="btn btn-primary shadow-sm mt-1" data-toggle="modal" data-target="#addnew"><i class="fa-solid fa-plus"></i></a>
                            </div>
                              
                              
                          </div>
                          <div class="card-content collapse show">

                              <div class="card-body pt-0 mt-0">

                                  <div class="table-responsive">
                                      <table class="table nowrap table-hover" id="myTable" width="100%" cellspacing="0">
                                          <thead class="bg-dark text-white">
                                              <tr>   
                                                  <th scope="col">#</th>                                  
                                                  <th scope="col">Class</th> 
                                                  <th scope="col">Program</th>                                                            
                                                  <th scope="col" class="text-center">Action</th>               
                                              </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                              require '../db/dbconn.php';
                                              $display_class = "
                                                    SELECT ct.class_id, ct.program_id, pt.program_code, ct.year, ct.section
                                                    FROM class_tbl ct
                                                    INNER JOIN program_tbl pt ON pt.program_id = ct.program_id
                                                    WHERE ct.deleted = 0
                                                    ";
                                              $sqlQuery = mysqli_query($conn, $display_class);
                                              $num = 1;

                                             
                                              while($row = mysqli_fetch_array($sqlQuery)){
                                                  $class_id = $row['class_id'];
                                                  $program_code = $row['program_code'];
                                                  $year = $row['year'];
                                                  $section = $row['section'];
                                                  $program_id = $row['program_id'];
                                                  
                                              ?>
                                            <tr>
                                              <td class=""><?php echo $num; ?></td>          
                                              <td class=""><?php echo $program_code.' '.$year.'-'.$section; ?></td>
                                              <td class=""><?php echo $program_code; ?></td>     
                                              <td class="text-center">
                                                <a href="" class="btn btn-sm btn-success shadow-sm"
                                                  data-toggle="modal" data-target="#edit_<?php echo $class_id; ?>">
                                                  <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="" class="btn btn-sm btn-danger shadow-sm delete-class-btn"
                                                   data-class-id="<?php echo $class_id; ?>"
                                                   data-class-name="<?php echo $program_code.' '.$year.'-'.$section; ?>">
                                                   <i class="fa-solid fa-trash"></i>
                                                </a>
                                              </td>
                                            </tr>
                                              <?php
                                                include('./modal/class_edit_modal.php');
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
          <?php include './modal/class_add_modal.php'; ?>  
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
            scrollX: true,
            scrollCollapse: true,
            scrollY: '40vh'
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
    const checkExistingClass = (formData) => {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: 'action/check_class.php', // URL to check the database
                type: 'POST',
                data: formData.serialize(), // Serialize form data
                success: function(response) {
                    if (response.exists) {
                        // Highlight the corresponding input fields with red border
                        if (response.exists.class_id) {
                            showWarningMessage('CLass already exists.');
                            formData.find('select[name="program_id"]').addClass('input-error');
                            formData.find('select[name="year"]').addClass('input-error');
                            formData.find('select[name="section"]').addClass('input-error');
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

    $('#addClass').on('click', function(e) {
        e.preventDefault(); // Prevent default form submission

        var formData = $('#addnew form'); // Select the form element

        // const requiredFields = formData.find(':input[required]').not('select');
        let fieldsAreValid = true; // Initialize as true

        // Remove existing error classes
        $('.form-control').removeClass('input-error');

        // requiredFields.each(function() {
        //     if ($(this).val().trim() === '') {
        //         fieldsAreValid = false; // Set to false if any required field is empty
        //         showWarningMessage('Please fill-up the required fields.');
        //         $(this).addClass('input-error'); // Add red border to missing field
        //     } else {
        //         $(this).removeClass('input-error'); // Remove red border if field is filled
        //     }
        // });

// Function to check if a select field is empty or has no selected value
const checkSelectField = (fieldName, errorMessage) => {
    const fieldValue = formData.find(`select[name="${fieldName}"]`).val();
    const fieldElement = formData.find(`select[name="${fieldName}"]`);

    if (!fieldValue || fieldValue === '') {
        fieldsAreValid = false; // Set to false if the field is empty
        showWarningMessage(errorMessage);
        fieldElement.addClass('input-error');
    } else {
        fieldElement.removeClass('input-error');
    }
};

// Check if program_id is empty or has no selected value
checkSelectField('program_id', 'Please select a department.');

// Check if section is empty or has no selected value
checkSelectField('section', 'Please select a section.');

// Check if year is empty or has no selected value
checkSelectField('year', 'Please select a year.');

        if (fieldsAreValid) {
            checkExistingClass(formData).then(() => {
                // If department doesn't exist, proceed with form submission
                $.ajax({
                    url: 'action/add_class.php', // URL to submit the form data
                    type: 'POST',
                    data: formData.serialize(), // Serialize form data
                    success: function(response) {
                        // Handle the success response
                        console.log(response); // Output response to console (for debugging)
                        Swal.fire({
                            icon: 'success',
                            title: 'Class added successfully',
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
                            title: 'Failed to add class',
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

        $(document).on('click', '[id^="updateClass_"]', function(e) {
            e.preventDefault(); // Prevent default form submission
            var deptId = $(this).attr('id').split('_')[1]; // Extract event ID
            var formData = $('#edit_' + deptId + ' form'); // Get the form data

            // Perform check for UID and email existence
            $.ajax({
                url: 'action/check_class_existence.php', // URL to check if UID and email exist
                type: 'POST',
                data: formData.serialize(), // Form data to be checked
                dataType: 'json', // Specify JSON data type for response
                success: function(response) {
                    // Remove existing error classes
                    $('.form-control').removeClass('input-error');

                    // Check if UID or email exists
                    if (response.classExists) {
                        // Both UID and email exist
                        showSweetAlert('error', 'Error', 'Class already exist in the database.');
                        $('#program_id_' + deptId).addClass('input-error'); // Add red border to UID field
                        $('#year_' + deptId).addClass('input-error'); // Add red border to email field
                        $('#section_' + deptId).addClass('input-error'); // Add red border to email field
                    } else {
                        // If UID and email do not exist, proceed with updating
                        $.ajax({
                            url: 'action/update_class.php', // URL to submit the form data
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
                                showSweetAlert('error', 'Error', 'Failed to update class. Please try again later.');
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error response for existence check
                    console.error(xhr.responseText); // Output error response to console (for debugging)
                    showSweetAlert('error', 'Error', 'Failed to check class existence. Please try again later.');
                }
            });
        });
    });
    </script>
<script>
$(document).ready(function() {
    // Function for deleting event
    $('.delete-class-btn').on('click', function(e) {
        e.preventDefault();
        var deleteBtn = $(this);
        var classID = deleteBtn.data('class-id');
        var className = decodeURIComponent(deleteBtn.data('class-name'));

        Swal.fire({
            title: 'Delete Class',
            html: "You are about to delete the following class:<br>" +
                  "<strong>Class:</strong> " + className + "<br>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fa626b',
            cancelButtonColor: '#6b6f80',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'action/delete_class.php', // Adjust the URL to your PHP script for deleting the event
                    type: 'POST',
                    data: {
                        class_id: classID
                    },
                    success: function(response) {
                        if (response.trim() === 'success') {
                            Swal.fire(
                                'Deleted!',
                                'Class has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete class.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire(
                            'Error!',
                            'Failed to delete program.',
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