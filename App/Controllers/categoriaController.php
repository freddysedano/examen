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
        // if(isset($_FILES['archivo']['name'])){
        //     // file name
        //     $filename = $_FILES['archivo']['name'];

        //     // Location
        //     $location = MAINPATH .'/public/'.$filename.'/';

        //     // file extension
        //     $file_extension = pathinfo($location, PATHINFO_EXTENSION);
        //     $file_extension = strtolower($file_extension);

        //     // Valid image extensions
        //     $valid_ext = array("pdf","doc","docx","jpg","png","jpeg");

        //     $response = 0;
        //     if(in_array($file_extension,$valid_ext)){
        //         // Upload file
        //         if(move_uploaded_file($_FILES['archivo']['tmp_name'],$location)){
        //             $response = 1;
        //         }
        //     }

        //     echo $response;
        //     exit;
        // }


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
            // $this->dao->create($obj);
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
