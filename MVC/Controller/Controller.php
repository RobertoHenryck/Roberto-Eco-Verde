<?php
require_once 'C:\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Model\Model.php';

class Controller
{
    private $Model;

    public function __construct($pdo)
    {
        $this->Model = new Model($pdo);
    }

    public function cadastrarConsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos, $id_usuario)
    {
        return $this->Model->cadastrarConsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos, $id_usuario);
    }

    public function listarConsumo($usuario_id)
    {
        return $this->Model->listarConsumo($usuario_id);
    }

    public function editarConsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos, $id_usuario, $id)
    {
        $this->Model->editarConsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos, $id_usuario, $id);
    }

    public function deletarConsumo($id)
    {
        return $this->Model->deletarConsumo($id);
    }
}
