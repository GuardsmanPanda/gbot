<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller {

    public function index() {
        $temp = [];
        exec("echo $(( $(< /sys/class/thermal/thermal_zone0/temp ) / 1000 ))", $temp);
        $test = $temp[0];
        return view('welcome', compact('test'));
    }
}
