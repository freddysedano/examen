<?php

namespace App\Daos;
use App\Models\CategoriaModel;
use Libs\Dao;
use stdClass;

class CategoriaDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }
    public function getAll(bool $estado)
    {
        $result = CategoriaModel::where('Estado',$estado)
        ->orderBy('Id','DESC')
        ->get();
        // $result= CategoriaModel::where('Estado',$estado)->orderBy('Id')->paginate();
        return $result;
    }
    public function get(int $Id)
    {
        $model= CategoriaModel::find($Id);
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
        $model = new CategoriaModel();
        $model->Id=$obj->Id;
        $model->Nombre=$obj->Nombre;
        $model->Descripcion=$obj->Descripcion;
        $model->Estado=$obj->Estado;
        $model->save();
        $model->Idguardado=$model->Id;
        return $model;//ejecutamos
    }
    public function update($obj)
    {
        $model = CategoriaModel::find($obj->Id);
        $model->Id=$obj->Id;
        $model->Nombre=$obj->Nombre;
        $model->Descripcion=$obj->Descripcion;
        $model->Estado=$obj->Estado;
        return $model->save();//ejecutamos
    }
    public function delete($Id)
    {
        $model = CategoriaModel::find($Id);
        return $model->delete();//ejecutamos
    }

}