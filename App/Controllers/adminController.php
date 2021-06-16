<?php
namespace App\Controllers;
use Libs\controller;

class AdminController extends Controller
{
    public function __construct()
    {
         $this->loadDirectoryTemplate("admin");
    }
    public function index()
    {
        echo $this->template->render('index');
    }
}