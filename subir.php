<?php
    if (isset($_POST["confirmar"])) {
        // carga la información luego de que se confirmen los datos
        // primero vamos a cargar los elementos de manera ordenada:
        if (isset($_FILES["imagen"]["name"])){
            require_once "conexionBD.php";
            $fileType=$_FILES['imagen']['type'];
            $fileName=$_FILES['imagen']['name'];
            $fileSize=$_FILES['imagen']['size'];
            $fileUploaded=fopen($_FILES['imagen']['tmp_name'],'r');
            $fileBinary=fread($fileUploaded, $fileSize);
            $fileBinary=cleanFile($fileBinary);
            insertJuegos($_POST["nombre_juego"], $fileBinary, $fileType, $_POST["descripcion"], $_POST["url_juego"], $_POST["genero_juego"], $_POST["plataforma"]);
            session_start();
            $_SESSION["mostrar_nombre"] = $_POST["nombre_juego"];
        }
    }
    header('Location: index.php'); // va a index, donde dice que se ha subido el elemento
?>
