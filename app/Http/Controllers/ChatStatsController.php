<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ChatStatsController extends Controller {

    public function index(Request $r) {
        $max_vals = DB::select("
            SELECT
                   MAX(chat_lines) AS chat_lines,
                   MAX(active_hours) AS active_hours,
                   MAX(idle_hours) AS idle_hours,
                   MAX(bob_coins) AS bob_coins
            FROM tuis
        ")[0];
        return view('chatstats')->with([
            'max_vals' => $max_vals,
        ]);
    }

    public function stats(Request $r) {
        switch ($r->get('sorters')[0]['field'] ?? '') {
            case "active_hours": $order = "active_hours"; break;
            case "updated_at": $order = "updated_at"; break;
            case "idle_hours": $order = "idle_hours"; break;
            case "bob_coins": $order = "bob_coins"; break;
            default: $order = "chat_lines"; break;
        }
        return DB::select("
            SELECT
                   name, flag, chat_lines, active_hours, idle_hours, bob_coins, updated_at
            FROM tuis
            ORDER BY $order DESC
            LIMIT 250
        ");
    }
}
