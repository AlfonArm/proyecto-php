<?php

    //BD: datos de la conexion
    define('HOST_NAME', 'localhost');
    define('USER_NAME','root');
    define('PASSWORD', '');
    define('DATA_BASE', 'juegos_online');

    $link_bd = mysqli_connect (HOST_NAME, USER_NAME , PASSWORD, DATA_BASE) or die ('Error'. mysqli_error ($link_bd));
    
    function getByIdGenero ($id){
        $query="SELECT * FROM generos WHERE ID = ". $id;
        $result = mysqli_query($GLOBALS['link_bd'], $query);
        if ($result)
            return mysqli_fetch_assoc($result);
        else
            die('Query Invalido: ' . mysqli_error() . '\n');
    }

    function getByIdPlataforma ($id){
        $query="SELECT * FROM plataformas WHERE ID = ". $id;
        $result = mysqli_query($GLOBALS['link_bd'], $query);
        if ($result)
            return mysqli_fetch_assoc($result);
        else
            die('Query Invalido: ' . mysqli_error() . '\n');
    }

    function getAllJuegosOrderByNombre(){
        $query="SELECT * FROM juegos ORDER BY nombre";
        $result = mysqli_query($GLOBALS['link_bd'], $query);
        if ($result)
            return $result;
        else
            die('Query Invalido: ' . mysqli_error() . '\n');
        return null;
    }

    function getAllPlataformasOrderByNombre(){
        $query="SELECT * FROM plataformas ORDER BY nombre";
        $result = mysqli_query($GLOBALS['link_bd'], $query);
        if ($result)
            return $result;
        else
            die('Query Invalido: ' . mysqli_error() . '\n');
        return null;
    }

    function getAllGenerosOrderByNombre(){
        $query="SELECT * FROM generos ORDER BY nombre";
        $result = mysqli_query($GLOBALS['link_bd'], $query);
        if ($result)
            return $result;
        else
            die('Query Invalido: ' . mysqli_error() . '\n');
        return null;
    }

    function getByNombreAndGeneroAndPlataformaOrderByNombre($nombre, $genero, $plataforma, $orden){
        $query="SELECT j.nombre, j.imagen, j.descripcion, j.url,j.id_genero, j.id_plataforma, j.tipo_imagen FROM juegos j";
        $query_where=" WHERE (j.nombre like '%".$nombre."%' OR j.descripcion like '%".$nombre."%') "; 
        if ($genero != "not_valid") $query_where = $query_where." AND j.id_genero = $genero";
        if ($plataforma != "not_valid") $query_where=$query_where." AND j.id_plataforma = $plataforma";
        if ($orden == 1) {
            $query_order=" ORDER BY j.nombre ASC";
        } else {
            $query_order=" ORDER BY j.nombre DESC";
        }
        $result = mysqli_query($GLOBALS['link_bd'], $query.$query_where.$query_order);
        if ($result)
            return $result;
        else
            die('Query Invalido: ' . mysqli_error() . '\n');
        return null;

    }

/**
 * @throws Exception
 */
function insertJuegos($name, $fileBinary, $fileType, $description, $url, $idGenero, $idPlataforma){
        $query = "INSERT INTO `juegos`(`nombre`, `imagen`, `tipo_imagen`, `descripcion`, `url`, `id_genero`, `id_plataforma`) ";
        $query_values = "VALUES ('$name','$fileBinary','$fileType','$description','$url','$idGenero','$idPlataforma')";
        //validación:
        if (($name == null)||($name == "")) return "El campo nombre no puede quedar vacío";
        if ($fileBinary == null) return "La imagen es obligatoria";
        // esto acepta .gif? xD
        if (($fileType != ".jpg")&&($fileType != ".jpeg")&&($fileType != ".png")&&($fileType != ".gif")) return "El formato de la imagen no es válido";
        if (($description == null)||($description == "")) return "Se debe poner una descripción";
        if (count($description) > 255) return "La descripción es demasiado larga";
        if ($idPlataforma == "not_valid") return "Se debe insertar una plataforma válida"
        // comprueba si existe el id de la plataforma
        try {$a = mysqli_query($GLOBALS['link_bd'], "SELECT * FROM plataformas p WHERE p.id = $idPlataforma")} 
        catch (Exception $e) {throw new Exception ("Error al verificar el ID de la plataforma")}

        if ($idGenero == "not_valid") return "Se debe insertar un género válido";
        // comprueba si existe el id del género
        try {$a = mysqli_query($GLOBALS['link_bd'], "SELECT * FROM generos g WHERE g.id = $idGenero")} 
        catch (Exception $e) {throw new Exception ("Error al verificar el ID del género")}
        
        if (($url == null)||($url == "")) return "Se debe insertar una URL válida";
        if (count($url) > 80) return "La URL no debe superar los 80 carácteres";
        try { 
            mysqli_query($GLOBALS['link_bd'], $query.$query_values);
            return false;
        }catch (Exception $e){
            throw new Exception("Error al persistir en base de datos");
        }
    }

    // RESUMEN: comprueba si faltan géneros y plataformas. La página funciona de forma deficiente sin estos módulos, por lo que se debe priorizar su carga.
    function emptyEntity () {
        $gen = "SELECT * FROM generos";
        $result = mysqli_query($GLOBALS['link_bd'], $gen);
        require_once ('cargar_datos.php');
        if (mysqli_num_rows($result) == 0) {
            cargar_generos($GLOBALS['link_bd']);
        }
        $plat = "SELECT * FROM plataformas";
        $result = mysqli_query($GLOBALS['link_bd'], $plat);
        if (mysqli_num_rows($result) == 0) {
            cargar_plataformas($GLOBALS['link_bd']);
        }
    }
?>