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

    public function listarConsumo()
    {
        $sql = "SELECT * FROM cadastro_consumo";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para editar o consumo
    public function editarConsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos, $id)
    {
        $sql = "UPDATE cadastro_consumo SET consumo_de_estacao = ?, consumo_do_servidor = ?, consumo_de_iluminacao = ?, consumo_de_climatizacao = ?, consumo_de_equipamentos = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos, $id]);
    }

    // Método para deletar o consumo
    public function deletarConsumo($id)
    {
        $sql = "DELETE FROM cadastro_consumo WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
