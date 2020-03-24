<?php
namespace Nautilus\Util;
use Twig\Loader;
use Twig\Environment;

class ErrorHelper
{
    public static function generateError(string $type)
    {
        $cache_dir = EnvironmentHelper::getEnv("CACHE_DIR");
        $loader = new Loader\FilesystemLoader(ROOT_DIR . "/views/Errors");
        $twig = new Environment($loader, [
            "cache" => ROOT_DIR . $cache_dir . "/twig"
        ]);

        switch($type)
        {
            case "404":
                $template = "DefaultErrorPage.html";
                $params = [
                    "error_code" => "404",
                    "error_title" => "Página não encontrada",
                    "error_message" => "A página que você está tentando acessar não existe."
                ];
                break;
        }

        echo $twig->render($template, $params);
        die();
    }
}