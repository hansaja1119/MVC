<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {

    define('ROOT', 'http://localhost/MVC/public');
} else {
    define('ROOT', 'http://remed.com');
}

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'asset');

// true means debug mode on
define('DEBUG', true);
