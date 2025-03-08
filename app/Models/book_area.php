<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class book_area extends Model
{
    protected $table = 'book_areas';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;
}
