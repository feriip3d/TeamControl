<?php
namespace App\Models;
use App\Persistence\CategoriaDAL;
use App\Persistence\LocalDAL;
use Nautilus\Util\MiscHelper;
use App\Models\Categoria;
use App\Models\Local;

class Evento implements \Nautilus\Resources\Model
{
    private int $id;
    private String $descricao;
    private String $data;
    private int $qtde_pessoas;
    private Local $local;
    private Categoria $categoria;
    private ?Funcao $funcao;

    public function __construct()
    {
        $num_args = func_num_args();
        switch ($num_args) {
            case 6:
                call_user_func_array([$this, "__construct1"], func_get_args());
                break;
            case 5:
                call_user_func_array([$this, "__construct2"], func_get_args());
                break;
        }
    }

    private function __construct1(int $id, String $descricao, String $data, int $qtde_pessoas, $id_local, $id_categoria)
    {
        $this->setId($id);
        $this->setDescricao($descricao);
        $this->setData($data);
        $this->setQtdePessoas($qtde_pessoas);
        $this->setLocal($id_local);
        $this->setCategoria($id_categoria);
    }

    private function __construct2(String $descricao, String $data, int $qtde_pessoas, $id_local, $id_categoria)
    {
        $this->setId(0);
        $this->setDescricao($descricao);
        $this->setData($data);
        $this->setQtdePessoas($qtde_pessoas);
        $this->setLocal($id_local);
        $this->setCategoria($id_categoria);
    }

    public function setId(int $id)
    {
        if($id < 0)
            $this->id = 0;
        else
            $this->id = $id;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setDescricao(String $descricao)
    {
        $this->descricao = $descricao;
    }

    public function getDescricao() : String
    {
        return $this->descricao;
    }

    public function setData(String $data)
    {
        $data_ver = explode('-', $data);
        if(checkdate($data_ver[1], $data_ver[2], $data_ver[0]))
        {
            $this->data = $data;
        } else {
            $this->data = "0000-00-00";
        }
    }

    public function getData() : String
    {
        return MiscHelper::to_br_dateformat($this->data);
    }

    public function setQtdePessoas(int $qtde_pessoas)
    {
        if($qtde_pessoas < 0)
            $this->qtde_pessoas = 0;
        else
            $this->qtde_pessoas = $qtde_pessoas;
    }

    public function getQtdePessoas() : int
    {
        return $this->qtde_pessoas;
    }

    public function setLocal($id_local)
    {
        if($id_local <= 0)
            $this->local = new Local();
        else
            $this->local = LocalDAL::getById($id_local);
    }

    public function getLocal() : Local
    {
        return $this->local;
    }

    public function setCategoria($id_categoria)
    {
        if($id_categoria <= 0)
            $this->categoria = new Categoria();
        else
            $this->categoria = CategoriaDAL::getById($id_categoria);
    }

    public function getCategoria() : Categoria
    {
        return $this->categoria;
    }
}