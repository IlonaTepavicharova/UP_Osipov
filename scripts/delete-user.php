<?php
// подключение к серверу 
require("connect.php");
require("authorize.php"); 
$user_id = $_REQUEST['user_id'];
// создание sql инструкции на удаление записи таблицы images 
$delete_images_sql = sprintf("DELETE FROM `images` WHERE `user_id` 
= %d", $user_id);
// выполнение запроса 
$res = $mysqli->query($delete_images_sql);
// если запрос на удаление удачен 
// переходим к удалению записи таблицы users 
if ($res) {
    $delete_users_sql = sprintf("DELETE FROM `users` WHERE `user_id` 
= %d", $user_id);
    $res = $mysqli->query($delete_users_sql);
    if ($res) {
        // возвращаем пользователя к исходному сценарию 
        $msg = "Указанный пользователь был удален";
        header("Location: show-users.php?msg=$msg");
    } else {
        header("Location: show-error.php?error_message=Ошибка 
удаления выбранного пользователя&system_error_message=" .
            $mysqli->error);
    }
} else {
    header("Location: show-error.php?error_message=Ошибка удаления 
изображения пользователя&system_error_message=" . $mysqli->error);
}
exit;