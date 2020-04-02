<?php


namespace vendor\core\base;
use vendor\core\Db;

abstract class Model {
    protected $pdo;

    public function __construct() {
        $this->pdo = Db::instance();
    }
}
