<?php

function dd($test): void {
    echo "<pre>";
    var_dump($test);
    echo "</pre>";
    die();
}
