<?php 
require './function/check_session.php';

// Call the checkSession function to perform session validation
checkSession();
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Admin Dashboard</title>
    <link rel="apple-touch-icon" href="../theme-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../theme-assets/images/ico/favicon.ico">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">

    <!-- Font Awesome Pro -->
    <!-- <link href="https://cdn.jsdelivr.net/gh/eliyantosarage/font-awesome-pro@main/fontawesome-pro-6.5.2-web/css/all.min.css" rel="stylesheet"> -->
    <script src="https://kit.fontawesome.com/a5fa2fa3ce.js" crossorigin="anonymous"></script>

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="../theme-assets/css/vendors.css">

    <!-- Chameleon CSS -->
    <link rel="stylesheet" type="text/css" href="../theme-assets/css/app-lite.css">
    <link rel="stylesheet" type="text/css" href="../theme-assets/css/custom.css">

    <!-- Page Level CSS -->
    <link rel="stylesheet" type="text/css" href="../theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../theme-assets/css/core/colors/palette-gradient.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="../theme-assets/bs-datepicker/css/bootstrap-datepicker3.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" integrity="sha256-h2Gkn+H33lnKlQTNntQyLXMWq7/9XI2rlPCsLsVcUBs=" crossorigin="anonymous">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js" integrity="sha256-+0Qf8IHMJWuYlZ2lQDBrF1+2aigIRZXEdSvegtELo2I=" crossorigin="anonymous"></script>
    <style>
        button.custom-csv-button {
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            border: none; /* No border */
            padding: 10px 20px; /* Padding */
            text-align: center; /* Centered text */
            text-decoration: none; /* No underline */
            display: inline-block; /* Inline-block */
            font-size: 12px; /* Font size */
            margin: 4px 2px; /* Margins */
            cursor: pointer; /* Pointer cursor */
            border-radius: 5px; /* Rounded corners */
        }

        button.custom-excel-button {
            background-color: #f44336; /* Red background */
            color: white; /* White text */
            border: none; /* No border */
            padding: 10px 20px; /* Padding */
            text-align: center; /* Centered text */
            text-decoration: none; /* No underline */
            display: inline-block; /* Inline-block */
            font-size: 12px; /* Font size */
            margin: 4px 2px; /* Margins */
            cursor: pointer; /* Pointer cursor */
            border-radius: 5px; /* Rounded corners */
        }
    </style>
</head>
