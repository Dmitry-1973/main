<?php header('Content-type: text/html; charset=utf-8')?>
<?php
/*
echo $_POST['id']."\r\n";
echo '<br>';
echo $_POST['title']."\r\n";
echo '<br>';
echo $_POST['description']."\r\n";
echo '<br>';
echo $_POST['status']."\r\n";
echo '<br>';
*/
$server_name = 'localhost';
$mysql_user = 'srv101121_1';
$mysql_password = '101121';
$db = 'srv101121_tasks_db';
$table_name = 'tasks_table';
$link = mysqli_connect($server_name, $mysql_user, $mysql_password, $db);
if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
//    echo 'Соединение установлено успешно с базой данных '.$db;
}

$id = mysqli_real_escape_string($link, $_POST['id']);
$title = mysqli_real_escape_string($link, $_POST['title']);
$description = mysqli_real_escape_string($link, $_POST['description']);
$status = mysqli_real_escape_string($link, $_POST['status']);
/*
echo'<br>';
echo $id."\r\n";
echo'<br>';
echo $title."\r\n";
echo'<br>';
echo $description."\r\n";
echo'<br>';
echo $status."\r\n";
*/
$sql = "DELETE FROM ".$table_name." WHERE id = ".$id."";
    if (mysqli_query($link, $sql)) {
//        echo "Строка удалена.";
		header ('Location: index.php');
        exit;
    } else {
        echo "Ошибка: " . mysqli_error($link);
    }		

?>