<?php

namespace Modules\News\Entities;

use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'resume', 'content'];


    public function news()
    {
        return $this->belongsTo('Modules\News\Entities\News');
    }
}