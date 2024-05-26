<?php

require_once "DBInit.php";

class Lsp {


    public static function addLsp($name, $country){
        $db = DBInit::getInstance();
        
        $sql = "INSERT INTO lsp (Name, Country) VALUES (:name, :country)";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':country', $country, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT LSP_ID, Name FROM lsp");
        $statement->execute();

        return $statement->fetchAll();
    }
}