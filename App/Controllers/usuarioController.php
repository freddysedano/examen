<?php

namespace App\Controllers;

use GUMP;
use Libs\controller;
use stdClass;

class UsuarioController extends controller
{
    private $us,$ust;
    public function __construct()
    {
         $this->loadDirectoryTemplate("usuario");
         $this->us=$this->loadDAO("usuario");
         $this->ust=$this->loadDAO("usuarioTipo");
        //  $this->loadDAO("usuarioTipo");
    }
    public function index($param=null)
    {
        $estado= isset($param[0])? ($param[0]): true;
        $data = $this->us-> getAll($estado);
        echo $this->template->render('index',['data'=>$data]);
    }
    public function detail($param=null)
    {   $obj=new stdClass();
        $Id= isset($param[0])? intval($param[0]): 0;
        $obj->data = $this->us-> get($Id);
        $obj->data1= $this->ust-> getAll(true);
        echo $this->template->render('detail',['data'=>$obj]);
    }
    public function save()
    {
        $valid_data= $this->validate($_POST);
        $status= $valid_data['status'];
        $data=$valid_data['data'];

        if ($status==true) {
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
                $rpta=$this->us->update($obj);
                $this->Createimg($obj->Id,'Usuarios');
            }else{
                $rpta=$this->us->create($obj);
                $this->Createimg($rpta->Idguardado,'Usuarios');
            }
            if ($rpta) {
                $response=[
                    'success'=> 1,
                    'message'=>'Categoria guardada correctamente',
                    'redirection'=> URL.'usuario'
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
            $this->us->delete($Id);
        }
         header('Location:' . URL . 'Usuario');
    }
    public function  validate($datos){
        $gump=new GUMP('es');
        $gump->validation_rules([
            'nombres'=>'required|max_len,10',
            'Descripcion'=>'min_len,5|max_len,30'
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
