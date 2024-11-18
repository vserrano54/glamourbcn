<?php

class Favorito
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function crearFavorito($data)
    {
        $query = "INSERT INTO favorito (usuario_id, servicio_id) VALUES (?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data["usuario_id"], $data["servicio_id"]]);
        $lastId = $this->conn->lastInsertId();

        return $lastId;
    }

    public function eliminarFavorito($idServicio, $data)
    {
        $query = "DELETE FROM favorito WHERE servicio_id= ? and usuario_id= ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idServicio, $data["usuario_id"]]);

        return true;
    }
}
