<?php
class database
{

    static function get_db_name():string {
        $config = parse_ini_file('config.ini');
        return $config["db_name"];
    }
    
    static function connect($dbname): mysqli
    {
        $config = parse_ini_file('config.ini');
        return new mysqli(
            $config["db_host"],
            $config["db_user"],
            $config["db_password"],
            $dbname
        );

    }

}