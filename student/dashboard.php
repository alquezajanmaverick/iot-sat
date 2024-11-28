<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

  <!-- include head.php -->
  <?php include './include/head.php'; ?>
  <!-- end head -->

  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-red-pink" data-col="2-columns">
<div class="d-none" id="dashboard"></div>


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
            <h3 class="content-header-title">Student Dashboard</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
<!-- Pie charts section start -->
<section id="chartjs-pie-charts">
    <div class="row">
        <!-- Simple Pie Chart -->
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Chart 1</h4>
                    <a class="heading-elements-toggle"><i class="fa-solid fa-ellipsis-vertical font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="fa-solid fa-minus"></i></a></li>
                            <!-- <li><a data-action="reload"><i class="fa-solid fa-rotate"></i></a></li> -->
                            <li><a data-action="expand"><i class="fa-solid fa-expand"></i></a></li>
                            <!-- <li><a data-action="close"><i class="fa-solid fa-x"></i></a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                            <div class="height-300">
                        <canvas id="simple-pie-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Simple Doughnut Chart -->
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Chart 2</h4>
                    <a class="heading-elements-toggle"><i class="fa-solid fa-ellipsis-vertical font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="fa-solid fa-minus"></i></a></li>
                            <!-- <li><a data-action="reload"><i class="fa-solid fa-rotate"></i></a></li> -->
                            <li><a data-action="expand"><i class="fa-solid fa-expand"></i></a></li>
                            <!-- <li><a data-action="close"><i class="fa-solid fa-x"></i></a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                            <div class="height-300">
                        <canvas id="simple-doughnut-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>
<!-- // Pie charts section end -->
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