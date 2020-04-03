<?php
namespace Nautilus\Resources;
use Nautilus\Resources\Request;
use Nautilus\Resources\Controller;
use Nautilus\Util\LoginHelper;
use Nautilus\Util\SessionHelper;
use Nautilus\Util\ErrorHelper;


class Dispatcher
{
    private Request $request;
    private Controller $controller;

    // URLS que não precisam de verificação de login
    // TODO: carregar de um arquivo .env ou similar
    private array $unprotected_urls = [
        "/login",
    ];

    public function __construct()
    {
        $this->request = new Request();
    }

    public function dispatch()
    {
        // Processando a requisição e seus parametros

        // Caso o usuário não estiver autenticado e a URL estiver protegida
        if(!LoginHelper::isAuthenticated() && !in_array($this->request->getURL(), $this->unprotected_urls))
        {
            // A URL da requisição é armazenada, e ele é redirecionado
            SessionHelper::storeObject("REQUEST_REDIRECT", $this->request->getURL());
            $this->request->redirect("login");
        }

        Router::parseURL($this->request);
        $controller = $this->loadController();
        if(!is_null($controller) && method_exists($controller, $this->request->getAction()))
        {
            call_user_func_array(
                [
                    $controller,
                    $this->request->getAction()
                ],
                [
                    $this->request->getParameters(),
                    $this->request->getMethod()
                ]
            );
        }
        else
        {
            ErrorHelper::generateError(404);
        }
    }

    private function loadController()
    {
        $controller_name = "\\App\\Controllers\\". ucfirst($this->request->getControllerName()) ."Controller";
        if(class_exists($controller_name))
            return new $controller_name;

        return null;
    }
}
