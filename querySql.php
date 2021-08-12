<?php
session_start();
$contry = "";
$array =array();
// if(isset($_POST['contry'])){


// }

$servername = "localhost";
$username = "contryes";
$password = "12345";
$dbname = "contryes";


// $_SESSION["servername"]=$servername;
// $_SESSION["username"]=$username;
// $_SESSION["password"]=$password;
// $_SESSION["dbname"]=$dbname;

// const SQL_SELECT = "SELECT * FROM contryes;";



$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
	die("<b style='color:red;'> NO conect </b>".$conn->connect_error);
}
echo "<b style='color:green;'> Conect OK </b>";

// $_SESSION["connect"] = $conn;
// $result = $_SESSION["connect"]->query($sqlQuery);


// -----------------------------

if (isset($_REQUEST["insert"])) {
    echo "\n insert \n";
    
    $result = $conn -> query("INSERT INTO contryes (
        id, 
        contry, 
        capital,
        `Alpha-2`) VALUES (
            NULL,
            '".$_POST["contry"]."',
            '".$_POST["capital"]."',
            '".$_POST["Alpha-2"]."' 
        );");
        $contry   = " WHERE contry = '".$_POST['contry']."'";
        $sqlQuery = "SELECT * FROM contryes ".$contry.";";
        $result   = $conn   -> query($sqlQuery);
        $array    = $result -> fetch_all(MYSQLI_ASSOC);
        
    } elseif (isset($_REQUEST["search"])) {
        echo "\n search \n";
        $contry   = " WHERE contry = '".$_POST['contry']."'";
        $sqlQuery = "SELECT * FROM contryes ".$contry.";";
        $result   = $conn   -> query($sqlQuery);
        $array    = $result -> fetch_all(MYSQLI_ASSOC);

    } elseif (isset($_REQUEST["all"])) {
        echo "\n all \n";
    } elseif (isset($_REQUEST["load"])) {
        echo "\n load \n";
    } elseif (isset($_REQUEST["save"])) {
        echo "\n save \n";
        // $sqlQuery = "SELECT * FROM contryes ;";
        // $result   = $conn   -> query($sqlQuery);
        // $array    = $result -> fetch_all(MYSQLI_ASSOC);
        $array = select($conn);
        save($array);
    } else {
        echo "\n requesr - free \n";
        // $sqlQuery = "SELECT * FROM contryes ;";
        // $result   = $conn   -> query($sqlQuery);
        // $array    = $result -> fetch_all(MYSQLI_ASSOC);

        $array = select($conn);
    }
    // $sqlQuery = "SELECT * FROM contryes ;";
    // $result   = $conn   -> query($sqlQuery);
    // $array    = $result -> fetch_all(MYSQLI_ASSOC);
function select($conn){
    $sqlQuery = "SELECT * FROM contryes ;";
    $result   = $conn   -> query($sqlQuery);
    $array    = $result -> fetch_all(MYSQLI_ASSOC); 
    return $array; 
}
// $conn->close();

function save($array)
{
echo "<div>isset array save</div>";
$data="";
    foreach ($array as $item) {
    // echo $value['contry'];
   
        foreach($item as $value){
            // echo $value;
            $data =$data.$value.",";
        }
        $data =$data."\n";
        
    }
    file_put_contents("dataSql.txt",$data); 
// echo $data;
echo"<b style='color:green;'> SAVE OK </b>";
}
// var_dump $array;


?>

 <nav>
     
    <a href="index.php">index.php</a>&nbsp;&nbsp;
	<a href="addContry.php">addContry</a>&nbsp;&nbsp;
	<a href="countrySearch.php">countrySearch</a>&nbsp;&nbsp;
	<a href="index.php?load=1">load</a>&nbsp;&nbsp;
    <a href="index.php?save=1">save</a>&nbsp;&nbsp;

</nav>
<!-- <div>
<button type="button" >Save</button>
</div> -->

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