<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class roomtype extends Model
{
    protected $table = 'roomtypes';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;
}
