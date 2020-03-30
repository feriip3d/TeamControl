<?php
namespace App\Models;

class ColabFuncao implements \Nautilus\Resources\Model
{
    private int $id;
    private String $nome;

    public function __construct()
    {
        $num_args = func_num_args();
        switch ($num_args) {
            case 2:
                call_user_func_array([$this, "__construct1"], func_get_args());
                break;
            case 1:
                call_user_func_array([$this, "__construct2"], func_get_args());
                break;
            case 0:
                call_user_func([$this, "__construct3"], []);
                break;
        }
    }

    private function __construct1(int $id, String $nome)
    {
        $this->setId($id);
        $this->setNome($nome);
    }

    private function __construct2(String $nome)
    {
        $this->setId(0);
        $this->setNome($nome);
    }

    public function setId(int $id)
    {
        if($id < 0)
        {
            $this->id = 0;
        } else {
            $this->id = $id;
        }
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setNome(String $nome)
    {
        $this->nome = $nome;
    }

    public function getNome() : String
    {
        return $this->nome;
    }
}