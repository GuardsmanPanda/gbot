<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class TwitchChatController extends Controller {

    public function get_badge(string $name) {
        $db_res = DB::select("
            SELECT tu.flag, u.tui
            FROM twitch_name_to_tui AS t
            LEFT JOIN tuis AS tu ON tu.id = t.tui
            LEFT JOIN users AS u ON u.tui = t.tui
            WHERE t.twitch_name = ? ", [mb_strtolower($name)])[0];


        //CREATE BADGE IMAGE
        $img = imagecreatetruecolor(400, 84);
        imagesavealpha($img, true);
        $color = imagecolorallocatealpha($img, 0, 0, 0, 127);
        imagefill($img, 0, 0, $color);

        //ADD SECRET WEBSITE ICON
        if ($db_res->tui) {
            $site_icon = imagecreatefrompng(public_path("static/img/misc/site_chat_icon.png"));
            imagecopy($img, $site_icon, 198, 0, 0, 0, 84, 84);
        }


        //PUT FLAG ON IMAGE
        $flag = $db_res->flag ?? 'none';
        $flag_image = imagecreatefrompng(public_path("static/img/flags/$flag.png"));
        imagecopy($img, $flag_image, 286, 0, 0, 0, 114, 84);


        //Store the file, then load the file and send it on its way.
        imagepng($img, storage_path("cache/chat_badge/$name"));
        return response()->file(storage_path("cache/chat_badge/$name"));
    }
}
