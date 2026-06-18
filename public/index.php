<?php
define('ROOT', dirname(__DIR__) . '/');

require_once ROOT . 'db/config.php';      // charge env.dev.php ou env.prod.php → définit APP_URL
define('WEBROOT', APP_URL);

// Erreurs visibles uniquement en dev (env.dev.php présent)
if (file_exists(ROOT . 'env.dev.php')) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

require_once ROOT . 'db/helpers.php';
require_once ROOT . 'validation/validate.php';

// Parse clean URLs: /controller/page → $_GET['controller'] + $_GET['page']
$_basePath    = rtrim(parse_url(APP_URL, PHP_URL_PATH), '/');
$_requestPath = trim(substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), strlen($_basePath)), '/');
if ($_requestPath && !isset($_GET['controller'])) {
    $_segments = explode('/', $_requestPath, 2);
    if ($_segments[0]) {
        $_GET['controller'] = $_REQUEST['controller'] = $_segments[0];
    }
    if (isset($_segments[1]) && $_segments[1]) {
        $_GET['page'] = $_REQUEST['page'] = $_segments[1];
    }
}
unset($_basePath, $_requestPath, $_segments);

require_once ROOT . 'route/web/route.php';
gestionControllerPage();
