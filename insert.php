<?php 
session_start();

$servername = $_SESSION["servername"];
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$dbname = $_SESSION["dbname"];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
	die("<b style='color:red;'> NO conect </b>".$conn->connect_error);
}
echo "<b style='color:green;'> Conect OK </b>";


$result= $conn->query("INSERT INTO contryes (
    id, 
    contry, 
    capital,
    `Alpha-2`) VALUES (
        NULL,
        '".$_POST["contry"]."',
        '".$_POST["capital"]."',
        '".$_POST["Alpha-2"]."' 
    );");
    include_once "index.php";
?>
<!-- 
INSERT INTO `contryes` 
    (
    `id`, 
    `contry`, 
    `capital`,
    `Alpha-2`
    ) 
    VALUES 
        (
        NULL, 
        'Великобритания', 
        'Лондон', 
        'GB'
        ), 
        (
        NULL, 
        'Германия', 
        'Берлин', 
        'DE'
        );  

 -->