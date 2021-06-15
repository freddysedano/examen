<?php namespace Libs;

class controller {
    protected $template;
    protected $dao;

    public function renderView1(string $view, $data=null) {
        require_once '../app/Views/'.$view.'.phtml';
        $template=new \League\Plates\Engine(MAINPATH . 'app/views/test');
        $template->setFileExtension('phtml');
        echo $template->render('index');
    }

    public function loadDirectoryTemplate(string $directory) {
        $this->template=new \League\Plates\Engine(MAINPATH . 'app/views/'.$directory);
        $this->template->setFileExtension('phtml');
    }

    public function loadDAO(string $daoname) {
        $classDao="App\\Daos\\".$daoname. "DAO";
        $this->dao=new $classDao();
    }

    public function Createimg($idimg,$nombre) {
        $imagen=$_FILES['imagen']['name'];
        if(isset($imagen) && $imagen !="") {
            $tipo=$_FILES['imagen']['type'];
            $temp=$_FILES['imagen']['tmp_name'];
            if( !((strpos($tipo, 'gif') || strpos($tipo, 'jpg')|| strpos($tipo, 'png')|| strpos($tipo, 'jpeg')))) {
                $_SESSION['mensaje']='solo se permite archivos jpeg, gif, webp';
                $_SESSION['tipo']='danger';
            }
            else {
                move_uploaded_file($temp, ROOT.'/images/'.$nombre.'/'.$nombre.'_'.$idimg.'.'.substr($tipo, 6, 4));
            }
        }
    }
}