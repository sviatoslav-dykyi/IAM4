<?php
namespace vendor\core;

class Router {
    protected static $routes = [];
    protected static $route = []; // поточний масив
    
    public static function add($regexp, $route=[]) {
        self::$routes[$regexp] = $route;
    }    
    public static function matchRoute($url) {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {                
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = ucwords($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }
    public static function dispatch($url) {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
            if (class_exists($controller)) {
                $cObj = new $controller(self::$route);
                $action = lcfirst(self::$route['action']);
                if (method_exists($cObj, $action)) {
                    $cObj->$action();
                    $cObj->getView();
                }else{
                    echo "Метод: <b>$controller::$action</b> не надений!";
                }
            }else{
                echo "Контроллер: <b>$controller</b> не надений!";
            }
        }else{
            http_response_code(404);
        }
    }

    protected static function removeQueryString($url) {
        if ($url) {
            $params = explode('&', $url, 2);
            if (false === strpos($params[0], '=')) {
                return $params[0];
            }else{
                return '';
            }
        }
        return $url;
    }
}
