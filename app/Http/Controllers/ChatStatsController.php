<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ChatStatsController extends Controller {

    public function index(Request $r) {
        return view('chatstats');
    }

    public function stats(Request $r) {
        return DB::select("
            SELECT chat_lines
            FROM tuis
            ORDER BY chat_lines
            LIMIT 250
        ");
    }
}
