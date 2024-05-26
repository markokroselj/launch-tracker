<?php

class ViewHelper {

    //Displays a given view and sets the $variables array into scope.
    public static function render($file, $variables = array()) {
        extract($variables);

        ob_start();
        try {
            if (!file_exists($file)) {
                throw new Exception("View file not found: $file");
            }
            include($file);
            $renderedView = ob_get_clean();
            echo $renderedView;
        } catch (Exception $e) {
            ob_end_clean(); 
            self::error500($e);
        }
    }

    // Redirects to the given URL
    public static function redirect($url) {
        header("Location: " . $url);
    }

    public static function error500($e) {
        http_response_code(500);
        self::render("view/500.php", ["error" => $e]);
        exit(); 
    }

    // Displays a simple 404 message
    public static function error404() {
        header('This is not the page you are looking for', true, 404);
        $html404 = sprintf("<!doctype html>\n" .
                            "<title>Error 404: Page does not exist</title>\n" .
                            "<h1>Error 404: Page does not exist</h1>\n".
                            "<p>The page <i>%s</i> does not exist.</p>", $_SERVER["REQUEST_URI"]);

        echo $html404;
    }

    // Returns true if the request is AJAX
    public static function isAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
}
