<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dicegolf extends Model {
    protected $table = 'dicegolf';

    public $timestamps = false;

    protected $fillable = [
        'tui', 'length', 'sum', 'game', 'start',
    ];
}
