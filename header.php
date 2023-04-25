<?php
    require_once ('conexionBD.php');
    $link = updateHeader();
    $plataformas = select_datos ($link, "plataformas");
    $generos = select_datos ($link, "generos");
?>

<script>
    function agregarJuego () {
        window.location.href = "altaJuego.php"
    }
</script>
<header>
    <div>
        <div class = "inicio">
            <h1><span>Game</span>pedia</h1>
            <p>Donde los gamers se unen</p>
        </div>
        <div class = "busqueda_header">
            <form method = "get" action = "index.php" id = "info_busqueda" class = "busqueda_header">
                <div>
                    <div class="container">
                        <input type = "text" name = "nombre" class = "buscador_header" placerholder = "Buscar"><br><br>
                    </div>
                    <div class="search"></div>
                </div>
                <div>
                    <label>Género:</label>
                    <select id = "header_genero" name = "genero">
                        <?php
                            if ($generos) {
                                foreach ($generos as $gen) {
                                    $nombre_gen = $gen["nombre"];
                                    $id_gen = $gen["id"];
                                    echo "<option value ='$id_gen'>$nombre_gen</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label>Plataforma:</label>
                    <select id = "header_plataforma" name = "plataforma">
                        <?php
                            if ($plataformas) {
                                foreach ($plataformas as $plat) {
                                    $nombre_plat = $plat["nombre"];
                                    $id_plat = $plat["id"];
                                    echo "<option value ='$id_plat'>$nombre_plat</option>";
                                }
                            }
                        ?>
                    </select><br><br>
                </div>
	    	    <div>
		    		<input type = "submit" value = "Buscar" id = "busqueda_juego" name = 'buscar' class = "boton_normal"></input>
			    </div>
            </form>
            <button  class = "boton_bonito" onclick = "agregarJuego()" role="button">Agregar</button>
        </div>
    </div>
</header>