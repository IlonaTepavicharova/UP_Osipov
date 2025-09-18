<?php
$first_name = trim($_REQUEST['first_name']); 
$last_name = trim($_REQUEST['last_name']); 
$email = trim($_REQUEST['email']); 
$url_site = trim($_REQUEST['url_site']); 
$vk = trim($_REQUEST['vk']); 
$bio = trim($_REQUEST['bio']); 
require("connect.php");
$insert_sql = <<<HEREDOC
INSERT INTO `users` (`first_name`, `last_name`, `email`, 
`url_site`, `vk`, `bio`) VALUES ( 
'$first_name', 
'$last_name', 
'$email', 
'$url_site', 
'$vk', 
'$bio' 
) 
HEREDOC; 
// выполняем запрос вставки данных о пользователе 
$mysqli->query($insert_sql) or die('Ошибка вставки данных: ' . 
$mysqli->errno . '. ' . $mysqli->error);
header("Location: show-user.php?user_id=" . $mysqli->insert_id); 
 

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