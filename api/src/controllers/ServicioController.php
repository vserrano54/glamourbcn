<?php

class ServicioController
{
    private $servicio;

    public function __construct()
    {
        $this->servicio = new Servicio();
    }

    public function getTodosLosServicios()
    {
        $servicios = $this->servicio->getTodosLosServicios();

        // Aquí le podemos asignar un atributo más en el array.
        for ($i = 0; $i < sizeof($servicios); $i++) {
            $servicio = $servicios[$i];
            $servicioId = $servicio["id"];

            // En función a un campo, le añadimos el atributo "color" a nuestra receta antes de devolverla de la API
            if ($servicio["dificultad"] == "fácil") {
                $servicio["color"] = "verde";
            } else if ($servicio["dificultad"] == "media") {
                $servicio["color"] = "amarillo";
            } else if ($servicio["dificultad"] == "difícil") {
                $servicio["color"] = "rojo";
            }
            /*
            // Vamos a agregar todos los ingredientes de la receta a la receta.
            $ingredientesReceta = $this->receta->getIngredientesReceta($recetaId);
            $receta["ingredientes"] = $ingredientesReceta;


            */
            $servicios[$i] = $servicio;
            
        }

        echo json_encode($servicios);
    }


    public function getServiciosPaginados($page, $limit, $search)
    {
        // Caramos las servicio filtradas para la tabla
        $servicios = $this->servicio->getServiciosPaginados($page, $limit, $search);

        // Cargamos todas los servicios para el recuento
        $todasLosServicios = $this->servicio->getTodosLosServicios();
        $totalServicios = sizeof($todasLosServicios);
        
        // Cargamos todas las servicios con el FILTRO para el recuento
        $serviciosFiltro = $this->receta->getServiciosFiltro($search);
        $totalServiciosFiltro = sizeof($serviciosFiltro);


        // Aquí le podemos asignar un atributo más en el array.
        for ($i = 0; $i < sizeof($servicios); $i++) {
            $servicio = $servicios[$i];
            $servicioId = $servicio["id"];

            // En función a un campo, le añadimos el atributo "color" a nuestra receta antes de devolverla de la API
            if ($servicio["dificultad"] == "fácil") {
                $servicio["color"] = "verde";
            } else if ($servicio["dificultad"] == "media") {
                $servicio["color"] = "amarillo";
            } else if ($servicio["dificultad"] == "difícil") {
                $servicio["color"] = "rojo";
            }

            // Vamos a agregar todos los ingredientes de la receta a la receta.
          /*  $ingredientesReceta = $this->receta->getIngredientesReceta($recetaId);
            $receta["ingredientes"] = $ingredientesReceta;
            */
            $servicios[$i] = $servicio;
            
        }

        // Para que el datatable muestre la cantidad de registros bien, hay que devolverle el total y el total de los filtrados.
        $respuestaDatatable = [
            "data" => $servicios,
            "recordsTotal" => $totalServicios,
            "recordsFiltered" => $totalServiciosFiltro
        ];

        echo json_encode($respuestaDatatable);
    }

    public function getServiciosFiltros($nombre, $dificultad, $duracionMin, $duracionMax, $destacada)
    {
        $servicios = $this->servicio->getserviciosFiltros($nombre, $dificultad, $duracionMin, $duracionMax, $destacada);

        // Aquí le podemos asignar un atributo más en el array.
        for ($i = 0; $i < sizeof($servicios); $i++) {
            $servicio = $servicios[$i];
            $servicioId = $servicio["id"];

            // En función a un campo, le añadimos el atributo "color" a nuestra receta antes de devolverla de la API
            if ($servicio["dificultad"] == "fácil") {
                $servicio["color"] = "verde";
            } else if ($servicio["dificultad"] == "media") {
                $servicio["color"] = "amarillo";
            } else if ($servicio["dificultad"] == "difícil") {
                $servicio["color"] = "rojo";
            }
            /*
            // Vamos a agregar todos los ingredientes de la receta a la receta.
            $ingredientesReceta = $this->receta->getIngredientesReceta($recetaId);
            $receta["ingredientes"] = $ingredientesReceta;
            */
            $servicios[$i] = $servicio;
        }

        echo json_encode($servicios);
    }

    public function getServicioById($idServicio)
    {
        $servicios = $this->servicio->getServicioById($idServicio);

        if ($servicios != null && sizeof($servicios) > 0) {
            // Como solo va ha ser un servicio, recuperamos la primera del array que devolvemos de la QUERY.
            $servicio = $servicios[0];

            // En función a un campo, le añadimos el atributo "color" a nuestra receta antes de devolverla de la API
            if ($servicio["dificultad"] == "fácil") {
                $servicio["color"] = "verde";
            } else if ($servicio["dificultad"] == "media") {
                $servicio["color"] = "amarillo";
            } else if ($servicio["dificultad"] == "difícil") {
                $servicio["color"] = "rojo";
            }
            /*
            // Vamos a agregar todos los ingredientes de la receta a la receta.
            $ingredientesReceta = $this->receta->getIngredientesReceta($idReceta);
            $receta["ingredientes"] = $ingredientesReceta;
            */

            echo json_encode($servicio);
        } else {
            echo json_encode(null);
        }
    }

