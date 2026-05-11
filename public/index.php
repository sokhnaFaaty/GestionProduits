<?php
error_reporting(E_ALL);
ini_set("display_error", 1);

define("WEBROOT","http://localhost:8002/");
define("ROOT", (substr($_SERVER['DOCUMENT_ROOT'] ,0, -6)));

require_once(ROOT."db/config.php");