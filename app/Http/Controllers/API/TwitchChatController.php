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

        // CREATE BADGE IMAGE
        $img = imagecreatetruecolor(400, 84);
        imagesavealpha($img, true);
        $color = imagecolorallocatealpha($img, 0, 0, 0, 127);
        imagefill($img, 0, 0, $color);

        //PUT FLAG ON BAD IMAGE
        $flag_image = imagecreatefrompng(public_path("static/img/flags/$flag.png"));
        imagecopy($img, $flag_image, 286, 0, 0, 0, 114, 84);

        return imagepng($img);
    }
}
