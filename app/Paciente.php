<?php

namespace App;

use PDO;

class Paciente extends Pessoa
{
    public $id;
    public $convenio;
    public $observacao;
    public $criado_em;
    public $atualizado_em;

    // Cadastrar paciente
    public function cadastrar()
    {
        $db = new DataBase('paciente');

        return $db->insert([
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'data_nascimento' => $this->data_nascimento,
            'telefone' => $this->telefone,
            'email' => $this->email,
            'endereco' => $this->endereco,
            'convenio' => $this->convenio,
            'observacao' => $this->observacao
        ]);
    }

    // Alterar paciente
    public function alterar()
    {
        $db = new DataBase('paciente');

        return $db->update('id = ' . (int) $this->id, [
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'data_nascimento' => $this->data_nascimento,
            'telefone' => $this->telefone,
            'email' => $this->email,
            'endereco' => $this->endereco,
            'convenio' => $this->convenio,
            'observacao' => $this->observacao
        ]);
    }

    // Deletar paciente
    public function delete()
    {
        $db = new DataBase('paciente');

        return $db->delete('id = ' . (int) $this->id);
    }

    // Listar pacientes
    public static function listar()
    {
        $db = new DataBase('paciente');

        $resultado = $db->execute(
            "SELECT * FROM paciente ORDER BY nome ASC"
        );

        $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

        $pacientes = [];

        foreach ($dados as $dado) {
            $paciente = new self();

            $paciente->id = $dado['id'];
            $paciente->nome = $dado['nome'];
            $paciente->cpf = $dado['cpf'];
            $paciente->data_nascimento = $dado['data_nascimento'];
            $paciente->telefone = $dado['telefone'];
            $paciente->email = $dado['email'];
            $paciente->endereco = $dado['endereco'];
            $paciente->convenio = $dado['convenio'];
            $paciente->observacao = $dado['observacao'];

            $paciente->criado_em = $dado['criado_em'] ?? null;
            $paciente->atualizado_em = $dado['atualizado_em'] ?? null;

            $pacientes[] = $paciente;
        }

        return $pacientes;
    }
}
