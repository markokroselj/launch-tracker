<?php

require_once("ViewHelper.php");
require_once("model/User.php");

class Controller
{
    public static function isUserAuthenticated(){
        if(empty($_COOKIE["jwt"]) || !isset($_COOKIE["jwt"])){
            return false;
        }
        require_once("controller/jwtAuth.php");
        return validateToken($_COOKIE["jwt"]);
    }

    public static function index()
    {
        
        ViewHelper::render("view/home.php", ["authenticated" => self::isUserAuthenticated()]);
    }

    public static function launches()
    {
        ViewHelper::render("view/launches.php",  ["authenticated" => self::isUserAuthenticated()]);
    }

    public static function login() {
        $register_status_output = "";
        if(isset($_GET['register']) && !empty($_GET['register'])){
            if($_GET['register'] == 'success'){
                $register_status_output = "You have registered successfully! 😃 Please login";
            }   
        }
        ViewHelper::render("view/login.php",  ["authenticated" => self::isUserAuthenticated(), "register_status_output" => $register_status_output]);
    }

    public static function register() {
        ViewHelper::render("view/register.php",  ["authenticated" => self::isUserAuthenticated()]);
    }

    public static function registerUser() {
        $rules = [
            "username" => [
                // Only letters, numbers, and dashes are allowed
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[a-zA-Z0-9\-]+$/"]
            ],
            "password" => [
                // At least 8 characters long, must contain at least one number
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^(?=.*\d).{8,}$/"]
            ]
        ];
    
        // Apply filter to all POST variables; from here onwards we never
        // access $_POST directly, but use the $data array
        $data = filter_input_array(INPUT_POST, $rules);
    
        // Initialize the errors array
        $errors = [
            "username" => $data["username"] === false ? "invalid-username" : "",
            "password" => $data["password"] === false ? "invalid-password" : "",
            "pwd_mismatch" => "",
            "empty_fields" => "",
            "user_exists" => ""
        ];
    
        // Check if password and password_repeat match
        if (!empty($_POST["password_repeat"]) && $_POST["password_repeat"] !== $data["password"]) {
            $errors["pwd_mismatch"] = "password-mismatch";
        }
    
        // Check if any required fields are empty
        if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["password_repeat"])) {
            var_dump($_POST);
            $errors["empty_fields"] = "empty-fields";
        }
        
        if(User::userExists($data['username'])){
            $errors["user_exists"] = "user-exists";
        }
    
      
        $isDataValid = true;
        foreach ($errors as $error) {
            $isDataValid = $isDataValid && empty($error);
        }

        if ($isDataValid) {
            User::createUser($data['username'], $data['password'], false);
            ViewHelper::redirect(BASE_URL."login?register=success");
            exit();
        } else {
            ViewHelper::redirect(BASE_URL."register?".http_build_query($errors));
        }
       exit();
    }

    public static function loginUser(){
        $rules = [
            "username" => [
                // Only letters, numbers, and dashes are allowed
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[a-zA-Z0-9\-]+$/"]
            ],
            "password" => [
                // At least 8 characters long, must contain at least one number
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^(?=.*\d).{8,}$/"]
            ]
        ];
    
        // Apply filter to all POST variables; from here onwards we never
        // access $_POST directly, but use the $data array
        $data = filter_input_array(INPUT_POST, $rules);
    
        // Initialize the errors array
        $errors = [
            "username" => $data["username"] === false ? "invalid-username" : "",
            "password" => $data["password"] === false ? "invalid-password" : "",
            "empty_fields" => "",
            "invalid_credentials" => ""
        ];
    
    
        // Check if any required fields are empty
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            $errors["empty_fields"] = "empty-fields";
        }
        
        if(!User::validateCredentials($data["username"], $data["password"])){
            $errors["invalid_credentials"] = "invalid-credentials";
        }
        
        $isDataValid = true;
        foreach ($errors as $error) {
            $isDataValid = $isDataValid && empty($error);
        }

        if ($isDataValid) {
            require_once("controller/jwtAuth.php");

            //log out existing user
            if(isset($_COOKIE['jwt'])){
                setcookie("jwt", "",  time() - 86400, "/", "", false, true); 
            }

            $userData = array(
                "username" => $data["username"]
            );
            
            $token = generateToken($userData);
            setcookie("jwt", $token, time() + (86400 * 30), "/", "", false, true); 
            if(isset($_GET['after-login']) && !empty($_GET['after-login'])){
                ViewHelper::redirect(BASE_URL. $_GET['after-login']);
            }else{
                ViewHelper::redirect(BASE_URL."home");
            }
            exit();
        } else {
            ViewHelper::redirect(BASE_URL."login?".http_build_query($errors). "&" . http_build_query(['after-login' => $_GET['after-login']]));
        }
       exit();
    }

    public static function logout(){
        setcookie("jwt", "",  time() - 86400, "/", "", false, true); 
        header("Location: home");   
        exit();
    }


    public static function dashboard(){
        if(!self::isUserAuthenticated()){
            ViewHelper::redirect(BASE_URL."login?after-login=dashboard");
            exit();
        }
       
        $username = self::isUserAuthenticated()->username;
        ViewHelper::render("view/dashboard.php", ["authenticated" => true, "username" => $username]);

    }
}
