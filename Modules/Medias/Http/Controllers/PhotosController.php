<?php

namespace Modules\Medias\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Modules\Medias\Entities\Photo;
use Modules\Medias\Http\Requests\PhotosRequest;
use Yajra\DataTables\DataTables;

class PhotosController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index()
	{
		return view('medias::photos.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create()
	{
		return view('medias::photos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * @param PhotosRequest $request
	 * @return RedirectResponse
	 */
	public function store(PhotosRequest $request)
	{
		$request->validated();

		$photo = new Photo();
		$photo->title = Input::get('title');
		$photo->description = Input::get('description');
		if (Input::get('actif') === null){
			$photo->actif = 0;
		} else {
			$photo->actif = 1;
		}

		$photo_value = $request->file('photo');
		$photo_name = $photo_value->getClientOriginalName();
        // Save photo dossier public
		$photo_path = $photo_value->storeAs('photos', $photo_name);
		//$fichier = Storage::put('photos', $request->file('photo'), 'public');

		$photo->uuid = $photo_path;

		$photo->save();

		Session::flash('message', 'Vous avez bien créé une nouvelle photo !');
		return Redirect::route('photos.index');
	}

	/**
	 * Show the specified resource.
	 * @param Photo $photo
	 * @return RedirectResponse
	 */
	public function show(Photo $photo)
	{
		return Redirect::to(url('/storage/'.$photo->uuid));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Photo $photo
	 * @return Response
	 */
	public function edit(Photo $photo)
	{
		return view('medias::photos.edit')->with('photo', $photo);
	}

	/**
	 * Update the specified resource in storage.
	 * @param PhotosRequest $request
	 * @param Photo $photo
	 * @return RedirectResponse
	 */
	public function update(PhotosRequest $request, Photo $photo)
	{

		$request->validated();

		$photo->title = Input::get('title');
		$photo->description = Input::get('description');
		if (Input::get('actif') === null){
			$photo->actif = 0;
		} else {
			$photo->actif = 1;
		}

		// Save photo dossier public
		if ($request->file('photo') != null) {
			$fichier = Storage::put('photos', $request->file('photo'), 'public');

			$photo->uuid = $fichier;
		}

		$photo->save();

		Session::flash('message', 'Vous avez bien édité la photo !');
		return Redirect::route('photos.index');

	}

	/**
	 * Remove the specified resource from storage.
	 * @param Photo $photo
	 * @return bool|null
	 * @throws \Exception
	 */
	public function destroy(Photo $photo)
	{
		if ($photo->delete()) {
		    //Storage::delete('')
			return 1;
		} else {
			return 0;
		}
	}

    public function getBasicData()
    {
        $photos = Photo::select(['id','title','description','uuid','actif','created_at','updated_at']);

        return Datatables::of($photos)
            ->addColumn('action', function ($photos) {
                return
                    "<a href=\"" . route('photos.show', $photos->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
						<i class=\"la la-eye\"></i>
					</a>"
                    ."<a href=\"" . route('photos.edit', $photos->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
                    ."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $photos->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
            })
            //->removeColumn('password')
            ->make(true);
    }

	/**
	 * @param Photo $photo
	 * @return int|mixed
	 */
	public function enable (Photo $photo)
	{
		$photo->actif = 1;
		if ($photo->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param Photo $photo
	 * @return int|mixed
	 */
	public function disable (Photo $photo)
	{
		$photo->actif = 0;
		if ($photo->save()) {
			return 1;
		} else {
			return 0;
		}
	}


	/**
	 *
	 */
	public function loadAllImg ()
	{
		$photos_saved = Photo::all();
		$uuid_saved = array();

		foreach ($photos_saved as $key=>$photo)
		{
			$uuid_saved[$photo->uuid] = $photo->id;
		}

        $storage_path = storage_path('app/public/photos');
		$photos_scan = scandir($storage_path);
		foreach ($photos_scan as $key=>$uuid)
		{
			// On ne veut pas les $uuid des dossiers ./ et ../
			if ($key > 1)
			{
				if (!array_key_exists('photos/'.$uuid, $uuid_saved)) {
				    if(is_file($storage_path.'/'.$uuid)){
                        $photo = new Photo();
                        $photo->title = $uuid;
                        $photo->actif = 1;
                        $photo->uuid = 'photos/' . $uuid;
                        $photo->save();
                    }
				}
			}
		}

		return 1;
	}

}
