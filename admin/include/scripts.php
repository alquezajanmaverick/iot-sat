    <!-- BEGIN VENDOR JS-->
    <script src="../theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="../theme-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN CHAMELEON  JS-->
    <script src="../theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
    <script src="../theme-assets/js/core/app-lite.js" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->

    <!-- BEGIN PAGE LEVEL JS-->
<!-- <script src="../theme-assets/js/scripts/charts/chartjs/bar/column.js" type="text/javascript"></script>
    <script src="../theme-assets/js/scripts/charts/chartjs/bar/bar.js" type="text/javascript"></script>
    <script src="../theme-assets/js/scripts/charts/chartjs/line/line.js" type="text/javascript"></script>
    <script src="../theme-assets/js/scripts/charts/chartjs/pie-doughnut/pie-simple.js" type="text/javascript"></script>
    <script src="../theme-assets/js/scripts/charts/chartjs/pie-doughnut/doughnut-simple.js" type="text/javascript"></script> -->
    <!-- END PAGE LEVEL JS-->
    
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.1/js/responsive.bootstrap4.js"></script>

<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<!-- DataTables Buttons extension -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>


<script src="../theme-assets/js/dayjs.min.js"></script>
<script src="../theme-assets/bs-datepicker/js/bootstrap-datepicker.min.js"></script>

    <script>
    // Wait for the document to be ready
    $(document).ready(function() {
        // Get the ID of the current page
        var currentPage = $('div[id]').attr('id');

        // Add the .active class to the corresponding navigation item
        $('#main-menu-navigation').find('a[href="' + currentPage + '.php"]').closest('li').addClass('active');
    });
    </script>
    <script>
        $(document).ready(function(){
            $("#logoutBtn").click(function(e){
                e.preventDefault(); // Prevent default action of the link

                $.ajax({
                    url: "../function/logout_action.php",
                    type: "POST",
                    success: function(response){
                        // Show SweetAlert2 notification with confirm button
                        Swal.fire({
                            icon: 'success',
                            title: 'Logout Successful',
                            text: 'You have been logged out successfully!',
                            showCancelButton: false,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to login page after clicking "OK"
                                window.location.href = "../login.php";
                            }
                        });
                        // Redirect to login page after successful logout
                        setTimeout(function(){
                        window.location.href = "../login.php";
                        }, 1500); // Redirect after 1.5 seconds
                    },
                    error: function(xhr, status, error){
                        // Handle error if any
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>