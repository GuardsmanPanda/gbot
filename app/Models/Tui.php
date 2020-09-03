<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tui extends Model {
    protected $table = 'tuis';

    public $timestamps = false;

    protected $fillable = [
        'flag', 'welcome_message',
    ];
}
