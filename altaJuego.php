<?php
    require_once ("conexionBD.php");
    include_once 'header.php';

    $plataformas = getAllPlataformasOrderByNombre();
    $generos = getAllGenerosOrderByNombre();

    function checkSession ($dataName) {
        if (isset($_SESSION[$dataName])) {
            $data = $_SESSION[$dataName];
            unset($_SESSION[$dataName]);
        } else {
            $data = "";
        }
        return $data;
    }

    if (isset($_POST["confirmar"])) {
        if (isset($_FILES["imagen"]["name"])){
            try {
                $fileType=$_FILES['imagen']['type'];
                $fileSize=$_FILES['imagen']['size'];
                if (($fileSize < 41943040)&&($_POST["genero_juego"] != "not_valid")&&($_POST["plataforma"] != "not_valid")) {
                    $fileBinary=base64_encode(file_get_contents($_FILES['imagen']['tmp_name']));
                    $insertar_error = insertJuegos($_POST["nombre_juego"], $fileBinary, $fileType, $_POST["descripcion"], $_POST["url_juego"], $_POST["genero_juego"], $_POST["plataforma"]);
                    if ($insertar_error != "") throw new Exception($insertar_error);
                    if (empty(session_id())) session_start();
                    $_SESSION["mostrar_nombre"] = $_POST["nombre_juego"];
                    header('Location: index.php');
                } else
                    throw new Exception("El tamaño de la imagen excede lo permitido");
            }
            catch (Exception $exception_error) {
                if (empty(session_id())) session_start();
                $_SESSION["error"] = $exception_error -> getMessage();
                $_SESSION["error_nombre"] = $_POST["nombre_juego"];
                $_SESSION["error_genero"] = $_POST["genero_juego"];
                $_SESSION["error_plataforma"] = $_POST["plataforma"];
                $_SESSION["error_descripcion"] = $_POST["descripcion"];
                $_SESSION["error_url"] = $_POST["url_juego"];
                header('Location: altaJuego.php');
                // el comentario de antes nada que ver. Lo que hay que hacer es que las redirecciones no sean un button con js sino un <a>
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
    <title>Subir juego</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                    <input placeholder="Nombre del juego" id = "nombre_juego" name = "nombre_juego" value = '<?php checkSession("error_nombre"); ?>'>
                    <p id = "return_nombre"></p>
                </fieldset>
                <fieldset>
                    <legend>Descripción</legend>
                    <textarea placeholder = "Hasta 255 caracteres" class = "texto_grande" id = "descripcion" name = "descripcion" value = '<?php checkSession("error_descripcion"); ?>'></textarea>
                    <p id = "return_desc"></p>
                </fieldset>
            </div>
            <div class="espacio_form">
                <fieldset>
                    <legend>Plataforma</legend>
                    <select id = "plataforma" name = "plataforma">
                        <?php
                            $aux_plat_error = checkSession ("error_plataforma");
                        ?>
                        <option <?php if ($aux_plat_error == "") { ?> selected <?php } ?> value = "not_valid">Seleccionar plataforma</option>
                        <?php
                            if (mysqli_num_rows($plataformas) > 0) {
                                while ($plat=mysqli_fetch_array($plataformas)){
                                    $nombre_plat = $plat["nombre"];
                                    $id_plat = $plat["id"];
                        ?>
                                    <option <?php if ($id_plat == $aux_plat_error) { ?> selected <?php } ?> value ='<?php echo $id_plat; ?>'><?php echo $nombre_plat; ?></option>
                        <?php
                                }
                            }
                        ?>
                    </select>
                    <p id = "return_plataforma"></p>
                </fieldset>
                <fieldset>
                    <legend>Dirección</legend>
                    <input type="url" placeholder="Máximo 80 caracteres" id = "url_juego" name = "url_juego" value = '<?php checkSession("error_url"); ?>'>
                    <p id = "return_direccion"></p>
                </fieldset>
            </div>
            <div class="espacio_form">
                <fieldset>
                    <legend>Género:</legend>
                    <select id = "genero_juego" name = "genero_juego" id = "genero_juego">
                        <?php
                            $aux_gen_error = checkSession ("error_genero");
                        ?>
                        <option <?php if ($aux_gen_error == "") { ?> selected <?php } ?> value = "not_valid">Seleccionar plataforma</option>
                        <?php
                            if (mysqli_num_rows($generos) > 0) {
                                while ($gen=mysqli_fetch_array($generos)){
                                    $nombre_gen = $gen["nombre"];
                                    $id_gen = $gen["id"];
                        ?>
                                    <option <?php if ($id_gen == $aux_gen_error) { ?> selected <?php } ?> value ='<?php echo $id_gen ?>'><?php echo $nombre_gen; ?></option>
                        <?php
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
        <button type = "submit" id = "confirmar" name = confirmar>Subir</button>
    </form>
    <?php
        if (isset($_SESSION["error"])) {
            $exception = $_SESSION["error"];
    ?>
            <script>swal('Error!', '$exception', 'error'); </script>";
    <?php
            unset($_SESSION["error"]);
        }
    ?>
    <?php include_once 'footer.php' ?>
