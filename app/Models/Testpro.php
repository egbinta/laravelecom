<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testpro extends Model
{
    use HasFactory;
    protected $table = "testpros";
    protected $fillable = [
        'proname',
        'proprice',
        'prodescription',
        'image'
    ];
}
