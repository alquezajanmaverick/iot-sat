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
                              <h4 class="card-title">List of Attendance</h4>
                              <a class="heading-elements-toggle"><i class="fa-solid fa-ellipsis-vertical font-medium-3"></i></a>
                              <div class="heading-elements">
                                  <ul class="list-inline mb-0">
                                      <li><a data-action="collapse"><i class="fa-solid fa-minus"></i></a></li>
                                      <li><a data-action="reload"><i class="fa-solid fa-rotate"></i></a></li>
                                      <li><a data-action="expand"><i class="fa-solid fa-expand"></i></a></li>
                                      <!-- <li><a data-action="close"><i class="fa-solid fa-x"></i></a></li> -->
                                  </ul>
                              </div>
                               
                          </div>
                          <div class="card-content collapse show">
                              <div class="card-body">
                                <!-- <div class="row float-left mb-2">
                                    <div class="col pl-2 pr-0">
                                        <select id="week" style="max-width:8rem;" class="form-control-sm form-select form-select-sm px-2" aria-label="Small select example">
                                            <option selected disabled>WEEK</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                            <option value="4">Four</option>
                                        </select>
                                    </div>
                                    <div class="col px-0" style="margin-left:0.8rem">
                                        <select id="month" style="max-width:8rem;" class="form-control-sm form-select form-select-sm px-2" aria-label="Small select example">
                                            <option selected disabled>MONTH</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="col px-0" style="margin-left:0.8rem;">
                                        <select style="width:7rem;" class="form-control-sm form-select form-select-sm px-2" aria-label="Small select example" id="minmaxyear">
                                            <option selected disabled>YEAR</option>
                                        </select>
                                    </div>
                                    <div class="col px-0 d-flex" style="margin-left:0.8rem;">
                                       <button id="triggerFilter" type="button" class="btn-sm btn-primary">FILTER</button>
                                       <button id="disableTriggerFilter" type="button" class="btn-sm btn-danger" style="margin-left:0.5rem"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 32 32"><path fill="currentColor" d="M22.448 21A10.86 10.86 0 0 0 25 14A10.99 10.99 0 0 0 6 6.466V2H4v8h8V8H7.332a8.977 8.977 0 1 1-2.1 8h-2.04A11.01 11.01 0 0 0 14 25a10.86 10.86 0 0 0 7-2.552L28.586 30L30 28.586Z"/></svg></button>
                                    </div>
                                </div> -->
                                  
                                <div class="float-right mb-2">
                                    <label for="dtp" class="form-label">Attendance Date:</label>
                                    <div class="d-flex">
                                        <input type="text" id="dtp" class="form-control datepicker">
                                        <button type="button" id="resetFilterbtn" class="btn-sm btn-danger ml-1">RESET</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                      <table class="table table-hover display nowrap table-bordered table-striped" id="myTable" width="100%" cellspacing="0">
                                        <thead class="bg-dark text-white">
                                            <tr>
                                                <th scope="col" class="d-none">#</th>
                                                <th scope="col">Acad Year & Sem</th>
                                                <th scope="col">Card ID</th>
                                                <th scope="col">Name</th>
                                                <!-- <th scope="col">Class</th> -->
                                                <th scope="col">Type</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
    $(document).ready(function () {
        var lastFetchId = null;
        var dataTableInitialized = false;
        var dataTable;
        var filtered = false;
        var baseDate = dayjs().format('YYYY-MM-DD')
        var container=$('.card-content').length>0 ? $('.card-content').parent() : "body";

        let dtpckr =  $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            container:container,
            todayHighlight: true,
            autoclose: true,
            orientation: 'left'
        });
        dtpckr.on('changeDate', function(e) {
            baseDate = dayjs(e.date).format('YYYY-MM-DD')
            filter = true
            fetchData(filter)
        });
        $('#disableDatePicker').on('click',function(e){
            filtered=false
            fetchData(filtered)
        })
        $('#resetFilterbtn').on('click',function(e){
            dtpckr.datepicker('setDate',null)
            filtered = false;
            fetchData(filtered)
        })
        
        $('#triggerFilter').on('click',function(e){
            filtered=true
            fetchData(filtered)
        })
        $('#disableTriggerFilter').on('click',function(e){
            filtered=false
            fetchData(filtered)
        })

        function initializeDataTable() {
            dataTable = $('#myTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
                "info": true,
                "scrollCollapse": true,
                "scrollX": true,
                "order": [[0, 'desc']], // Reverse order by the first column (assuming it contains the UID or a similar identifier)
                "columnDefs": [
                    { "visible": false, "targets": [0] } // Hide the first column (attendance_id)
                ],
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'csvHtml5',
                        className: 'custom-csv-button',
                        filename: 'Attendance_CSV'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'custom-excel-button',
                        filename: 'Attendance_Excel'
                    }
                ]
            });
        }

        const getMinMaxYear = () =>{
            let res = {}
            $.ajax({
                url:'action/fetch_attendance_minmax_year.php',
                type:'GET',
                dataType:'json',
                success:function(response){
                    if (response.length > 0) {
                        res = response[0]
                        let MIN = Number(res.MINYEAR)
                        let MAX = Number(res.MAXYEAR)
                        let diff = MAX - MIN
                        if(diff > 0 ){
                            for(let x = MIN;x <= (MIN + diff);x++){
                                $('#minmaxyear').append(`<option value="${x}">${x}</option>`)
                            }
                        }else{
                            $('#minmaxyear').append(`<option value="${MIN}">${MIN}</option>`)
                        }
                    }
                }
            })
        }
        
        getMinMaxYear()

        function fetchData(f = false) {
            $.ajax({
                url: 'action/fetch_attendance.php'+ (f == true ? `?date=${baseDate}` : ''),
                type: 'GET',
                // data: {
                //     last_fetch_id: lastFetchId
                // },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        lastFetchId = response[0].attendance_id;
                    }
                        renderTable(response);
                },
                complete: function () {
                    //setTimeout(fetchData(filtered), 300); // Fetch data every 3 seconds ---- 
                    //( this is 300 milliseconds , not 3 seconds and has wrong implementation of setTimeout LOL)
                    // kawawa server sau XD

                    // setTimeout(()=>fetchData(filtered), 3000); // THIS is Fetching data every 3 seconds
                }
            });
        }

        function renderTable(data) {
            console.log(data)
            if (!dataTableInitialized) {
                initializeDataTable();
                dataTableInitialized = true;
            }
            dataTable.rows().clear().draw()

            // Loop through the data and add rows to the table
            for (var i = 0; i < data.length; i++) {
                var row = data[i];
                var typeBadge = row.type == 1 ? '<span class="badge badge-primary badge-pill font-weight-bold">IN</span>' : '<span class="badge badge-danger badge-pill font-weight-bold">OUT</span>';
                var date = new Date(row.date_time);
                var formattedDate = date.toLocaleString();

                // Check if the row is already present in the table
                var existingRow = dataTable.row('#' + row.attendance_id);
                if (!existingRow.length) {
                    // Add new row at the top of the table
                    var newRow = [
                        row.attendance_id,
                        row.acadyearsem,
                        row.uid,
                        row.name,
                        // row.class,
                        typeBadge,
                        formattedDate
                    ];

                    // Insert the new row at the top of the table
                    dataTable.row.add(newRow, 0).draw(false);
                }
            }
        }
        fetchData(filtered); // Start fetching data
    });
</script>

  </body>
</html>