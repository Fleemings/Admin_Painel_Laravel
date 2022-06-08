<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    use HasFactory;
    protected $guarded = []; // same  as fillable
    // protected $fillable = [ // comunica com a migration para preencher os campos
    //     'title',
    //     'short_title',
    //     'home_slide',
    //     'video_url'
    // ];
}
