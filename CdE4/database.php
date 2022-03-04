<?php
class Database
{
    //Definindo atributos do banco de dados.
    private static $dbName = 'cde4';
    private static $dbHost = 'localhost';
    private static $dbUserName = 'root';
    private static $dbUserPassword = '';
    private static $cont = null;

    //Conectar-se ao banco de dados.
    public static function connect()
    {
        if (self::$cont == null) {
            try {
                self::$cont = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUserName, self::$dbUserPassword);
            } catch (PDOException $e) {
                die("Não foi possível se conectar ao banco de dados" . self::$dbName . " : " . $e->getMessage());
            }
        }
        return self::$cont;
    }

    //Desconectar-se do banco de dados.
    public static function disconnect()
    {
        self::$cont = null;
    }
}
