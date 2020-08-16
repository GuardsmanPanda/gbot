<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class DiceGolfController extends Controller {

    public function index() {
        $p_max = DB::select("SELECT MAX(length) AS ml, MAX(sum) AS ms FROM dicegolf")[0];
        return view('dicegolf', compact('p_max'));
    }

    public function stats_gather(Request $r) {
        $start = intval($r->get('game') ?? 100);
        $start = min($start, 2147483647);
        $start = max($start, 2);
        return DB::select("
            SELECT
                t.name,
                ROW_NUMBER() OVER (ORDER BY d.length DESC, d.sum DESC) AS rank,
                d.*
            FROM dicegolf AS d
            LEFT JOIN tuis AS t ON d.tui = t.id
            WHERE d.start = ?
            LIMIT 100
            ", [$start]);
    }
}
