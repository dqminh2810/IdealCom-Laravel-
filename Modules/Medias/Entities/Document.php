<?php

namespace Modules\Medias\Entities;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['title', 'description', 'uuid', 'actif'];
}
