<?php
$servername = "localhost";
$user = "root";
$pass = "chebon01";
$dbname = "maxilo";


$pdo = new PDO("mysql:host={$servername};dbname={$dbname}", $user, $pass);
// add this:
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);





	class Database{
        private static $dbName = 'maxilo' ;
        private static $dbHost = 'localhost' ;
        private static $dbUsername = 'root';
        private static $dbUserPassword = 'chebon01';

        private static $cont  = null;

        public function __construct() {
            die('Init function is not allowed');
        }

        public static function connect()
        {
            // One connection through whole application
            if ( null == self::$cont )
            {
                try
                {
                    self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
                }
                catch(PDOException $e)
                {
                    die($e->getMessage());
                }
            }
            return self::$cont;
        }

        public static function disconnect()
        {
            self::$cont = null;
        }
    }

?>





