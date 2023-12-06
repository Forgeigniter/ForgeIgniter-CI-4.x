<?php namespace Modules\WelcomeModule\Controllers;

use CodeIgniter\Controller;

class WelcomeModule extends Controller
{
    public function index()
    {
        return view('Modules\WelcomeModule\Views\welcome_message');
    }
}

