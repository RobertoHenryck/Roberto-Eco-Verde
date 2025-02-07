<?php
class Model
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrarConsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos, $id_usuario)
    {
        $sql = "INSERT INTO cadastro_consumo (consumo_de_estacao, consumo_do_servidor, consumo_de_iluminacao, consumo_de_climatizacao, consumo_de_equipamentos, id_usuario) 
                VALUES (:consumo_de_estacao, :consumo_do_servidor, :consumo_de_iluminacao, :consumo_de_climatizacao, :consumo_de_equipamentos, :id_usuario)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":consumo_de_estacao", $consumo_de_estacao);
        $stmt->bindParam(":consumo_do_servidor", $consumo_do_servidor);
        $stmt->bindParam(":consumo_de_iluminacao", $consumo_de_iluminacao);
        $stmt->bindParam(":consumo_de_climatizacao", $consumo_de_climatizacao);
        $stmt->bindParam(":consumo_de_equipamentos", $consumo_de_equipamentos);
        $stmt->bindParam(":id_usuario", $id_usuario);

        return $stmt->execute();
    }

    public function listarConsumo($usuario_id)
    {
        $sql = "SELECT * FROM cadastro_consumo WHERE id_usuario = $usuario_id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarConsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos, $id_usuario, $id)
    {
        $sql = "UPDATE cadastro_consumo SET consumo_de_estacao = ?, consumo_do_servidor = ?, consumo_de_iluminacao = ?, consumo_de_climatizacao = ?, consumo_de_equipamentos = ?, id_usuario = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos, $id_usuario, $id]);
    }

    public function deletarConsumo($id)
    {
        $sql = "DELETE FROM cadastro_consumo WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
