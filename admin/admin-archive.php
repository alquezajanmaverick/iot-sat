<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

  <!-- include head.php -->
  <?php include './include/head.php'; ?>
  <!-- end head -->

  <body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-red-pink" data-col="2-columns">
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
            <h3 class="content-header-title">Archived Admin</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item"><a href="admin.php">Admin</a>
                  </li>
                  <li class="breadcrumb-item"><a href="admin-archive.php">Archive</a>
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
                              <h4 class="card-title">List of Archived Admin</h4>
                            </div>
                            <div class="float-right">
                              <a href="admin.php" class="btn btn-outline-secondary shadow-sm mt-1"><i class="fa-solid fa-arrow-left mr-1"></i>Back</a>
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
                                                                    WHERE att.deleted = 1";
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
                                                <a href="" class="btn btn-sm btn-info shadow-sm restore-admin-btn"
                                                   data-admin-id="<?php echo $admin_id; ?>"
                                                   data-user-id="<?php echo $user_id; ?>"
                                                   data-admin-name="<?php echo htmlspecialchars($name); ?>">
                                                   <i class="fa-solid fa-trash-can-arrow-up"></i>
                                                </a>
                                              </td>
                                            </tr>
                                            <?php
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
            // Function for deleting event
            $('.restore-admin-btn').on('click', function(e) {
                e.preventDefault();
                var deleteBtn = $(this);
                var adminID = deleteBtn.data('admin-id');
                var userID = deleteBtn.data('user-id');
                var adminName = decodeURIComponent(deleteBtn.data('admin-name'));

                Swal.fire({
                    title: 'Restore Admin',
                    html: "You are about to restore the following admin:<br>" +
                          "<strong>Admin Name:</strong> " + adminName + "<br>",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#28afd0',
                    cancelButtonColor: '#6b6f80',
                    confirmButtonText: 'Yes, restore it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'action/restore_admin.php', // Adjust the URL to your PHP script for deleting the event
                            type: 'POST',
                            data: {
                                admin_id: adminID,
                                user_id: userID
                            },
                            success: function(response) {
                                if (response.trim() === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Admin has been restored.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to restore admin.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Failed to restore admin.',
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