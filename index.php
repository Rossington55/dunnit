<?php
require("settings.php");
$query = "SELECT * FROM test";
$result = db($query,false);

echo $result;
?>