<?php
namespace App\Controllers;
use Nautilus\Resources\Controller;
use Nautilus\Util\ImageHelper;
use Nautilus\Util\SessionHelper;

class IndexController extends Controller
{
    public function index(?array $parameters)
    {
        $this->setParameters($parameters);
        $this->pushParameter("page_title", "Início");
        $this->render("index");
    }
}