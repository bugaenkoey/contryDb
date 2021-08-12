<?php
session_start();

echo "addContry \n";
?>
<nav>
<a href="index.php">index.php</a>
	
<!-- <form method="POST" action="insert.php"> -->
<form method="POST" action="querySql.php">
	<div><input type="text" name="contry">contry</div>
	<div><input type="text" name="capital">capital</div>
	<div><input type="text" name="Alpha-2">Alpha-2 ISO 3166-1</div>
	<input type="hidden" name="insert" value="" />
	<div><input type="submit" ></div>
</form>
<!-- 
	if (isset($_REQUEST["insert"])) {
    $sqlStmt = $db->prepare(SQL_INSERT);
    $sqlStmt->execute($_REQUEST["data"]);
 -->