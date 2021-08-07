<?php
session_start();

$servername = "localhost";
$username = "contryes";
$password = "12345";
$dbname = "contryes";

$_SESSION["servername"]=$servername;
$_SESSION["username"]=$username;
$_SESSION["password"]=$password;
$_SESSION["dbname"]=$dbname;

const SQL_SELECT = "SELECT * FROM contryes";

$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error){
	die("<b style='color:red;'> NO conect </b>".$conn->connect_error);
}
echo "<b style='color:green;'> Conect OK </b>";

$_SESSION['connect']= $conn;

 $sqlQuery = SQL_SELECT;
 if($result= $conn->query($sqlQuery)){
	$array= $result->fetch_all(MYSQLI_ASSOC);
}
$conn->close();
?>
<!-- 1. Необходимо создать страницу ,которая содержит 2 формы. 
1-я для поиска стран. 2-я для добавления новой страны.
2. Каждую форму должен обрабатывать отдельный php-скрипт. 
Уже введенные данные в форму необходимо сохранять в сессии
 либо с cookie, чтобы при обновлении страницы эти 
предыдущие значения оставались в полях для ввода.
3. Для хранения стран создать базу данных и в ней соотв. таблицу. 
4. Создать php-скрипт, который берет список стран из текстового файла, 
структуру файла продумать самостоятельно. (дополнительно) -->
 <nav>
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
	// $arrayName = array("one","two");
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
