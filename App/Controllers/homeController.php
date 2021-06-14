<?php
namespace App\Controllers;
use Libs\controller;

class HomeController extends Controller
{
    public function __construct()
    {
         $this->loadDirectoryTemplate("home");
    }
    public function index()
    {
        echo $this->template->render('index');
    }
}