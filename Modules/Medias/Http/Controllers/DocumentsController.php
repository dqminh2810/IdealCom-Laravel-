<?php

namespace Modules\Medias\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Modules\Medias\Entities\Document;
use Modules\Medias\Http\Requests\DocumentsRequest;
use Psy\Util\Json;
use Yajra\DataTables\DataTables;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('medias::documents.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('medias::documents.create');
    }

		/**
		 * Store a newly created resource in storage.
		 * @param DocumentsRequest $request
		 * @return RedirectResponse
		 */
    public function store(DocumentsRequest $request)
    {
			$request->validated();

			$doc = new Document();
			$doc->title = Input::get('title');
			$doc->description = Input::get('description');
			if (Input::get('actif') === null){
				$doc->actif = 0;
			} else {
				$doc->actif = 1;
			}

			// Save document dossier public
			$fichier = Storage::put('documents', $request->file('document'), 'public');

			$doc->uuid = $fichier;

			$doc->save();

			Session::flash('message', 'Vous avez bien créé un nouveau document !');
			return Redirect::route('documents.index');
    }

		/**
		 * Show the specified resource.
		 * @param Document $document
		 * @return RedirectResponse
		 */
    public function show(Document $document)
    {
        return Redirect::to(url('/storage/'.$document->uuid));
    }

		/**
		 * Show the form for editing the specified resource.
		 * @param Document $document
		 * @return Response
		 */
    public function edit(Document $document)
    {
        return view('medias::documents.edit')->with('document', $document);
    }

		/**
		 * Update the specified resource in storage.
		 * @param DocumentsRequest $request
		 * @param Document $document
		 * @return RedirectResponse
		 */
    public function update(DocumentsRequest $request, Document $document)
    {

			$request->validated();

			$document->title = Input::get('title');
			$document->description = Input::get('description');
			if (Input::get('actif') === null){
				$document->actif = 0;
			} else {
				$document->actif = 1;
			}

			// Save document dossier public
			if ($request->file('document') != null) {
				$fichier = Storage::put('documents', $request->file('document'), 'public');

				$document->uuid = $fichier;
			}

			$document->save();

			Session::flash('message', 'Vous avez bien édité le document !');
			return Redirect::route('documents.index');

    }

		/**
		 * Remove the specified resource from storage.
		 * @param Document $document
		 * @return bool|null
		 * @throws \Exception
		 */
    public function destroy(Document $document)
    {
    	if ($document->delete()) {
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
			$documents = Document::select(['id','title','description','uuid','actif','created_at','updated_at']);

			return Datatables::of($documents)
				->addColumn('action', function ($documents) {
					return
						"<a href=\"" . route('documents.show', $documents->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
						<i class=\"la la-eye\"></i>
					</a>"
						."<a href=\"" . route('documents.edit', $documents->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
						."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $documents->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
				})
				//->removeColumn('password')
				->make(true);
		}

		/**
		 * @param Document $document
		 * @return int|mixed
		 */
		public function enable (Document $document)
		{
			$document->actif = 1;
			if ($document->save()) {
				return 1;
			} else {
				return 0;
			}
		}

		/**
		 * @param Document $document
		 * @return int|mixed
		 */
		public function disable (Document $document)
		{
			$document->actif = 0;
			if ($document->save()) {
				return 1;
			} else {
				return 0;
			}
		}
}
