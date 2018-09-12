<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Owner extends Eloquent
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'firsName', 'lastName'
    ];

    public function cars() {
        return $this->hasMany(Car::class);
    }
}
