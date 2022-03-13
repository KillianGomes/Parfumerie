<?php

abstract class Driver{

    private static $bd;
 
    private static function getBd()
    {
        if(self::$bd === null){
            try{
                self::$bd = new PDO('mysql:host=localhost; dbname=ecf','root','');
                self::$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$bd->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        return self::$bd;
    }

    protected function getRequest($sql, $params = null){

        $result = self::getBd()->prepare($sql);
        $result->execute($params);

        return $result;
    } 
}

