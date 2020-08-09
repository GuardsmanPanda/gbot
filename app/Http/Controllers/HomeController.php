<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller {

    public function index() {
        $test = file_get_contents('/sys/class/thermal/thermal_zone0/temp');
        return view('welcome', compact('test'));
    }
}
