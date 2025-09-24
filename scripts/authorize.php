<?php
if (
    !isset($_SERVER["PHP_AUTH_USER"]) ||
    !isset($_SERVER["PHP_AUTH_PW"])
) {
    header("HTTP/1.1 401 Unauthorized");
    header("WWW-Authenticate: Basic realm='The virtuality club'");
    exit('
<html>
<head>
<link href="../css/phpMM.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrap">
<div id="header"><h1>PHP & MySQL: The Missing Manual</h1></div>
<div id="example">Профиль</div>
<div id="content">
<h1>Упс, что-то пошло не так...</h1>
<h3>Контент страницы закрыт для несанкционированного доступа</h3>
</div>
<div id="footer"></div>
</div>
</body>
</html>
');
}
;
// если значения в диалоговое окно введены идем дальше
require("connect.php");
// поиск пользователя с введенными значениями username и password
$select_user = sprintf(
    "SELECT `user_id`, `username` FROM `users` WHERE `username` = '%s' AND `password` = '%s'",
    $mysqli->real_escape_string(trim($_SERVER['PHP_AUTH_USER'])),
    $mysqli->real_escape_string(trim($_SERVER['PHP_AUTH_PW']))
);
$res = $mysqli->query($select_user);
// если пользователь найден
// присваиваем переменным данные из базы
// идем дальше
if ($mysqli->affected_rows == 1) {
    $row = $res->fetch_array();
    $user_id = $row['user_id'];
    // сохраняем данные авторизованного пользователя 
    setcookie('user_id', $user_id);
    setcookie('username', $row['username']);
    // перенаправляем пользователя на его профиль
    header("Location: /scripts/show-user.php?user_id=" . $user_id);

} else {
    // иначе опять: 
// отправляем заголовки
// выводим окно аутентификации
    header("HTTP/1.1 401 Unauthorized");
    header("WWW-Authenticate: Basic realm='The virtuality club'");
    exit;
}
