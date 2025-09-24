<?php
$first_name = trim($_REQUEST['first_name']);
$last_name = trim($_REQUEST['last_name']);
$email = trim($_REQUEST['email']);
$url_site = trim($_REQUEST['url_site']);
$vk = trim($_REQUEST['vk']);
$bio = trim($_REQUEST['bio']);
require("connect.php");

// выполняем запрос вставки данных о пользователе 

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
    header("Location: show-error.php?error_message=Сервер не может получить выбранное вами изображение&system_error_message=$system_error_message");
    exit;
}
if (is_uploaded_file($_FILES["user_pic"]["tmp_name"]) == 0) {
    $system_error_message = "Запрос на отправку локального файла: " .
        $_FILES["user_pic"]["tmp_name"];
    header("Location: show-error.php?error_message=Сервер не может отправлять локальные файлы&system_error_message=$system_error_message");
    exit;
}
if (!getimagesize($_FILES["user_pic"]["tmp_name"])) {
    $system_error_message = "Файл: " . $_FILES["user_pic"]["tmp_name"]
        . " не является файлом изображения";
    header("Location: show-error.php?error_message=Вы выбрали файл, для своего фото, который не является dизображением&system_error_message=$system_error_message");
    exit;
}
$now = time();
$upload_filename = "../upload/" . $now . "_" . $_FILES["user_pic"]["name"];
if (
    !move_uploaded_file(
        $_FILES["user_pic"]["tmp_name"],
        $upload_filename
    )
) {
    $system_error_message = "Ошибка сохранения файла в директории сервера: " . $upload_filename;
    header("Location: show-error.php?error_message=Возникла проблема с сохранением вашего файла на сервере&system_error_message=$system_error_message");
    exit;
}
$insert_sql = <<<HEREDOC
INSERT INTO `users` (`first_name`, `last_name`, `email`, 
`url_site`, `vk`, `bio`, `user_pic_path`) VALUES ( 
'$first_name', 
'$last_name', 
'$email', 
'$url_site', 
'$vk', 
'$bio', 
'$upload_filename' 
) 
HEREDOC;

if (!$mysqli->query($insert_sql)) {
    header("Location: show-error.php?error_message=Ошибка вставки 
данных&system_error_message=" . $mysqli->error);
    exit;
}

?>
<!-- <html>

<head>
    <link href="../css/phpMM.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="wrap">
        <div id="header">
            <h1>PHP & MySQL: The Missing Manual</h1>
        </div>
        <div id="example">Регистрация</div>
            <?php require("menu.php"); ?>
            <div id="content">
                <p>Это запись той информации, которую вы отправили:</p>
                <p>
                    Имя: <?php echo $first_name . " " . $last_name; ?><br />
                    Адрес электронной почты: <?php echo $email; ?><br />
                    <a href="//<?php echo $url_site; ?>" target="_blank">Ваш
                        персональный сайт</a><br />
                    <a href="https://vk.com/<?php echo $vk; ?>" target="_blank">Ваша страница ВКонтакте<br />
                </p>
            </div>
            <div id="footer"></div>
    </div>
</body>

</html> -->