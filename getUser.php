<?php
	require("genDB.php");
	require("sanitise.php");
	$userId = "";
	
	if(isset ($_GET["id"])){
		$userId = sanitise_input($_GET["id"]);
		echo "<p>$userId</p>";
	}else{
		echo "<p>Error: No user id given</p>";
	}
	

	$query = "SELECT * FROM users WHERE user_id = '$userId''";
	$result = db($query,false);

	if($result == null){
		echo "<p>$result</p>";
		$query = "INSERT INTO users (user_id) VALUES ($userId)";
		$result = db($query,true);
	}

	echo json_encode($result);
?>