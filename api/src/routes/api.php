<?php

/*
------------------------------------------------------------------------------------------------------


 ██████  ██████  ███    ██ ███████ ██  ██████  ██    ██ ██████   █████   ██████ ██  ██████  ███    ██ 
██      ██    ██ ████   ██ ██      ██ ██       ██    ██ ██   ██ ██   ██ ██      ██ ██    ██ ████   ██ 
██      ██    ██ ██ ██  ██ █████   ██ ██   ███ ██    ██ ██████  ███████ ██      ██ ██    ██ ██ ██  ██ 
██      ██    ██ ██  ██ ██ ██      ██ ██    ██ ██    ██ ██   ██ ██   ██ ██      ██ ██    ██ ██  ██ ██ 
 ██████  ██████  ██   ████ ██      ██  ██████   ██████  ██   ██ ██   ██  ██████ ██  ██████  ██   ████ 
                                                                                                      
                                                                                                      
------------------------------------------------------------------------------------------------------
*/


/***************CONEXION***************************/
require_once '../config/database.php';

/***************MODELOS***************************/
require_once '../src/models/Usuario.php';
require_once '../src/models/Servicio.php';




/****************CONTROLLER*************************/
require_once '../src/controllers/UsuarioController.php';
require_once '../src/controllers/ServicioController.php';



/************Instancia de Objetos Controller************/
$usuarioController = new UsuarioController();
$servicioController = new ServicioController();


/*******************Metodos************************/
$method = $_SERVER['REQUEST_METHOD']; // Saber si nos está llamando por: GET, POST, PUT, DELETE
$path = $_SERVER['REQUEST_URI']; // La ruta a la que llama la web. cocinillas.com/api/getrecetas (/getrecetas)

$basePath = "/glamourbcn/api/public";

/*********Obtener el path completo de la URL*********/
$path = str_replace($basePath, '', $path);

$MENSAJE_ERROR_ENDPOINT = "Este Endpoint no está disponible con el método " . $method;             


