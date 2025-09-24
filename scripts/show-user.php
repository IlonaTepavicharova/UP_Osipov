<?php
require("connect.php");
require("authorize.php");
// извлекаем данные из суперглобального массива REQUEST 
$user_id = $_REQUEST["user_id"];
// создание строки инструкции SELECT 
$select_query = "SELECT * FROM `users` WHERE `user_id` = " . $user_id;
$res = $mysqli->query($select_query);
if ($res) {
    $row = $res->fetch_array();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    // сценарий может быть указан в теге источника изображения - src 
    $user_image = "show-image.php?user_id=" . $user_id;
    $bio = preg_replace('/[\r\n]+/', '<p>', $row['bio']);
    $email = $row['email'];
    $url_site = $row['url_site'];
    $vk = $row['vk'];
} else {
    header("Location: show-error.php?error_message=Ошибка получения пользователя с ID = $user_id&system_error_message=Невозможно обработать запрос на извлечение данных пользователя");
    exit;
}

// $first_name = "Кристофер Джон"; 
// $last_name = "Вильсон"; 
// $user_image = "../images/missing_user.png";
// $bio = "Кристофер Джон Вильсон - старт-питчер бейсбольной команды 
// Техас Рейнджерс. После нескольких лет выступлений в качестве релиф
// питчера,в 2010 году дебютировал в качестве стартера Рейнджерс, а в 
// 2011 году стал штатным стартером команды. Левша, известен своим 
// крутым характером,толстыми ожерельями из веревок и целым набором из 
// устрашающих противника вещей.<p>Кристофер Джон не только 
// бейсболист, но и автогонщик, и предпочитает домашнему безделью 
// южноафриканское сафари.</p>"; 
// $email = "mailto:wilson@exasrangers.com"; 
// $url_site = "http://wilson.exasrangers.com"; 
// $vk = "https://vk.com/j_wilson"; 
?>
<html>

<head>
    <link href="../css/phpMM.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="wrap">
        <div id="header">
            <h1>PHP & MySQL: The Missing Manual</h1>
        </div>
        <div id="example">Профиль</div>
        <?php require("menu.php"); ?>
        <div id="content">
            <div class="user_profile">
                <h1><?php echo "{$first_name} {$last_name}"; ?></h1>
                <p><img src="<?php echo $user_image; ?>" class="user_pic" />
                    <?php echo $bio; ?></p>
                <p class="contact_info">Поддерживайте связь с <?php echo
                    $first_name; ?>:</p>
                <ul>
                    <li>...по электронной почте
                        <a href="<?php echo $email; ?>"><?php echo $email; ?></a>
                    </li>
                    <li>...путем
                        <a href="<?php echo $url_site; ?>">посещения его сайта</a>
                    </li>
                    <li>...путем
                        <a href="<?php echo $vk; ?>">отслеживания его сообщений в VK</a>
                    </li>
                </ul>
                <hr />
                <p>
                <form method='POST' action='/scripts/edit-user.php?user_id= <?php echo $user_id; ?>'>
                    <button type='submit'>Редактировать</button>
                </form>
                </p>
            </div>
        </div>
        <div id="footer"></div>
    </div>
</body>

</html>