<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Languages\Entities\Language;
use Modules\Medias\Entities\Photo;
use Modules\News\Entities\News;
use Modules\News\Entities\NewsTranslation;
use Modules\News\Http\Requests\NewsRequest;
use Yajra\DataTables\DataTables;
use Modules\Core\Helpers\LocaleHelper;


class NewsController extends Controller
{
		/**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('news::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('news::create');
    }

		/**
		 * Store a newly created resource in storage.
	 	 * @param NewsRequest $request
	 	 * @return \Illuminate\Http\RedirectResponse
	 	 */
    public function store(NewsRequest $request)
		{
			// Vérifie les champs en fonction des "rules" defini dans NewsRequest, si ça ne
			// correpsond pas, il affiche les messages d'erreur directement sur le formulaire.
	        $request->validated();
            //dd(Input::get('content'));

			$news = new News;
			//$news->title = Input::get('title');
            //$news->resume = Input::get('resume');
			//$news->content = Input::get('content');
			$news->image = Input::get('image');
			$news->user_id = Auth::user()->getAuthIdentifier();
			$news->save();

			//ENGLISH
                $news_translation_en = new NewsTranslation();
                $news_translation_en->news_id = $news->id;
                $news_translation_en->locale = 'en';
                $news_translation_en->title = Input::get('en-title');
                $news_translation_en->resume = Input::get('en-resume');
                $news_translation_en->content = Input::get('en-content');
            //FRENCH
                $news_translation_fr = new NewsTranslation();
                $news_translation_fr->news_id = $news->id;
                $news_translation_fr->locale = 'fr';
                $news_translation_fr->title = Input::get('fr-title');
                $news_translation_fr->resume = Input::get('fr-resume');
                $news_translation_fr->content = Input::get('fr-content');

            $news_translation_en->save();
            $news_translation_fr->save();

            Session::flash('message', __('message.success_store_news'));
			return Redirect::route('news.index');

		}

	/**
	 * Show the specified resource.
	 * @param News $news
	 * @return Response
	 */
    public function show(News $news)
    {
        return view('news::show')->with('news', $news);
    }

	/**
	 * Show the form for editing the specified resource.
	 * @param News $news
	 * @return Response
	 */
    public function edit(News $news)
    {
        return view('news::edit')->with('news', $news);
    }

	  /**
		 * Update the specified resource in storage.
		 * @param NewsRequest $request
	 	 * @param News $news
	 	 * @return \Illuminate\Http\RedirectResponse
		 */
    public function update(NewsRequest $request, News $news)
    {

		$request->validated();
		//dd(Input::get('content'));
		//$news->title = Input::get('title');
		//$news->resume = Input::get('resume');
		//$news->content = Input::get('content');
		//$id_photo = Input::get('image')+1;
		//$news->image = DB::table('photos')->where('id', $id_photo)->value('uuid');
		$news->image = Input::get('image');

		$news->save();


		//ENGLISH
		$news_translation_en = NewsTranslation::where('news_id', $news->id)->where('locale', 'en')->first();
		$news_translation_en->title = Input::get('en-title');
		$news_translation_en->resume = Input::get('en-resume');
		$news_translation_en->content = Input::get('en-content');
		//FRENCH
		$news_translation_fr = NewsTranslation::where('news_id', $news->id)->where('locale', 'fr')->first();
		$news_translation_fr->title = Input::get('fr-title');
		$news_translation_fr->resume = Input::get('fr-resume');
		$news_translation_fr->content = Input::get('fr-content');

		$news_translation_en->save();
		$news_translation_fr->save();

		Session::flash('message', __('message.success_update_news'));
		return Redirect::route('news.index');

	}

	/**
	 * Remove the specified resource from storage.
	 * @param News $news
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
    public function destroy(News $news)
    {
			// delete
			$news->delete();

			// redirect
			return 'true';
    }

    public function getBasicData()
    {
        $news = News::all();
        return Datatables::of($news)
            ->addColumn('action', function ($news) {
                return
                    "<a href=\"" . route('news.show', $news->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
						<i class=\"la la-eye\"></i>
					</a>"
                    ."<a href=\"" . route('news.edit', $news->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
                    ."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $news->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
            })
            ->editColumn('user_id', '{{ App\User::where("id",$user_id)->first()->name }}')
            ->make(true);
    }

	public function enable (News $news)
	{
		$news->actif = 1;
		$news->save();

		return $news->actif;
	}
	public function disable (News $news)
	{
		$news->actif = 0;
		$news->save();

		return $news->actif;
	}
}

