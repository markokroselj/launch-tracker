<?php



$urls = [
    "" => function () {
        Controller::index();
    },
    "home" => function () {
        ViewHelper::redirect(BASE_URL);
    },
    "launches" => function () {
        Controller::launches();
    },

    "register" => function () {
        Controller::register();
    },
    
    "api/register" => function () {
        Controller::registerUser();
    },
    
    "api/login" => function () {
        Controller::loginUser();
    },

    "login" => function () {
        Controller::login();
    },

    "github-auth-callback" => function () {
        include_once "controller/callback.php";
    },

    "logout" => function (){
       Controller::logout();
    },

    "dashboard" => function (){
      Controller::dashboard();
    }
]; 