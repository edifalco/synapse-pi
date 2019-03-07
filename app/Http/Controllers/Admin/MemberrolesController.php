<?php

namespace App\Http\Controllers\Admin;

use App\Memberrole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMemberrolesRequest;
use App\Http\Requests\Admin\UpdateMemberrolesRequest;

class MemberrolesController extends Controller
{
    /**
     * Display a listing of Memberrole.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('memberrole_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('memberrole_delete')) {
                return abort(401);
            }
            $memberroles = Memberrole::onlyTrashed()->get();
        } else {
            $memberroles = Memberrole::all();
        }

        return view('admin.memberroles.index', compact('memberroles'));
    }

    /**
     * Show the form for creating new Memberrole.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('memberrole_create')) {
            return abort(401);
        }
        
        $members = \App\Member::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.memberroles.create', compact('members', 'projects', 'partners'));
    }

    /**
     * Store a newly created Memberrole in storage.
     *
     * @param  \App\Http\Requests\StoreMemberrolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberrolesRequest $request)
    {
        if (! Gate::allows('memberrole_create')) {
            return abort(401);
        }
        $memberrole = Memberrole::create($request->all());



        return redirect()->route('admin.memberroles.index');
    }


    /**
     * Show the form for editing Memberrole.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('memberrole_edit')) {
            return abort(401);
        }
        
        $members = \App\Member::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $memberrole = Memberrole::findOrFail($id);

        return view('admin.memberroles.edit', compact('memberrole', 'members', 'projects', 'partners'));
    }

    /**
     * Update Memberrole in storage.
     *
     * @param  \App\Http\Requests\UpdateMemberrolesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemberrolesRequest $request, $id)
    {
        if (! Gate::allows('memberrole_edit')) {
            return abort(401);
        }
        $memberrole = Memberrole::findOrFail($id);
        $memberrole->update($request->all());



        return redirect()->route('admin.memberroles.index');
    }


    /**
     * Display Memberrole.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('memberrole_view')) {
            return abort(401);
        }
        $memberrole = Memberrole::findOrFail($id);

        return view('admin.memberroles.show', compact('memberrole'));
    }


    /**
     * Remove Memberrole from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('memberrole_delete')) {
            return abort(401);
        }
        $memberrole = Memberrole::findOrFail($id);
        $memberrole->delete();

        return redirect()->route('admin.memberroles.index');
    }

    /**
     * Delete all selected Memberrole at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('memberrole_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Memberrole::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Memberrole from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('memberrole_delete')) {
            return abort(401);
        }
        $memberrole = Memberrole::onlyTrashed()->findOrFail($id);
        $memberrole->restore();

        return redirect()->route('admin.memberroles.index');
    }

    /**
     * Permanently delete Memberrole from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('memberrole_delete')) {
            return abort(401);
        }
        $memberrole = Memberrole::onlyTrashed()->findOrFail($id);
        $memberrole->forceDelete();

        return redirect()->route('admin.memberroles.index');
    }
}
