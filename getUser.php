<?php
	require("genDB.php");
	require("sanitise.php");
	$userId = "";
	$name = "";
	
	if(isset ($_GET["id"])){
		$userId = sanitise_input($_GET["id"]);
	}else{
		echo "<p>Error: No user id given</p>";
		return;
	}

	if(isset ($_GET["fullname"])){
		$name = sanitise_input($_GET["fullname"]);
	}else{
		echo "<p>Error: No name given</p>";
		return;
	}
	
	$query = "SELECT * FROM users WHERE user_id = '$userId'";
	$results = db($query,false);
	echo $results;
	return;
	if($result == null){//No user was found, create a new user
		$query = "INSERT INTO users (user_id, fullname) VALUES ('$userId', '$name')";
		$result = db($query,true);

		$query = "INSERT INTO completed (user_id, badge) VALUES ('$userId',0)";
		$result = db($query,true);
	}

	ob_clean();
	echo json_encode($result);
?>