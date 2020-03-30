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
}