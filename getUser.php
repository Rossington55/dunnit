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
	

	$query = "SELECT badge FROM users WHERE user_id = '$userId'";
	$result = db($query,false);

	if($result == null){//No user was found, create a new user
		$query = "INSERT INTO users (user_id, badge) VALUES ('$userId', 0)";
		$result = db($query,true);

		$query = "SELECT badge FROM users WHERE id = $result";
		$result = db($query,false);
	}

	ob_clean();
	echo json_encode($result);
?>