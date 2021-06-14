<?php
namespace Libs;
class controller
{
    protected $template;
    protected $dao;
    public function renderView1(string $view, $data = null)
    {
        require_once '../app/Views/'.$view.'.phtml';
        $template = new \League\Plates\Engine(MAINPATH . 'app/views/test');
        $template->setFileExtension('phtml');
        echo $template->render('index');
    }
    public function loadDirectoryTemplate(string $directory)
    {
        $this->template = new \League\Plates\Engine(MAINPATH . 'app/views/'.$directory);
        $this->template->setFileExtension('phtml');
    }
    public function loadDAO(string $daoname)
    {
        $classDao="App\\Daos\\".$daoname. "DAO";
        $this->dao = new $classDao();
    }
}
