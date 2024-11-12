<?php
namespace App\Backend\Utils;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './src/src/Exception.php';
require './src/src/PHPMailer.php';
require './src/src/SMTP.php';

class Emails {

    public function __construct() {

    }

// Instância da classe

        public static function RedefinirSenha(){
            $mail = new PHPMailer(true);
            try
        {
            // Configurações do servidor
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();        //Devine o uso de SMTP no envio
            $mail->SMTPAuth = true; //Habilita a autenticação SMTP
            $mail->Username   = 'projectpazinterprise@gmail.com';
            $mail->Password   = 'onlt mrec jzfx bjbr';
            // Criptografia do envio SSL também é aceito
            $mail->SMTPSecure = 'tls';
            // Informações específicadas pelo Google
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            // Define o remetente
            $mail->setFrom('projectpazinterprise@gmail.com');
            // Define o destinatário
            $mail->addAddress('murilovnasc.prog@gmail.com');
            // Conteúdo da mensagem
            $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
            $mail->Subject = 'Teste Envio de Email usando PHPMailer';
            $mail->Body    = '<!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <style>
                    /* Estilos gerais */
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                        background-color: #f4f4f4;
                        color: #333333;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #ffffff;
                        border-radius: 8px;
                        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        text-align: center;
                        padding: 20px 0;
                        background-color: #007bff;
                        color: #ffffff;
                        border-radius: 8px 8px 0 0;
                    }
                    .header h1 {
                        margin: 0;
                        font-size: 24px;
                    }
                    .content {
                        padding: 20px;
                        text-align: center;
                    }
                    .content p {
                        font-size: 16px;
                        line-height: 1.5;
                    }
                    .button {
                        display: inline-block;
                        padding: 12px 24px;
                        margin: 20px 0;
                        font-size: 16px;
                        font-weight: bold;
                        color: #ffffff;
                        background-color: #007bff;
                        text-decoration: none;
                        border-radius: 5px;
                    }
                    .footer {
                        text-align: center;
                        font-size: 12px;
                        color: #777777;
                        padding: 10px 20px;
                        border-top: 1px solid #dddddd;
                        border-radius: 0 0 8px 8px;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>Redefinição de Senha</h1>
                    </div>
                    <div class="content">
                        <p>Olá,</p>
                        <p>Recebemos uma solicitação para redefinir a sua senha. Se você fez essa solicitação, clique no botão abaixo para redefinir sua senha:</p>
                        <a href="localhost:5327/" class="button">Redefinir Senha</a>
                        <p>Se você não solicitou a redefinição, pode ignorar este e-mail.</p>
                        <p>Atenciosamente,<br>Sua Equipe</p>
                    </div>
                    <div class="footer">
                        <p>Este e-mail foi enviado automaticamente. Por favor, não responda.</p>
                        <p>&copy; 2024 Sua Empresa. Todos os direitos reservados.</p>
                    </div>
                </div>
            </body>
            </html> ';
            $mail->AltBody = 'Enviando parametros para email';
            // Enviar
            $mail->send();
            echo 'A mensagem foi enviada!';
        }
        catch (Exception $e)
        {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>