<?php

    class Db{
        private static $conn;
        private static $settings = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_EMULATE_PREPARES => false,
        );

        public static function connect($host, $user, $password, $database){
            if(!isset(self::$conn)){
                self::$conn = new PDO("mysql:host=$host;dbname=$database",$user,$password, self::$settings);
            }
        }

        public static function queryOne($query, $params = array()){
            $result = self::$conn->prepare($query);
            try {
                $result->execute($params);
                return $result->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                
            }
            
        }

         public static function queryAll($query, $params = array()){
             $result = self::$conn->prepare($query);
             try {
                $result->execute($params);
                return $result->fetchAll(PDO::FETCH_ASSOC);
             } catch (PDOException $ex) {
                 
             }
             
         }

         public static function queryCount($query, $params = array()){
             $result = self::$conn->prepare($query);
             try {
                $result->execute($params);
                return $result->rowCount();
             } catch (PDOException $ex) {
             }
         }
    }

?>