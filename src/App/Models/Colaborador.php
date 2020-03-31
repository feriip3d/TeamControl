<?php
namespace App\Models;
use App\Persistence\ColabFuncaoDAL;
use Nautilus\Util\MiscHelper;

class Colaborador implements \Nautilus\Resources\Model
{
    private int $id;
    private String $nome;
    private String $telefone;
    private String $celular;
    private String $data_nascimento;
    private String $cpf;
    private ?ColabFuncao $funcao;

    public function __construct()
    {
        $num_args = func_num_args();
        switch ($num_args) {
            case 7:
                call_user_func_array([$this, "__construct4"], func_get_args());
                break;
            case 6:
                call_user_func_array([$this, "__construct1"], func_get_args());
                break;
            case 5:
                call_user_func_array([$this, "__construct2"], func_get_args());
                break;
            case 0:
                call_user_func([$this, "__construct3"], []);
                break;
        }
    }

    private function __construct1(int $id, String $nome, String $telefone, String $celular, String $data_nascimento, String $cpf)
    {

        $this->setId($id);
        $this->setNome($nome);
        $this->setTelefone($telefone);
        $this->setCelular($celular);
        $this->setDataNascimento($data_nascimento);
        $this->setCPF($cpf);
        $this->setFuncao(0);
    }

    private function __construct2(String $nome, String $telefone, String $celular, String $data_nascimento, String $cpf)
    {
        $this->setId(0);
        $this->setNome($nome);
        $this->setTelefone($telefone);
        $this->setCelular($celular);
        $this->setDataNascimento($data_nascimento);
        $this->setCPF($cpf);
        $this->setFuncao(0);
    }

    private function __construct3()
    {
        $this->setId(0);
        $this->setNome("");
        $this->setTelefone("");
        $this->setCelular("");
        $this->setDataNascimento("0000-00-00");
        $this->setCPF("");
        $this->setFuncao(0);
    }

    private function __construct4(int $id, String $nome, String $telefone, String $celular, String $data_nascimento, String $cpf, int $id_funcao)
    {
        $this->setId($id);
        $this->setNome($nome);
        $this->setTelefone($telefone);
        $this->setCelular($celular);
        $this->setDataNascimento($data_nascimento);
        $this->setCPF($cpf);
        $this->setFuncao($id_funcao);
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

    public function setTelefone(String $telefone)
    {
        $this->telefone = $telefone;
    }

    public function getTelefone() : String
    {
        return MiscHelper::mask($this->telefone, "(##)####-####");
    }

    public function setCelular(String $celular)
    {
        $this->celular = $celular;
    }

    public function getCelular() : String
    {
        return MiscHelper::mask($this->celular, "(##)#####-####");
    }

    public function setDataNascimento(String $data)
    {
        $data_ver = explode('-', $data);
        if(checkdate($data_ver[1], $data_ver[2], $data_ver[0]))
        {
            $this->data_nascimento = $data;
        } else {
            $this->data_nascimento = "0000-00-00";
        }
    }

    public function getDataNascimento() : String
    {
        return MiscHelper::to_br_dateformat($this->data_nascimento);
    }

    public function setCPF(String $cpf)
    {
        $this->cpf = $cpf;
    }

    public function getCPF() : String
    {
        return MiscHelper::mask($this->cpf, '###.###.###-##');
    }

    public function setFuncao(int $id_funcao)
    {
        if($id_funcao <= 0)
        {
            $this->funcao = null;
        } else {
            $this->funcao = ColabFuncaoDAL::getById($id_funcao);
        }
    }

    public function getFuncao() : ColabFuncao
    {
        return $this->funcao;
    }

    public function serialize()
    {
        $instance = get_object_vars($this);
        $instance['data_nascimento'] = $this->getDataNascimento();
        $instance['cpf'] = $this->getCPF();
        $instance['telefone'] = $this->getTelefone();
        $instance['celular'] = $this->getCelular();
        $instance['funcao'] = $this->funcao->getNome();
        $instance['acoes'] = "";
        return json_encode($instance);
    }

    public function toArray()
    {
        $instance = get_object_vars($this);
        $instance['data_nascimento'] = MiscHelper::to_br_dateformat($instance['data_nascimento']);
        $instance['cpf'] = $this->getCPF();
        $instance['telefone'] = $this->getTelefone();
        $instance['celular'] = $this->getCelular();
        $instance['funcao'] = $this->funcao->getNome();
        $instance['acoes'] = "";
        return $instance;
    }
}