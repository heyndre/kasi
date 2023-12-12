<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\WelcomeNotification\WelcomeController as BaseWelcomeController;
use Symfony\Component\HttpFoundation\Response;

class welcomeController extends BaseWelcomeController
{
    protected function sendPasswordSavedResponse(): Response
    {
        return redirect()->route('dashboard');
    }
}
