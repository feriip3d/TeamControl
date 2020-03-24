<?php
namespace App\Controllers;
use App\Persistence\UserDAL;
use App\Models\User;
use Nautilus\Resources\Controller;

class UsuariosController extends Controller
{
    function index($parameters)
    {
        $this->setParameters($parameters);
        $this->pushParameter("page_title", "Usuários");
        $this->pushParameter("page_subheading", "> Consultar usuários");
        $this->render("index");
    }

    function cadastrar($parameters)
    {
        $this->setParameters($parameters);
        $this->pushParameter("page_title", "Usuários");
        $this->pushParameter("page_subheading", "> Cadastar novo usuário");
        $this->render("cadastrar");
    }

    function visualizar($parameters)
    {
        $this->setParameters($parameters);
        $id_user = $this->getParameter('id');
        if(!empty($id_user) && $id_user > 0)
        {
            $user = UserDAL::getByStatement('id = ?',[$id_user]);
            $this->pushParameter("user_result", $user[0]);
            $this->pushParameter("page_title", "Usuários");
            $this->pushParameter("page_subheading", "> Visualizar Usuário");
            $this->render("visualizar");
        } else {
            header("Location: /usuarios");
        }
    }

    function consultar($parameters)
    {
        $method = func_get_arg(1);
        if($method == 'POST')
        {
            $parameters['search_term'] =
                filter_input(INPUT_POST, "return_type", FILTER_SANITIZE_STRING);
            $parameters['return_type'] =
                filter_input(INPUT_POST, "return_type", FILTER_SANITIZE_STRING);

            $this->setParameters($parameters);
            if($parameters['return_type'] == 'json')
            {
                $json = array();
                $user = UserDAL::getByStatement('username LIKE ?',['%e%']);
                foreach($user as $u)
                {
                    $json[] = $u->toArray();
                }

                header('Content-Type: application/json');
                echo json_encode($json);
            } else {
                $this->pushParameter("page_title", "Usuários");
                $this->pushParameter("page_subheading", "> Consultar usuários");
            }
        }
    }
}