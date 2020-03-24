<?php
namespace App\Controllers;
use Nautilus\Resources\Controller;
use Nautilus\Resources\Request;
use Nautilus\Util\SessionHelper;

class LogoutController extends Controller
{
    function index()
    {
        $request = new Request();
        SessionHelper::destroySession();
        $request->redirect("login");
    }
}