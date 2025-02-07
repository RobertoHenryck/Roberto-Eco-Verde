<?php
require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Model\Model.php';

class Controller
{
    private $Model;

    public function __construct($pdo)
    {
        $this->Model = new Model($pdo);
    }

    public function cadastrarconsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos)
    {
        return $this->Model->cadastrarconsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos);
    }

    public function listarconsumo()
    {
        return $this->Model->listarconsumo();
    }
    
}
