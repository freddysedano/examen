<?php

namespace App\Controllers;

use GUMP;
use Libs\controller;
use stdClass;

class ClienteController extends controller
{
    public function __construct()
    {
         $this->loadDirectoryTemplate("cliente");
         $this->loadDAO("cliente");
    }
    public function index($param=null)
    {
        $estado= isset($param[0])? ($param[0]): true;
        $data = $this->dao-> getAll($estado);
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
        $valid_data= $this->validate($_POST);
        $status= $valid_data['status'];
        $data=$valid_data['data'];

        if ($status==true) {
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
                $rpta=$this->dao->update($obj);
            }else{
                $rpta=$this->dao->create($obj);
            }
            if ($rpta) {
                $response=[
                    'success'=> 1,
                    'message'=>'Categoria guardada correctamente',
                    'redirection'=> URL.'cliente'
                ];
            }else{$response=[
                    'success'=> 0,
                    'message'=>'Error al guardar los datos',
                    'redirection'=> ''
                ];
            }
        }else{
            $response=[
                    'success'=> -1,
                    'message'=> $data,
                    'redirection'=> ''
                ];
        }
        echo  json_encode($response);
    }
    public function  delete($param=null){
        $Id= isset($param[0])? intval($param[0]): 0;
        if ($Id >0) {
            $this->dao->delete($Id);
        }
         header('Location:' . URL . 'cliente/index');
    }
    public function  validate($datos){
        $gump=new GUMP('es');
        $gump->validation_rules([
            'nombres'=>'required|max_len,20',
            'apellidos'=>'required|max_len,50',
            'direccion'=>'min_len,8|max_len,100',
            'telf'=>'numeric',
            'creditolimite'=>'max_numeric,1000',
            'ruc'=>'numeric'
        ]);
        $valid_data=$gump->run($datos);
        if ($gump->errors()) {
            $response=[
                'status'=> false,
                'data'=>$gump->get_errors_array()
            ];
        }else{
            $response=[
                'status'=> true,
                'data'=>$valid_data
            ];
        }
        return $response;
    }
}
