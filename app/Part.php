<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Part extends Eloquent
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'number', 'name'
    ];

}
