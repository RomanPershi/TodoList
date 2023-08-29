<?php


class Router
{
    protected static $roles;
    protected static $routes;
    protected static $middlewares;
    protected static $Router = null;

    private function __construct()
    {

    }
    public static function route($url, $controller)
    {
        if (self::$Router === null) {
            self::$Router = new Router();
        }
        self::$routes[$url] = $controller;
        self::$middlewares[$url] = [1];
        return $url;
    }
    public static function setRoles($roles)
    {
        self::$roles = $roles;
    }
    public static function onRelocate()
    {
        $controller = self::getControllerOrAction(true);
        $action = self::getControllerOrAction(false);
        if (self::checkAccess()) {
            self::includeController($controller);
            self::actionController($controller, $action);
        }else{self::redirectToMain();}
    }
    public static function middleware($routes, $middleware)
    {
        foreach ($routes as $route) {
            self::$middlewares[$route] = $middleware;
        }
    }
    protected static function includeController($controller)
    {
        $file = $controller . '.php';
        $path = "application/controllers/" . $controller . '.php';
        if (file_exists($path)) {
            include "application/controllers/" . $file;
        } else {
            self::ErrorPage404();
        }
    }
    protected static function checkAccess()
    {
        foreach (self::$roles[$_SESSION['role']] as $role)
        {
            foreach (self::$middlewares[self::getUrl()] as $middleware)
            {
                if ($middleware == $role)
                    return true;
            }
        }
        return false;
    }
    protected static function actionController($controller, $action)
    {
        $controller = new $controller();
        return (method_exists($controller, $action)) ? $controller->$action() : self::ErrorPage404();
    }

    protected static function getControllerOrAction($return)
    {
        $controller = explode('@', self::searchController(self::getUrl()));
        $action = (isset($controller[1])) ? $controller[1] : 'invoke';
        return $return ? $controller[0] : $action;
    }
    protected static function getUrl()
    {
        return (strpos($_SERVER['REQUEST_URI'], '?')) ? strstr($_SERVER['REQUEST_URI'], '?', true) : $_SERVER['REQUEST_URI'];

    }
    protected static function searchController($url)
    {
        return isset(self::$routes[$url]) ? self::$routes[$url] : self::ErrorPage404();
    }
    protected static function redirectToMain()
    {
        header('Location: main');
    }
    protected static function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}
