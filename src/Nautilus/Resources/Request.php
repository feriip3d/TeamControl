<?php
namespace Nautilus\Resources;

// Classe de requisição
class Request
{
    private string $url;
    private string $method;
    private ?array $parameters;
    private ?string $action;
    private ?string $controller_name;

    // No construtor, é obtida a URL de requisição da superglobal $_SERVER['REQUEST_URI']
    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->controller_name = null;
        $this->parameters = [];
        $this->action = "index";
    }

    public function setParametersArray(array $param_arr)
    {
        $this->parameters = $param_arr;
    }

    public function setAction(string $action)
    {
        $this->action = $action;
    }

    public function setURL(string $url)
    {
        $this->url = '/'.$url;
    }

    public function setControllerName(string $controller_name)
    {
        $this->controller_name = $controller_name;
    }

    // Define uma URL para redirecionamento (usando setUrl())
    public function redirect(string $url)
    {
        $this->setURL($url);
        header("Location: /". $url );
    }

    public function pushParameter(string $param_name, string $param)
    {
        $this->parameters[$param_name] = $param;
    }

    public function getParameters() : ?array
    {
        return $this->parameters;
    }

    public function getURL() : string
    {
        return $this->url;
    }

    public function getControllerName() : ?string
    {
        return $this->controller_name;
    }

    public function getAction() : ?string
    {
        return $this->action;
    }

    public function getMethod() : string
    {
        return $this->method;
    }
}