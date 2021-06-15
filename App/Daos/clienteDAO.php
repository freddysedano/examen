<?php

namespace App\Daos;

use App\Models\ClienteModel;
use Libs\Dao;
use stdClass;

class ClienteDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }
    public function getAll(bool $estado)
    {
        $result = ClienteModel::where('Estado',$estado)
        ->orderBy('Id','DESC')
        ->get();
        return $result;
    }
    public function get(int $Id)
    {
        $model= ClienteModel::find($Id);
         if (is_null($model)) {
            $model = new stdClass();
            $model->Id=0;
            $model->Nombres='';
            $model->Apellidos='';
            $model->Direccion='';
            $model->Telf='';
            $model->CreditoLimite=0;
            $model->Ruc=0;
            $model->Estado=false;
        }
        return $model;
    }
    public function create($obj)
    {
        $model = new ClienteModel();
        $model->Id=$obj->Id;
        $model->Nombres=$obj->Nombres;
        $model->Apellidos=$obj->Apellidos;
        $model->Direccion=$obj->Direccion;
        $model->Telf=$obj->Telf;
        $model->CreditoLimite=$obj->CreditoLimite;
        $model->Ruc=$obj->Ruc;
        $model->Estado=$obj->Estado;
        $model->save();
        $idimg=$model->Id;
        return $idimg;//ejecutamos
    }
    public function update($obj)
    {
        $model = ClienteModel::find($obj->Id);
        $model->Id=$obj->Id;
        $model->Nombres=$obj->Nombres;
        $model->Apellidos=$obj->Apellidos;
        $model->Direccion=$obj->Direccion;
        $model->Telf=$obj->Telf;
        $model->CreditoLimite=$obj->CreditoLimite;
        $model->Ruc=$obj->Ruc;
        $model->Estado=$obj->Estado;
        return $model->save();//ejecutamos
    }
    public function delete($Id)
    {
        $model = ClienteModel::find($Id);
        return $model->delete();//ejecutamos
    }
}