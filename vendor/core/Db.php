<?php


namespace vendor\core;

class Db {
    protected static $instance;

    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new \PDO('mysql:host=localhost;dbname=cp84961_s;charset=utf8', 'cp84961_s', 'plm8jbXenwpm',
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ]
            );
        }
        return self::$instance;
    }
}
