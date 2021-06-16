<?php

namespace App\Controllers;

use GUMP;
use Libs\controller;
use stdClass;

class ProductoController extends controller
{
    private $product,$categ,$marca,$unidad;
    public function __construct()
    {
        $this->loadDirectoryTemplate("producto");
        $this->product =$this->loadDAO("producto");
        $this->categ =$this->loadDAO("categoria");
        $this->marca =$this->loadDAO("marca");
        $this->unidad =$this->loadDAO("unidad");
    }
    public function index($param=null)
    {
        $estado= isset($param[0])? ($param[0]): true;
        $data = $this->product-> getAll($estado);
        echo $this->template->render('index',['data'=>$data]);
    }
    public function detail($param=null)
    {
        $obj=new stdClass();
        $Id= isset($param[0])? intval($param[0]): 0;
        $obj->producto = $this->product-> get($Id);
        $obj->categoria = $this->categ-> getAll(true);
        $obj->marcas = $this->marca-> getAll(true);
        $obj->unidades = $this->unidad-> getAll(true);
        echo $this->template->render('detail',['data'=>$obj]);
    }
    public function save()
    {
        $valid_data= $this->validate($_POST);
        $status= $valid_data['status'];
        $data=$valid_data['data'];

        if ($status==true) {
            $obj=new stdClass();
            $obj->Id= isset( $_POST['Id_producto'])? intval($_POST['Id_producto']):0;
            $obj->IdMarca=isset( $_POST['idmarca'])? intval($_POST['idmarca']):0;
            $obj->IdCategoria=isset( $_POST['idcateg'])? intval($_POST['idcateg']):0;
            $obj->IdUnidad=isset( $_POST['idunidad'])? intval($_POST['idunidad']):0;
            $obj->Nombre=isset( $_POST['nombre'])? $_POST['nombre']:'';
            $obj->Descripcion=isset( $_POST['descripcion'])? $_POST['descripcion']:'';
            $obj->PrecioCosto=isset( $_POST['preciocosto'])? intval($_POST['preciocosto']):0;
            $obj->Precioventa=isset( $_POST['precioventa'])? intval($_POST['precioventa']):0;
            $obj->Stock=isset( $_POST['stock'])? intval($_POST['stock']):0;
            $obj->StockMinimo=isset( $_POST['stockminimo'])? intval($_POST['stockminimo']):0;
            if (isset( $_POST['estado'])) {
            if($_POST['estado']=='on'){
                $obj->Estado=true;
            }else{$obj->Estado=false;}
            }else{$obj->Estado=false;}
            if($obj->Id>0) {
                $rpta=$this->product->update($obj);
                $this->Createimg($obj->Id,'Productos');
            }else{
                $rpta=$this->product->create($obj);
                $this->Createimg($rpta->Idguardado,'Productos');
            }
            if ($rpta) {
                $response=[
                    'success'=> 1,
                    'message'=>'Categoria guardada correctamente',
                    'redirection'=> URL.'producto'
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
            $this->product->delete($Id);
        }
         header('Location:' . URL . 'producto/index');
    }
    public function  validate($datos){
        $gump=new GUMP('es');
        $gump->validation_rules([
            'nombre'=>'required|max_len,10',
            'descripcion'=>'min_len,5|max_len,100',
            'preciocosto'=>'required|max_len,8|min_numeric,1',
            'precioventa'=>'required|max_len,8|min_numeric,1',
            'stock'=>'required|min_numeric,1',
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
