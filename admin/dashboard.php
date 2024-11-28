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
            <h3 class="content-header-title">Dashboard</h3>
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
          <section id="">
              <!-- Column Card -->
  <div class="row match-height">
    
<div class="col-xl-4 col-lg-12">
    <div class="card height-200 pull-up">
        <div class="card-header">
            <h5 class="text-muted danger position-absolute">Porta <span id="device-name">Primaria</span></h5>
            <a class="heading-elements-toggle">
                <i class="la la-ellipsis-v font-medium-3"></i>
            </a>
            <div class="heading-elements">
                <i class="fa-solid fa-torii-gate danger font-large-1 float-right"></i>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="text-center p-1">
                    <i class="fa-solid fa-wifi secondary fa-5x" id="status-icon"></i>
                    <p id="device-status" class="mt-1 text-secondary">Device is offline!</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-lg-12">
    <div class="card height-200 pull-up">
        <div class="card-header">
            <h5 class="text-muted primary position-absolute">Porta <span id="device-name2">Exitus</span></h5>
            <a class="heading-elements-toggle">
                <i class="la la-ellipsis-v font-medium-3"></i>
            </a>
            <div class="heading-elements">
                <i class="fa-solid fa-torii-gate primary font-large-1 float-right"></i>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="text-center p-1">
                    <i class="fa-solid fa-wifi secondary fa-5x" id="status-icon2"></i>
                    <p id="device-status2" class="mt-1 text-secondary">Device is offline!</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-lg-12">
    <div class="card height-200 pull-up">
        <div class="card-header">
            <h5 class="text-muted warning position-absolute">Last Active</h5>
            <a class="heading-elements-toggle">
                <i class="la la-ellipsis-v font-medium-3"></i>
            </a>
            <div class="heading-elements">
                <i class="fa-solid fa-clock warning font-large-1 float-right"></i>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="text-left">
                    <div class="my-2">
                        <p class="mb-0 font-weight-bold"></i>Porta Primaria: <span class="font-weight-light" id="last-active1"> N/A</span></p>
                        
                    </div>
                    <div class="my-2">
                        <p class="mb-0 font-weight-bold"></i>Porta Exitus: <span class="font-weight-light" id="last-active2"> N/A</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  </div>
          </section>
