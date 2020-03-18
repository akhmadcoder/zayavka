<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zayavka extends Model
{
    protected $fillable = [
        'name', 'phone', 'description',
    ];

}
