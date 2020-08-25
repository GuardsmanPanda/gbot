<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExperimentalController extends Controller {

    public function index() {
        return view("experimental");
    }

    public function login_twitch(Request $r) {
        try {
            $url = "https://id.twitch.tv/oauth2/token?client_id=q8q6jjiuc7f2ef04wmb7m653jd5ra8";
            $url .= "&client_secret=" . config('app.twitch_secret');
            $url .= "&redirect_uri=https://gman.bot/oauth/twitch";
            $url .= "&scope=" . $r->get('scope');
            $url .= "&grant_type=authorization_code";
            $url .= "&code=" . $r->get('code');
            $resp = Http::post($url)->json();
            if (!in_array('expires_in', $resp)) Log::warning('Error on twitch Auth ' . json_encode($resp));
            return 'ok - expires in: ' . $resp['expires_in'];
        } catch (\Exception $e) {
            Log::warning('Error on twitch Auth ' . $e->getMessage());
            return 'Not ok';
        }
    }
}
