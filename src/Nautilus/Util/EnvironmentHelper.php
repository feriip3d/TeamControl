<?php
namespace Nautilus\Util;

class EnvironmentHelper
{
    public static function getEnv($env_var)
    {
        return $_ENV[$env_var];
    }

    public static function getEnvByPrefix($env_var_prefix)
    {
        $prefix_arr = [];
        foreach(array_keys($_ENV) as $key)
        {
            if(preg_match("/$env_var_prefix/i", $key))
            {
                $prefix_arr[$key] = $_ENV[$key];
            }
        }

        return $prefix_arr;
    }
}