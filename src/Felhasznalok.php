<?php

namespace Doggo\Database;

use Illuminate\Database\Eloquent\Model;

class Felhasznalok extends Model {
    protected $table = 'felhasznalok';
    public $timestamps = false;
    
    protected $guarded = ['id'];
}