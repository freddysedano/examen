<?php

namespace App\Controllers;

use Libs\controller;
use stdClass;

class ClienteController extends controller
{
    public function __construct()
    {
         $this->loadDirectoryTemplate("cliente");
         $this->loadDAO("cliente");
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
        $obj->Id=isset( $_POST['Id_cliente'])? intval($_POST['Id_cliente']):0;
        $obj->Nombres=isset( $_POST['nombres'])? $_POST['nombres']:'';
        $obj->Apellidos=isset( $_POST['apellidos'])? $_POST['apellidos']:'';
        $obj->Direccion=isset( $_POST['direccion'])? $_POST['direccion']:'';
        $obj->Telf=isset( $_POST['telf'])? $_POST['telf']:0;
        $obj->CreditoLimite=isset( $_POST['creditolimite'])? $_POST['creditolimite']:0;
        $obj->Ruc=isset( $_POST['ruc'])? $_POST['ruc']:0;
        if (isset( $_POST['estado'])) {
           if($_POST['estado']=='on'){
            $obj->Estado=true;
        }else{$obj->Estado=false;}
        }else{$obj->Estado=false;}


        if($obj->Id>0) {
            $this->dao->update($obj);
        }else{
            $idimg=$this->dao->create($obj);
        }
        header('Location:'.URL.'cliente/index');
    }
    public function  delete($param=null){
        $Id= isset($param[0])? intval($param[0]): 0;
        if ($Id >0) {
            $this->dao->delete($Id);
        }
         header('Location:' . URL . 'cliente/index');
    }
}
