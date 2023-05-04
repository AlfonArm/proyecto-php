function dio_click () {
    nombre_juego = document.getElementById("nombre_juego").value;
    descripcion = document.getElementById("descripcion").value;
    url_juego = document.getElementById("url_juego").value;
    imagen = document.getElementById("imagen").value;
    plataforma = document.getElementById("plataforma").value;
    genero = document.getElementById("genero_juego").value;
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
        let fileInput = document.getElementById('imagen');
        let filePath = fileInput.value;
        let allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
        if (!allowedExtensions.exec(filePath)){
            document.getElementById("return_imagen").innerHTML = "El archivo tiene que tener alguna de las siguientes extensiones: .jpeg/.jpg/.png/.gif";
            cont++;
        }else
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
    if (plataforma == "not_valid") {
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
    if (genero == "not_valid") {
        document.getElementById("return_genero").innerHTML = "Se debe elegir una opción válida";
        cont++;
    } else {
        document.getElementById("return_genero").innerHTML = "";
    }
    return (cont == 0);
}