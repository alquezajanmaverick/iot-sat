<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

  <!-- include head.php -->
  <?php include './include/head.php'; ?>
  <!-- end head -->

  <body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-red-pink" data-col="2-columns">
<div class="d-none" id="academic"></div>
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
            <h3 class="content-header-title">Academic Year</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item"><a href="department.php">Department</a>
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
                              <h4 class="card-title">List of Academic Year</h4>
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
                                                  <th scope="col">Academic Year</th> 
                                                  <th scope="col">Semester</th>                                                             
                                                  <th scope="col">Default</th>                                                             
                                                  <th scope="col" class="text-center">Action</th>               
                                              </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                              require '../db/dbconn.php';
                                              $display_academic = "SELECT * FROM acad_yr_tbl WHERE deleted = 0";
                                              $sqlQuery = mysqli_query($conn, $display_academic);
                                              $num = 1;

                                             
                                              while($row = mysqli_fetch_array($sqlQuery)){
                                                  $acad_id = $row['acad_id'];
                                                  $year_start = $row['year_start'];
                                                  $year_end = $row['year_end'];
                                                  $semester = $row['semester'];
                                                  $is_default = $row['is_default'];

                                                if ($row['semester'] == 1) {
                                                    $sem = "1st Semester";
                                                } else if ($row['semester'] == 2){
                                                    $sem = "2nd Semester";
                                                } else{
                                                    $sem = "Mid Year";
                                                }

                                                if ($is_default == 1) {
                                                    $is_default_text = "<div class='row'><div class='col'><i class='fa-solid fa-circle-check text-primary fa-xl'></i></div></div>";
                                                } else{
                                                    $is_default_text = "<div class='row'><div class='col'><i class='fa-solid fa-circle-xmark fa-xl'></i></div></div>";
                                                }
                                                  
                                              ?>
                                            <tr>
                                              <td class=""><?php echo $num; ?></td>          
                                              <td class=""><?php echo $year_start; ?> - <?php echo $year_end; ?></td>
                                              <td class=""><?php echo $sem; ?></td>   
                                              <td class=""><?php echo $is_default_text; ?></td>   
                                              <td class="text-center">
                                                <?php if ($is_default == 1) { ?>
                                                    <a href="" class="btn btn-sm btn-primary shadow-sm set-default-btn disabled" 
                                                       data-acad-id="<?php echo $acad_id; ?>"
                                                       data-acad-year="<?php echo htmlspecialchars($year_start.' - '.$year_end); ?>"
                                                       data-acad-semester="<?php echo htmlspecialchars($sem); ?>">
                                                       <i class="fa-solid fa-thumbtack"></i>
                                                    </a>
                                                    <a href="" class="btn btn-sm btn-danger shadow-sm delete-acad-btn disabled" 
                                                       data-acad-id="<?php echo $acad_id; ?>"
                                                       data-acad-year="<?php echo htmlspecialchars($year_start.' - '.$year_end); ?>"
                                                       data-acad-semester="<?php echo htmlspecialchars($sem); ?>">
                                                       <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                <?php }elseif ($is_default == 0) { ?>
                                                    <a href="" class="btn btn-sm btn-primary shadow-sm set-default-btn" 
                                                       data-acad-id="<?php echo $acad_id; ?>"
                                                       data-acad-year="<?php echo htmlspecialchars($year_start.' - '.$year_end); ?>"
                                                       data-acad-semester="<?php echo htmlspecialchars($sem); ?>">
                                                       <i class="fa-solid fa-thumbtack"></i>
                                                    </a>
                                                    <a href="" class="btn btn-sm btn-danger shadow-sm delete-acad-btn" 
                                                       data-acad-id="<?php echo $acad_id; ?>"
                                                       data-acad-year="<?php echo htmlspecialchars($year_start.' - '.$year_end); ?>"
                                                       data-acad-semester="<?php echo htmlspecialchars($sem); ?>">
                                                       <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                <?php } ?>
                                              </td>
                                            </tr>
                                              <?php
                                                // include('./modal/department_edit_modal.php');
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
          <?php include './modal/academic_add_modal.php'; ?>  
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
        $('#year_start').on('input', function() {
            var yearStart = $(this).val();
            if(yearStart >= 2009 && yearStart <= 9999){
                var yearEnd = parseInt(yearStart) + 1;
                $('#year_end').val(yearEnd);
            } else {
                $('#year_end').val('');
            }
        });

        // Function to show SweetAlert2 warning message
        const showWarningMessage = (message) => {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: message
            });
        };

        function validateYearField(field, minYear, maxYear) {
            var year = $(field).val();
            if (year < minYear || year > maxYear) {
                $(field).addClass('input-error');
                return false;
            } else {
                $(field).removeClass('input-error');
                return true;
            }
        }

        // Function to check if academic year already exists
        const checkExistingAcademic = (formData) => {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: 'action/check_academic.php', // URL to check the database
                    type: 'POST',
                    data: formData.serialize(), // Serialize form data
                    success: function(response) {
                        if (response.exists) {
                            // Highlight the corresponding input fields with red border
                            showWarningMessage('Academic Year already exists.');
                            formData.find('input[name="year_start"]').addClass('input-error');
                            formData.find('input[name="year_end"]').addClass('input-error');
                            reject(); // Reject the promise if academic year already exists
                        } else {
                            resolve(); // Resolve the promise if academic year doesn't exist
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Output error response to console (for debugging)
                        reject(); // Reject the promise if there's an error
                    }
                });
            });
        };

        $('#addAcademic').on('click', function(e) {
            e.preventDefault(); // Prevent default form submission

            var formData = $('#addnew form'); // Select the form element

            const requiredFields = formData.find('[required]');
            let fieldsAreValid = true; // Initialize as true

            // Remove existing error classes
            $('.form-control').removeClass('input-error');

            requiredFields.each(function() {
                if ($(this).val().trim() === '') {
                    fieldsAreValid = false; // Set to false if any required field is empty
                    showWarningMessage('Please fill-up the required fields.');
                    $(this).addClass('input-error'); // Add red border to missing field
                    return;
                } else {
                    $(this).removeClass('input-error'); // Remove red border if field is filled
                }
            });

            var minYear = 2009;
            var maxYear = 9999;

            if (!validateYearField('#year_start', minYear, maxYear)) {
                showWarningMessage('Please enter a valid 4-digit year for Year Start.');
                fieldsAreValid = false;
            }

            if (!validateYearField('#year_end', minYear, maxYear)) {
                showWarningMessage('Please enter a valid 4-digit year for Year End.');
                fieldsAreValid = false;
            }


            if (fieldsAreValid) {
                checkExistingAcademic(formData).then(() => {
                    // If department doesn't exist, proceed with form submission
                    $.ajax({
                        url: 'action/add_academic.php', // URL to submit the form data
                        type: 'POST',
                        data: formData.serialize(), // Serialize form data
                        success: function(response) {
                            // Handle the success response
                            console.log(response); // Output response to console (for debugging)
                            Swal.fire({
                                icon: 'success',
                                title: 'Academic Year added successfully',
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
                                title: 'Failed to add academic year',
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
        // Function for deleting event
        $('.delete-acad-btn').on('click', function(e) {
            e.preventDefault();
            var deleteBtn = $(this);
            var acadID = deleteBtn.data('acad-id');
            var acadYear = decodeURIComponent(deleteBtn.data('acad-year'));
            var acadSem = decodeURIComponent(deleteBtn.data('acad-semester'));

            Swal.fire({
                title: 'Delete Academic Year & Semester',
                html: "You are about to delete the following academic year & semester:<br>" +
                      "<strong>Academic Year:</strong> " + acadYear + "<br>" +
                      "<strong>Semester:</strong> " + acadSem + "<br>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#fa626b',
                cancelButtonColor: '#6b6f80',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'action/delete_academic.php', // Adjust the URL to your PHP script for deleting the event
                        type: 'POST',
                        data: {
                            acad_id: acadID
                        },
                        success: function(response) {
                            if (response.trim() === 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    'Academic year & semester has been deleted.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete academic year & semester.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire(
                                'Error!',
                                'Failed to delete academic year & semester.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Function for deleting event
        $('.set-default-btn').on('click', function(e) {
            e.preventDefault();
            var deleteBtn = $(this);
            var acadID = deleteBtn.data('acad-id');
            var acadYear = decodeURIComponent(deleteBtn.data('acad-year'));
            var acadSem = decodeURIComponent(deleteBtn.data('acad-semester'));

            Swal.fire({
                title: 'Set as Default Academic Year & Semester',
                html: "You are about to set as default the following academic year & semester:<br>" +
                      "<strong>Academic Year:</strong> " + acadYear + "<br>" +
                      "<strong>Semester:</strong> " + acadSem + "<br>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#fa626b',
                cancelButtonColor: '#6b6f80',
                confirmButtonText: 'Yes, set it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'action/set_academic.php', // Adjust the URL to your PHP script for deleting the event
                        type: 'POST',
                        data: {
                            acad_id: acadID
                        },
                        success: function(response) {
                            if (response.trim() === 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    'Academic year & semester has been set as default.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Failed to set as default academic year & semester.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire(
                                'Error!',
                                'Failed to set as default academic year & semester.',
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