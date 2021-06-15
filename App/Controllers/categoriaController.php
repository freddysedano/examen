<?php

namespace App\Controllers;

use Libs\controller;
use stdClass;

class CategoriaController extends controller
{
    public function __construct()
    {
         $this->loadDirectoryTemplate("categoria");
         $this->loadDAO("categoria");
    }
    public function index()
    {
        $data = $this->dao-> getAll(true);
        echo $this->template->render('index',['data'=>$data]);//,['data'=>$data]
    }
    public function detail($param=null)
    {
        $Id= isset($param[0])? intval($param[0]): 0;
        $data =$this->dao->get($Id);
        echo $this->template->render('detail',['data'=>$data]);
    }
    public function save()
    {
        $obj=new stdClass();
        $obj->Id= isset( $_POST['Id_categoria'])? intval($_POST['Id_categoria']):0;
        $obj->Nombre= isset( $_POST['nombre'])? $_POST['nombre']:'';
        $obj->Descripcion= isset( $_POST['descripcion'])? $_POST['descripcion']:'';
        // $obj->estado= isset( $_POST['estado'])? $_POST['estado']:false;
        if (isset( $_POST['estado'])) {
           if($_POST['estado']=='on'){
            $obj->Estado=true;
        }else{$obj->Estado=false;}
        }else{$obj->Estado=false;}

        // if ($_FILES ["archivo"] ["error"]>0) {
        // echo "Error al cargar archivo";
        // }else{
        //     $permitidos = array ("image/gif", "image/jpg", "image/png", "application/pdf") ;
        //     $limite_kb = 400;
        //     if (in_array($_FILES["archivo"] ["type"], $permitidos) && $_FILES["archivo" ] ["size"] <= $limite_kb * 1024){
        //         $ruta= MAINPATH .'/public/'.$obj->Id.'/';
        //         $archivo=$ruta.$_FILES["archivo"]["name"];
        //         if(!file_exists($ruta)){
        //             mkdir($ruta);
        //         }
        //         if(!file_exists($archivo)){
        //             $resultado= @move_uploaded_file($_FILES["archivo"]["tmp_name"],$archivo);
        //             if ($resultado) {
        //                 echo "archivo guardado";
        //             }else{echo "Error al guardad archivo";}
        //         }else{
        //             echo "Archivo ya existe";
        //         }
        //     }else {
        //     echo "Archive no permitido o excede el tamano";
        //     }
        // }
        if($obj->Id>0) {
            // $this->dao->update($obj);
        }else{
            $idimg=$this->dao->create($obj);
            $imagen = $_FILES['imagen']['name'];
            $nombre = $_POST['titulo'];

            if(isset($imagen) && $imagen != ""){
                $tipo = $_FILES['imagen']['type'];
                $temp  = $_FILES['imagen']['tmp_name'];

            if( !((strpos($tipo,'gif') || strpos($tipo,'jpg')|| strpos($tipo,'png')|| strpos($tipo,'jpeg') ))){
                $_SESSION['mensaje'] = 'solo se permite archivos jpeg, gif, webp';
                $_SESSION['tipo'] = 'danger';
            }else{
                move_uploaded_file($temp, ROOT.'/images/Productos/'.$nombre.'_'.$idimg.'.'.substr($tipo,6,4));
            }
            }
        }
        header('Location:'.URL.'categoria/index');
    }
    public function  delete($param=null){
        $Id= isset($param[0])? intval($param[0]): 0;
        if ($Id >0) {
            $this->dao->delete($Id);
        }
         header('Location:' . URL . 'categoria/index');
    }
}