/*
------------------------------------------------------------------------------------------------------


██    ██ ███████ ██    ██  █████  ██████  ██  ██████  ███████ 
██    ██ ██      ██    ██ ██   ██ ██   ██ ██ ██    ██ ██      
██    ██ ███████ ██    ██ ███████ ██████  ██ ██    ██ ███████ 
██    ██      ██ ██    ██ ██   ██ ██   ██ ██ ██    ██      ██ 
 ██████  ███████  ██████  ██   ██ ██   ██ ██  ██████  ███████ 
                                                              
                                                                                                                
------------------------------------------------------------------------------------------------------
*/
if ($path == "/usuarios/todos") {
    if ($method == "GET") {
        $usuarioController->getTodosLosUsuarios();
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}

if ($path == "/usuarios/new") {
    if ($method == "POST") {
        $usuarioController->crearUsuario();
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}

if (preg_match("/usuarios\/update\/(.+)/", $path, $matches)) {
    if ($method == "PUT") {
        $idUsuario = $matches[1];
        $usuarioController->actualizarUsuario($idUsuario);
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}

if (preg_match("/usuarios\/delete\/(.+)/", $path, $matches)) {
    if ($method == "DELETE") {
        $idUsuario = $matches[1];
        $usuarioController->eliminarUsuario($idUsuario);
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}

/*
------------------------------------------------------------------------------------------------------

███████ ███████ ██████  ██    ██ ██  ██████ ██  ██████  ███████ 
██      ██      ██   ██ ██    ██ ██ ██      ██ ██    ██ ██      
███████ █████   ██████  ██    ██ ██ ██      ██ ██    ██ ███████ 
     ██ ██      ██   ██  ██  ██  ██ ██      ██ ██    ██      ██ 
███████ ███████ ██   ██   ████   ██  ██████ ██  ██████  ███████ 
                                                               
------------------------------------------------------------------------------------------------------
*/

// Llamada GET para recuperar todas los servicios de la Base de Datos
if ($path == "/servicios/todos") {
    if ($method == "GET") {
        $servicioController->getTodosLosServicios();
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}

// Llamada GET para recuperar todas los servicios DESTACADAS de la Base de Datos

if ($path == "/servicios/destacados") {
    if ($method == "GET") {
    
        $servicioController->getServiciosDestacados();
                             
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}

// Llamada GET para recuperar las servicios paginados para nuestro DataTable
if (str_contains($path, "/servicios/paginados")) {
    if ($method == "GET") {
        $page = $_GET["page"] ?? 1;
        $limit = $_GET["limit"] ?? 10;
        $search = $_GET["search"] ?? "";

        $servicioController->getServiciosPaginados($page, $limit, $search);
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}



// Llamada GET para recuperar los servicios según filtros que le pasamos
if (str_contains($path, "/servicios/filtros")) {
    if ($method == "GET") {
        $nombre = $_GET["nombre"] ?? null; // Si no nos está llegando el parámetro GET, nos lo dejará como NULL
        $dificultad = $_GET["dificultad"] ?? null; // Si no nos está llegando el parámetro GET, nos lo dejará como NULL
        $duracionMin = $_GET["duracion_min"] ?? null; // Si no nos está llegando el parámetro GET, nos lo dejará como NULL
        $duracionMax = $_GET["duracion_max"] ?? null; // Si no nos está llegando el parámetro GET, nos lo dejará como NULL
        $destacada = $_GET["destacada"] ?? null; // Si no nos está llegando el parámetro GET, nos lo dejará como NULL

        $servicioController->getServiciosFiltros($nombre, $dificultad, $duracionMin, $duracionMax, $destacada);
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}

// Llamada GET para recuperar un servicio específico por ID
if (preg_match("/servicio\/(.+)/", $path, $matches)) {
    if ($method == "GET") {
        $idServicio = $matches[1];
        $servicioController->getServicioById($idServicio);
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}

// Llamada GET para recuperar los servicios que contengan un nombre que le pasamos.
if (preg_match("/servicios\/nombre\/(.+)/", $path, $matches)) {
    if ($method == "GET") {
        $nombre = $matches[1];
        $servicioController->getServiciosByNombre($nombre);
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}

// Llamada GET para recuperar los servicios que contengan un nombre que le pasamos.
if (preg_match("/servicios\/favoritos\/usuario\/(.+)/", $path, $matches)) {
    if ($method == "GET") {
        $idUsuario = $matches[1];
        $servicioController->getServiciosFavoritosUsuario($idUsuario);
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}

// Crear un nuevo sevicio con datos que nos llegan por POST
if ($path == "/servicio/new") {
    if ($method == "POST") {
        $servicioController->crearServicio();
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}

// Actualizar un servicio que nos llegan los datos por PUT (además nos llega el ID de servicio que queremos actualizar)
if (preg_match("/servicio\/update\/(.+)/", $path, $matches)) {
    if ($method == "PUT") {
        $idServicio = $matches[1];
        $servicioController->actualizarServicio($idServicio);
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}

// Borrar un servicio según el ID que nos llega en la URL
if (preg_match("/servicio\/delete\/(.+)/", $path, $matches)) {
    if ($method == "DELETE") {
        $idServicio = $matches[1];
        $servicioController->eliminarServicio($idServicio);
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}




/*
------------------------------------------------------------------------------------------------------


███████  █████  ██    ██  ██████  ██████  ██ ████████  ██████  ███████ 
██      ██   ██ ██    ██ ██    ██ ██   ██ ██    ██    ██    ██ ██      
█████   ███████ ██    ██ ██    ██ ██████  ██    ██    ██    ██ ███████ 
██      ██   ██  ██  ██  ██    ██ ██   ██ ██    ██    ██    ██      ██ 
██      ██   ██   ████    ██████  ██   ██ ██    ██     ██████  ███████ 

                                                                                         
------------------------------------------------------------------------------------------------------
*/

// Solo necesitamos DAR DE ALTA un favorito o ELIMINAR UN FAVORITO.

if ($path == "/favoritos/new") {
    if ($method == "POST") {
        $favoritoController->crearFavorito();
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}


if (preg_match("/favoritos\/delete\/(.+)/", $path, $matches)) {
    if ($method == "DELETE") {
        $idServicio = $matches[1];
        $favoritoController->eliminarFavorito($idServicio);
    } else {
        echo $MENSAJE_ERROR_ENDPOINT;
    }
}





