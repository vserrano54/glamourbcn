<?php

class Servicio
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getTodoslosServicios()
    {
        // Se va a conectar a la base de datos y va a hacer la llamada
        $query = "SELECT * FROM servicio";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getServicioPaginado($page, $limit, $search)
    {
        $offset = ($page - 1) * $limit;

        // Consulta principal
        $query = "SELECT * FROM servicio";
        $params = [];

        if (!empty($search)) {
            $query .= " WHERE LOWER(nombre) LIKE LOWER(:search)";
            $params[":search"] = "%" . $search . "%";
        }

        $query .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);

        // Añadimos los parámetros mediante el BIND PARAM
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);

        // Añadir la búsqueda si existe
        if (!empty($search)) {
            $stmt->bindParam(":search", $params[":search"], PDO::PARAM_STR);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getServicioFiltro($search)
    {
        // Consulta principal
        $query = "SELECT * FROM servicio";
        $params = [];

        if (!empty($search)) {
            $query .= " WHERE LOWER(nombre) LIKE LOWER(:search)";
            $params[":search"] = "%" . $search . "%";
        }

        $stmt = $this->conn->prepare($query);

        // Añadir la búsqueda si existe
        if (!empty($search)) {
            $stmt->bindParam(":search", $params[":search"], PDO::PARAM_STR);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getServicioFiltros($nombre, $dificultad, $duracionMin, $duracionMax, $destacada)
    {
        // Se va a conectar a la base de datos y va a hacer la llamada
        $query = "SELECT * FROM servicio WHERE 1=1"; // Este "WHERE 1=1" lo metemos para poder formar el WHERE de forma dinámica más tarde, sin importar que parámetros nos llegan. Aunque falte alguno, sigue funcionando
        $params = [];

        if ($nombre != null) { // Sería lo mismo que "nombre != null"
            $query .= " AND LOWER(nombre) LIKE LOWER(?)";
            $params[] = "%" . strtolower($nombre) . "%";
        }

        if ($dificultad != null) {
            $query .= " AND dificultad = ?";
            $params[] = $dificultad;
        }

        if ($duracionMin != null) {
            $query .= " AND duracion >= ?";
            $params[] = $duracionMin;
        }

        if ($duracionMax != null) {
            $query .= " AND duracion <= ?";
            $params[] = $duracionMax;
        }

        if ($destacada != null && $destacada != 0 && $destacada != "0") {
            $query .= " AND destacada = ?";
            $params[] = $destacada;
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getServicioById($idServicio)
    {
        // Se va a conectar a la base de datos y va a hacer la llamada
        $query = "SELECT * FROM servicio WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idServicio]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function getServicioDestacadas()
    {
        // Se va a conectar a la base de datos y va a hacer la llamada
        $query = "SELECT * FROM servicio WHERE destacada = 1";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function buscarPorNombre($nombre)
    {
        // Se va a conectar a la base de datos y va a hacer la llamada
        $query = "SELECT * FROM servicio WHERE LOWER(nombre) LIKE LOWER(?)"; // Comparamos con el nombre en minúsculas
        $stmt = $this->conn->prepare($query);
        $nombre = "%" . strtolower($nombre) . "%"; // Convertimos el nombre a minúsculas antes de pasarlo a la SQL.

        //$stmt->bindParam('s', $nombre);
        $stmt->execute([$nombre]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function buscarPorFavUsuario($idUsuario)
    {
        // Se va a conectar a la base de datos y va a hacer la llamada

        // Si no necesitamos todos los campos del servicio, y solo necesitamos el ID del servicio, nos valdría con esta QUERY.
        //$quert = "SELECT servicio_id FROM favorito WHERE usuario_id = ?";

        // Esta es en caso de que necesitemos recuperar todos los campos de nuestros servicios.
        $query = "SELECT * FROM servicio r WHERE r.id IN (SELECT servicio_id FROM favorito WHERE usuario_id = ?)"; // Comparamos con el nombre en minúsculas
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idUsuario]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function crearServicio($data)
    {
        $query = "INSERT INTO servicio (nombre, descripcion, duracion, dificultad, foto) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['nombre'], $data['descripcion'], $data['duracion'], $data['dificultad'], $data['foto']]);
        $lastId = $this->conn->lastInsertId(); // Esta función de aquí devuelve el último ID insertado.

        return $lastId;
    }

    public function actualizarServicio($id, $data)
    {
        $query = "UPDATE servicio SET nombre=?, descripcion=?, duracion=?, dificultad=?, foto=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['nombre'], $data['descripcion'], $data['duracion'], $data['dificultad'], $data['foto'], $id]);

        return true;
    }

    public function eliminarServicio($id)
    {
        $query = "DELETE FROM servicio WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return true;
    }
/*
    public function getIngredientesReceta($recetaId)
    {
        $query = "SELECT * FROM ingredientes WHERE receta_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$recetaId]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    */
}