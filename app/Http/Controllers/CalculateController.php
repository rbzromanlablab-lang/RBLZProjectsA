<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculateController extends Controller
{
    function about() {
    $a = 5;
    $b = 5;
    $sum = $a + $b;

    return "sum is: $sum";
    }
}
