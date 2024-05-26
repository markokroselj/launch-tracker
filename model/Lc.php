<?php

require_once "DBInit.php";

class Lc{


    public static function addLc($name, $location){
        $db = DBInit::getInstance();
        
        $sql = "INSERT INTO lc (Name, Location) VALUES (:name, :location)";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':location', $location, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT LC_ID, Name FROM lc");
        $statement->execute();

        return $statement->fetchAll();
    }
}