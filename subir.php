<?php
    if (isset($_POST["confirmar"])) {
        // carga la información luego de que se confirmen los datos
        // primero vamos a cargar los elementos de manera ordenada:
        if (isset($_FILES["imagen"]["name"])){
            try {
                require_once "conexionBD.php";
                $fileType=$_FILES['imagen']['type'];
                $fileSize=$_FILES['imagen']['size'];
                if ($fileSize > 41943040) throw new Exception("The file is too big");
                $fileBinary=base64_encode(file_get_contents($_FILES['imagen']['tmp_name']));
                $uploaded = insertJuegos($_POST["nombre_juego"], $fileBinary, $fileType, $_POST["descripcion"], $_POST["url_juego"], $_POST["genero_juego"], $_POST["plataforma"]);
                if (empty(session_id())) session_start();
                if ($uploaded) throw new Exception("Error Processing Request", 1);
                $_SESSION["mostrar_nombre"] = $_POST["nombre_juego"];
                header('Location: index.php');
            }
            catch (Exception $return_error) {
                $_SESSION["error"] = $return_error;
                header('Location: altaJuego.php');
            }
        }
    }
?>
