<html>
<body>
<?php
	session_start();
// 1. Gather form data

// Initialize the parallel arrays in the session if they don't exist yet
if (!isset($_SESSION['arr_dates'])) { 
    $_SESSION['arr_dates']     	= array();
    $_SESSION['arr_counties']  	= array();
    $_SESSION['arr_states']   	= array();
    $_SESSION['arr_sizes'] 		= array();
    $_SESSION['arr_incomes']    = array();
}

// When the form is submitted, push the new data into the parallel arrays
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Process string manipulation
    $rawLocation   = $_POST["county-state"];
    $locationParts = explode("-", $rawLocation);
    
    // 2. Add each piece of data to its matching index across the arrays
    $_SESSION['arr_dates'][]    	= $_POST["census-date"];
    $_SESSION['arr_counties'][]  	= $locationParts[0];   // Counties
    $_SESSION['arr_states'][]    	= $locationParts[1];   // State
    $_SESSION['arr_sizes'][] 		= (int)$_POST["household-number"];
    $_SESSION['arr_incomes'][]    	= (float)$_POST["household-income"];
	
    header("Location: index.html");
    exit();	
}
?>

</body>
</html>