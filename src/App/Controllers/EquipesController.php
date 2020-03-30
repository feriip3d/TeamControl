<?php
namespace App\Controllers;
use App\Models\Colaborador;
use App\Persistence\ColabFuncaoDAL;
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
        $acao = filter_input(INPUT_POST, "acao", FILTER_SANITIZE_STRING);

        if(!empty($acao))
        {
            if($acao == "add_colab")
            {
                $method = func_get_arg(1);
                if ($method == "POST") {
                    $evento_id = filter_input(INPUT_POST, "evento_id", FILTER_VALIDATE_INT);
                    $valor_pago = filter_input(INPUT_POST, "i_colab_value", FILTER_VALIDATE_FLOAT);
                    $id_new_colab = filter_input(INPUT_POST, "i_colab_id", FILTER_VALIDATE_INT);
                    $func_new_colab = filter_input(INPUT_POST, "i_colab_func", FILTER_VALIDATE_INT);
                    if (
                        (is_numeric($id_new_colab) && $id_new_colab > 0) &&
                        (is_numeric($func_new_colab) && $func_new_colab > 0)
                    ) {
                        $colab = ColaboradorDAL::getById($id_new_colab);
                        $funcao = ColabFuncaoDAL::getById($func_new_colab);
                        $evento = EventoDAL::getById($evento_id);

                        if (!is_null($colab) && !is_null($funcao) && !is_null($funcao)) {
                            if (ColaboradorDAL::insertIntoEquipe($colab, $funcao, $evento, $valor_pago)) {
                                $json = [
                                    "error" => false,
                                    "return" => [
                                        "message" => "Colaborador Inserido"
                                    ]
                                ];
                            }
                        } else {
                            $json = [
                                "error" => true,
                                "error_code" => 1,
                                "return" => [
                                    "message" => "Parâmetros Invalidos"
                                ]
                            ];
                        }
                    } else {
                        $json = [
                            "error" => true,
                            "error_code" => 1,
                            "return" => [
                                "message" => "Parâmetros Invalidos"
                            ]
                        ];
                    }
                } else {
                    $json = [];
                }

                echo json_encode($json);
            } else if($acao == "list_colab") {
                $evento_id = filter_input(INPUT_POST, "evento_id", FILTER_VALIDATE_INT);
                $colabs = ColaboradorDAL::getInEquipe($evento_id);
                $colaboradores = [];
                foreach($colabs as $colab)
                {
                    $colaboradores[] = $colab->toArray();
                }

                echo json_encode($colaboradores);
            } else if ($acao == "del_colab") {
                $evento_id = filter_input(INPUT_POST, "evento_id", FILTER_VALIDATE_INT);
                $colab_id = filter_input(INPUT_POST, "colab_id", FILTER_VALIDATE_INT);

                if(ColaboradorDAL::removeFromEquipe($colab_id, $evento_id))
                {
                    $json = [
                        "error" => false,
                        "result" => [
                            "message" => "Colaborador removido"
                        ]
                    ];
                } else {
                    $json = [
                        "error" => true,
                        "result" => [
                            "message" => "Falha ao remover colaborador"
                        ]
                    ];
                }

                echo json_encode($json);
            }
        } else {
            if(empty($evento_id) || !is_numeric($evento_id))
            {
                $this->pushParameter("error", "missing_id");
                // TELA PARA CONSULTA
            } else {
                $evento = EventoDAL::getById($evento_id);
                if(is_null($evento))
                {
                    $this->pushParameter("error", "missing_event");
                } else {
                    unset($evento_id);
                    $funcoes = ColabFuncaoDAL::getByStatement("1", []);
                    $colab_disp = ColaboradorDAL::getNotInEquipe($evento->getId());

                    $this->pushParameter("colab_disp", $colab_disp);
                    $this->pushParameter("funcoes", $funcoes);
                    $this->pushParameter("evento", $evento);
                }
            }

            $this->pushParameter("page_title", "Gerenciar Equipes");
            $this->render("index");
        }
    }
}