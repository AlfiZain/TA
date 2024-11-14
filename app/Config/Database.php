<?php
namespace app\Config;
class Database{
    private static ?\PDO $pdo = null;

    public static function getConnection(): \PDO
    {
        if(self::$pdo === null){
            //Create new PDO
            $config = [
                "database" => [
                    "host" => "localhost",
                    "dbname" => "siswa_terbaik",
                    "username" => "root",
                    "password" => "",
                    "port" => "3306"
                ]
            ];

            try {
                self::$pdo = new \PDO(
                    "mysql:host={$config['database']['host']};dbname={$config['database']['dbname']};port={$config['database']['port']}",
                    $config['database']['username'],
                    $config['database']['password']
                );
            } catch (\PDOException $e) {
                exit("Koneksi ke database gagal: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    public static function beginTransaction(): void
    {
        self::getConnection()->beginTransaction();
    }

    public static function commitTransaction(): void
    {
        self::getConnection()->commit();
    }

    public static function rollbackTransaction(): void
    {
        self::getConnection()->rollBack();
    }
}
?>
