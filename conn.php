<?php


class Database
{
    private static $db_host = 'localhost';
    private static $db_name = 'import';
    private static $db_username = 'root';
    private static $pass_word = '123456';
    private static $charset = 'utf8mb4';

    private static $conn;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function connect()
    {
        static::$conn = null;
        if (static::$conn == null) {
            try {
                $server_path = "mysql:host=" . static::$db_host . ";dbname=" . static::$db_name . ";charset=" . static::$charset;
                static::$conn = new PDO($server_path, static::$db_username, static::$pass_word);
                return static::$conn;
            } //if error throw exception
            catch (\PDOException $e) {
                return $e->getMessage();
            }

        } else {
            return static::$conn;
        }

    }
    public function getAll(){

    }

}
