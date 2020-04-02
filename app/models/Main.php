<?php


namespace app\models;
use vendor\core\base\Model;

class Main extends Model {
    public $table = 'users';

    public function findAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY date DESC";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function findOne($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ? LIMIT 1";
        $query = $this->pdo->prepare($sql);
        $query->execute([$id]);
        return $query->fetch();
    }
    public function add() {
        $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
        $role = trim(filter_var($_POST['role'], FILTER_SANITIZE_STRING));
        $status = trim(filter_var($_POST['status'], FILTER_SANITIZE_STRING));
        $id = $_POST['id'] ?: null;        
        if ($id === null) {
            $sql = "INSERT INTO {$this->table} (name, status, role) VALUES (?, ?, ?)";
            $masks = [$name, $status, $role];
        } else {
            $sql = "UPDATE {$this->table} SET name = ?, status = ?, role = ? WHERE id = ?";
            $masks = [$name, $status, $role, $id];
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($masks);
        return true;
    }
    public function del($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $query = $this->pdo->prepare($sql);
        $query->execute([$id]);
    }
    public function updateByField($field, $value, $id) {
        $sql = "UPDATE {$this->table} SET $field = ? WHERE id = ?";
        $query = $this->pdo->prepare($sql);
        $query->execute([$value, $id]);
    }
}
