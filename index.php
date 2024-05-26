<?php
require_once("controller/Controller.php");
require_once("router.php");


define("BASE_URL", rtrim(dirname($_SERVER["SCRIPT_NAME"]), '/') . '/');
define("ASSETS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "assets/");


$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";


try {
    if (isset($urls[$path])) {
       $urls[$path]();
    } else {
        ViewHelper::render("view/404.php");
        http_response_code(404);
    }
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
} 
