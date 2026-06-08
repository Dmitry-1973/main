<?php header('Content-type: text/html; charset=utf-8')?>

<!DOCTYPE html>
<html lang="ru">
<head>
<title>Тестовое задание</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

-----------------------------------------------------<br>
В GitHub работать не будет.<br>
Работает здесь: https://1-bag.ru/tasks_host.php
<br>
-----------------------------------------------------<br>

<?php
// Соединение с сервером базы данных ----------------
$server_name = 'localhost';
$mysql_user = 'srv101121_1';
$mysql_password = '101121';
$db = 'srv101121_tasks_db';
$link = mysqli_connect($server_name, $mysql_user, $mysql_password);

if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
//    print("Соединение установлено успешно");
}
mysqli_set_charset($link, "utf8mb4");
echo ('<br>'. "\r\n");
echo ('<br>'. "\r\n");
//---------------------------------------------------


// Создание базы данных  srv101121_tasks_db ---------
/*
$sql = "CREATE DATABASE srv101121_tasks_db";
if (mysqli_query($link, $sql)) {
    echo 'База данных '.$db.' создана успешно';
} else {
    echo 'Ошибка содания базы '.$db.': ' . mysqli_error($link);
}
echo ('<br>'. "\r\n");
echo ('<br>'. "\r\n");
*/


//Создание таблицы tasks_table в базе данных srv101121_tasks_db ------/
/*
mysqli_select_db($link, $db);
$sql = "CREATE TABLE tasks_table (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(30) NOT NULL,
description VARCHAR(20) NOT NULL,
status VARCHAR(30) NOT NULL)"; 
if (mysqli_query($link, $sql)) {
    echo "Таблица tasks_table в базе данных srv101121_tasks_db создана успешно";
} else {
    echo "Ошибка содания таблицы tasks_table в базе данных tasks_db: " . mysqli_error($link);
}
echo ('<br>'. "\r\n");
echo ('<br>'. "\r\n");
*/
//----------------------------------------------------------


// Список всех таблиц в базе данных srv101121_tasks_db -------------
/*
$result = mysqli_query($link, 'SHOW TABLES FROM '.$db.'');
if($result != false)
  {	
    echo "Список таблиц в базе данных srv101121_tasks_db:"."<br>\r\n";
	foreach($result as $row) 
     {
      echo implode('', $row). "<br>\r\n";
     }
  }
*/
//----------------------------------------------------------


//Добавление строки в таблицу tasks_table в базе данных srv101121_tasks_db ------
/*
for ($i=0; $i<6; $i++)
{
$id = $i;	
$title = 'task_'.$i;
$description = 'Description of task '.$i;
$status = 'Created';
              // Экранирование данных для безопасности (защита от SQL-инъекций)
$id = mysqli_real_escape_string($link, $id);			  
$title = mysqli_real_escape_string($link, $title);
$description = mysqli_real_escape_string($link, $description);
$status = mysqli_real_escape_string($link, $status);

$sql = "INSERT INTO tasks_table (id, title, description, status) VALUES ('$id', '$title', '$description', '$status')";
if (mysqli_query($link, $sql)) {
//    echo "Новая запись успешно добавлена";
//    // Получить ID последней добавленной записи
    echo " ID: " . mysqli_insert_id($link);
} else {
    echo "Ошибка: " . $sql . "<br>" . mysqli_error($link);
}
}
*/
//------------------------------------------------------------------------------

//Получение массива таблицы tasks_table базы данных srv101121_tasks_db ------
$table_name = 'tasks_table';
$link = mysqli_connect($server_name, $mysql_user, $mysql_password, $db);
if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
//    echo 'Соединение установлено успешно с таблицей '.$table_name.' базы данных '.$db;
}
echo ('<br>'. "\r\n");
$query = 'SELECT * FROM '.$table_name;
$result = mysqli_query($link, $query); 
$row_cnt = mysqli_num_rows($result);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
//echo 'таблица '.$table_name.' содержит строк: '.$row_cnt;
echo ('<br>'. "\r\n");
//print_r ($rows);
//-------------------------------------------------------------------------------


