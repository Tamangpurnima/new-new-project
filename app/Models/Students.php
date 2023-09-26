<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'email',
        'contact',
        'passedyear',
        'previousschool',
        'gpa',
        'interest',
        'goal',
        'image',
    ];
}
