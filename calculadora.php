<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    if(isset($_POST['nombre']) && !empty($_POST['nombre']) &&
    isset($_POST['email']) && !empty($_POST['email']) &&
    isset($_POST['tipo_aula']) && !empty($_POST['tipo_aula']) &&
    isset($_POST['numero_asistentes']) && !empty($_POST['numero_asistentes']) &&
    isset($_POST['numero_horas']) && !empty($_POST['numero_horas']) && $_POST['numero_horas'] < 111
    ) {


        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $tipo_aula = $_POST['tipo_aula'];
        $numero_asistentes = $_POST['numero_asistentes'];
        $numero_horas = $_POST['numero_horas'];
        $precio = 0;

        function aforo($tipo_aula, $numero_asistentes) {
            if ($numero_asistentes > 15 && $tipo_aula == "cancha_baloncesto") {
            exit("La cantidad de asistentes supera el aforo máximo del espacio que ha seleccionado");
            } elseif ($numero_asistentes > 35 && ($tipo_aula == "cancha_baloncesto" || $tipo_aula == "aula_normal" || $tipo_aula == "aula_equipada")) {
                exit("La cantidad de asistentes supera el aforo máximo del espacio que ha seleccionado");
            } elseif ($numero_asistentes > 60 && ($tipo_aula == "cancha_baloncesto" || $tipo_aula == "aula_normal" || $tipo_aula == "aula_equipada" || $tipo_aula == "cafeteria" || $tipo_aula == "patio_interior")) {
                exit("La cantidad de asistentes supera el aforo máximo del espacio que ha seleccionado");
            } elseif ($numero_asistentes > 110 && ($tipo_aula == "cancha_baloncesto" || $tipo_aula == "aula_normal" || $tipo_aula == "aula_equipada" || $tipo_aula == "cafeteria" || $tipo_aula == "patio_interior" || $tipo_aula == "salon_de_actos")){
                exit("La cantidad de asistentes supera el aforo máximo del espacio que ha seleccionado");
            }
        }
        aforo($_POST['tipo_aula'], $_POST ['numero_asistentes']);

        if ($tipo_aula == "aula_normal") {
            $precio = 15;
        }
        elseif ($tipo_aula == "aula_equipada") {
            $precio = 25;
        }
        elseif ($tipo_aula == "salon_de_actos") {
            $precio = 35;
        }
        elseif ($tipo_aula == "cafeteria") {
            $precio = 25;
        }
        elseif ($tipo_aula == "patio_interior") {
            $precio = 10;
        }
        elseif ($tipo_aula == "cancha_baloncesto") {
            $precio = 15;
        }
        $precio_final = $precio * $numero_horas;



        $mail = new PHPMailer(true);
    try {

        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'espaiabastos@gmail.com';
        $mail->Password = 'abastos2000';
        $mail->SMTPSecure = 'tls'; //tambien vale ssl puerto 443
        $mail->Port = 587;
        $mail->setFrom('espaiabastos@gmail.com', 'Espai Abastos');
        $mail->addAddress($_POST['email']);
        $mail->isHTML(true); //para enviar un correo en html
        $mail->Subject = 'Espai Abastos';
        $mail->Body    = 'Cuerpo del correo';
        $mail->AltBody = 'Cuerpo del correo en texto plano';

        $mail->send();
        $yo = $_SERVER['HTTP_HOST'];
        $url = "http://$yo/indexexito.html";
        header("Location: $url");
    } catch (Exception $e) {
        echo '<h1>Hola '.$nombre.' parece que ha habido un problema al enviarte un correo, en cualquier caso el precio sería de '.$precio_final. '€</h1>';
    }
    } else {
        $yo = $_SERVER['HTTP_HOST'];
        $url = "http://$yo/indexerror.html";
        header("Location: $url");
    }
?>