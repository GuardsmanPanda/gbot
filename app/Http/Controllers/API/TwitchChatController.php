<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class TwitchChatController extends Controller {

    public function get_badge(string $name) {
        return '1';
    }
}
