<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller {

    public function index() {
        $test = number_format(file_get_contents('/sys/class/thermal/thermal_zone0/temp'), 1);
        return view('welcome', compact('test'));
    }
}
