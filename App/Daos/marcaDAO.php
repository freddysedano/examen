<?php

namespace App\Daos;

use App\Models\MarcaModel;
use Libs\Dao;
use stdClass;

class MarcaDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }
    public function getAll(bool $estado)
    {
        $result = MarcaModel::where('Estado',$estado)
        ->orderBy('Id','DESC')
        ->get();
        return $result;
    }
    public function get(int $Id)
    {
        $model= MarcaModel::find($Id);
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
        $model = new MarcaModel();
        $model->Id=$obj->Id;
        $model->Nombre=$obj->Nombre;
        $model->Descripcion=$obj->Descripcion;
        $model->Estado=$obj->Estado;
        return $model->save();//ejecutamos
    }
    public function update($obj)
    {
        $model = MarcaModel::find($obj->Id);
        $model->Id=$obj->Id;
        $model->Nombre=$obj->Nombre;
        $model->Descripcion=$obj->Descripcion;
        $model->Estado=$obj->Estado;
        return $model->save();//ejecutamos
    }
    public function delete($Id)
    {
        $model = MarcaModel::find($Id);
        return $model->delete();//ejecutamos
    }
}