<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stories extends Model
{
    protected $fillable = [
        'name', 'name_en', 'title', 'title_en', 'story', 'story_en', 'avatar', '_order', 'active',
    ];
}