//Удаление таблицы ---------------------------------------------
/*
$sql = 'DROP TABLE IF EXISTS '.$table_name;
if (mysqli_query($link, $sql)) {
    echo "Таблица $table_name успешно удалена или ее не существовало.";
} else {
    echo "Ошибка при удалении таблицы: " . mysqli_error($link);
}
*/
//--------------------------------------------------------------
?>
<header>
<h1>Тестовое задание</h1>
</header>

<div id="main_title">Список задач / Обновление задач</div>
<div id="main_title_2">Редактирование задачи / Удаление задачи</div>
<div id="main_title_3">Добавление задачи</div>
<div id="main">
<div id="buttons_1">
<button onclick="document.location='index.php'">обновить задачи</button>
<button onclick="changevision_2();">добавить задачу</button>
</div>

<?php   
for ($i=0; $i<$row_cnt; $i++)
{
  echo'	
   <div class="task">
   <div class="vision">id: <div class="inform">'.$rows[$i]["id"].'</div></div>
   title: <div class="inform">'.$rows[$i]["title"].'</div>
   description: <div class="inform">'.$rows[$i]["description"].'</div>
   status: <div class="inform">'.$rows[$i]["status"].'</div>
   <button onclick="changevision('.$rows[$i]["id"].');">редактировать</button>
   </div>';
}	
	
?>
<div id="buttons_2">
<button onclick="document.location='index.php'">обновить задачи</button>
<button onclick="changevision_2();">добавить задачу</button>
</div>

</div>


<?php   
for ($i=0; $i<$row_cnt; $i++)
{
  echo'
   <div>
   <form method="post" id="'.$rows[$i]["id"].'" action="edit.php" class="nonvision">
   <div class="task">
   <div class="vision">id: <div class="inform">'.$rows[$i]["id"].'</div></div>
   <input type="hidden" name="id" value="'.$rows[$i]["id"].'" required>
   <label>title:</label>
   <input type="text" name="title" value="'.$rows[$i]["title"].'" required>
   <label>description:</label>
   <input type="text" name="description" value="'.$rows[$i]["description"].'" required>
   <label>status:</label>
   <input type="text" name="status" value="'.$rows[$i]["status"].'" required>
   <button type="submit">сохранить</button>
   <button type="submit" formaction="delete.php">удалить</button>
   <button onclick="event.preventDefault(); document.location=\'index.php\'">отмена</button>
   </div>
   </form>
   </div>';

}
?>

<?php   
echo'
   <div id="add_task" class="nonvision">
   <form method="post" action="/add.php">
   <div class="task">
   <label>title:</label>
   <input type="text" name="title" placeholder="Заголовок задачи" required>
   <label>description:</label>
   <input type="text" name="description" placeholder="Описание задачи" required>
   <label>status:</label>
   <input type="text" name="status" placeholder="Статус задачи" required>
   <button type="submit">добавить</button>
   <button onclick="event.preventDefault(); document.location=\'index.php\'">отмена</button>
   </div>
   </form>
   </div>';
?>

<br><br>
<script>
function changevision(id)
{
  document.getElementById(id).style.display = 'inline';
  document.getElementById('main').style.display = 'none';
  document.getElementById('main_title').style.display = 'none';
  document.getElementById('add_task').style.display = 'none';
  document.getElementById('main_title_2').style.display = 'inline';
}
function changevision_2()
{
  document.getElementById('main').style.display = 'none';
  document.getElementById('main_title').style.display = 'none';
  document.getElementById('main_title_2').style.display = 'none';
  document.getElementById('main_title_3').style.display = 'inline';
  document.getElementById('add_task').style.display = 'inline';
}	
</script>

</body>
</html>
