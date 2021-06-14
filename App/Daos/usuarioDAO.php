<?php

namespace App\Daos;

use App\Models\UsuarioModel;
use Libs\Dao;
use stdClass;

class UsuarioDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }
    public function getAll(bool $estado)
    {
        $result = UsuarioModel::where('Estado',$estado)
        ->orderBy('Id','DESC')
        ->get();
        return $result;
    }
    public function get(int $Id)
    {
        $model= UsuarioModel::find($Id);
         if (is_null($model)) {
            $model = new stdClass();
            $model->Id=0;
            $model->IdTipo=0;
            $model->Nombres='';
            $model->Apellidos='';
            $model->Direccion='';
            $model->Telf='';
            $model->Usuario='';
            $model->Clave='';
            $model->Correo='';
            $model->FCreacion='';
            $model->FEliminacion='';
            $model->Estado=false;
        }
        return $model;
    }
    public function create($obj)
    {
        $model = new UsuarioModel();
        $model->Id=$obj->Id;
        $model->IdTipo=$obj->IdTipo;
        $model->Nombres=$obj->Nombres;
        $model->Apellidos=$obj->Apellidos;
        $model->Direccion=$obj->Direccion;
        $model->Telf=$obj->Telf;
        $model->Usuario=$obj->Usuario;
        $model->Clave=$obj->Clave;
        $model->Correo=$obj->Correo;
        $model->FCreacion=$obj->FCreacion;
        $model->FEliminacion=$obj->FEliminacion;
        $model->Estado=$obj->Estado;
        return $model->save();//ejecutamos
    }
    public function update($obj)
    {
        $model = UsuarioModel::find($obj->Id);
        $model->Id=$obj->Id;
        $model->IdTipo=$obj->IdTipo;
        $model->Nombres=$obj->Nombres;
        $model->Apellidos=$obj->Apellidos;
        $model->Direccion=$obj->Direccion;
        $model->Telf=$obj->Telf;
        $model->Usuario=$obj->Usuario;
        $model->Clave=$obj->Clave;
        $model->Correo=$obj->Correo;
        $model->FCreacion=$obj->FCreacion;
        $model->FEliminacion=$obj->FEliminacion;
        $model->Estado=$obj->Estado;
        return $model->save();//ejecutamos
    }
    public function delete($Id)
    {
        $model = UsuarioModel::find($Id);
        return $model->delete();//ejecutamos
    }
}