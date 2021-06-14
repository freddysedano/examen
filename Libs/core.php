<?php
namespace Libs;

class Core
{
    public function __construct()
    {
        //capturamos los elementos de la petecion
        $url= isset($_GET['url'])? $_GET['url']:null;
        //quitamos el ultimo /
        $url= rtrim($url, '/');
        // convertimos en array los elementos de la URL (petecion)
        $url = explode('/', $url);
        //si el usuario no proporciona un controlador
        // myEcho($url);
        if (empty($url[0])) {
            //llamamos al controlador prederminado
            require_once '../App/Controllers/homeController.php';
            (new \App\Controllers\HomeController())->index();
            return false;
        }
        //cuando el usuario especifique un controlador
        //Vereficamos si el controlador especifique exite
        $path_controller ='../app/controllers/'. $url[0]. 'Controller.php';
        if(file_exists($path_controller))
        {
            //creamos una instancia de dicho controlador
            require_once $path_controller;
            $controller_name = '\\App\\Controllers\\' .$url[0]. 'Controller';
            $controller =new $controller_name();
            $size= count($url);
            //si la cantidad de elementos del array es mayor o igual que 2
            // se ha especificado un controlador y una accion
            if ($size >=2) {
                //erificamo que la eaccion especificad por el usuario exista en el controlador
                if (method_exists($controller, $url[1])) {
                    if ($size>=3) {
                        //al menos el usuario a especificado un parametro
                        //capturamos los parametros ingresados en un array 'param'
                        $param=[];
                        for ($i = 2; $i < $size; $i++) {
                            array_push($param, $url[$i]);
                        }
                        // echo "<pre>", print_r($param), '</pre>';
                        $controller->{$url[1]}($param);
                    }else
                    {
                        // en caso que el usuario no especificado parametro entonces llamamos
                        //a la accion sin parametro
                        $controller->{$url[1]}();
                    }
                }else
                {
                    echo "el metodo de accion {$url[1]} no exixte ";
                }
            }
            else
            {
                // cuando el usuario no especifique ninguna accion llamamos de
                //manera prederterminada al accion index.php
                $controller->index();
            }
            //echo "el controlador {$url[0]}  exixte ";
        }else{
            //echo "el controlador {$url[0]} no exixte ";
        }
        // echo "<pre>", print_r($url), "</pre>";
        // var_dump($url);
    }
}



