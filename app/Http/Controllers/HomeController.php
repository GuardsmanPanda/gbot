<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller {

    public function index() {
        $test = "Hello World!";
        return view('welcome', compact('test'));
    }
}
