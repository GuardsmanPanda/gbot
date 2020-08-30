<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class UserController extends Controller {

    public function flag_selector() {
        $flags = scandir(public_path("static/img/flags"));
        $flags = array_filter($flags, function ($flag) { return strlen($flag) > 4; });
        $flags = array_map(function ($flag) { return substr($flag, 0, strlen($flag)-4); }, $flags);
        return view('flag_selector', compact('flags'));
    }
}
