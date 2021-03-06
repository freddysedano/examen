<?php

namespace Libs;
use \Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public function __construct(){
        $cpsule= new Capsule();
        $cpsule->addConnection([
            'driver'=> env('DB_CONNECTION','mysql'),
            'host'=>env('DB_HOST'),
            'database'=>env('DB_DATABASE'),
            'username'=>env('DB_USERNAME'),
            'password'=>env('DB_PASSWORD'),
            'charset'=>env('DB_CHARSET'),
            'collation'=>env('utf8_unicode_ci'),
            'prefix'=>'',
        ]);
        $cpsule->setAsGlobal();
        $cpsule->bootEloquent();
    }
}
