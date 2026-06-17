<?php

function dd($test): void {
    echo "<pre>";
    var_dump($test);
    echo "</pre>";
    die();
}
function loadView(string $view,array $datas = [],string $layout = "base"){
    ob_start();
    extract($datas);
    require_once(ROOT."views/".$view.".php");
    $content = ob_get_clean();
    require_once(ROOT."views/layout/".$layout.".layout.php");
}

function path (string $controller,string $action){
    return WEBROOT."?controller=$controller&page=$action";
}