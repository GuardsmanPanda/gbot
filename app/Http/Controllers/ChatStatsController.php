<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ChatStatsController extends Controller {

    public function index(Request $r) {
        $max_vals = DB::select("
            SELECT
                   MAX(chat_lines), MAX(active_hours), MAX(idle_hours), MAX(bob_coins)
            FROM tuis
        ")[0];
        return view('chatstats', compact('max_vals'));
    }

    public function stats(Request $r) {
        return DB::select("
            SELECT
                   name, chat_lines, active_hours, idle_hours, bob_coins, updated_at
            FROM tuis
            ORDER BY chat_lines DESC
            LIMIT 250
        ");
    }
}
