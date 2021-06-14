<?php

namespace App\Daos;

use App\Models\UnidadModel;
use Libs\Dao;
use stdClass;

class UnidadDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }
    public function getAll(bool $estado)
    {
        $result = UnidadModel::where('Estado',$estado)
        ->orderBy('Id','DESC')
        ->get();
        return $result;
    }
    public function get(int $Id)
    {
        $model= UnidadModel::find($Id);
         if (is_null($model)) {
            $model = new stdClass();
            $model->Id=0;
            $model->Nombre='';
            $model->Estado=false;
        }
        return $model;
    }
    public function create($obj)
    {
        $model = new UnidadModel();
        $model->Id=$obj->Id;
        $model->Nombre=$obj->Nombre;
        $model->Estado=$obj->Estado;
        return $model->save();//ejecutamos
    }
    public function update($obj)
    {
        $model = UnidadModel::find($obj->Id);
        $model->Id=$obj->Id;
        $model->Nombre=$obj->Nombre;
        $model->Estado=$obj->Estado;
        return $model->save();//ejecutamos
    }
    public function delete($Id)
    {
        $model = UnidadModel::find($Id);
        return $model->delete();//ejecutamos
    }
}