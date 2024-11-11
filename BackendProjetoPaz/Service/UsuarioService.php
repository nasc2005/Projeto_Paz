<?php
namespace App\Backend\Service;

use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

require '../Utils/src/src/Exception.php';
require '../Utils/src/src/PHPMailer.php';
require '../Utils/src/src/SMTP.php';

use App\Backend\Model\Usuario;
use App\Backend\Repository\UsuarioRepository;
use Exception;

use DateTime;

class UsuarioService {
    private $repository;

    public function __construct(UsuarioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function login($data) {
        if (!isset($data->email) || !isset($data->senha)) {
            http_response_code(400);
            echo json_encode(["error" => "Email e senha são necessários para o login."]);
            return;
        }
        try {
            $usuario = $this->repository->getUsuarioByEmail($data->email);
            //senha com hash
            //if ($usuario && password_verify($data->senha, $usuario['senha']))
            //senha sem "hash"
            if ($data->senha === $usuario['senha']) {
                unset($usuario['senha']);
                http_response_code(200);
                echo json_encode([
                    "message" => "Login bem-sucedido.", 
                    "usuario" => $usuario
                ]);
        } else {
            http_response_code(401);
            echo json_encode(["error"=> "Email ou senha incorretos"]);
        }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => "Erro interno do servidor."]);
        }
    }

    public function create($data) {
        if (!isset($data->id_instituicao, $data->nome, $data->telefone, $data->email, $data->senha, $data->perfil, $data->cpf, $data->data_nasc, $data->imagem)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a criação do usuário."]);
            return;
        }
        $usuario = new Usuario();
        $usuario->setIdInstituicao($data->id_instituicao);
        $usuario->setNome($data->nome);
        $usuario->setTelefone($data->telefone);
        $usuario->setEmail($data->email);
        $usuario->setSenha($data->senha);
        $usuario->setCpf($data->cpf);
        $usuario->setPerfil($data->perfil);
        $usuario->setDataNasc($data->data_nasc);
        $usuario->setImagem($data->imagem);
        $usuario->setInsertDateTime(new DateTime());

        if ($this->repository->insertUsuario($usuario)) {
            http_response_code(201);
            echo json_encode(["message" => "Usuário criado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao criar usuário."]);
        }
    }
   
    public function read($id = null) {
        if ($id) {
            $result = $this->repository->getUsuarioById($id);
            unset($result['senha']);
            $status = $result ? 200 : 404;
        } else {
            $result = $this->repository->getAllUsuarios();
            foreach ($result as &$usuario) {
                unset($usuario['senha']);
            }
            unset($usuario);
            $status = !empty($result) ? 200 : 404;
        }

        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhum usuário encontrado."]);
    }

    public function readByPerfil($perfil) {
        if($perfil) {
            $result = $this->repository->getUsuariosByPerfil($perfil);
            foreach ($result as &$usuario) {
                unset($usuario['senha']);
            }
            unset($usuario);
            $status = !empty($result) ? 200 : 404;
        }
        http_response_code($status);
        $response = [
            "data" => $result ?: null,
            "message" => !empty($result) ? "Usuários encontrados para o perfil especificado." : "Nenhum usuário encontrado para o perfil."
        ];
        echo json_encode($response);
    }

    public function readByPerfil2($perfil) {
        $response = [
            "data" => null,
            "message" => "Nenhum usuário encontrado para o perfil."
        ];
    
        if ($perfil) {
            $result = $this->repository->getUsuariosByPerfil($perfil);
            
            // Remove a senha dos resultados
            foreach ($result as &$usuario) {
                unset($usuario['senha']);
            }
            unset($usuario);
    
            $status = !empty($result) ? 200 : 404;
            http_response_code($status);
    
            $response = [
                "data" => !empty($result) ? $result : null,
                "message" => !empty($result) ? "Usuários encontrados para o perfil especificado." : "Nenhum usuário encontrado para o perfil."
            ];
        }
    
        // Retorna o array de resposta ao invés de imprimi-lo
        return $response;
    }
    
        

    public function update($data) {
        if (!isset($data->id_usuario, $data->id_instituicao, $data->nome, $data->telefone, $data->email, $data->cpf, $data->perfil, $data->data_nasc, $data->imagem)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para atualização do usuário."]);
            return;
        }

        $usuario = new Usuario();
        $usuario->setId($data->id_usuario);
        $usuario->setIdInstituicao($data->id_instituicao);
        $usuario->setNome($data->nome);
        $usuario->setTelefone($data->telefone);
        $usuario->setEmail($data->email);
        $usuario->setCpf($data->cpf);
        $usuario->setPerfil($data->perfil);
        $usuario->setDataNasc($data->data_nasc);
        $usuario->setImagem($data->imagem);
        $usuario->setInsertDateTime(new DateTime());

        if ($this->repository->updateusuario($usuario)) {
            http_response_code(200);
            echo json_encode(["message" => "Usuário atualizado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar usuário."]);
        }
    }

    public function delete($id) {
        if ($this->repository->deleteusuario($id)) {
            http_response_code(200);
            echo json_encode(["message" => "Usuário excluído com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao excluir instituição."]);
        }
    }

    public function EnviaEmail($email) {
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
        $mail->addAddress($email);
        // Conteúdo da mensagem
        $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
        $mail->Subject = 'Redefinição de Senha';
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
                    <p>Olá, Usuario estamos aqui para ajudar!</p>
                    <p>Recebemos uma solicitação para redefinir a sua senha. Se você fez essa solicitação, clique no botão abaixo para redefinir sua senha:</p>
                    <a href="http://localhost:5173/nova-senha?email='.$email.'" class="button">Redefinir Senha</a>
                    <p>Se você não solicitou a redefinição, pode ignorar este e-mail.</p>
                    <p>Atenciosamente,<br>Equipe de Desenvolvimento</p>
                </div>
                <div class="footer">
                    <p>Este e-mail foi enviado automaticamente. Por favor, não responda.</p>
                    <p>&copy; 2024 Projeto Paz. Todos os direitos reservados.</p>
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

    public function EnviaEmailVendedor($email) {
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
        $mail->addAddress($email);
        // Conteúdo da mensagem
        $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
        $mail->Subject = 'Agradecimentos por estar no projeto Paz';
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
                        <h1>Bem-vindo à PAZ!</h1>
                    </div>
                    <div class="content">
                        <p>Olá, <strong>Seja Bem Vindo!</strong>,</p>
                        <p>Estamos muito felizes em tê-lo(a) como um novo vendedor em nossa plataforma PAZ! Sua jornada conosco começa agora, e queremos garantir que você tenha uma experiência incrível.</p>
                        <p>Se você tiver alguma dúvida ou precisar de ajuda, nossa equipe está à disposição para assisti-lo(a) a qualquer momento.</p>
                        <p>Fique atento(a) às próximas atualizações e novidades!</p>
                        <p>Atenciosamente,<br>Equipe de Desenvolvimento</p>
                    </div>
                    <div class="footer">
                        <p>Este e-mail foi enviado automaticamente. Por favor, não responda.</p>
                        <p>&copy; 2024 PAZ. Todos os direitos reservados.</p>
                    </div>
                </div>
            </body>
            </html>';
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

    public function EnviaEmailVenda($email) {
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
        $mail->addAddress($email);
        // Conteúdo da mensagem
        $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
        $mail->Subject = 'Agradecimentos por estar no projeto Paz';
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
                        <h1>Bem-vindo à PAZ!</h1>
                    </div>
                    <div class="content">
                        <p>Olá, <strong>Seja Bem Vindo!</strong>,</p>
                        <p>Estamos muito felizes em tê-lo(a) como um novo vendedor em nossa plataforma PAZ! Sua jornada conosco começa agora, e queremos garantir que você tenha uma experiência incrível.</p>
                        <p>Se você tiver alguma dúvida ou precisar de ajuda, nossa equipe está à disposição para assisti-lo(a) a qualquer momento.</p>
                        <p>Fique atento(a) às próximas atualizações e novidades!</p>
                        <p>Atenciosamente,<br>Equipe de Desenvolvimento</p>
                    </div>
                    <div class="footer">
                        <p>Este e-mail foi enviado automaticamente. Por favor, não responda.</p>
                        <p>&copy; 2024 PAZ. Todos os direitos reservados.</p>
                    </div>
                </div>
            </body>
            </html>';
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

    public function EnviaEmailNotificarVenda($email) {
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
        $mail->addAddress($email);
        // Conteúdo da mensagem
        $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
        $mail->Subject = 'Agradecimentos por estar no projeto Paz';
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
            <h1>Nova Venda Realizada</h1>
        </div>
        <div class="content">
            <p>Olá,</p>
            <p>Informamos que uma nova venda foi concluída com sucesso em nossa plataforma.</p>
            <p><strong>Detalhes da Venda:</strong></p>
            <ul>
                <li><strong>Vendedor:</strong> Nome do Vendedor</li>
                <li><strong>Data da Venda:</strong> Data da Venda</li>
            </ul>
            <p>Para mais informações e acompanhamento, acesse o painel administrativo.</p>
            <p>Atenciosamente,<br>Equipe de Desenvolvimento</p>
        </div>
        <div class="footer">
            <p>Este e-mail foi enviado automaticamente. Por favor, não responda.</p>
            <p>&copy; 2024 PAZ. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
';
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

    public function EnviaEmailFaltaProduto($email,$Produto) {
        $mail = new PHPMailer(true);

        $data = new DateTime();
        var_dump($data);die;
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
        $mail->addAddress($email);
        // Conteúdo da mensagem
        $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
        $mail->Subject = 'Agradecimentos por estar no projeto Paz';
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
                    <h1>Produto em Falta</h1>
                </div>
                <div class="content">
                    <p>Olá,</p>
                    <p>Informamos que o produto abaixo está indisponível em nossa plataforma.</p>
                    <p><strong>Detalhes do Produto:</strong></p>
                    <ul style="text-align: left;">
                        <li><strong>Nome:</strong> '.$Produto.'</li>
                        <li><strong>Última Atualização:</strong> '.$data.'</li>
                    </ul>
                    <p>Por favor, atualize o estoque ou entre em contato com o fornecedor para restabelecer a disponibilidade do produto o quanto antes.</p>
                    <p>Atenciosamente,<br>Equipe de Desenvolvimento</p>
                </div>
                <div class="footer">
                    <p>Este e-mail foi enviado automaticamente. Por favor, não responda.</p>
                    <p>&copy; 2024 PAZ. Todos os direitos reservados.</p>
                </div>
            </div>
        </body>
        </html>';
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