<?php 
namespace app\App;

class Router{
    private static array $routes=[];

    public static function add(string $method,
                                string $path,
                                string $controller,
                                string $function,
                                array $middleware = []): void
                                {
                                    self::$routes[]=[
                                        'method' => $method,
                                        'path' => $path,
                                        'controller' => $controller,
                                        'function' => $function,
                                        'middleware' => $middleware
                                    ];
                                }

    public static function run(): void
    {
        $path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
        $method = $_SERVER['REQUEST_METHOD'];
        
        foreach(self::$routes as $routes){
            $pattern = "#^" . $routes['path'] . "$#";
            if($method == $routes['method'] && preg_match($pattern, $path, $match)){

                //call middleware
                foreach($routes['middleware'] as $middleware){
                    $instance = new $middleware;
                    $instance->before();
                }

                $function = $routes['function'];
                $controller = new $routes['controller'];
                // $controller->$function();
                
                array_shift($match);
                call_user_func_array([$controller, $function], $match);
                return;
            }
        }
        
        http_response_code(404);
        echo "Controller Not Found";
    }
}

?>