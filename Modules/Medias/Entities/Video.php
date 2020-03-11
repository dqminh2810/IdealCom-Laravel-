<?php

namespace Modules\Medias\Entities;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'description', 'url', 'actif'];
}
