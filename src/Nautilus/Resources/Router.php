<?php
namespace Nautilus\Resources;
use Nautilus\Resources\Request;

// Classe para gerenciamento de rotas do aplicativo
class Router
{
    public static function parseURL(Request $request)
    {
        $parameters = [];
        // Remove os espaços da URL e prepara suas partes para processamento
        // removendo a primeira parte da url e separando os parametros
        // A URL segue formatada da seguinte forma
        // {host}/{controller}/{acao}/[[nome_parametro]/[parametro]/]...
        $raw_url = array_filter(explode('?', $request->getURL()));
        if(sizeof($raw_url) > 1)
            $parameters = array_pop($raw_url);
        $raw_url = array_filter(explode('/', $raw_url[0]));
        if(!empty($raw_url))
        {
            $request->setControllerName(array_shift($raw_url));
            if(!empty($raw_url))
                $request->setAction(array_shift($raw_url));
        }
        else
        {
            // Se não informado nenhum controller, o usuario será direcionado para a index
            $request->setUrl("index");
            $request->setControllerName("index");
        }
        // Se existir parametros a serem processados, serão passados adiante corretamente
        if(!empty($parameters))
        {
            $parameters = explode('&', $parameters);
            foreach($parameters as $item)
            {
                $item = explode('=', $item);
                $request->pushParameter($item[0], $item[1]);
            }
        }
    }
}