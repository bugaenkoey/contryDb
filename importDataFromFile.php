<?php
echo 'импортировать данные из файла ';
$dataFile ='contry.txt';

if(file_exists($dataFile)){
$data = file($dataFile);
//  print_r $data;
echo " YES";
// echo $data;
foreach ($data as $line) {
    echo "<br/>" .$line. "\n";
}
}
else echo " NO";





?>
<!-- 
    $usersFile ='foo/usersFile.txt';
		function readNames($usersFile){return file($usersFile);};
		$names= readNames($usersFile);
		// var_dump($names);
 -->