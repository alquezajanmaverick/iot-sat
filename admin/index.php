<?php
	session_start();

	function checkSession() {
	    // Check if the 'user_id' session variable is not set
	    if (!isset($_SESSION['user_id'])) {
	        redirectToLogin("You must login first!");
	    }

	    // Check the role and redirect accordingly
	    if ($_SESSION['usertype'] == "1") {
	        // Redirect to admin dashboard
	        redirectTo("../admin/dashboard.php");
	    } elseif ($_SESSION['usertype'] == "2") {
	        // Redirect to faculty dashboard
	        redirectTo("../student/dashboard.php");
	    } else {
	        // Redirect to login page with an error message
	        redirectToLogin("You must login first!");
	    }
	}

	function redirectToLogin($errorMessage) {
	    $_SESSION['error'] = $errorMessage;
	    header("Location: ../login.php");
	    exit;
	}

	function redirectTo($location) {
	    header("Location: $location");
	    exit;
	}

	// Call the checkSession function to perform session validation
	checkSession();
?>
