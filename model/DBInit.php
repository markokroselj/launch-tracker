<?php 
use Dotenv\Dotenv;

include './vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class DBInit {
     

    private static $host = "";
    private static $user = "";
    private static $password = "";
    private static $schema = "";
    private static $instance = null;

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    /**
     * Returns a PDO instance -- a connection to the database.
     * The singleton instance assures that there is only one connection active
     * at once (within the scope of one HTTP request)
     * 
     * @return PDO instance 
     */
    public static function getInstance() {
        self::$host = $_ENV['DB_HOST'];
        self::$user = $_ENV['DB_USER'];
        self::$password = $_ENV['DB_PASSWORD'];
        self::$schema = $_ENV['DB_SCHEMA'];

        if (!self::$instance) {
            $config = "mysql:host=" . self::$host
                    . ";dbname=" . self::$schema;
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            );

            self::$instance = new PDO($config, self::$user, self::$password, $options);
        }

        return self::$instance;
    }

}