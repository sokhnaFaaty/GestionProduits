<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
define("ROOT", (substr($_SERVER['DOCUMENT_ROOT'] ,0, -6)));


define("WEBROOT","http://localhost:8003/");
require_once(ROOT."views/header.php");
require_once(ROOT."db/config.php");
require_once(ROOT."route/web/route.php");
