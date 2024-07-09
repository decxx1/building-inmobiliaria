<?php

namespace App\Http\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{

    public function property(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'url' => 'required|string',
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:50',
            'message' => 'required|string|min:10',
            'captcha_token'  => [new Recaptcha],
        ]);

        $validated = $validator->validated();
        $title = 'Contacto por un inmueble, de: ';
        $url = $validated['url'];
        $name = $validated['name'];
        $phone = $validated['phone'];
        $message = $validated['message'];

        $this->send($name, $message, $title, $phone, $url);
    }

    public function send($name, $message, $title, $phone = null, $url = null)
    {

        $emailUserName = env('MAIL_USERNAME');
        $emailPassword = env('MAIL_PASSWORD');
        $smtpHost = env('MAIL_HOST');
        $smtpPort = env('MAIL_PORT');
        $smtpEncryption = env('MAIL_ENCRYPTION');

        $mail = new PHPMailer(true);


        try {
            //Server settings
            $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $smtpHost;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $emailUserName;                     //SMTP username
            $mail->Password   = $emailPassword;                               //SMTP password
            $mail->SMTPSecure = $smtpEncryption;            //Enable implicit TLS encryption
            $mail->Port       = $smtpPort;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS


            // Establecer el remitente y la dirección de envío real
            $mail->setFrom($emailUserName, 'Building Inmobiliaria');
            $mail->addAddress($emailUserName);

            // Establecer el remitente que se mostrará en el campo "From"
            $mail->clearReplyTos(); // Eliminar las direcciones de respuesta anteriores (si las hubiera)
            //$mail->addReplyTo($email, $name);

            $mail->CharSet = 'UTF-8';

            // Formatear mensaje en HTML con los datos del remitente
            $body = "
                <ul style='font-size:16px;'>
                    <li><strong style='font-size:18px;'>Nombre:</strong> $name</li>";
            $body.= $phone ? "<li><strong style='font-size:18px;'>Teléfono:</strong> $phone</li>" : '';
            $body.= $url ? "<li><strong style='font-size:18px;'>Inmueble:</strong> <a href='$url'>Ir al inmueble</a></li>" : '';
            $body.="</ul>
                    <br/><br/>
                    <h4>Mensaje:</h4>
                    <p>$message</p>";

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $title . $name;
            $mail->Body    = $body;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mailSent = $mail->send();

            if ($mailSent) {
                return redirect()->back()->with([
                    'message' => '¡El mensaje se envió correctamente!'
                ]);
            } else {
                return redirect()->back()->withErrors([
                    'message' => 'Error al enviar el mensaje',
                    'error' => $mail->ErrorInfo
                ]);
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors([
                'message' => 'Error al enviar el mensaje',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function footer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'message' => 'required|string|min:10',
            'captcha_token'  => [new Recaptcha],
        ]);

        $validated = $validator->validated();

        $title = 'Contacto desde la web, de: ';
        $name = $validated['name'];
        $message = $validated['message'];

        $this->send($name, $message, $title);
    }
}
