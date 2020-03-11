<?php

namespace Modules\Pages\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\ModelCore;

class Page extends Model
{
    protected $fillable = ['title', 'url', 'code', 'actif'];
}