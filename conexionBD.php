<?php
    require_once ("constants.php");

    $host_name = Constants::HOST_NAME;
    $user_name = Constants::USER_NAME;
    $password = Constants::PASSWORD;
    $data_base = Constants::DATA_BASE;
    $link_bd = mysqli_connect ($host_name, $user_name , $password, $data_base) or die ('Error'. mysqli_error ($link_bd));
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

    function getByNombreAndGeneroAndPlataformaOrderByNombre($nombre, $genero, $plataforma){
        $query="SELECT * FROM juegos j";
        $query_where=" WHERE j.nombre like '%".$nombre."%' OR j.descripcion like '%".$nombre."%' "; 
        if ($genero > 1) {
            $query = $query." JOIN generos g ON j.id_genero = g.id ";
            $query_where = $query_where." AND j.id = $genero";
        }
        if ($plataforma > 1) {
            $query = $query." JOIN plataformas p ON j.id_plataforma = p.id ";
            $query_where=$query_where." AND p.id = $plataforma";
        }

        /*
        Comenté esta sección porque recordé que la opción de no elegir género o plataforma también están a disposición. Es curioso que copié exactamente el mismo código y tira
        error... Pero como entregamos la semana que viene voy a preguntar mañana al respecto. NO BORRES ESTO

        $query="SELECT * FROM juegos j JOIN generos g ON j.id_genero = g.id JOIN plataformas p ON j.id_plataforma = p.id ";
        $query_where="WHERE j.nombre like '%".$nombre."%' AND g.id = ".$genero." AND p.id = ".$plataforma;
        if (empty($nombre))
            $query_where="WHERE j.nombre = '' AND g.id = ".$genero." AND p.id = ".$plataforma;
        */

        $query_order=" ORDER BY j.nombre";
        /* echo $query.$query_where.$query_order; */
        $result = mysqli_query($GLOBALS['link_bd'], $query.$query_where.$query_order);
        if ($result)
            return $result;
        else
            die('Query Invalido: ' . mysqli_error() . '\n');
        return null;

    }

    function cleanFile($fileBinary){
        return mysqli_escape_string($GLOBALS['link_bd'], $fileBinary);
    }

    function insertJuegos($name, $fileBinary, $fileType, $description, $url, $idGenero, $idPlataforma){
        $query = "INSERT INTO `juegos`(`nombre`, `imagen`, `tipo_imagen`, `descripcion`, `url`, `id_genero`, `id_plataforma`) ";
        $query_values = "VALUES ('$name','$fileBinary','$fileType','$description','$url','$idGenero','$idPlataforma')";
        mysqli_query($GLOBALS['link_bd'], $query.$query_values);
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