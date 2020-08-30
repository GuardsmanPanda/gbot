<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class UserController extends Controller {

    public function flag_selector() {
        $flags = scandir(public_path("static/img/flags"));
        $flags = array_filter($flags, function ($flag) { return strlen($flag) > 4; });
        return view('flag_selector', compact('flags'));
    }
}
