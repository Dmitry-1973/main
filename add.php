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
$query = 'SELECT * FROM '.$table_name;
$result = mysqli_query($link, $query); 
$row_cnt = mysqli_num_rows($result);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
//echo 'таблица '.$table_name.' содержит строк: '.$row_cnt;
//echo ('<br>'. "\r\n");
//print_r ($rows);
$id = $rows[$row_cnt - 1]["id"];
//echo'id последней строки:  '.$id.' ';
$id++;



$title = mysqli_real_escape_string($link, $_POST['title']);
$description = mysqli_real_escape_string($link, $_POST['description']);
$status = mysqli_real_escape_string($link, $_POST['status']);
$sql = "INSERT INTO ".$table_name." (id, title, description, status) VALUES ('$id', '$title', '$description', '$status')";
if (mysqli_query($link, $sql)) {
//    echo "Новая строка успешно добавлена. ID: " . mysqli_insert_id($link);
} else {
    echo "Ошибка: " . $sql . "<br>" . mysqli_error($link);
}
header("Location: index.php");
exit;
?>
