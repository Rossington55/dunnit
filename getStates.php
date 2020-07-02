<?php
	require("genDB.php");
	require("sanitise.php");
	$query = "SELECT * FROM states";
	$result = db($query,false);

	ob_clean();
	echo json_encode($result);
?>