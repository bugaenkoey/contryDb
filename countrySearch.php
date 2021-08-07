<?php
echo "countrySearch";

?>
<nav>
<a href="index.php">index.php</a>
</nav>
<form method="POST" action="countrySearch.php">
	<div><input type="text" name="countrySearch" value="name country search">input name country search</div>
	<div><input type="submit" ></div>
</form>

<?php
var_dump($_POST);
?>