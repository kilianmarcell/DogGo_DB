<?php

namespace Doggo\Database;

use Illuminate\Database\Eloquent\Model;

class Ertekeles extends Model {
    protected $table = 'ertekelesek';
    public $timestamps = false;
    
    protected $guarded = ['id'];
}