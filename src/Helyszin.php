<?php

namespace Doggo\Database;

use Illuminate\Database\Eloquent\Model;

class Helyszin extends Model {
    protected $table = 'helyszinek';
    public $timestamps = false;
    
    protected $guarded = ['id'];
}