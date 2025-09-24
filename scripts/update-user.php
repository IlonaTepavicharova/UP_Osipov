<?php
// подключение к серверу 
require("connect.php");
// получаем GET параметр
$user_id = $_REQUEST['user_id'];
// получаем POST параметры 
$first_name = trim($_REQUEST['first_name']);
$last_name = trim($_REQUEST['last_name']);
$email = trim($_REQUEST['email']);
$url_site = trim($_REQUEST['url_site']);
$vk = trim($_REQUEST['vk']);
$bio = trim($_REQUEST['bio']);
// создание строки инструкции UPDATE 
$update_sql = sprintf("UPDATE `users` SET `first_name` = '%s', 
`last_name` = '%s', `bio` = '%s', `email` = '%s',`url_site` = '%s', 
`vk` = '%s'  WHERE `user_id` = %d",
    $mysqli->real_escape_string($first_name),
    $mysqli->real_escape_string($last_name),
    $mysqli->real_escape_string($bio),
    $mysqli->real_escape_string($email),
    $mysqli->real_escape_string($url_site),
    $mysqli->real_escape_string($vk),
    $user_id
);
// выполнение запроса 
$res = $mysqli->query($update_sql);
// если запрос выполнен выводим список пользователей 
if ($res) {
    header("Location: show-user.php?user_id=" . $user_id);
} else {
    header("Location: show-error.php?error_message=Ошибка обновления 
данных пользователя&system_error_message=" . $mysqli->error);
}
exit;
?>