<?php

namespace App\Http\Controllers;

use App\Models\OauthToken;
use App\Models\Tui;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExperimentalController extends Controller {
    private $client_id = 'q8q6jjiuc7f2ef04wmb7m653jd5ra8';


    public function index() {
        Tui::find(10)->update(['welcome_message' => 'Denmark']);
        return view("experimental");
    }

    public function login_twitch(Request $r) {
        try {
            $url = "https://id.twitch.tv/oauth2/token?client_id=" . $this->client_id;
            $url .= "&client_secret=" . config('app.twitch_secret');
            $url .= "&redirect_uri=https://gman.bot/oauth/twitch";
            $url .= "&scope=" . $r->get('scope');
            $url .= "&grant_type=authorization_code";
            $url .= "&code=" . $r->get('code');

            $resp = Http::post($url);
            if ($resp->failed()) {
                Log::warning($resp->body());
                return 'Login failed.';
            }

            $token = $resp->json()['access_token'];
            $resp = Http::withToken($token)
                ->withHeaders(['Client-ID' => $this->client_id])
                ->get("https://api.twitch.tv/helix/users");
            if ($resp->failed()) {
                Log::warning($resp->body());
                return 'Getting Twitch ID Failed.';
            }
            $twitch_user = $resp->json()['data'][0];

            if ($twitch_user['display_name'] == 'GuardsmanBob') {
                OauthToken::firstOrCreate([
                    'name' => 'gbob_twitch',
                    'access_token' => $twitch_user['access_token'],
                    'refresh_token' => $twitch_user['refresh_token'],
                ]);
            }

            $user = User::firstOrCreate(['tui' => $twitch_user['id']], ['name' => $twitch_user['display_name']]);
            Auth::login($user);

            return redirect('/');
        } catch (Exception $e) {
            Log::warning('Error on twitch Auth ' . $e->getMessage());
            return 'Not ok';
        }
    }
}
