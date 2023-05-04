<?php
	require_once ("conexionBD.php");
    include_once ('header.php');
    $plataformas = getAllPlataformasOrderByNombre();
    $generos = getAllGenerosOrderByNombre();
    $nombreGet = "";
    if (isset($_GET["buscar"])) {
        $nombreGet = $_GET["nombre"];
        $generoGet = $_GET["genero"];
        $plataformaGet = $_GET["plataforma"];
        $orden = $_GET["orden"];
        $lista = getByNombreAndGeneroAndPlataformaOrderByNombre($nombreGet, $generoGet, $plataformaGet, $orden);
    } else
        $lista = getAllJuegosOrderByNombre();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
        <title>Gamepedia - inicio</title>
        <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
    </head>
    <body>
    <div class = "busqueda_header">
        <form method = "get" action = "index.php" id = "info_busqueda" class = "busqueda_header">
            <div>
                <label>Buscar:</label>
                <input type = "text" name = "nombre" placerholder = "Nombre del juego" value="<?php echo $nombreGet ?>"><br><br>
            </div>
            <div>
                <label>Género:</label>
                <select id = "header_genero" name = "genero">
                    <option selected value = "not_valid">Seleccionar género</option>
                    <?php
                    if (mysqli_num_rows($generos) > 0) {
                        while ($gen=mysqli_fetch_array($generos)){
                            $nombre_gen = $gen["nombre"];
                            $id_gen = $gen["id"];
                            if ($id_gen == $generoGet)
                                echo "<option selected value ='$id_gen'>$nombre_gen</option>";
                            else echo "<option value ='$id_gen'>$nombre_gen</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div>
                <label>Plataforma:</label>
                <select id = "header_plataforma" name = "plataforma">
                    <option selected value = "not_valid">Seleccionar plataforma</option>
                    <?php
                    if (mysqli_num_rows($plataformas) > 0) {
                        while ($plat=mysqli_fetch_array($plataformas)){
                            $nombre_plat = $plat["nombre"];
                            $id_plat = $plat["id"];
                            if ($id_plat == $plataformaGet)
                                echo "<option selected value ='$id_plat'>$nombre_plat</option>";
                            else echo "<option value ='$id_plat'>$nombre_plat</option>";
                        }
                    }
                    ?>
                </select><br><br>
            </div>
            <div>
                <label>Orden:</label>
                <select id = "header_orden" name = "orden">
                    <option selected value = '1'>Ascendente</option>
                    <option value = '2'>Descendente</option>
                </select>
            </div>
            <div>
                <input type = "submit" value = "Buscar" id = "busqueda_juego" name = "buscar">
            </div>
        </form>
        <button  class = "boton_bonito" onclick = "agregarJuego()" role="button">Agregar</button>
    </div>
    <div>
    </div>
        <div class = "lista">
            <?php
                if (isset($_SESSION["mostrar_nombre"])) {
                    echo '<script src="js/main.js"></script>';
                    unset($_SESSION["mostrar_nombre"]);
                }
                function insertJuego ($juego) {
                    $juego_nombre = $juego["nombre"];
                    $juego_imagen = $juego ['imagen'];
                    $juego_desc = $juego["descripcion"];
                    $juego_url = $juego["url"];
                    $genero_filtrado = getByIdGenero ($juego["id_genero"]);
		            $juego_imagen_formato = $juego["tipo_imagen"];
                    $juego_genero = $genero_filtrado["nombre"];
                    $plataforma_filtrado = getByIdPlataforma ($juego["id_plataforma"]);
                    $juego_plataforma = $plataforma_filtrado["nombre"];
                    echo
                    "<div class = 'bloque_info' id = 'agregar_juego'>
                        <img class='reducir_img' src='data:".$juego_imagen_formato.";charset=utf8;base64, ".$juego_imagen."'/>
                        <div class = 'info_right'>
                            <p class = 'boldeable'>$juego_nombre</p>
                            <p>$juego_desc</p>
                            <p>Género: $juego_genero</p>
                            <p>Plataforma: $juego_plataforma</p>
                            <p>Página web: $juego_url</p>
                        </div>
                     </div>";
                }
                if (mysqli_num_rows($lista) > 0) {
                    while ($juego = mysqli_fetch_array($lista)){
                        echo "<div class = 'flex justify_center'>";
                        insertJuego($juego);
                        if ($juego = mysqli_fetch_array($lista)) {
                            insertJuego($juego);
                            if ($juego = mysqli_fetch_array($lista)) {
                                insertJuego($juego);
                                if ($juego = mysqli_fetch_array($lista))
                                    insertJuego($juego);   
                            }
                        }
                    echo "</div>";
                    }
                } else {
                    echo
                    "<div class = 'flex justify_center'>
                        <div>
                            <img src = 'images/not_found.png' id = 'not_found'/>
                            <p>No se han encontrado resultados</p>
                        </div>
                    </div>";
                }
            ?>
        </div>
        <?php include_once 'footer.php' ?>
