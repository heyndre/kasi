<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  alchemyguy\YoutubeLaravelApi\AuthenticateService;


class YoutubeController extends Controller
{
    public function loginGoogle()
    {
        $authObject  = new AuthenticateService;

        # Replace the identifier with a unqiue identifier for account or channel
        $authUrl = $authObject->getLoginUrl('email', 'kasichannel');
    }
}
