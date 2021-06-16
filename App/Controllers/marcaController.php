<?php

namespace App\Controllers;

use GUMP;
use Libs\controller;
use stdClass;

class MarcaController extends controller
{
    public function __construct()
    {
         $this->loadDirectoryTemplate("marca");
         $this->loadDAO("marca");
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
            $obj->Id= isset( $_POST['Id_marca'])? intval($_POST['Id_marca']):0;
            $obj->Nombre= isset( $_POST['nombre'])? $_POST['nombre']:'';
            $obj->Descripcion= isset( $_POST['descripcion'])? $_POST['descripcion']:'';
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
                    'redirection'=> URL.'marca'
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
         header('Location:' . URL . 'marca/index');
    }
    public function  validate($datos){
        $gump=new GUMP('es');
        $gump->validation_rules([
            'nombre'=>'required|max_len,10',
            'descripcion'=>'min_len,5|max_len,30'
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
