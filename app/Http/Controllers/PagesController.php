<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    

    public function maintenance() {
        return "Sorry, the site is currently under maintenance. Please check back later.";
    }
    
}

    