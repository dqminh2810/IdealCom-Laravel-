<?php
namespace Modules\Subscribers\Http\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Subscribers\Entities\Group;
use Modules\Subscribers\Entities\Subscriber;
use Modules\Subscribers\Http\Requests\GroupsRequest;
use Yajra\DataTables\Facades\DataTables;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('subscribers::groups.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('subscribers::groups.create');
    }
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GroupsRequest $request)
    {
        $request->validated();

        $group = new Group();
        $group->code=Input::get('code');
        $group->name=Input::get('name');
        $group->actif=1;
        $group->save();

        // redirect
        Session::flash('message', 'Successfully created Group!');
        return Redirect::route('groups.index');
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Group $group)
    {
        return view('subscribers::groups.show')->with('group', $group);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Group $group)
    {
        return view('subscribers::groups.edit')->with('group', $group);;
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GroupsRequest $request, Group $group)
    {
        $request->validated();

        $group->code=Input::get('code');
        $group->group_name=Input::get('name');
        $group->actif=1;
        $group->save();

        // redirect
        Session::flash('message', 'Successfully updated Group!');
        return Redirect::route('groups.index');
    }
    public function destroy(Group $group)
    {
        if ($group->delete()) {
            DB::table('group_subscriber')->where('group_id', $group->id)->delete();
            return 1;
        } else {
            return 0;
        }
    }
    /**
     * @return mixed
     * @throws \Exception
     */
    public function getDatatableSubscriber(Subscriber $subscriber)
    {
        $groups = $subscriber->groups;
        return Datatables::of($groups)
            ->addColumn('action', function ($groups) use ($subscriber) {
                return
                    "<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $groups->id . "\" data-subscriber_id=\"" . $subscriber->id . "\" title=\"Désassocier\" data-action=\"remove\">
						<i class=\"la la-remove\"></i>
					</button>";
            })
            //->removeColumn('password')
            ->make(true);
    }


    public function getBasicData()
    {
        $groups = Group::select(['id','code','group_name','actif','created_at','updated_at']);

        return Datatables::of($groups)
            /*->addColumn('auteur', function ($news) {
                $auteur = News::findOrFail($news->id)->user->name;
                if ($auteur == null) {
                    return User::find(1)->name;
                } else {
                    return $auteur;
                }
            })*/
            ->addColumn('action', function ($groups) {
                return
                    "<a href=\"" . route('groups.edit', $groups->id) . "\" class=\"m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill\" title=\"Editer\">
						<i class=\"la la-edit\"></i>
					</a>"
                    ."<button class=\"m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill\" id=\"" . $groups->id . "\" title=\"Supprimer\" data-action=\"delete\">
						<i class=\"la la-trash\"></i>
					</button>";
            })
            ->make(true);
    }

    public function enable (Group $group)
    {
        $group->actif = 1;
        $group->save();

        return $group->actif;
    }

    public function disable (Group $group)
    {
        $group->actif = 0;
        $group->save();

        return $group->actif;
    }
}