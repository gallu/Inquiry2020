<?php   // libs/DbHandle.php
/*
 * init.php をincludeしてからの利用を想定: Configクラスを解決するため
 */

class DbHandle {
    static public function get() : \PDO {
        static $dbh = null;
        if (null === $dbh) {
//echo "connect\n";
            $user = Config::get('db_user');
            $pass = Config::get('db_pass');
            $host = Config::get('db_host');
            $dbname = Config::get('db_dbname');
            $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
            //
            $options = [
                \PDO::ATTR_EMULATE_PREPARES => false,  // 静的プレースホルダにする
                \PDO::MYSQL_ATTR_MULTI_STATEMENTS => false, // 複文を禁止する
            ];
            //
            try {
                $dbh = new \PDO($dsn, $user, $pass, $options);
            } catch (\PDOException $e) {
                // XXX
                echo $e->getMessage();
                exit;
            }
        }
        return $dbh;
    }
}
