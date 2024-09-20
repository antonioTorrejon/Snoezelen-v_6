<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;
    
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {

         // Creamos un nuevo objeto PHPMailer
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS'];
     
         $mail->setFrom('cuentas@snoezelen.com');
         $mail->addAddress($this->email, $this->nombre);
         $mail->Subject = 'Confirma tu Cuenta';

         // Incrustanmos HTML para construir el mensaje de confirmación
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

         $contenido = '<html>';
         $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong>!</p>";
         $contenido .= "<p>Has registrado correctamente tu cuenta en Snoezelen, pero es necesario confirmarla.</p>";
         $contenido .= "<p>Presiona aquí para hacerlo: <a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";       
         $contenido .= "<p>Si tú no creaste esta cuenta, puedes ignorar este mensaje.</p>";
         $contenido .= "<p>Muchas gracias por tu confianza y recibe un saludo muy cordial.</p>";
         $contenido .= '</html>';
         $mail->Body = $contenido;

         //Enviar el mail
         $mail->send();

    }
    public function enviarConfirmacionProf() {

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('cuentas@snoezelen.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu Cuenta';


        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong>!</p>";
        $contenido .= "<p>Has registrado correctamente tu cuenta en Snoezelen, pero es necesario confirmarla.</p>";
        $contenido .= "<p>Presiona aquí para hacerlo: <a href='" . $_ENV['APP_URL'] . "/profesionales/confirmar-profesionales?token=" . $this->token . "'>Confirmar Cuenta</a>";       
        $contenido .= "<p>Si tú no creaste esta cuenta, puedes ignorar este mensaje.</p>";
        $contenido .= "<p>Muchas gracias por tu confianza y recibe un saludo muy cordial.</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        $mail->send();

   }

    public function enviarInstrucciones() {

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('cuentas@snoezelen.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu password';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong>!</p>"; 
        $contenido .= "<p>Has solicitado reestablecer tu password para acceder a tu cuenta de Snoezelen.</p>";
        $contenido .= "<p>Presiona aquí para hacerlo: <a href='" . $_ENV['APP_URL'] . "/reestablecer?token=" . $this->token . "'>Reestablecer Password</a>";        
        $contenido .= "<p>Si tú no solicitaste este cambio, puedes ignorar este mensaje.</p>";
        $contenido .= "<p>Muchas gracias por tu confianza y recibe un saludo muy cordial.";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }

    public function enviarInstruccionesProf() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('cuentas@snoezelen.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong>!</p>"; 
        $contenido .= "<p>Has solicitado reestablecer tu password para acceder a tu cuenta de Snoezelen.</p>";
        $contenido .= "<p>Presiona aquí para hacerlo: <a href='" . $_ENV['APP_URL'] . "/profesionales/reestablecer-profesionales?token=" . $this->token . "'>Reestablecer Password</a>";        
        $contenido .= "<p>Si tú no solicitaste este cambio, puedes ignorar este mensaje.</p>";
        $contenido .= "<p>Muchas gracias por tu confianza y recibe un saludo muy cordial.";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }
}