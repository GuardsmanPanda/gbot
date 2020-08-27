<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class TwitchChatController extends Controller {

    public function get_badge(string $name) {
        $flag = DB::select("
            SELECT tu.flag
            FROM twitch_name_to_tui AS t
            LEFT JOIN tuis AS tu ON tu.id = t.tui
            WHERE t.twitch_name = ? ", [mb_strtolower($name)])[0]->flag ?? 'none';

        return response()->file(public_path("static/img/flags/$flag.png"))->setMaxAge(0);
    }
}
