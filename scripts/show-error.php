<?php
$error_message = $_REQUEST["error_message"]; 
$system_error_message = $_REQUEST["system_error_message"];
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
        <div id="example">Извините</div>
        <?php require("menu.php"); ?>
        <div id="content">
            <h1>Нам очень жаль...</h1>
            <span class="error_message">
                <?php
                echo $error_message;
                ?>
            </span>
            <p><img src="../images/error.jpg" class="error" />
            <p><img src="../images/error.jpg" class="error" />
                Не волнуйтесь, мы в курсе происходящего и предпримем все
                необходимые меры. Если же вы хотите связаться с нами и узнать
                подробности произошедшего или вас что-нибудь беспокоит в
                сложившейся ситуации, пришлите нам
                <a href="mailto:admin@localhost">сообщение</a> и мы
                непременно откликнемся.
            </p>
            <p> А сейчас, если вы желаете вернуться на страницу, ставшую
                причиной проблемы, то можете <a href="javascript:history.go(-1);">
                    кликнуть здесь</a>. Если возникнет такая же проблема, то
                вы можете вернуться на страницу чуть позже. Уверены, что к
                тому времени мы во всем разберемся. Еще раз спасибо...
                надеемся на ваше скорое возвращение.</p>
            <p>И еще раз извините за причиненные неудобства.</p>
            <hr />
            <?php
            echo "<p>Было получено следующее сообщение об ошибке 
                системного уровня: <b> " . $system_error_message .
                "</b></p>";
            ?>
        </div>
        <div id="footer"></div>
    </div>
</body>

</html>