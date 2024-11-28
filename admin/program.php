<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

  <!-- include head.php -->
  <?php include './include/head.php'; ?>
  <!-- end head -->

  <body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-red-pink" data-col="2-columns">
<div class="d-none" id="program"></div>
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
            <h3 class="content-header-title">Program</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item"><a href="program.php">Program</a>
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
                              <h4 class="card-title">List of Program</h4>
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
                                                  <th scope="col">Program Code</th> 
                                                  <th scope="col">Program Name</th>
                                                  <th scope="col">Department</th>                                                             
                                                  <th scope="col" class="text-center">Action</th>               
                                              </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                              require '../db/dbconn.php';
                                              $display_program = "
                                                    SELECT pt.program_id, pt.program_code, pt.program_name, dt.department_code, pt.department_id
                                                    FROM program_tbl pt
                                                    INNER JOIN  department_tbl dt on dt.department_id = pt.department_id
                                                    WHERE pt.deleted = 0
                                                    ";
                                              $sqlQuery = mysqli_query($conn, $display_program);
                                              $num = 1;

                                             
                                              while($row = mysqli_fetch_array($sqlQuery)){
                                                  $program_id = $row['program_id'];
                                                  $program_code = $row['program_code'];
                                                  $program_name = $row['program_name'];
                                                  $department = $row['department_code'];
                                                  $department_id = $row['department_id'];
                                                  
                                              ?>
                                            <tr>
                                              <td class=""><?php echo $num; ?></td>          
                                              <td class=""><?php echo $program_code; ?></td>
                                              <td class=""><?php echo $program_name; ?></td>   
                                              <td class=""><?php echo $department; ?></td>   
                                              <td class="text-center">
                                                <a href="" class="btn btn-sm btn-success shadow-sm"
                                                  data-toggle="modal" data-target="#edit_<?php echo $program_id; ?>">
                                                  <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="" class="btn btn-sm btn-danger shadow-sm delete-program-btn" 
                                                   data-program-id="<?php echo $program_id; ?>"
                                                   data-program-code="<?php echo $program_code; ?>"
                                                   data-program-name="<?php echo htmlspecialchars($program_name); ?>">
                                                   <i class="fa-solid fa-trash"></i>
                                                </a>
                                              </td>
                                            </tr>
                                              <?php
                                                include('./modal/program_edit_modal.php');
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
          <?php include './modal/program_add_modal.php'; ?>  
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
    const checkExistingProgram = (formData) => {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: 'action/check_program.php', // URL to check the database
                type: 'POST',
                data: formData.serialize(), // Serialize form data
                success: function(response) {
                    if (response.exists) {
                        // Highlight the corresponding input fields with red border
                        if (response.exists.program_code) {
                            showWarningMessage('Program code already exists.');
                            formData.find('input[name="program_code"]').addClass('input-error');
                        }
                        if (response.exists.program_name) {
                            showWarningMessage('Program name already exists.');
                            formData.find('textarea[name="program_name"]').addClass('input-error');
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

    $('#addProgram').on('click', function(e) {
        e.preventDefault(); // Prevent default form submission

        var formData = $('#addnew form'); // Select the form element

        const requiredFields = formData.find(':input[required]').not('select');
        let fieldsAreValid = true; // Initialize as true

        // Remove existing error classes
        $('.form-control').removeClass('input-error');

        requiredFields.each(function() {
            if ($(this).val().trim() === '') {
                fieldsAreValid = false; // Set to false if any required field is empty
                showWarningMessage('Please fill-up the required fields.');
                $(this).addClass('input-error'); // Add red border to missing field
            } else {
                $(this).removeClass('input-error'); // Remove red border if field is filled
            }
        });

        // Check if department_id is empty or has no selected value
        const departmentId = formData.find('select[name="department_id"]').val();
        if (!departmentId || departmentId === '') {
            fieldsAreValid = false; // Set to false if department_id is empty
            showWarningMessage('Please select a department.');
            formData.find('select[name="department_id"]').addClass('input-error');
        } else {
            formData.find('select[name="department_id"]').removeClass('input-error');
        }

        if (fieldsAreValid) {
            checkExistingProgram(formData).then(() => {
                // If department doesn't exist, proceed with form submission
                $.ajax({
                    url: 'action/add_program.php', // URL to submit the form data
                    type: 'POST',
                    data: formData.serialize(), // Serialize form data
                    success: function(response) {
                        // Handle the success response
                        console.log(response); // Output response to console (for debugging)
                        Swal.fire({
                            icon: 'success',
                            title: 'Program added successfully',
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
                            title: 'Failed to add program',
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
    // For dynamically rendered modals
    $(document).on('click', '[id^="updateProgram_"]', function(e) {
        e.preventDefault(); // Prevent default form submission
        
        var deptId = $(this).attr('id').split('_')[1]; // Extract event ID
        var formData = $('#edit_' + deptId + ' form').serialize(); // Serialize form data

        $.ajax({
            url: 'action/update_program.php', // URL to submit the form data
            type: 'POST',
            data: formData, // Form data to be submitted
            success: function(response) {
                // Handle the success response
                console.log(response); // Output response to console (for debugging)
                Swal.fire({
                    icon: 'success',
                    title: 'Program updated successfully',
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
                    title: 'Failed to update program',
                    text: 'Please try again later.',
                    showConfirmButton: true, // Show OK button
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                }); 
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    // Function for deleting event
    $('.delete-program-btn').on('click', function(e) {
        e.preventDefault();
        var deleteBtn = $(this);
        var programId = deleteBtn.data('program-id');
        var programCode = decodeURIComponent(deleteBtn.data('program-code'));
        var programName = decodeURIComponent(deleteBtn.data('program-name'));

        Swal.fire({
            title: 'Delete Program',
            html: "You are about to delete the following program:<br>" +
                  "<strong>Program Code:</strong> " + programCode + "<br>" +
                  "<strong>Program Name:</strong> " + programName + "<br>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fa626b',
            cancelButtonColor: '#6b6f80',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'action/delete_program.php', // Adjust the URL to your PHP script for deleting the event
                    type: 'POST',
                    data: {
                        program_id: programId
                    },
                    success: function(response) {
                        if (response.trim() === 'success') {
                            Swal.fire(
                                'Deleted!',
                                'Program has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete program.',
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