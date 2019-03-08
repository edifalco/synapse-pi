<?php

namespace App\Http\Controllers\Admin;

use App\Memberrole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMemberrolesRequest;
use App\Http\Requests\Admin\UpdateMemberrolesRequest;
use Yajra\DataTables\DataTables;

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


        
        if (request()->ajax()) {
            $query = Memberrole::query();
            $query->with("member");
            $query->with("project");
            $query->with("partner");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('memberrole_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'memberroles.id',
                'memberroles.member_id',
                'memberroles.role',
                'memberroles.project_id',
                'memberroles.partner_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'memberrole_';
                $routeKey = 'admin.memberroles';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('member.name', function ($row) {
                return $row->member ? $row->member->name : '';
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });
            $table->editColumn('partner.name', function ($row) {
                return $row->partner ? $row->partner->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.memberroles.index');
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
