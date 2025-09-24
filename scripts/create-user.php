<?php
// проверка отсутствия ошибки при отправке изображения 
if ($_FILES["user_pic"]["error"] != 0) {
    switch ($_FILES["user_pic"]["error"]) {
        case 1:
            $system_error_message = "Превышен максимальный размер 
файла указанный в файле php.ini";
            break;
        case 2:
            $system_error_message = "Превышен максимальный размер 
файла указанный в форме HTML";
            break;
        case 3:
            $system_error_message = "Была отправлена только часть 
файла";
            break;
        case 4:
            $system_error_message = "Файл для отправки не был 
выбран";
    }
    header("Location: show-error.php?error_message=Сервер не может 
получить выбранное вами 
изображение&system_error_message=$system_error_message");
    exit;
}
// проверка, является ли файл результатом нормальной отправки 
if (is_uploaded_file($_FILES["user_pic"]["tmp_name"]) == 0) {
    $system_error_message = "Запрос на отправку локального файла: "
        . $_FILES["user_pic"]["tmp_name"];
    header("Location: show-error.php?error_message=Сервер не может 
отправлять локальные 
файлы&system_error_message=$system_error_message");
    exit;
}
// проверка, действительно ли отправляемый файл изображение 
if (!getimagesize($_FILES["user_pic"]["tmp_name"])) {
    $system_error_message = "Файл: " .
        $_FILES["user_pic"]["tmp_name"] . " не является файлом 
изображения";
    header("Location: show-error.php?error_message=Вы выбрали файл, 
для своего фото, который не является 
изображением&system_error_message=$system_error_message");
    exit;
}
$first_name = trim($_REQUEST['first_name']);
$last_name = trim($_REQUEST['last_name']);
$username = trim($_REQUEST['username']);
$password = trim($_REQUEST['password']);
$email = trim($_REQUEST['email']);
$url_site = trim($_REQUEST['url_site']);
$vk = trim($_REQUEST['vk']);
$bio = trim($_REQUEST['bio']);

require("connect.php");
// создаем строку sql-запроса на вставку данных 
$insert_sql = sprintf(
    "INSERT INTO `users` ( `first_name`, `last_name`, `username`, `password`, `email`, `url_site`, `vk`, `bio`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
    $mysqli->real_escape_string($first_name),
    $mysqli->real_escape_string($last_name),
    $mysqli->real_escape_string($username),
    $mysqli->real_escape_string($password),
    $mysqli->real_escape_string($email),
    $mysqli->real_escape_string($url_site),
    $mysqli->real_escape_string($vk),
    $mysqli->real_escape_string($bio)
);

// вставка данных о пользователе втаблицу users 
if (!$mysqli->query($insert_sql)) {
    header("Location: show-error.php?error_message=Ошибка вставки 
данных&system_error_message=" . $mysqli->error);
    exit;
}
// вставка изображения в таблицу images 
$image_filename = $_FILES["user_pic"]["name"];
$image_info = $_FILES["user_pic"]["tmp_name"];
$image_mime_type = $_FILES["user_pic"]["type"];
$image_size = $_FILES["user_pic"]["size"];
$image_data = file_get_contents($_FILES["user_pic"]["tmp_name"]);
// так как функция возвращает ID последней операции  
// важно выполнить присвоение до вставки изображения  
$user_id = $mysqli->insert_id;
// создаем строку sql-запроса на вставку изображения 
$insert_image_sql = sprintf("INSERT INTO `images` (`user_id`, 
`filename`, `mime_type`, `file_size`, `image_data`) VALUES ( 
%d, '%s', '%s', '%s', '%s')",
    $user_id,
    $mysqli->real_escape_string($image_filename),
    $mysqli->real_escape_string($image_mime_type),
    $mysqli->real_escape_string($image_size),
    $mysqli->real_escape_string($image_data)
);
if (!$mysqli->query($insert_image_sql)) {
    header("Location: show-error.php?error_message=Ошибка вставки изображения&system_error_message=" . $mysqli->error);
    exit;
}
;
// перенаправление пользователя на страницу,  
// показывающую информацию о пользователе 
// теперь используем переменную $user_id 
header("Location: show-user.php?user_id=" . $user_id);
exit;
?>