<?php
    require_once ('conexionBD.php');
    if(empty(session_id())) session_start();
    emptyEntity();
    $plataformas = getAllPlataformasOrderByNombre();
    $generos = getAllGenerosOrderByNombre();
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
                    <label>Buscar:</label>
                    <input type = "text" name = "nombre" placerholder = "Buscar"><br><br>
                </div>
                <div>
                    <label>Género:</label>
                    <select id = "header_genero" name = "genero">
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
                </div>
                <div>
                    <label>Plataforma:</label>
                    <select id = "header_plataforma" name = "plataforma">
                        <?php
                            if (mysqli_num_rows($plataformas) > 0) {
                                while ($plat=mysqli_fetch_array($plataformas)){
                                    $nombre_plat = $plat["nombre"];
                                    $id_plat = $plat["id"];
                                    echo "<option value ='$id_plat'>$nombre_plat</option>";
                                }
                            }
                        ?>
                    </select><br><br>
                </div>
	    	    <div>
		    		<input type = "submit" value = "Buscar" id = "busqueda_juego" name = "buscar"></input> <!-- era de class boton normal -->
			    </div>
            </form>
        </div>
        <div>
            <button  class = "boton_bonito" onclick = "agregarJuego()" role="button">Agregar</button>
        </div>
    </div>
</header>