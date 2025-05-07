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

    public function listarConsumo($id_usuario)
    {
        $sql = "SELECT * FROM cadastro_consumo WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarConsumo($consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos, $id_registro)
    {
        $sql = "UPDATE cadastro_consumo SET consumo_de_estacao = ?, consumo_do_servidor = ?, consumo_de_iluminacao = ?, consumo_de_climatizacao = ?, consumo_de_equipamentos = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$consumo_de_estacao, $consumo_do_servidor, $consumo_de_iluminacao, $consumo_de_climatizacao, $consumo_de_equipamentos, $id_registro]);
    }

    public function deletarConsumo($id)
    {
        $sql = "DELETE FROM cadastro_consumo WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function cadastrarfeedback($nome, $feedback, $email, $usuario_id)
    {
        $sql = "INSERT INTO feedback (nome, feedback, email, usuario_id) 
                VALUES (:nome, :feedback, :email, :usuario_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":feedback", $feedback);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":usuario_id", $usuario_id);  
        return $stmt->execute();
    }
    

    
    public function listarfeedback()
    {
        $sql = "SELECT * FROM feedback";  
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

        
}