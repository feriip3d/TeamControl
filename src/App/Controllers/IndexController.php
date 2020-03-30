<?php
namespace App\Controllers;
use App\Persistence\EventoDAL;
use Nautilus\Resources\Controller;
use Nautilus\Util\ImageHelper;
use Nautilus\Util\SessionHelper;

class IndexController extends Controller
{
    public function index(?array $parameters)
    {
        $eventos = EventoDAL::getByStatement("1 ORDER BY id DESC LIMIT 5", []);

        $this->setParameters($parameters);
        $this->pushParameter("eventos", $eventos);
        $this->pushParameter("page_title", "Início");
        $this->render("index");
    }
}