<?php

namespace Modules\Subscribers\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Modules\Subscribers\Entities\Group_subscriber;
use Illuminate\Support\Facades\Session;
use Modules\Subscribers\Entities\Group;
use Modules\Subscribers\Entities\Subscriber;
use Modules\Subscribers\Http\Requests\SubscribersRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('subscribers::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('subscribers::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  SubscribersRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SubscribersRequest $request)
    {
        $request->validated();

        $subscriber = new Subscriber();
        $subscriber->subscriber_name=Input::get('subscriber_name');
        $subscriber->email=Input::get('email');
        $subscriber->actif=1;
        $subscriber->save();

        // redirect
        Session::flash('message', 'Successfully created Subscriber!');
        return Redirect::route('subscribers.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Subscriber $subscriber)
    {
        return view('subscribers::show')->with('subscriber', $subscriber);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Subscriber $subscriber)
    {
        return view('subscribers::edit')->with('subscriber', $subscriber);;
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SubscribersRequest $request, Subscriber $subscriber)
    {
        $request->validated();

        $subscriber->subscriber_name=Input::get('subscriber_name');
        $subscriber->email=Input::get('email');
        $subscriber->actif=1;
        $subscriber->save();


        // redirect
        Session::flash('message', 'Successfully updated Subscriber!');
        return Redirect::route('subscribers.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Subscriber $subscriber, Group $group)
    {
        if ($subscriber->delete()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getBasicData()
    {
        /**
         * $subscribers = DB::table('group_subscriber')
        ->join('subscribers', 'subscribers.id', '=', 'group_subscriber.subscriber_id')
        ->join('groups', 'groups.id', '=', 'group_subscriber.group_id')
        ->select('subscribers.*', 'groups.group_name');
        */

        $subscribers = Subscriber::select(['id', 'subscriber_name', 'email', 'actif']);
        return Datatables::of($subscribers)
            /*->addColumn('auteur', function ($news) {
                $auteur = News::findOrFail($news->id)->user->name;
                if ($auteur == null) {
                    return User::find(1)->name;
                } else {
                    return $auteur;
                }
            })*/
            ->addColumn('action', function ($subscribers) {
                return
                    "<a href=\"" . route('subscribers.show', $subscribers->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Prévisualiser\">
						<i class=\"la la-eye\"></i>
					</a>"
                    ."<a href=\"" . route('subscribers.edit', $subscribers->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
                    ."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $subscribers->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
            })
            ->make(true);
    }

    public function addGroup(Subscriber $subscriber){
        //TODO
        $group = Group::where('id', Input::get('group_id')+1)->first();

        if ($subscriber->groups()->where('group_id', $group->id)->exists())
        {
            Session::flash('message', 'Erreur: Le domaine est déjà associé à l\'agence');
            return Redirect::route('subscribers.show', $subscriber->id);
        }
        else
        {
            $subscriber->groups()->attach($group);
            Session::flash('message', 'Vous avez bien associé le domaine à l\'agence !');
            return Redirect::route('subscribers.show', $subscriber->id);
        }

    }

    public function removeGroup(Group $group, Subscriber $subscriber){
        //TODO
        if ($subscriber->groups()->where('group_id', $group->id)->exists())
        {
            $subscriber->groups()->detach($group);
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function enable (Subscriber $subscriber)
    {
        $subscriber->actif = 1;
        $subscriber->save();

        return $subscriber->actif;
    }

    public function disable (Subscriber $subscriber)
    {
        $subscriber->actif = 0;
        $subscriber->save();

        return $subscriber->actif;
    }

}
