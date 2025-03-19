<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        // Email sending logic
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@salon.com'); // mail from
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu cuenta';

        // HTML del mail
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<p> Hola ' . $this->nombre . '</p>';
        $contenido .= '<p> Para confirmar tu cuenta por favor da click en el siguiente enlace </p>';
        $contenido .= '<a href="' .  $_ENV['APP_URL'] .  '/confirmar-cuenta?token=' . $this->token . '">Confirmar cuenta</a>';
        $contenido .= '<p> Si no fuiste tu, ignora este mensaje </p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;
        $mail->AltBody = 'Para confirmar tu cuenta por favor da click en el siguiente enlace: http://localhost:3000/confirmar-cuenta?token=' . $this->token;

        $mail->send();

        if (!$mail->send()) {
            echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
        } else {
            echo 'Correo enviado con éxito.';
        }
    }

    public function enviarRecuperacion()
    {
        // Email sending logic
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@salon.com'); // mail from
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu contraseña';

        // HTML del mail
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<p> Hola ' . $this->nombre . '</p>';
        $contenido .= '<p> Has solicitado reestablecer tu contraseña, sigue el siguiente enlace para hacerlo </p>';
        $contenido .= '<a href="' .  $_ENV['APP_URL'] .  '/recover?token=' . $this->token . '">Recuperar contraseña</a>';
        $contenido .= '<p> Si no fuiste tu, ignora este mensaje </p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;
        $mail->AltBody = 'Para confirmar tu cuenta por favor da click en el siguiente enlace: http://localhost:3000/recover?token=' . $this->token;

        $mail->send();

        if (!$mail->send()) {
            echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
        } else {
            echo 'Correo enviado con éxito.';
        }
    }
}
