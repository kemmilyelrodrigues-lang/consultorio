
<?php

namespace App;

class Paciente
{
    public $id;
    public $nome;
    public $cpf;
    public $data_nascimento;
    public $telefone;
    public $email;
    public $endereco;
    public $convenio;
    public $observacao;

    public function cadastrar()
    {
        $db = new DataBase('paciente');

        $dados = [
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'data_nascimento' => $this->data_nascimento,
            'telefone' => $this->telefone,
            'email' => $this->email,
            'endereco' => $this->endereco,
            'convenio' => $this->convenio,
            'observacao' => $this->observacao
        ];

        return $db->insert($dados);
    }

    public static function listar()
    {
        $db = new DataBase('paciente');

        return $db->selectAll();
    }
}