    public function getServiciosDestacados()
    {
        $servicios = $this->servicio->getServiciosDestacados();

        // Aquí le podemos asignar un atributo más en el array.
        for ($i = 0; $i < sizeof($servicios); $i++) {
            $servicio = $servicios[$i];
            $servicioId = $servicio["id"];

            // En función a un campo, le añadimos el atributo "color" a nuestra receta antes de devolverla de la API
            if ($servicio["dificultad"] == "fácil") {
                $servicio["color"] = "verde";
            } else if ($servicio["dificultad"] == "media") {
                $servicio["color"] = "amarillo";
            } else if ($servicio["dificultad"] == "difícil") {
                $servicio["color"] = "rojo";
            }
/*
            // Vamos a agregar todos los ingredientes de la receta a la receta.
            $ingredientesReceta = $this->receta->getIngredientesReceta($recetaId);
            $receta["ingredientes"] = $ingredientesReceta;
*/
            $servicios[$i] = $servicio;
        }

        echo json_encode($servicios);
    }

    public function getServiciosByNombre($nombre)
    {
        $servicios = $this->servicio->buscarPorNombre($nombre);

        // Aquí le podemos asignar un atributo más en el array.
        for ($i = 0; $i < sizeof($servicios); $i++) {
            $servicio = $servicios[$i];
            $servicioId = $servicio["id"];

            /*
            // Vamos a agregar todos los ingredientes de la receta a la receta.
            $ingredientesReceta = $this->receta->getIngredientesReceta($recetaId);
            $receta["ingredientes"] = $ingredientesReceta;
            */

            $servicios[$i] = $servicio;
        }

        echo json_encode($servicios);
    }

    public function getServiciosFavoritasUsuario($idUsuario)
    {
        $servicios = $this->servicio->buscarPorFavUsuario($idUsuario);

        // Aquí le podemos asignar un atributo más en el array.
        for ($i = 0; $i < sizeof($servicios); $i++) {
            $serevicio = $servicios[$i];
            $servicioId = $servicio["id"];
            /*
            // Vamos a agregar todos los ingredientes de la receta a la receta.
            $ingredientesReceta = $this->receta->getIngredientesReceta($recetaId);
            $receta["ingredientes"] = $ingredientesReceta;
            */
            $servicios[$i] = $serevicio;
        }

        echo json_encode($servicios);
    }

    public function crearServicio()
    {
        $data = json_decode(file_get_contents("php://input"), true); // Recuperamos parámetros POST

        if ($data != null) {
            if (
                isset($data['nombre']) && $data['nombre'] != null && $data['nombre'] != "" &&
                isset($data['descripcion']) && $data['descripcion'] != null && $data['descripcion'] != "" &&
                isset($data['duracion']) && $data['duracion'] != null && $data['duracion'] != "" &&
                isset($data['dificultad']) && $data['dificultad'] != null && $data['dificultad'] != "" &&
                isset($data['foto']) && $data['foto'] != null && $data['foto'] != "" 
            ) {
                $idInsertado = $this->servicio->crearServicio($data); // Le pasamos los parámetros que nos llegan por POST

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

    public function actualizarServicio($id)
    {
        $data = json_decode(file_get_contents("php://input"), true); // Recuperamos parámetros POST

        if ($data != null) {
            if (
                isset($data['nombre']) && $data['nombre'] != null && $data['nombre'] != "" &&
                isset($data['descripcion']) && $data['descripcion'] != null && $data['descripcion'] != "" &&
                isset($data['duracion']) && $data['duracion'] != null && $data['duracion'] != "" &&
                isset($data['dificultad']) && $data['dificultad'] != null && $data['dificultad'] != "" &&
                isset($data['foto']) && $data['foto'] != null && $data['foto'] != ""
            ) {
                $servicioActualizado = $this->servicio->actualizarServicio($id, $data); // Le pasamos los parámetros que nos llegan por POST

                if ($servicioActualizado != null) {
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

    public function eliminarServicio($id)
    {
        $servicioBorrado = $this->servicio->eliminarServicio($id);

        if ($servicioBorrado) {
            $resultado = ["mensaje" => "Registro eliminado correctamente."];
        } else {
            $resultado = ["mensaje" => "No se ha podido eliminar el registro de la base de datos."];
        }

        echo json_encode($resultado);
    }
}
