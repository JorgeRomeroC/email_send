<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Correo
{
    public static function SendMail()
    {
        if (isset($_POST['funaction'])) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_ADD_SLASHES);
            $nombre = $_POST['name'];
            if (empty($name)) {
                $_SESSION['MESSAGEFORM'] = "<div id='timeAlert' class='alert alert-danger' role='alert'>
                El campo nombre es obligatorio
                    </div>";
                header("Location:index.php");
                exit();
            }
            $_SERVER["NAME"] = $name;

            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            if (empty($email)) {
                $_SESSION['MESSAGEFORM'] = "<div id='timeAlert' class='alert alert-danger' role='alert'>
                El campo email es obligatorio
                    </div>";
                header("Location:index.php");
                exit();
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['MESSAGEFORM'] = "<div id='timeAlert' class='alert alert-danger' role='alert'>
                El formato del correo electrónico no es válido
                    </div>";
                header("Location:index.php");
                exit();
            }
            $_SESSION['EMAIL'] = $email;

            $tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
            if (empty($tel)) {
                $_SESSION['MESSAGEFORM'] = "<div id='timeAlert' class='alert alert-danger' role='alert'>
                El campo telefono es obligatorio
                    </div>";
                header("Location:index.php");
                exit();
            }
            $_SESSION['TEL'] = $tel;


            $charge = filter_input(INPUT_POST, 'charge', FILTER_SANITIZE_SPECIAL_CHARS);
            if (empty($charge)) {
                $_SESSION['MESSAGEFORM'] = "<div id='timeAlert' class='alert alert-danger' role='alert'>
                    El campo cargo es obligatorio
                </div>";
                header("Location:index.php");
                exit();
            }
            $_SESSION['CHARGE'] = $charge;

            $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
            $message = $_POST['message'];
            if (empty($message)) {
                $_SESSION['MESSAGEFORM'] = "<div id='timeAlert' class='alert alert-danger' role='alert'>
                    El campo mensaje es obligatorio
                </div>";
                header("Location:index.php");
                exit();
            }
            $_SESSION['MESSAGEFORM'] = $message;
            
            $EmailTitle = "Nuevo mensaje de contacto | $name";
            $DestinoEmail = "contacto@jorgeromeroc.com";
            $DestinoName = "Jorge Romero";
            $body = "<h1 style='text-align: center;'>Formulario de Contacto</h1>";
            $body = $body."<p><strong>Nombre: </strong> $name</p>";
            $body = $body."<p><strong>Email: </strong> <a href='mailto:$email'>$email</a></p>";
            $body = $body."<p><strong>Cargo: </strong> $charge</p>";
            $body = $body."<p><strong>Tel&eacute;fono: </strong> $tel</p>";
            $body = $body."<p><strong>Mensaje: </strong> $message</p>";
            $body = $body."<p style='text-align: center;'><strong>Formulario hecho para postulacion en REBOLD; por Jorge Romero C;</strong></p>";
            unset($_SESSION["NAME"]);
            unset($_SESSION["EMAIL"]);
            unset($_SESSION["CHARGE"]);
            unset($_SESSION["PHONE"]);
            unset($_SESSION["MESSAGE"]);

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();   
                $mail->CharSet = 'UTF-8';                                         //Send using SMTP
                $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'contacto@jorgeromeroc.com';                     //SMTP username
                $mail->Password   = 'Silvana.-12';                               //SMTP password
                $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption: PHPMailer::ENCRYPTION_SMTPS;  
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('contacto@jorgeromeroc.com', 'Jorge Romero C');
                $mail->addAddress('jorgeromeroc.12@gmail.com', 'Jorge Romero C');     //Add a recipient
                $mail->addAddress('contacto@jorgeromeroc.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $EmailTitle;
                $mail->Body    = $body;
     

                // En lugar de hacer echo directamente, almacena el mensaje en la sesión
                if ($mail->send()) {
                    $_SESSION['MESSAGEFORM'] = "<div id='timeAlert' class='alert alert-success' role='alert'>
                    Mensaje enviado correctamente
                        </div>";
                        header("Location:index.php");
                        exit();
                
                } 
                
            } catch (Exception $e) {
                $_SESSION['MESSAGEFORM'] = "<div id='timeAlert' class='alert alert-danger' role='alert'>
                Error al enviar el mensaje  $mail->ErrorInfo
                    </div> ";
                header("Location:index.php");
                exit();
            }

            }
    }
}