<?php
namespace Nautilus\Util;

class SessionHelper
{
    public static function restoreObject(string $session_var_name)
    {
        if(!empty($session_var_name) && is_string($session_var_name))
        {
            if(!empty($_SESSION[$session_var_name]))
                return unserialize($_SESSION[$session_var_name]);
        }

        return null;
    }

    public static function storeObject(string $session_var_name, $object)
    {
        if(!empty($session_var_name) && is_string($session_var_name))
        {
            $_SESSION[$session_var_name] = serialize($object);
            return true;
        }

        return false;
    }

    public static function destroySession() : void
    {
        session_destroy();
        unset($_SESSION);
    }
}