<?php

namespace App\Controllers;

use Libs\controller;
use stdClass;

class UsuarioController extends controller
{
    public function __construct()
    {
         $this->loadDirectoryTemplate("usuario");
         $this->loadDAO("usuario");
    }
    public function index()
    {
        $data = $this->dao-> getAll(true);
        echo $this->template->render('index',['data'=>$data]);
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
        $obj->Id=isset( $_POST['Id_Usuario'])? intval($_POST['Id_Usuario']):0;
        $obj->IdTipo=isset( $_POST['tipo'])? intval($_POST['tipo']):0;
        $obj->Nombres=isset( $_POST['nombres'])? $_POST['nombres']:'';
        $obj->Apellidos=isset( $_POST['apellidos'])? $_POST['apellidos']:'';
        $obj->Direccion=isset( $_POST['direccion'])? $_POST['direccion']:'';
        $obj->Telf=isset( $_POST['telf'])? $_POST['telf']:0;
        $obj->Usuario=isset( $_POST['usuario'])? $_POST['usuario']:0;
        $obj->Clave=isset( $_POST['clave'])? $_POST['clave']:0;
        $obj->Correo=isset( $_POST['correo'])? $_POST['correo']:0;
        $obj->FCreacion=isset( $_POST['fechacreacion'])? $_POST['fechacreacion']:0;
        $obj->FEliminacion=isset( $_POST['FEliminacion'])? $_POST['FEliminacion']:0;
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
        header('Location:'.URL.'Usuario');
    }
    public function  delete($param=null){
        $Id= isset($param[0])? intval($param[0]): 0;
        if ($Id >0) {
            $this->dao->delete($Id);
        }
         header('Location:' . URL . 'Usuario');
    }
}
