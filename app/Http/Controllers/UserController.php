<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class UserController extends Controller {

    public function flag_selector() {
        return view('flag_selector');
    }
}
