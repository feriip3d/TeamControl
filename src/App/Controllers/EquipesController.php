<?php
namespace App\Controllers;
use Nautilus\Resources\Controller;
use Nautilus\Util\SessionHelper;

class EquipesController extends Controller
{
    public function index(?array $parameters)
    {
        $this->setParameters($parameters);
        $this->pushParameter("page_title", "Gerenciar Equipes");
        $this->render("index");
    }
}