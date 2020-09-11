<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class TwitchChatController extends Controller {

    public function get_badge(string $name) {
        $db_res = DB::select("
            SELECT tu.flag, tu.heart_color, u.tui
            FROM twitch_name_to_tui AS t
            LEFT JOIN tuis AS tu ON tu.id = t.tui
            LEFT JOIN users AS u ON u.tui = t.tui
            WHERE t.twitch_name = ? ", [mb_strtolower($name)])[0];

        //ARRAY OF ICONS TO ADD TO BASE
        $icons = [];

        //PUT FLAG ON IMAGE
        $flag = $db_res->flag ?? 'none';
        if ($flag !== 'none') {
            $flag_image = imagecreatefrompng(public_path("static/img/flags/$flag.png"));
            array_push($icons, ['width' => 114, 'img' => $flag_image]);
        }


        if ($db_res->heart_color) {
            $heart_icon = imagecreatefrompng(public_path("static/img/misc/heart_" . $db_res->heart_color . ".png"));
            array_push($icons, ['width' => 102, 'img' => $heart_icon]);
        }

        //ADD SECRET WEBSITE ICON
        if ($db_res->tui) {
            $site_icon = imagecreatefrompng(public_path("static/img/misc/site_chat_icon.png"));
            array_push($icons, ['width' => 84, 'img' => $site_icon]);
        }

        //CREATE BADGE BASE IMAGE
        $badge_width = 400;
        $img = imagecreatetruecolor($badge_width, 84);
        imagesavealpha($img, true);
        $color = imagecolorallocatealpha($img, 0, 0, 0, 127);
        imagefill($img, 0, 0, $color);

        //ADD ALL ICONS
        foreach ($icons as $icon) {
            $badge_width -= $icon['width'] + 8;
            imagecopy($img, $icon['img'], $badge_width, 0, 0, 0, $icon['width'], 84);
        }


        //Store the file, then load the file and send it on its way.
        imagepng($img, storage_path("cache/chat_badge/$name"));
        usleep(10000);
        return response()->file(storage_path("cache/chat_badge/$name"));
    }
}
