<?php

namespace App\Daos;

use App\Models\UsuarioTipoModel;
use Libs\Dao;
use stdClass;

class UsuarioTipoDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }
    public function getAll(bool $estado)
    {
        $result = UsuarioTipoModel::where('Estado',$estado)
        ->orderBy('Id','DESC')
        ->get();
        return $result;
    }
    public function get(int $Id)
    {
        $model= UsuarioTipoModel::find($Id);
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
        $model = new UsuarioTipoModel();
        $model->Id=$obj->Id;
        $model->Nombre=$obj->Nombre;
        $model->Estado=$obj->Estado;
        return $model->save();//ejecutamos
    }
    public function update($obj)
    {
        $model = UsuarioTipoModel::find($obj->Id);
        $model->Id=$obj->Id;
        $model->Nombre=$obj->Nombre;
        $model->Estado=$obj->Estado;
        return $model->save();//ejecutamos
    }
    public function delete($Id)
    {
        $model = UsuarioTipoModel::find($Id);
        return $model->delete();//ejecutamos
    }
}