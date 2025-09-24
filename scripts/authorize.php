<?php
define("VALIDUSER", "admin");
define("VALIDPWD", "secret");
if (
    $_SERVER["PHP_AUTH_USER"] != VALIDUSER ||
    $_SERVER["PHP_AUTH_PW"] != VALIDPWD
) {
    header("HTTP/1.1 401 Unauthorized");
    header("WWW-Authenticate: Basic realm='The virtuality club'");
    // exit; 
    exit(' 
<html> 
<head> 
<link href="../css/phpMM.css" rel="stylesheet" type="text/css" 
/> 
</head> 
<body> 
<div class="wrap"> 
<div id="header"><h1>PHP & MySQL: The Missing 
Manual</h1></div> 
<div id="example">Status 401</div> 
<div id="content"> 
<h1>Упс, что-то пошло не так...</h1> 
<h3>Контент страницы закрыт для несанкционированного 
доступа</h3> 
</div> 
<div id="footer"></div> 
</div> 
</body> 
</html> 
');
}