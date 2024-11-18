<?php

class FavoritoController
{
    private $favoritos;

    public function __construct()
    {
        $this->favoritos = new Favorito();
    }

    public function crearFavorito()
    {
        $data = json_decode(file_get_contents("php://input"), true); // Recuperamos parámetros POST

        if ($data != null) {
            if (
                isset($data['usuario_id']) && $data['usuario_id'] != null && $data['usuario_id'] != "" &&
                isset($data['servicio_id']) && $data['servicio_id'] != null && $data['servicio_id'] != ""
            ) {
                $idInsertado = $this->favoritos->crearFavorito($data); // Le pasamos los parámetros que nos llegan por POST

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


    public function eliminarFavorito($idServicio)
    {
        $data = json_decode(file_get_contents("php://input"), true); // Recuperamos parámetros POST

        if ($data != null) {
            if (
                isset($data['usuario_id']) && $data['usuario_id'] != null && $data['usuario_id'] != ""
            ) {
                $favoritoBorrado = $this->favoritos->eliminarFavorito($idServicio, $data);

                if ($favoritoBorrado) {
                    $resultado = ["mensaje" => "Registro eliminado correctamente."];
                } else {
                    $resultado = ["mensaje" => "No se ha podido eliminar el registro de la base de datos."];
                }
            } else {
                $resultado = ["mensaje" => "Faltan algunos parámetros."];
            }
        } else {
            $resultado = ["mensaje" => "No estamos recibiendo ningún parámetro."];
        }

        echo json_encode($resultado); // Pintamos el resultado
    }
}
