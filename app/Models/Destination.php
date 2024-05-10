<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    protected $fillable = ['id','country_name', 'conjunction', 'name', 'computer_name'];
    protected $table = 'destinations';
}
