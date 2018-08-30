<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Car extends Eloquent
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'licensePlate', 'make', 'model','year', 'price'
    ];

    public function parts() {
        return $this->embedsMany(Part::class);
    }
}
