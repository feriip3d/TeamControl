<?php
namespace App\Models;
use \NumberFormatter;

class Categoria implements \Nautilus\Resources\Model
{
    private int $id;
    private String $descricao;
    private float $valor;

    public function __construct()
    {
        $num_args = func_num_args();
        switch ($num_args) {
            case 3:
                call_user_func_array([$this, "__construct1"], func_get_args());
                break;
            case 2:
                call_user_func_array([$this, "__construct2"], func_get_args());
                break;
            case 0:
                call_user_func([$this, "__construct3"], []);
                break;
        }
    }

    private function __construct1(int $id, String $descricao, float $valor)
    {
        $this->setId($id);
        $this->setDescricao($descricao);
        $this->setValor($valor);
    }

    private function __construct2(String $descricao, float $valor)
    {
        $this->setId(0);
        $this->setDescricao($descricao);
        $this->setData($valor);
    }

    private function __construct3()
    {
        $this->setId(0);
        $this->setDescricao("");
        $this->setData(0);
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

    public function setValor(float $valor)
    {
        if($valor < 0)
            $this->valor = 0;
        else
            $this->valor = $valor;
    }

    public function getValor() : String
    {
        return sprintf("%0.2f",$this->valor);
    }
}