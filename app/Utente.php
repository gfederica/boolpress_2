<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utente extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message'
    ];
}
