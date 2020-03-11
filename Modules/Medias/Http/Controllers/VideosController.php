<?php

namespace Modules\Medias\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Modules\Medias\Entities\Video;
use Modules\Medias\Http\Requests\VideosRequest;
use Psy\Util\Json;
use Yajra\DataTables\DataTables;

class VideosController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index()
	{
		return view('medias::videos.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create()
	{
		return view('medias::videos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * @param VideosRequest $request
	 * @return RedirectResponse
	 */
	public function store(VideosRequest $request)
	{
		$request->validated();

		$video = new Video();
		$video->title = Input::get('title');
		$video->description = Input::get('description');
		$video->url = Input::get('url');
		if (Input::get('actif') === null){
			$video->actif = 0;
		} else {
			$video->actif = 1;
		}

		$video->save();

		Session::flash('message', 'Vous avez bien créé une nouvelle vidéo !');
		return Redirect::route('videos.index');
	}

	/**
	 * Show the specified resource.
	 * @param Video $video
	 * @return RedirectResponse
	 */
	public function show(Video $video)
	{
		return Redirect::to($video->url);
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Video $video
	 * @return Response
	 */
	public function edit(Video $video)
	{
		return view('medias::videos.edit')->with('video', $video);
	}

	/**
	 * Update the specified resource in storage.
	 * @param VideosRequest $request
	 * @param Video $video
	 * @return RedirectResponse
	 */
	public function update(VideosRequest $request, Video $video)
	{

		$request->validated();

		$video->title = Input::get('title');
		$video->description = Input::get('description');
		$video->url = Input::get('url');
		if (Input::get('actif') === null){
			$video->actif = 0;
		} else {
			$video->actif = 1;
		}

		$video->save();

		Session::flash('message', 'Vous avez bien édité la vidéo !');
		return Redirect::route('videos.index');

	}

	/**
	 * Remove the specified resource from storage.
	 * @param Video $video
	 * @return bool|null
	 * @throws \Exception
	 */
	public function destroy(Video $video)
	{
		if ($video->delete()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @return Json
	 * @throws \Exception
	 */
	public function getBasicData()
	{
		$videos = Video::select(['id','title','description','url','actif','created_at','updated_at']);

		return Datatables::of($videos)
			->addColumn('action', function ($videos) {
				return
					"<a href=\"" . route('videos.show', $videos->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
						<i class=\"la la-eye\"></i>
					</a>"
					."<a href=\"" . route('videos.edit', $videos->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
					."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $videos->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
			})
			//->removeColumn('password')
			->make(true);
	}

	/**
	 * @param Video $video
	 * @return int|mixed
	 */
	public function enable (Video $video)
	{
		$video->actif = 1;
		if ($video->save()) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param Video $video
	 * @return int|mixed
	 */
	public function disable (Video $video)
	{
		$video->actif = 0;
		if ($video->save()) {
			return 1;
		} else {
			return 0;
		}
	}
}
