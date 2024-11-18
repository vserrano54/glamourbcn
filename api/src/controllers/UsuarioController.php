<?php

class UsuarioController
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function getTodosLosUsuarios()
    {
        $usuarios = $this->usuario->getTodosLosUsuarios();

        echo json_encode($usuarios);
    }

    public function crearUsuario()
    {
        $data = json_decode(file_get_contents("php://input"), true); // Recuperamos parámetros POST

        if ($data != null) {
            if (
                isset($data['email']) && $data['email'] != null && $data['email'] != "" &&
                isset($data['nombre']) && $data['nombre'] != null && $data['nombre'] != "" &&
                isset($data['foto_perfil']) && $data['foto_perfil'] != null && $data['foto_perfil'] != "" &&
                isset($data['password']) && $data['password'] != null && $data['password'] != "" &&
                isset($data['edad']) && $data['edad'] != null && $data['edad'] != ""
            ) {
                $idInsertado = $this->usuario->crearUsuario($data); // Le pasamos los parámetros que nos llegan por POST

                if ($idInsertado != null && $idInsertado != -1) {
                    $resultado = ["mensaje" => "Registro creado con éxito (ID insertado: " . $idInsertado . ")"];
                } else {
                    $resultado = ["mensaje" => "No se ha podido dar de alta el registro en la base de datos."];
                }
            } else {
                $resultado = ["mensaje" => "Faltan algunos parámetros."];
            }
        } else {
            $resultado = ["mensaje" => "No estamos recibiendo ningún parámetro."];
        }

        echo json_encode($resultado); // Pintamos el resultado
    }

    public function actualizarUsuario($id)
    {
        $data = json_decode(file_get_contents("php://input"), true); // Recuperamos parámetros POST

        if ($data != null) {
            if (
                isset($data['email']) && $data['email'] != null && $data['email'] != "" &&
                isset($data['nombre']) && $data['nombre'] != null && $data['nombre'] != "" &&
                isset($data['foto_perfil']) && $data['foto_perfil'] != null && $data['foto_perfil'] != "" &&
                isset($data['password']) && $data['password'] != null && $data['password'] != "" &&
                isset($data['edad']) && $data['edad'] != null && $data['edad'] != ""
            ) {
                $usuarioActualizado = $this->usuario->actualizarUsuario($id, $data); // Le pasamos los parámetros que nos llegan por POST

                if ($usuarioActualizado != null) {
                    $resultado = ["mensaje" => "Registro actualizado correctamente."];
                } else {
                    $resultado = ["mensaje" => "No se ha podido actualizar el registro en la base de datos."];
                }
            } else {
                $resultado = ["mensaje" => "Faltan algunos parámetros."];
            }
        } else {
            $resultado = ["mensaje" => "No estamos recibiendo ningún parámetro."];
        }

        echo json_encode($resultado); // Pintamos el resultado
    }

    public function eliminarUsuario($id)
    {
        $usuarioBorrado = $this->usuario->eliminarUsuario($id);

        if ($usuarioBorrado) {
            $resultado = ["mensaje" => "Registro eliminado correctamente."];
        } else {
            $resultado = ["mensaje" => "No se ha podido eliminar el registro de la base de datos."];
        }

        echo json_encode($resultado);
    }
}
