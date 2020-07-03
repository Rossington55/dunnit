<?php
	require("genDB.php");
	require("sanitise.php");
	$userId = "";
	
	if(isset ($_GET["id"])){
		$userId = sanitise_input($_GET["id"]);
	}else{
		echo "<p>Error: No user id given</p>";
		return;
	}
	
	$query = "SELECT badge FROM completed WHERE user_id = '$userId'";

	ob_clean();
	echo json_encode($result);
?>