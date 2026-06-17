<?php
define('ROOT', str_replace('public', '', $_SERVER['DOCUMENT_ROOT']));

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
require_once ROOT . 'route/web/route.php';
gestionControllerPage();
