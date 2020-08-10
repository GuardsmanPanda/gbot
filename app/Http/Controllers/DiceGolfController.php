<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DiceGolfController extends Controller {

    public function index() {
        return view('dicegolf');
    }

    public function stats_gather() {
        return DB::select("SELECT * FROM dicegolf");
    }
}
