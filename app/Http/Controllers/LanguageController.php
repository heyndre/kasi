<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function setLanguage($lang) {
        // set on session
        session(['language' => $lang]);
        return redirect()->back();
    }
}
