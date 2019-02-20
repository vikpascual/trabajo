<?php

if(isset($_POST['nombre']) && !empty($_POST['nombre']) &&
isset($_POST['mail']) && !empty($_POST['mail']) &&
isset($_POST['detalles']) && !empty($_POST['detalles'])
) {
    $archivo = fopen('datos.txt','a')
    or die ('Problemas con el fichero'); // el 'a' sirve para crear un archivo y si existe abrir el archivo existente
    function escribir($nombre, $telefono, $email,$detalles,$archivo){
        fwrite($archivo,"Datos:"); //tambien se puede fputs
        fwrite($archivo,"\n");
        fwrite($archivo, "Nombre: ".$nombre);
        fwrite($archivo,"\n");
        fwrite($archivo, "Telefono ".$telefono);
        fwrite($archivo,"\n");
        fwrite($archivo, "Email: ".$email);
        fwrite($archivo,"\n");
        fwrite($archivo, "detalles: ".$detalles);
        fwrite($archivo,"\n");
        fwrite($archivo, "<------------------------------------------------------------------------>");
      fwrite($archivo,"\n");
    }
    escribir($_POST['nombre'], $_POST['telefono'], $_POST['mail'],$_POST['detalles'],$archivo);
        $yo = $_SERVER['HTTP_HOST'];
        $url = "http://$yo/indexexito.html";
        header("Location: $url");
} else {
    $yo = $_SERVER['HTTP_HOST'];
        $url = "http://$yo/indexerror.html";
        header("Location: $url");
}
?>