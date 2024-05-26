<?php

require_once "DBInit.php";

class User {

    public static function userExists($username){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT User_ID FROM users WHERE Username = :username;");
        $statement->bindParam(":username", $username, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
  
    public static function createUser($username, $password, $isAdmin){
        $db = DBInit::getInstance();

        // Set password to empty string if not provided
        if (empty($password)) {
            $password = '';
        }
    
        // Hash the password
        $hashedPassword = !empty($password) ?  password_hash($password, PASSWORD_DEFAULT) : '';
    
        // Prepare the SQL statement
        $statement = $db->prepare("INSERT INTO Users (Username, Password, IsAdmin, Register_date) VALUES (:username, :password, :isAdmin, :register_date)");
    
        // Bind the parameters
        $statement->bindParam(":username", $username, PDO::PARAM_STR);
        $statement->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
        $statement->bindParam(":isAdmin", $isAdmin, PDO::PARAM_BOOL);
        $currentDateTime = date('Y-m-d H:i:s'); // Current time in the format 'YYYY-MM-DD HH:MM:SS'
        $statement->bindParam(":register_date", $currentDateTime, PDO::PARAM_STR);
    
        // Execute the statement
        return $statement->execute();
    }

    public static function validateCredentials($username, $password){ 
        if (empty($password) || empty($username)) {
            return false;
        }
      
        try {
            $db = DBInit::getInstance();
    
            $stmt = $db->prepare("SELECT Password FROM Users WHERE Username = :username LIMIT 1");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
    
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
          
            if ($user && password_verify($password, $user['Password'])) {
        
                return true;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            error_log('Database error: ' . $e->getMessage());
            return false;
        }
    }

}