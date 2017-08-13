

    <?php
    $mysql_hostname = "localhost";
    $mysql_user = "geekangi_QW";
    $mysql_password = "123123123";
    $mysql_database = "geekangi_Quick Way";
    $prefix = "";
    $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
    mysql_select_db($mysql_database, $bd) or die("Could not select database");
    ?>
