<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DiceGolfController extends Controller {

    public function index() {
        $p_max = DB::select("SELECT MAX(length) AS ml, MAX(sum) AS ms FROM dicegolf")[0];
        return view('dicegolf', compact('p_max'));
    }

    public function stats_gather() {
        return DB::select("
            SELECT
                t.name,
                d.*
            FROM dicegolf AS d
            LEFT JOIN tuis AS t ON d.tui = t.id
            ORDER BY
                d.length DESC
            LIMIT 50
            ");
    }
}
