<?php
class Model
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrarConsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos)
    {
        $sql = "INSERT INTO cadastro_consumo(consumo_de_estacao, consumo_do_servidor, consumo_de_iluminacao, consumo_de_climatizacao, consumo_de_equipamentos) 
                VALUES(:consumo_de_estacao, :consumo_do_servidor, :consumo_de_iluminacao, :consumo_de_climatizacao, :consumo_de_equipamentos)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":consumo_de_estacao", $consumo_de_estacao);
        $stmt->bindParam(":consumo_do_servidor", $consumo_do_servidor);
        $stmt->bindParam(":consumo_de_iluminacao", $consumo_de_iluminacao);
        $stmt->bindParam(":consumo_de_climatizacao", $consumo_de_climatizacao);
        $stmt->bindParam(":consumo_de_equipamentos", $consumo_de_equipamentos);

        return $stmt->execute();
    }

    public function listarconsumo()
    {
        $sql = "SELECT * FROM cadastro_consumo  ";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  
}
