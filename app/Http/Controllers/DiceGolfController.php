<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class DiceGolfController extends Controller {

    public function index() {
        return view('dicegolf');
    }
}
