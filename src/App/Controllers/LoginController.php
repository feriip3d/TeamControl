<?php
namespace App\Controllers;
use Nautilus\Resources\Controller;
use Nautilus\Util\EnvironmentHelper;
use Nautilus\Util\SessionHelper;
use Nautilus\Util\LoginHelper;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\User;
use App\Persistence\UserDAL;

class LoginController extends Controller
{
    public function index(?array $parameters)
    {
        $method = func_get_arg(1);

        $this->setParameters($parameters);
        $this->pushParameter("page_title", "Login");

        $token = filter_input(INPUT_POST, "token", FILTER_SANITIZE_STRING);
        $token2 = filter_var(SessionHelper::restoreObject('token2'), FILTER_SANITIZE_STRING);
        if($method == 'POST' && !empty($token))
        {
            $hash = hash_hmac('sha256', 'login', $token2);
            if (hash_equals($hash, $token))
            {
                $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
                if(!empty($username) && !empty($password))
                {
                    $user = UserDAL::getByUsername($username);
                    if(!is_null($user) && LoginHelper::authenticate($password,$user->getPasswordHash()))
                    {
                        SessionHelper::storeObject("USER", $user);
                        $redirect = (!empty(SessionHelper::restoreObject("REQUEST_REDIRECT_URL")))?
                            SessionHelper::restoreObject("REQUEST_REDIRECT_URL"):'/index';

                        header("Location: ".$redirect);
                    }else{
                        $this->pushParameter("page_error", "wrong_user_pass");
                        $this->pushParameter("username", $username);
                    }
                }else
                {
                    $this->pushParameter("page_error", "invalid_username");
                    $this->pushParameter("username", $username);
                }
            }
        }

        $this->render("index");
    }

    public function forgot(?array $parameters)
    {
        $this->setParameters($parameters);
        $this->pushParameter("page_title", "Recuperação de Acesso");
        $method = func_get_arg(1);
        $token = filter_input(INPUT_POST, "token", FILTER_SANITIZE_STRING);
        $token2 = filter_var(SessionHelper::restoreObject('token2'), FILTER_SANITIZE_STRING);
        if($method == 'POST' && !empty($token))
        {
            $hash = hash_hmac('sha256', 'forgot', $token2);
            if (hash_equals($hash, $token))
            {
                $email_input = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
                // TODO: verificação de email;
                $user = UserDAL::getByEmail($email_input);
                if(!is_null($user))
                {
                    $email_to = $user->getEmail();
                    $company = EnvironmentHelper::getEnv("COMPANY_NAME");
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->CharSet = 'UTF-8';
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'tls';
                    $mail->Username = "email@email.com.br";
                    $mail->Password = EnvironmentHelper::getEnv("MAILPASS");
                    $mail->Port = "587";

                    $mail->setFrom('email@email.com.br', $company);
                    $mail->addAddress($email_to, '');
                    $mail->isHTML(true);
                    $mail->Subject = "[{$company}] Recuperação de Acesso";
                    $mail->Body = 'Link para recuperar senha <a href="nautilus.dev/">aqui</a>';
//                    $mail->AltBody = 'Para visualizar essa mensagem acesse http://site.com.br/mail';
//                    $mail->addAttachment('/tmp/image.jpg', 'nome.jpg');

                    if(!$mail->send())
                    {
                        $this->pushParameter("page_error", "send_error");
                    } else {
                        $this->pushParameter("page_success", "send");
                        $this->pushParameter("b_status", "disabled");
                    }
                }else
                {
                    $this->pushParameter("page_error", "email_not_found");
                }
            }
            $this->pushParameter("email", $email_input);
        }
        $this->render("forgot");
    }
}