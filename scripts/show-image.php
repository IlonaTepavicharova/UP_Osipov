<?php
// укажем содержимое какого типа поступит браузеру  
// header("Content-type: image/jpeg"); 
// подключение к серверу 
require("connect.php");
// проверка наличия параметра user_id 
if (!isset($_REQUEST["user_id"])) {
    header("Location: show-error.php?error_message=Не указано 
изображение для загрузки&system_error_message=Файл show-user.php 
не передает ID пользователя для загрузки");
    exit;
}
;
$user_id = $_REQUEST["user_id"];
// создание инструкции select 
$select_image = sprintf("SELECT * FROM `images` WHERE  `user_id` = 
%d", $user_id);
// выполнение запроса 
$res = $mysqli->query($select_image);
$row = $res->fetch_array();
// информация о mime типе файла хранится в таблице image 
header("Content-type: " . $row["mime_type"]);
echo $row["image_data"];