<div id="menu">
    <ul>
        <li><a href="/index.html">Главная страница</a></li>
        <?php
        if (isset($_COOKIE["username"])) {
            echo "<li><a href='/scripts/show-user.php?user_id=" . $_COOKIE["user_id"] . "'>Мой профиль</a></li>";
            echo "<li><a href='/scripts/logout.php'>Отмена авторизации</a></li>";
        } else {
            echo "<li><a href='/scripts/login.php'>Авторизация</a></li>";
        }
        ?>
    </ul>
</div>