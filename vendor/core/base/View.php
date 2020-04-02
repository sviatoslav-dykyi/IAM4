<?php


namespace vendor\core\base;


class View {

    public $route = [];

    public function __construct($route) {
        $this->route = $route;
    }

    public function render($vars) {
        if (is_array($vars)) extract($vars);

        $file_layout = APP . "/views/{$this->route['controller']}/index.php";

        require $file_layout;
    }
}
