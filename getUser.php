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
	

	$query = "SELECT * FROM users WHERE user_id = $userId";
	$result = db($query,false);

	if($result == null){
		$query = "INSERT INTO users (user_id) VALUES ($userId)";
		$result = db($query,true);

		$query = "SELECT * FROM users WHERE id = $result";
		$result = db($query,false);
	}

	ob_clean();
	echo json_encode($result);
?>