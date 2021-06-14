<?php

namespace App\Controllers;

use Libs\controller;
use stdClass;

class UsuarioTipoController extends controller
{
    public function __construct()
    {
         $this->loadDirectoryTemplate("usuarioTipo");
         $this->loadDAO("usuarioTipo");
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
        $obj->Id= isset( $_POST['Id_usuarioTipo'])? intval($_POST['Id_usuarioTipo']):0;
        $obj->Nombre= isset( $_POST['nombre'])? $_POST['nombre']:'';
        if (isset( $_POST['estado'])) {
           if($_POST['estado']=='on'){
            $obj->Estado=true;
        }else{$obj->Estado=false;}
        }else{$obj->Estado=false;}


        if($obj->Id>0) {
            $this->dao->update($obj);
        }else{
            $this->dao->create($obj);
        }
        header('Location:'.URL.'usuarioTipo');
    }
    public function  delete($param=null){
        $Id= isset($param[0])? intval($param[0]): 0;
        if ($Id >0) {
            $this->dao->delete($Id);
        }
         header('Location:' . URL . 'usuarioTipo');
    }
}
