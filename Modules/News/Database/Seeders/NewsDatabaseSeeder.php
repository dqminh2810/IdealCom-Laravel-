<?php

namespace Modules\News\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\News\Entities\News;
use Modules\News\Entities\NewsTranslation;

class NewsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		for($i = 0; $i < 10; ++$i)
		{
			$news = new News();
			$news->user_id = rand(1, 10);
			$news->actif = rand(0,1);
			$news->save();
		}
        $listnews = News::all();
        foreach ($listnews as $key=>$news){
            $news_translation_en = new NewsTranslation();
            $news_translation_en->news_id = $news->id;
            $news_translation_en->locale = 'en';
            $news_translation_en->title = 'Title'.$key;
            $news_translation_en->resume = 'Resume'.$key;
            $news_translation_en->content = 'Content'.$key;
            $news_translation_en->save();

            $news_translation_fr = new NewsTranslation();
            $news_translation_fr->news_id= $news->id;
            $news_translation_fr->locale = 'fr';
            $news_translation_fr->title = 'Titre'.$key;
            $news_translation_fr->resume = 'Résumé'.$key;
            $news_translation_fr->content = 'Contenu'.$key;
            $news_translation_fr->save();

        }
    }
}
