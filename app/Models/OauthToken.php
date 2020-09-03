<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthToken extends Model {
    protected $table = 'oauth_tokens';

    protected $primaryKey = 'name';
    public $timestamps = false;

    protected $fillable = [
        'name', 'access_token', 'refresh_token', 'expires_at',
    ];
}
