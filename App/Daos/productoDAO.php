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
            $model->IdMarca=0;
            $model->IdCategoria=0;
            $model->IdUnidad=0;
            $model->Nombre='';
            $model->Descripcion='';
            $model->PrecioCosto=0;
            $model->Precioventa=0;
            $model->Stock=0;
            $model->StockMinimo=0;
            $model->Estado=false;
        }
        return $model;
    }
    public function create($obj)
    {
        $model = new ProductoModel();
        $model->Id=$obj->Id;
        $model->IdMarca=$obj->IdMarca;
        $model->IdCategoria=$obj->IdCategoria;
        $model->IdUnidad=$obj->IdUnidad;
        $model->Nombre=$obj->Nombre;
        $model->Descripcion=$obj->Descripcion;
        $model->PrecioCosto=$obj->PrecioCosto;
        $model->Precioventa=$obj->Precioventa;
        $model->Stock=$obj->Stock;
        $model->StockMinimo=$obj->StockMinimo;
        $model->Estado=$obj->Estado;
        $model->save();
        $model->Idguardado=$model->Id;
        return $model;//ejecutamos
    }
    public function update($obj)
    {
        $model = ProductoModel::find($obj->Id);
        $model->Id=$obj->Id;
        $model->IdMarca=$obj->IdMarca;
        $model->IdCategoria=$obj->IdCategoria;
        $model->IdUnidad=$obj->IdUnidad;
        $model->Nombre=$obj->Nombre;
        $model->Descripcion=$obj->Descripcion;
        $model->PrecioCosto=$obj->PrecioCosto;
        $model->Precioventa=$obj->Precioventa;
        $model->Stock=$obj->Stock;
        $model->StockMinimo=$obj->StockMinimo;
        $model->Estado=$obj->Estado;
        return $model->save();//ejecutamos
    }
    public function delete($Id)
    {
        $model = ProductoModel::find($Id);
        return $model->delete();//ejecutamos
    }
}