<?php
error_reporting(E_ALL);
<<<<<<< HEAD
ini_set("display_error", 1);

define("WEBROOT","http://localhost:8002/");
define("ROOT", (substr($_SERVER['DOCUMENT_ROOT'] ,0, -6)));

=======
ini_set('display_errors', 1);
define("ROOT", (substr($_SERVER['DOCUMENT_ROOT'] ,0, -6)));

define("WEBROOT","http://localhost:8003/");
>>>>>>> e5e2cb5540e4e505d15c340191e34d76827f7d56
require_once(ROOT."db/config.php");