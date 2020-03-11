<?php
/**
 * Created by PhpStorm.
 * User: dqminh
 * Date: 28/05/2018
 * Time: 15:07
 */

namespace Modules\Medias\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Medias\Entities\Photo;

class PhotosDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// On scan les img déjà présentes dans le dossier storage/photos et on les
		// enregistre dans la base de donnée.
        $photos = scandir(storage_path('app/public/photos'));
        foreach ($photos as $key=>$uuid)
		{
			// On ne veut pas les $uuid des dossiers ./ et ../
			if ($key > 1)
			{
			    if(is_file(storage_path('app/public/photos').'/'.$uuid)){
                    $photo = new Photo();
                    $photo->title = $uuid;
                    $photo->actif = 1;
                    $photo->uuid = 'photos/'.$uuid;
                    $photo->save();
                }
			}
		}
    }
}