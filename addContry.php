<?php
session_start();

echo "addContry";
?>
<nav>
<a href="index.php">index.php</a>
	
<form method="POST" action="insert.php">
	<div><input type="text" name="contry">contry</div>
	<div><input type="text" name="capital">capital</div>
	<div><input type="text" name="Alpha-2">Alpha-2 ISO 3166-1</div>
	<div><input type="submit" ></div>
</form>