<!-- Pie charts section start -->
<section id="chartjs-pie-charts">
    <div class="row">
        <!-- Simple Pie Chart -->
        <div class="col-md-6 col-sm-12">
            <div class="card pull-up">
                <div class="card-header">
                    <h4 class="card-title">Attendance Overview (Current Academic Year)</h4>
                    <a class="heading-elements-toggle"><i class="fa-solid fa-ellipsis-vertical font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="fa-solid fa-minus"></i></a></li>
                            <!-- <li><a data-action="reload"><i class="fa-solid fa-rotate"></i></a></li>/ -->
                            <li><a data-action="expand"><i class="fa-solid fa-expand"></i></a></li>
                            <!-- <li><a data-action="close"><i class="fa-solid fa-x"></i></a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="height-300">
                            <canvas id="simple-bar-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Simple Doughnut Chart -->
        <div class="col-md-6 col-sm-12">
            <div class="card pull-up">
                <div class="card-header">
                    <h4 class="card-title">Attendance Per Program (Current Academic Year)</h4>
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
                            <canvas id="simple-donut-chart"></canvas>
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
    <script>
        $(document).ready(function() {
            // Function to update the card based on data from check_active.php
            function updateCard(statusIconId, deviceStatusId, deviceNameId, deviceLastActive, color) {
                // Fetch device name from the span
                var deviceName = $('#' + deviceNameId).text().toLowerCase();

                $.ajax({
                    url: '../function/check_active.php', // Change the URL to point to your check_active.php script
                    dataType: 'json',
                    data: { deviceName: deviceName }, // Pass deviceName as data to the AJAX request
                    success: function(data) {
                        if (data.length > 0) {
                            var lastActiveTime = new Date(data[data.length - 1].last_active);
                            var currentTime = new Date();
                            var diffInSeconds = (currentTime - lastActiveTime) / 1000;

                            var formattedDateTime = lastActiveTime.toLocaleString('en-US', { 
                                year: 'numeric', 
                                month: '2-digit', 
                                day: '2-digit', 
                                hour: '2-digit', 
                                minute: '2-digit',
                                hour12: true // Specify whether to use 12-hour or 24-hour time format
                            });

                            // Update the card based on the time difference
                            if (diffInSeconds > 10) {
                                $('#' + statusIconId).removeClass('fa-wifi '+color).addClass('fa-wifi secondary');
                                $('#' + deviceStatusId).removeClass('text-'+color).addClass('text-secondary').text('Device is offline!');
                                $('#' + deviceLastActive).addClass('text-warning').text(formattedDateTime);
                            } else {
                                $('#' + statusIconId).removeClass('fa-wifi secondary').addClass('fa-wifi '+color);
                                $('#' + deviceStatusId).removeClass('text-secondary').addClass('text-'+color).text('Device is online!');
                                $('#' + deviceLastActive).addClass('text-warning').text(formattedDateTime);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching device status:', error);
                    }
                });
            }

            // Call the updateCard function initially
            updateCard('status-icon', 'device-status', 'device-name','last-active1', 'danger');
            updateCard('status-icon2', 'device-status2', 'device-name2','last-active2', 'primary');

            // Call the updateCard function every 5 seconds
            setInterval(function() {
                updateCard('status-icon', 'device-status', 'device-name','last-active1', 'danger');
                updateCard('status-icon2', 'device-status2', 'device-name2','last-active2', 'primary');
            }, 4000);
        });
    </script>

    <script>
        $(document).ready(function() {

            // Function to format numbers (if needed)
            function number_format(number, decimals, dec_point, thousands_sep) {
                number = (number + '').replace(',', '').replace(' ', '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function(n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            // AJAX request to fetch data from PHP script
            $.ajax({
                url: 'action/fetch_attendance_per_month.php', // Replace with the actual path to your PHP script
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Extracting labels and data from the response
                    var labels = data.map(function(item) {
                        return item.month;
                    });
                    var attendanceData = data.map(function(item) {
                        return item.total_attendance;
                    });

                    // Define an array of colors for each bar
                    var barColors = [
                        "rgba(78, 115, 223, 1)",
                        "rgba(54, 185, 204, 1)",
                        "rgba(28, 200, 138, 1)",
                        "rgba(246, 194, 62, 1)",
                        "rgba(231, 74, 59, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(255, 159, 64, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(255, 99, 132, 1)",
                        "rgba(133, 135, 150, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(52, 58, 64, 1)"
                    ];

                    // Bar Chart Example
                    var ctx = document.getElementById("simple-bar-chart");
                    var myBarChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Total Attendance",
                                backgroundColor: barColors, // Use the array of colors
                                borderColor: barColors, // Use the array of colors for borders as well
                                data: attendanceData,
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 10,
                                    right: 25,
                                    top: 25,
                                    bottom: 0
                                }
                            },
                            scales: {
                                xAxes: [{
                                    gridLines: {
                                        display: true, // Hide x-axis gridlines
                                        drawBorder: true
                                    },
                                    ticks: {
                                        display: true // Show x-axis labels
                                    }
                                }],
                                yAxes: [{
                                    gridLines: {
                                        display: true, // Hide y-axis gridlines
                                        drawBorder: true
                                    },
                                    ticks: {
                                        display: true, // Hide y-axis labels and ticks
                                    }
                                }],
                            },
                            legend: {
                                display: false // Hide the legend
                            },
                            tooltips: {
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "#858796",
                                titleMarginBottom: 10,
                                titleFontColor: '#6e707e',
                                titleFontSize: 14,
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                intersect: false,
                                mode: 'index',
                                caretPadding: 10,
                                callbacks: {
                                    label: function(tooltipItem, chart) {
                                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                        return datasetLabel + ': ' + tooltipItem.yLabel;
                                    }
                                }
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Output error response to console (for debugging)
                    // Handle the error
                }
            });
        });
    </script>

<!--     <script>
    $(document).ready(function() {
        // Function to format numbers (if needed)
        function number_format(number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // AJAX request to fetch data from PHP script
        $.ajax({
            url: 'action/fetch_attendance_per_program.php', // Replace with the actual path to your PHP script
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Extracting labels and data from the response
                var labels = data.map(function(item) {
                    return item.program_code;
                });
                var attendanceData = data.map(function(item) {
                    return item.total_attendance;
                });

                // Define an array of colors for each section of the donut
                var donutColors = [
                    "rgba(78, 115, 223, 1)",
                    "rgba(54, 185, 204, 1)",
                    "rgba(28, 200, 138, 1)",
                    "rgba(246, 194, 62, 1)",
                    "rgba(231, 74, 59, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(255, 99, 132, 1)",
                    "rgba(133, 135, 150, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(52, 58, 64, 1)"
                ];

                // Donut Chart Example
                var ctx = document.getElementById("simple-donut-chart").getContext('2d');
                var myDonutChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: attendanceData,
                            backgroundColor: donutColors,
                            hoverBackgroundColor: donutColors,
                            hoverBorderColor: "rgba(234, 236, 244, 1)"
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        var datasetLabel = context.dataset.label || '';
                                        return datasetLabel + ': ' + number_format(context.raw);
                                    }
                                }
                            },
                            legend: {
                                display: true,
                                position: 'bottom',
                            }
                        },
                        cutout: '50%', // Adjust the thickness of the donut
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
                // Handle the error
            }
        });
    });
</script> -->

  </body>
</html>