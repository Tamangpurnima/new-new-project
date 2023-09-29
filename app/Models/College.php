<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'email',
        'phone',
        'password',
        'contact',
        'description',
        'logo',
        'gallery.*',
    ];

    public function images()
    {
        return $this->hasMany(CollegeImage::class);
    }

    public function courseDetails()
    {
        return $this->hasMany(CourseDetail::class, 'college_id');
    }

}
