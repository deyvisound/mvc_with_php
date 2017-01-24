<?php

namespace App;

/**
 * Description of Router
 *
 * @author deyvison
 */
class Router {
    
    private $routes;
    
    function __construct() {
        $this->initRoutes();
        echo $this->run($this->getUrl());
    }        

    public function initRoutes(){
        $routes = array(
            'home'      => array(
                'route'    =>  '/',
                'controller'=>  'indexController',
                'action'    =>  'index'
            ),
            'contact'   => array(
                'route'    =>  '/contact',
                'controller'=>  'indexController',
                'action'    =>  'contact'
            ),
        );
        
        $this->setRoutes($routes);
    }
    
    public function run($url) {
        array_walk($this->routes, function($route) use ($url) {            
            if($url == $route['route']){
                $class = "App\\Controllers\\".ucfirst($route['controller']);
                $controller = new $class;
                $action = $route['action'];
                $controller->$action();
            }
        });
    }
    
    public function setRoutes(array $routes) {
        $this->routes = $routes;
    }

        
    public function getUrl(){
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }

}
