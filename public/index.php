<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
define("ROOT", (str_replace("public","",$_SERVER['DOCUMENT_ROOT'])));

// var_dump($_SERVER['DOCUMENT_ROOT']);
// var_dump(ROOT);
define("WEBROOT","http://localhost:8003/");
require_once(ROOT."views/header.php");
require_once(ROOT."db/config.php");
require_once(ROOT."route/web/route.php");
