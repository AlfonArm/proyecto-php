<?php
    require_once ("conexionBD.php");
    include_once 'header.php';
    $plataformas = getAllPlataformasOrderByNombre();
    $generos = getAllGenerosOrderByNombre();

    if (isset($_POST["confirmar"])) {
        if (isset($_FILES["imagen"]["name"])){
            try {
                $fileType=$_FILES['imagen']['type'];
                $fileSize=$_FILES['imagen']['size'];
                if (($fileSize < 41943040)&&($_POST["genero_juego"] != "not_valid")&&($_POST["plataforma"] != "not_valid")) {
                    $fileBinary=base64_encode(file_get_contents($_FILES['imagen']['tmp_name']));
                    $uploaded = insertJuegos($_POST["nombre_juego"], $fileBinary, $fileType, $_POST["descripcion"], $_POST["url_juego"], $_POST["genero_juego"], $_POST["plataforma"]);
                    if (empty(session_id())) session_start();
                    if ($uploaded) throw new Exception("Error Processing Request", 1);
                    $_SESSION["mostrar_nombre"] = $_POST["nombre_juego"];
                    header('Location: index.php');
                }
            }
            catch (Exception $return_error) {
                $_SESSION["error"] = $return_error;
                header('Location: altaJuego.php'); // el problema con esto es que no se debería recargar la página :P
            }
        }
    }
?>
<html>
<head>
    <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
    <title>Subir juego</title>
    <script src="js/functions.js"></script>
</head>
<body>
    <button  class = "boton_bonito desextremizar" onclick = "volverAIndex()" role="button">Volver</button>
    <form class="cuadro" onsubmit = "return dio_click()" method = "post" action="altaJuego.php" enctype="multipart/form-data">
        <div class = "top_form">
            <p>Completa el siguiente formulario para subir el juego</p>
        </div>
        <div class = "flex"> 
            <div class="espacio_form">
                <fieldset>
                    <legend>Nombre</legend>
                    <input placeholder="Nombre del juego" id = "nombre_juego" name = "nombre_juego">
                    <p id = "return_nombre"></p>
                </fieldset>
                <fieldset>
                    <legend>Descripción</legend>
                    <textarea placeholder = "Hasta 255 caracteres" class = "texto_grande" id = "descripcion" name = "descripcion"></textarea>
                    <p id = "return_desc"></p>
                </fieldset>
            </div>
            <div class="espacio_form">
                <fieldset>
                    <legend>Plataforma</legend>
                    <select id = "plataforma" name = "plataforma">
                        <option selected value = "not_valid">Seleccionar plataforma</option>
                        <?php
                            if (mysqli_num_rows($plataformas) > 0) {
                                while ($plat=mysqli_fetch_array($plataformas)){
                                    $nombre_plat = $plat["nombre"];
                                    $id_plat = $plat["id"];
                                    echo "<option value ='$id_plat'>$nombre_plat</option>";
                                }
                            }
                        ?>
                    </select>
                    <p id = "return_plataforma"></p>
                </fieldset>
                <fieldset>
                    <legend>Dirección</legend>
                    <input type="url" placeholder="Máximo 80 caracteres" id = "url_juego" name = "url_juego">
                    <p id = "return_direccion"></p>
                </fieldset>
            </div>
            <div class="espacio_form">
                <fieldset>
                    <legend>Género:</legend>
                    <select id = "genero_juego" name = "genero_juego" id = "genero_juego">
                        <option selected value = "not_valid">Seleccionar plataforma</option>
                        <?php
                            if (mysqli_num_rows($generos) > 0) {
                                while ($gen=mysqli_fetch_array($generos)){
                                    $nombre_gen = $gen["nombre"];
                                    $id_gen = $gen["id"];
                                    echo "<option value ='$id_gen'>$nombre_gen</option>";
                                }
                            }
                        ?>
                    </select>
                    <p id = "return_genero"></p>
                </fieldset>
                <div>
                    <p>Seleccionar imagen</p>
                    <input type = "file" id = "imagen" name = "imagen">
                    <p id = "return_imagen"> </p>
                </div>
            </div>
        </div>
        <?php
            if (isset($_SESSION["error"])) {
                $e = $_SESSION["error"];
                echo "<p id = 'error_de_subida'>Error: $e</p>";
            }
            unset($_SESSION["error"]);
        ?>
        <button type = "submit" id = "confirmar" name = confirmar>Subir</button>
    </form>    
    <?php include_once 'footer.php' ?>
