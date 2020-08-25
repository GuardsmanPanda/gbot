<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class ExperimentalController extends Controller {

    public function index() {
        return view("experimental");
    }

    public function login_twitch(Request $r) {
        try {
            $prefix = "https://id.twitch.tv/oauth2/authorize?client_id=q8q6jjiuc7f2ef04wmb7m653jd5ra8&redirect_uri=https://gman.bot/oauth/twitch";
            $resp = Http::post($prefix . "&client_secret=" . env('TWITCH_SECRET') . "&scope=" . $r->get('scope' . "&code=" . $r->get('code')))->json();
            return 'ok - expires in: ' . $resp['expires_in'];
        } catch (\Exception $e) {
            return 'Not ok';
        }
    }
}
