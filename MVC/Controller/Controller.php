<?php
require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Model\Model.php';

class Controller
{
    private $Model;

    public function __construct($pdo)
    {
        $this->Model = new Model($pdo);
    }

    public function cadastrarConsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos)
    {
        return $this->Model->cadastrarConsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos);
    }

    public function listarConsumo()
    {
        return $this->Model->listarConsumo();
    }

    public function editarConsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos, $id)
    {
        // Corrigi os parâmetros, que estavam com nomes errados (ex: $nome, $data_hora, etc.).
        $this->Model->editarConsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos, $id);
    }

    public function deletarConsumo($id)
    {
        return $this->Model->deletarConsumo($id);
    }

   
}
