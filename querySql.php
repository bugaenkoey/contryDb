<?php
session_start();
$contry = "";
if(isset($_POST['contry'])){
$contry =" WHERE contry = '".$_POST['contry']."'";

}

$servername = "localhost";
$username = "contryes";
$password = "12345";
$dbname = "contryes";

$_SESSION["servername"]=$servername;
$_SESSION["username"]=$username;
$_SESSION["password"]=$password;
$_SESSION["dbname"]=$dbname;

// const SQL_SELECT = "SELECT * FROM contryes;";

$sqlQuery = "SELECT * FROM contryes ".$contry." Limit 20;";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
	die("<b style='color:red;'> NO conect </b>".$conn->connect_error);
}
echo "<b style='color:green;'> Conect OK </b>";

$_SESSION["connect"]= $conn;
$result = $_SESSION["connect"]->query($sqlQuery);
$array= $result->fetch_all(MYSQLI_ASSOC);
// $conn->close();
?>

 <nav>
     
    <a href="index.php">index.php</a>
	<a href="addContry.php">addContry</a>
	<a href="countrySearch.php">countrySearch</a>
</nav>

<table border="1" >
	<thead>
	<tr>
		<th colspan="2">&nbsp;</th>
		<th>id</th>
		<th>contry</th>
		<th>capital</th>
		<th>Alpha-2</th>
	</tr>
	</thead>
	<tbody>
		
	<?php 
	foreach ($array as  $value) {?> 
	<tr>
		
		<td><button>Edit</button></td>
		<td><button>Delete</button></td>
		<td><?php echo $value['id']; ?></td>
		<td><?php echo $value['contry']; ?></td>
		<td><?php echo $value['capital']; ?></td>
		<td><?php echo $value['Alpha-2']; ?></td>
			
	</tr>
		<?php } ?> 
	</tbody>
</table>
