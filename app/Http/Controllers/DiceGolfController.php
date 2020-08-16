<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class DiceGolfController extends Controller {

    public function index(Request $r) {
        $start = intval($r->get('start') ?? 100);
        $start = min($start, 2147483647);
        $start = max($start, 2);
        $p_max = DB::select(" SELECT MAX(length) AS ml, MAX(sum) AS ms FROM dicegolf WHERE start = ?", [$start])[0];
        return view('dicegolf', compact('p_max', 'start'));
    }

    public function stats_gather(Request $r) {
        return DB::select("
            SELECT
                t.name,
                d.*
            FROM dicegolf AS d
            LEFT JOIN tuis AS t ON d.tui = t.id
            WHERE d.start = ?
            ORDER BY d.length desc, d.sum desc
            LIMIT 100
            ", [$r->get('start')]);
    }
}
