<?php
	require_once ("conexionBD.php");
    include_once ('header.php');
    // lo mismo: $link se genera en header. Así mismo se generan las opciones del header
    if (isset($_GET["buscar"])) { // se elige la opcion buscar
        $nombre = $_GET["nombre"];
        $genero = $_GET["genero"];
        $plataforma = $_GET["plataforma"];
        $lista = getByNombreAndGeneroAndPlataformaOrderByNombre($nombre, $genero, $plataforma); 
    } else
        $lista = getAllJuegosOrderByNombre();
?>
<html>
    <head>
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
        <title>Gamepedia - inicio</title>
    </head>
    <body>
        <div class = "lista">
            <div class = "pre_ventana_confirmacion">
                <?php
                    if (isset($_SESSION["mostrar_nombre"])) {
                        echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
                              <script src='js/functions.js'></script>";
                        unset($_SESSION["mostrar_nombre"]);
                    }
                ?>
            </div>
        <?php
            if (mysqli_num_rows($lista) > 0) {
                while ($juego = mysqli_fetch_array($lista)){
                    $juego_nombre = $juego["nombre"];
                    $juego_imagen = base64_encode($juego ['imagen']);
                    $juego_desc = $juego["descripcion"];
                    $juego_url = $juego["url"];
                    $genero_filtrado = getByIdGenero ($juego["id_genero"]);
                    $juego_genero = $genero_filtrado["nombre"];
                    $plataforma_filtrado = getByIdPlataforma ($juego["id_plataforma"]);
                    $juego_plataforma = $plataforma_filtrado["nombre"];
                    echo
                    "<div class = 'bloque_info' id = 'agregar_juego'>
                        <img class='reducir_img' src='data:image/jpg;charset=utf8;base64,".$juego_imagen."'/>
                        <div class = 'info_right'>
                            <p>$juego_nombre</p>
                            <p>$juego_desc</p>
                            <p>Género: $juego_genero</p>
                            <p>Plataforma: $juego_plataforma</p>
                            <p>Página web: $juego_url</p>
                        </div>
                     </div>";
                }
            } else {
                echo
                "<div class = 'bloque_info centrar'>
                 <img src = 'images/not_found.png' class = 'reducir_img centrar'/>
                 <p class = 'centrar'>No se han encontrado resultados</p>
                 </div>";
            }
        ?>
        </div>
        <?php include_once 'footer.php' ?>
