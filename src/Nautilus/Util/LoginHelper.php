<?php
namespace Nautilus\Util;

class LoginHelper
{
    public static function isAuthenticated() : bool
    {
        $user = SessionHelper::restoreObject("USER");

        return !is_null($user);
    }

    public static function authenticate($password, $hash) : bool
    {
        return password_verify($password, $hash);
    }
}