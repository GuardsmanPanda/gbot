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
            $prefix = "https://id.twitch.tv/oauth2/token?client_id=q8q6jjiuc7f2ef04wmb7m653jd5ra8&redirect_uri=https://gman.bot/oauth/twitch";
            $resp = Http::post($prefix . "&client_secret=" . env('TWITCH_SECRET') . "&scope=" . $r->get('scope') . "&code=" . $r->get('code'))->json();
            if (!in_array('expires_in', $resp)) Log::warning('Error on twitch Auth ' . json_encode($resp));
            return 'ok - expires in: ' . $resp['expires_in'];
        } catch (\Exception $e) {
            Log::warning('Error on twitch Auth ' . $e->getMessage());
            return 'Not ok';
        }
    }
}
