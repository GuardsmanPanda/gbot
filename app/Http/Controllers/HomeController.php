<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller {

    public function index() {
        $temp = [];
        exec("echo 'text'", $temp);
        $test = $temp[0];
        return view('welcome', compact('test'));
    }
}
