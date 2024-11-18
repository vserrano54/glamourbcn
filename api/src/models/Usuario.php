<?php

class Usuario
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getTodosLosUsuarios()
    {
        // Ejemplo complejo de SQL con subconsulta/subquery para recuperar el nombre de la receta
        // Además, le hemos puesto un apodo a las tablas para diferenciar de qué tabla quiero recuperar los datos.
        $query = "SELECT * FROM usuario";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function crearUsuario($data)
    {
        $query = "INSERT INTO usuario (email, nombre, foto_perfil, password, edad) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data["email"], $data["nombre"], $data["foto_perfil"], $data["password"], $data["edad"]]);
        $lastId = $this->conn->lastInsertId();

        return $lastId;
    }

    public function actualizarUsuario($id, $data)
    {
        $query = "UPDATE usuario SET email = ?, nombre = ?, foto_perfil = ?, password = ?, edad = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data["email"], $data["nombre"], $data["foto_perfil"], $data["password"], $data["edad"], $id]);

        return true;
    }

    public function eliminarUsuario($id)
    {
        $query = "DELETE FROM usuario WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return true;
    }
}
