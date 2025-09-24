<!DOCTYPE HTML>
<html>

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
        <div id="content"></div>
        
            <div id="content">
                <h1>Вступайте в наш виртуальный клуб</h1>
                <p>Пожалуйста, введите ниже свои данные для связи в
                    Интернете:</p>
                <form action="create-user.php" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <label for="first_name">Имя:</label> <input type="text" name="first_name" size="20" /><br />
                        <label for="last_name">Фамилия:</label> <input type="text" name="last_name" size="20" /><br />
                        <label for="email">Адрес электронной почты:</label> <input type="text" name="email"
                            size="50" /><br />
                        <label for="url_site">URL-адрес сайта:</label> <input type="text" name="url_site"
                            size="50" /><br />
                        <label for="vk">Идентификатор в VK:</label> <input type="text" name="vk" size="20" /><br />
                        <label for="user_pic">Прикрепить фото:</label><input type="file" name="user_pic"
                            size="30" /><br />
                        <label for="bio">Биография:</label>
                        <textarea name="bio" cols="40" rows="10"></textarea>
                    </fieldset>
                    <br />
                    <fieldset class="center">
                        <input type="submit" value="Вступить в клуб" />
                        <input type="reset" value="Очистить и начать все сначала" />
                    </fieldset>
                    </fieldset>
                    <br />
                </form>
            </div>
            <div id="footer"></div>
        </div>
</body>

</html>