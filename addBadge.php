<?php
	require("genDB.php");
	require("sanitise.php");
	$userId = "";
	$badge = 0;
	
	if(isset ($_GET["id"])){
		$userId = sanitise_input($_GET["id"]);
	}else{
		echo "<p>Error: No user id given</p>";
		return;
	}

	if(isset ($_GET["badge"])){
		$badge = sanitise_input($_GET["badge"]);
	}else{
		echo "<p>Error: No badge given</p>";
		return;
	}
	
	$query = "SELECT * FROM users WHERE user_id = '$userId' AND badge=$badge";
	$result = db($query,false);
	if($result != null){
		ob_clean();
		return false;
	}
	
	$query = "INSERT INTO users (user_id, badge) VALUES ('$userId',$badge)";
	$result = db($query,true);

	if(!$result){
		ob_clean();
		return;
	}

	$query = "SELECT badge FROM users WHERE user_id = '$userId'";
	$result = db($query,false);

	ob_clean();
	echo json_encode($result);
?>