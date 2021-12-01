<?php

namespace Doggo\Database;

use Illuminate\Database\Eloquent\Model;

class Komment extends Model {
    protected $table = 'kommentek';
    public $timestamps = false;
    
    protected $guarded = ['id'];
}