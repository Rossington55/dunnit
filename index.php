<?php
require("genDB.php");
$query = "SELECT * FROM test";
$result = db($query,false);
echo json_encode($result);
?>