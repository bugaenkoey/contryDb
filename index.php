<!-- 1. Необходимо создать страницу ,которая содержит 2 формы. 
1-я для поиска стран. 2-я для добавления новой страны.
2. Каждую форму должен обрабатывать отдельный php-скрипт. 
Уже введенные данные в форму необходимо сохранять в сессии
 либо с cookie, чтобы при обновлении страницы эти 
предыдущие значения оставались в полях для ввода.
3. Для хранения стран создать базу данных и в ней соотв. таблицу. 
4. Создать php-скрипт, который берет список стран из текстового файла, 
структуру файла продумать самостоятельно. (дополнительно) -->



<?php
session_start();
$contry = "";
$array = array();
$fileName = "dataSql.txt";
$selectCol = "*";

$servername = "localhost";
$username = "contryes";
$password = "12345";
$dbname = "contryes";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("<b style='color:red;'> NO conect </b>"
        . $conn->connect_error);
}
echo "<b style='color:green;'> Conect OK </b>";

createTable($conn);

if (isset($_REQUEST["insert"])) {
    insertPost($conn);
    $contry   = " WHERE contry = '" . $_POST['contry'] . "'";
    $array = select($conn);
} elseif (isset($_REQUEST["search"])) {
    $contry   = " WHERE contry = '" . $_POST['contry'] . "'";
    $array = select($conn);
} elseif (isset($_REQUEST["load"])) {
    load($conn);
} elseif (isset($_REQUEST["save"])) {
    save($conn);
} else {
    $array = select($conn);
}

function createTable($conn)
{

    $tablecontryes = "CREATE TABLE `contryes` (
        `contry` varchar(60) NOT NULL,
        `capital` varchar(168),
        `Alpha-2` varchar(2),
        PRIMARY KEY (`contry`)
        );";

    $result = $conn->query($tablecontryes);
}

function insertPost($conn)
{
    $result = $conn->query("INSERT INTO contryes (
        contry, 
        capital,
        `Alpha-2`) VALUES (
            '" . $_POST["contry"] . "',
            '" . $_POST["capital"] . "',
            '" . $_POST["Alpha-2"] . "' 
        );");
}



function select($conn)
{
    global $contry;
    global $selectCol;
    // $sqlQuery = "SELECT * FROM contryes ;";
    $sqlQuery = "SELECT " . $selectCol . " FROM contryes " . $contry . ";";
    $result   = $conn->query($sqlQuery);
    $array    = $result->fetch_all(MYSQLI_ASSOC);
    return $array;
}

function load($conn)
{
    global $fileName;
    $stringData = file_get_contents($fileName);

    $arrayData = explode("\n", $stringData);
    $arrayData2 = array();
    foreach ($arrayData as $item) {
        $arrayColum = explode(",", $item);
        array_push($arrayData2, $arrayColum);
    }

    $loadDataInFile = " INSERT IGNORE INTO `contryes` SET";

    foreach ($arrayData2 as $row) {
        $insertIgnore =  $loadDataInFile .
            " `contry` = '" . $row[0] .
            "', `capital` = '" . $row[1] .
            "', `Alpha-2` = '" . $row[2] . "';";
        $result = $conn->query($insertIgnore);
    }
    echo "<b style='color:green;'> Load OK </b>";
}

function save($conn)
{
    // $sqlQuery = "SELECT 
    // contry, 
    // capital,
    // `Alpha-2` FROM contryes ;";
    // $result   = $conn->query($sqlQuery);
    // $array    = $result->fetch_all(MYSQLI_ASSOC);
    global $contry;
    $contry = "";
    $array = select($conn);
    $data = "";
    foreach ($array as $item) {
        foreach ($item as $word) {
            $data = $data . $word . ",";
        }
        $data = substr($data, 0, -1); //remove separator in end
        $data = $data . "\n";
    }
    $data = substr($data, 0, -1); //remove empty array in end
    // echo $data;
    global $fileName;
    file_put_contents($fileName, $data);
    echo "<b style='color:green;'> SAVE OK </b>";
}
?>

<nav>

    <a href="index.php">index.php</a>&nbsp;&nbsp;
    <a href="addContry.php">addContry</a>&nbsp;&nbsp;
    <a href="searchCountry.php">searchCountry</a>&nbsp;&nbsp;
    <a href="index.php?load=1">load</a>&nbsp;&nbsp;
    <a href="index.php?save=1">save</a>&nbsp;&nbsp;

</nav>

<table border="1">
    <thead>
        <tr>
            <!-- <th colspan="2">&nbsp;</th> -->
            <!-- <th>id</th> -->
            <th>contry</th>
            <th>capital</th>
            <th>Alpha-2</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($array as  $value) :  ?>
            <tr>
                <!-- <td><button>Edit</button></td>
                <td><button>Delete</button></td> -->
                <!-- <td><?php /*echo $value['id']; */ ?></td> -->
                <td><?php echo $value['contry']; ?></td>
                <td><?php echo $value['capital']; ?></td>
                <td><?php echo $value['Alpha-2']; ?></td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>