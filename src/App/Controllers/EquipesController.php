<?php
namespace App\Controllers;
use App\Persistence\ColaboradorDAL;
use Nautilus\Resources\Controller;
use Nautilus\Util\SessionHelper;
use App\Persistence\EventoDAL;

class EquipesController extends Controller
{
    public function index(?array $parameters)
    {
        $this->setParameters($parameters);
        $evento_id = filter_var($this->getParameter("evento"), FILTER_VALIDATE_INT);
        if(empty($evento_id) || !is_numeric($evento_id))
        {
            $this->pushParameter("error", "missing_id");
        } else {
            $evento = EventoDAL::getById($evento_id);
            if(is_null($evento))
            {
                $this->pushParameter("error", "missing_event");
            } else {
                unset($evento_id);
                $colaboradores = ColaboradorDAL::getInEquipe($evento->getId());
                $this->pushParameter("colaboradores", $colaboradores);
                $this->pushParameter("evento", $evento);
            }
        }


        $this->pushParameter("page_title", "Gerenciar Equipes");
        $this->render("index");
    }
}