<?php
namespace Nautilus\Resources;
use Nautilus\Util\EnvironmentHelper;
use Nautilus\Util\ErrorHelper;
use Nautilus\Util\ImageHelper;
use Nautilus\Util\LoginHelper;
use Nautilus\Util\SessionHelper;
use Twig\Loader;
use Twig\Environment;
use Twig\Extension;
use Twig\Error\Error;
use Twig\TwigFunction;

class Controller
{
    private array $parameters = [];

    // Insere um novo parametro/valor
    public function pushParameter(String $name, $data)
    {
        $this->parameters[$name] = $data;
    }

    // Carrega um conjunto de parametros/valores
    public function setParameters(array $parameter_array)
    {
        $this->parameters = array_merge($parameter_array);
    }

    public function getParameter(String $paramater_name)
    {
        return filter_var($this->parameters[$paramater_name]);
    }

    // Carrega a view do controller e as variaveis
    public function render($filename='index')
    {
        $this->pushParameter("company_name", EnvironmentHelper::getEnv("COMPANY_NAME"));
        $this->pushParameter("app_name", EnvironmentHelper::getEnv("APP_NAME"));
        $this->pushParameter("company_initials", EnvironmentHelper::getEnv("COMPANY_INITIALS"));
        $this->pushParameter("app_version", EnvironmentHelper::getEnv("APP_VERSION"));

        if(LoginHelper::isAuthenticated())
        {
            $this->pushParameter("user", SessionHelper::restoreObject("USER"));
            $this->pushParameter("img", new ImageHelper());
        }

        $folder = '/'. ucfirst(str_replace(["App", "Controllers", "Controller", "\\"], '', get_class($this))) .'/';

        try
        {
            // Obtem o diretório de cache
            $cache_dir = EnvironmentHelper::getEnv("CACHE_DIR");
            $loader = new Loader\FilesystemLoader(ROOT_DIR ."/views");
            $twig = new Environment($loader, [
                "cache" => ROOT_DIR . $cache_dir . "/twig",
                "auto_reload" => true
            ]);

            $twig->addFunction(
                new TwigFunction(
                    'form_token',
                    function($lock_to = null) {
                        if (is_null(SessionHelper::restoreObject('token'))) {
                            SessionHelper::storeObject('token', bin2hex(random_bytes(32)));
                        }
                        if (is_null(SessionHelper::restoreObject('token2'))) {
                            SessionHelper::storeObject('token2',bin2hex(random_bytes(32)));
                        }
                        if (is_null($lock_to)) {
                            return SessionHelper::restoreObject('token');
                        }
                        return hash_hmac('sha256', $lock_to, SessionHelper::restoreObject('token2'));
                    }
                )
            );

            echo $twig->render($folder . $filename .".html", $this->parameters);
        }
        catch (Error $e)
        {
            ErrorHelper::generateError(404);
        }
    }
}