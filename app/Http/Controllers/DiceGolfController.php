<?php

namespace App\Http\Controllers;

use App\Models\Tui;
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

    public function stats(Request $r) {
        switch ($r->get('sorters')[0]['field'] ?? '') {
            case "sum": $order = "d.sum desc, d.length, d.created_at"; break;
            case "created_at": $order = "created_at desc"; break;
            default: $order = "d.length desc, d.sum desc, d.created_at"; break;
        }
        return DB::select("
            SELECT
                t.name,
                d.*
            FROM dicegolf AS d
            LEFT JOIN tuis AS t ON d.tui = t.id
            WHERE d.start = ?
            ORDER BY $order
            LIMIT 100
            ", [$r->get('start')]);
    }

    public function most_games() {
        return DB::select("SELECT
            t.name, count(t.name) as amount
            FROM dicegolf AS d
            LEFT JOIN tuis AS t ON d.tui = t.id
            GROUP BY t.name
            ORDER by amount desc
            LIMIT 100
            ");
    }

    public function most_popular() {
        return DB::select("
            SELECT
                start AS Game, COUNT(start) AS Amount
            FROM dicegolf
            GROUP BY start
            ORDER BY Amount desc
            LIMIT 100
        ");
    }

    public function hole_in_one() {
        return DB::select("
            SELECT
                t.name, d.game, d.created_at
            FROM dicegolf AS d
            LEFT JOIN tuis AS t ON d.tui = t.id
            WHERE d.length = 1
            ORDER BY d.start desc, d.created_at
            LIMIT 100
        ");
    }
}
