<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

  <!-- include head.php -->
  <?php include './include/head.php'; ?>
  <!-- end head -->

  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-red-pink" data-col="2-columns">
<div class="d-none" id="attendance"></div>

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
            <h3 class="content-header-title">Attendance Records</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item"><a href="attendance.php">Attendance Records</a>
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
                              <h4 class="card-title">List of My Attendance</h4>
                              <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                              <div class="heading-elements">
                                  <ul class="list-inline mb-0">
                                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                      <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
                                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                      <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                  </ul>
                              </div>
                          </div>
                          <div class="card-content collapse show">
                              <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="table nowrap table-hover" id="myTable" width="100%" cellspacing="0">
                                          <thead class="bg-dark text-white">
                                              <tr>
                                                  <th scope="col">#</th>                                  
                                                  <th scope="col">UID</th> 
                                                  <th scope="col">Name</th>
                                                  <th scope="col">Type</th>                                                       
                                                  <th scope="col">Date</th>                             
                                                  <!-- <th scope="col">Action</th>                           -->
                                              </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                              require '../db/dbconn.php';
                                              $student_id = $_SESSION['student_id'];

                                              $display_attendance = "
                                                        SELECT att.student_id, att.attendance_id, att.uid, att.date_time, att.type, CONCAT(st.last_name, ' ', st.first_name) as name, CONCAT(pt.program_code, ' ',ct.year,'-',ct.section) as class
                                                        FROM attendance_tbl att
                                                        INNER JOIN student_tbl as st ON att.student_id = st.student_id
                                                        WHERE att.student_id = '$student_id'
                                                        ORDER BY att.date_time DESC
                                                      ";
                                              $sqlQuery = mysqli_query($conn, $display_attendance);
                                              $num = 1;

                                              while($row = mysqli_fetch_array($sqlQuery)){
                                                  $uid = $row['uid'];
                                                  $att_id = $row['attendance_id'];
                                                  $name = $row['name'];
                                                  $type = $row['type'];
                                                  $date = date('h:i a | F d, Y', strtotime($row['date_time']));
                                              ?>
                                            <tr>    
                                              <td class=""><?php echo $num; ?></td>      
                                              <td class=""><?php echo $uid; ?></td>
                                              <td class=""><?php echo $name; ?></td>
                                              <td class="text-center">
                                                <?php
                                                  if ($type == 1) { ?>
                                                     <span class="badge badge-primary font-weight-bold">IN</span>
                                                <?php
                                                   } elseif ($type == 2) { ?>
                                                     <span class="badge badge-danger font-weight-bold">OUT</span>
                                                <?php     
                                                   }
                                                ?>
                                              </td>   
                                              <td class=""><?php echo $date; ?></td>
                                            </tr>
                                              <?php
                                                // include('modal/admin_edit_modal.php');
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
  </body>
</html>