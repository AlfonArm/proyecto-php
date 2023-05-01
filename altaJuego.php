<?php
    require_once ("conexionBD.php");
    include_once 'header.php';
    $plataformas = getAllPlataformasOrderByNombre();
    $generos = getAllGenerosOrderByNombre();
?>
<html>
<head>
    <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
    <title>Subir juego</title>
    <script>
        function dio_click () {
            // pregunté sobre esto en la clase y me dijeron que el return funcionaba correctamente y que debe haber un error a la hora de tomar un valor. De ahí los console.log
            nombre_juego = document.getElementById("nombre_juego").value;
            descripcion = document.getElementById("descripcion").value;
            url_juego = document.getElementById("url_juego").value;
            imagen = document.getElementById("imagen").value;
            plataforma = document.getElementById("plataforma").value;
            cont = 0;
            console.log(cont);
            if ((nombre_juego == null) || (nombre_juego == "")) {
                document.getElementById("return_nombre").innerHTML = "Este campo es obligatorio";
                cont++;
            } else {
                document.getElementById("return_nombre").innerHTML = "";
            }
            if ((imagen == null) || (imagen.length == 0)) {
                document.getElementById("return_imagen").innerHTML = "Este campo es obligatorio";
                cont++;
            } else {
                document.getElementById("return_imagen").innerHTML = "";
            }
            if ((descripcion == null) || (descripcion == "")) {
                document.getElementById("return_desc").innerHTML = "Este campo es obligatorio";
                cont++;
            } else {
                if (descripcion.length > 255) {
                    document.getElementById("return_desc").innerHTML = "La descripción es muy larga";
                    cont++;
                } else {
                    document.getElementById("return_desc").innerHTML = "";
                }
            } 
            if (plataforma == 1) {
                document.getElementById("return_plataforma").innerHTML = "Se debe elegir una opción válida";
                cont++;
            } else {
                document.getElementById("return_plataforma").innerHTML = "";
            }
            if ((url_juego == null) || (url_juego == "")) {
                document.getElementById("return_direccion").innerHTML = "Este campo es obligatorio";
                cont++;
            } else {
                if (url_juego.length > 80) {
                    document.getElementById("return_direccion").innerHTML = "El enlace es muy largo";
                    cont++;
                } else {
                    document.getElementById("return_direccion").innerHTML = "";
                }
            }
            return (cont == 0);
        }
    </script>
</head>
<body>
    <form class="cuadro" onsubmit = "return dio_click()" method = "post" action="subir.php" enctype="multipart/form-data">
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
                    <select id = "genero_juego" name = "genero_juego">
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
    <?php include_once 'footer.php' ?>
