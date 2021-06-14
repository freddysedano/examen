<?php

namespace App\Daos;

use App\Models\ProductoModel;
use Libs\Dao;
use stdClass;

class ProductoDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }
    public function getAll(bool $estado)
    {
        $result = ProductoModel::where('Estado',$estado)
        ->orderBy('Id','DESC')
        ->get();
        return $result;
    }
    public function get(int $Id)
    {
        $model= ProductoModel::find($Id);
         if (is_null($model)) {
            $model = new stdClass();
            $model->Id=0;
            $model->Nombre='';
            $model->Descripcion='';
            $model->Estado=false;
        }
        return $model;
    }
    public function create($obj)
    {
        $model = new ProductoModel();
        $model->Id=$obj->Id;
        $model->Nombre=$obj->Nombre;
        $model->Descripcion=$obj->Descripcion;
        $model->Estado=$obj->Estado;
        return $model->save();//ejecutamos
    }
    public function update($obj)
    {
        $model = ProductoModel::find($obj->Id);
        $model->Id=$obj->Id;
        $model->Nombre=$obj->Nombre;
        $model->Descripcion=$obj->Descripcion;
        $model->Estado=$obj->Estado;
        return $model->save();//ejecutamos
    }
    public function delete($Id)
    {
        $model = ProductoModel::find($Id);
        return $model->delete();//ejecutamos
    }
}