<?php
require("connect.php");
// получение ID из GET-параметра  
$user_id = $_REQUEST['user_id'];
// получение данных из формы пользователя 
$first_name = trim($_REQUEST['first_name']);
$last_name = trim($_REQUEST['last_name']);
$email = trim($_REQUEST['email']);
$url_site = trim($_REQUEST['url_site']);
$vk = trim($_REQUEST['vk']);
$bio = trim($_REQUEST['bio']);
// создание SQL инструкции UPDATE таблицы users 
$update_users_sql = sprintf("UPDATE `users` SET `first_name` = 
'%s', `last_name` = '%s', `bio` = '%s', `email` = '%s',`url_site` = 
'%s', `vk` = '%s'  WHERE `user_id` = %d",
    $mysqli->real_escape_string($first_name),
    $mysqli->real_escape_string($last_name),
    $mysqli->real_escape_string($bio),
    $mysqli->real_escape_string($email),
    $mysqli->real_escape_string($url_site),
    $mysqli->real_escape_string($vk),
    $user_id
);
$res = $mysqli->query($update_users_sql);
if ($res) {

    if ($_FILES["user_pic"]["error"] != 4) {
        // выполняем стандартные операции проверки изображения 
// проверка отсутствия ошибки при отправке изображения 
        if ($_FILES["user_pic"]["error"] != 0) {
            switch ($_FILES["user_pic"]["error"]) {
                case 1:
                    $system_error_message = "Превышен максимальный 
размер файла указанный в файле php.ini";
                    break;
                case 2:
                    $system_error_message = "Превышен максимальный 
размер файла указанный в форме HTML";
                    break;
                case 3:
                    $system_error_message = "Была отправлена только 
часть файла";
                    break;
                case 4:
                    $system_error_message = "Файл для отправки не был 
выбран";
            }
            header("Location: show-error.php?error_message=Сервер не 
может получить выбранное вами 
изображение&system_error_message=$system_error_message");
            exit;
        }
    }
    // проверка, является ли файл результатом нормальной отправки 
    if (is_uploaded_file($_FILES["user_pic"]["tmp_name"]) == 0) {
        $system_error_message = "Запрос на отправку локального 
файла: " . $_FILES["user_pic"]["tmp_name"];
        header("Location: show-error.php?error_message=Сервер не 
может отправлять локальные 
файлы&system_error_message=$system_error_message");
        exit;
    }
    // проверка, действительно ли отправляемый файл изображение 
    if (!getimagesize($_FILES["user_pic"]["tmp_name"])) {
        $system_error_message = "Файл: " . $_FILES["user_pic"]["tmp_name"] . " не является файлом изображения";
        header("Location: show-error.php?error_message=Вы выбрали 
файл, для своего фото, который не является 
изображением&system_error_message=$system_error_message");
        exit;
    }
    $image_filename = $_FILES["user_pic"]["name"];
    $image_info = $_FILES["user_pic"]["tmp_name"];
    $image_mime_type = $_FILES["user_pic"]["type"];
    $image_size = $_FILES["user_pic"]["size"];
    $image_data =
        file_get_contents($_FILES["user_pic"]["tmp_name"]);
    // создание SQL инструкции UPDATE таблицы images 
    $update_images_sql = sprintf("UPDATE `images` SET `filename` 
= '%s', `mime_type` = '%s', `file_size` = '%s', `image_data` 
= '%s'WHERE `user_id` = %d",
        $mysqli->real_escape_string($image_filename),
        $mysqli->real_escape_string($image_mime_type),
        $mysqli->real_escape_string($image_size),
        $mysqli->real_escape_string($image_data),
        $user_id
    );
    // выполнение запроса на обновление данных таблицы images 
    $res = $mysqli->query($update_images_sql);
    if (!$res) {
        header("Location: show-error.php?error_message=Ошибка 
обновления изображения пользователя&system_error_message="
            . $mysqli->error);
        exit;
    }

    header("Location: show-user.php?user_id=" . $user_id);
} else {
    header("Location: show-error.php?error_message=Ошибка обновления 
данных пользователя&system_error_message=" . $mysqli->error);
}
exit;
?>