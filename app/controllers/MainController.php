<?php
namespace app\controllers;
use app\models\Main;
use vendor\core\base\Controller;


class MainController extends Controller {
    protected $model;

    public function __construct($route) {
        parent::__construct($route);
        $this->model = new Main();
    }
    public function index() {
        $users = $this->model->findAll();
        $this->set(compact('users' ));
    }
    public function add() {
        $this->model->add();
    }
    public function del() {
        $id = $_GET['id'];
        $this->model->del($id);
        header('Location: ' . '/');
    }
    public function get() {
        $users = $this->model->findAll();
        $id = $_GET['id'];
        $user1 = $this->model->findOne($id);
        $this->set(compact( 'users', 'user1' ));
    }
    public function action() {
        $action_id = trim(filter_var($_POST['action_id'], FILTER_SANITIZE_STRING));
        $actionUsers = trim(filter_var($_POST['actionUsers'], FILTER_SANITIZE_STRING));
        $id_users = explode(",", $actionUsers);
        switch ($action_id) {
            case 1:
                foreach ($id_users as $id_user) {
                    $this->model->updateByField('status', 'active', $id_user);
                }
                break;
            case 2:
                foreach ($id_users as $id_user) {
                    $this->model->updateByField('status', 'not-active', $id_user);
                }
                break;
            case 3:
                foreach ($id_users as $id_user) {
                    $this->model->del($id_user);
                }
        }
    }


















    //public function testAction() {
//        if ($this->isAjax()) {
//            $post = \R::findOne('posts', "id = {$_POST['id']}");
//            $this->loadView('_test', compact('post'));
//            die;
//        }
//        echo 222;
    //}
//    public function editAction() {
////        $id = $_GET['id'];
////        $user = \R::findOne('users_management', "id = {$id}");
////        $this->set(compact('user')); // масив compact буде розпечатаний
////
////        if ($this->isAjax()) {
////            $post = \R::findOne('posts', "id = {$_POST['id']}");
////            $this->loadView('_test', compact('post'));
////            die;
////        }
////        echo 222;
//    }

}
