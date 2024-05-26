<?php

require_once "DBInit.php";

class Orbit {


    public static function addOrbit($id, $description){
        $db = DBInit::getInstance();
        
        $sql = "INSERT INTO Orbit (Orbit_ID, Description) VALUES (:id, :description)";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}