<?php
// подключение к серверу 
require("connect.php");
$user_id = $_REQUEST["user_id"];
// создание строки инструкции SELECT 
$select_sql = sprintf(
    "SELECT * FROM `users` WHERE `user_id` = %d",
    $user_id
);
// выполнение запроса 
$res = $mysqli->query($select_sql);
// если запрос выполнен получаем данные пользователя 
if ($res) {
    $row = $res->fetch_array();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $url_site = $row['url_site'];
    $vk = $row['vk'];
    $bio = $row['bio'];
} else {
    header("Location: show-error.php?error_message=Ошибка вывода 
данных пользователя для редактирования&system_error_message=" .
        $mysqli->error);
    exit;
}
?>
<html>

<head>
    <link href="../css/phpMM.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="wrap">
        <div id="header">
            <h1>PHP & MySQL: The Missing
                Manual</h1>
        </div>
        <div id="example">Редактор</div>
        <!—- подключаем файл меню -->
            <?php require("menu.php"); ?>
            <div id="content">
                <h1>Виртуальный клуб</h1>
                <p>Форма правки данных пользователя:</p>
                <!—- файл update-user.php будет создан ниже -->
                    <!—- ID пользователя передаем в GET параметре -->
                        <form action="/scripts/update-user.php?user_id=<?php echo
                            $user_id; ?>" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <label for="first_name">Имя:</label> <input type="text" name="first_name" size="20"
                                    value="<?php echo
                                        $first_name; ?>" /><br />
                                <label for="last_name">Фамилия:</label> <input type="text" name="last_name" size="20"
                                    value="<?php
                                    echo $last_name; ?>" /><br />
                                <label for="email">Адрес электронной почты:</label>
                                <input type="text" name="email" size="50" value="<?php
                                echo $email; ?>" /><br />
                                <label for="url_site">URL-адрес сайта:</label> <input type="text" name="url_site"
                                    size="50" value="<?php echo
                                        $url_site; ?>" /><br />
                                <label for="vk">Идентификатор в VK:</label> <input type="text" name="vk" size="20"
                                    value="<?php echo
                                        $vk; ?>" /><br />
                                <label for="user_pic">Прикрепить фото: </label> <input type="file" name="user_pic"
                                    size="30" /><br />
                                <label for="bio">Биография:</label> <textarea name="bio" cols="40" rows="10"><?php echo
                                    $bio; ?></textarea>
                            </fieldset>
                            <br />
                            <fieldset class="center">
                                <input type="submit" value="Сохранить" />
                            </fieldset>
                        </form>
            </div>
            <div id="footer"></div>
    </div>
</body>

</html>