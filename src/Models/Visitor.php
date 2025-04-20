<?php

namespace MonishRoy\VisitorTracking\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'ip',
        'country',
        'region',
        'city',
        'device',
        'os',
        'browser',
        'url'
    ];
}
