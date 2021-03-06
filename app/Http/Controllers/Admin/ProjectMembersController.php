<?php

namespace App\Http\Controllers\Admin;

use App\ProjectMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectMembersRequest;
use App\Http\Requests\Admin\UpdateProjectMembersRequest;
use Yajra\DataTables\DataTables;

class ProjectMembersController extends Controller
{
    /**
     * Display a listing of ProjectMember.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('project_member_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = ProjectMember::query();
            $query->with("project");
            $query->with("member");
            $query->with("partner");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('project_member_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'project_members.id',
                'project_members.project_id',
                'project_members.member_id',
                'project_members.partner_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'project_member_';
                $routeKey = 'admin.project_members';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });
            $table->editColumn('member.name', function ($row) {
                return $row->member ? $row->member->name : '';
            });
            $table->editColumn('partner.name', function ($row) {
                return $row->partner ? $row->partner->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.project_members.index');
    }

    /**
     * Show the form for creating new ProjectMember.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('project_member_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $members = \App\Member::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.project_members.create', compact('projects', 'members', 'partners'));
    }

    /**
     * Store a newly created ProjectMember in storage.
     *
     * @param  \App\Http\Requests\StoreProjectMembersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectMembersRequest $request)
    {
        if (! Gate::allows('project_member_create')) {
            return abort(401);
        }
        $project_member = ProjectMember::create($request->all());



        return redirect()->route('admin.project_members.index');
    }


    /**
     * Show the form for editing ProjectMember.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('project_member_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $members = \App\Member::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $project_member = ProjectMember::findOrFail($id);

        return view('admin.project_members.edit', compact('project_member', 'projects', 'members', 'partners'));
    }

    /**
     * Update ProjectMember in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectMembersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectMembersRequest $request, $id)
    {
        if (! Gate::allows('project_member_edit')) {
            return abort(401);
        }
        $project_member = ProjectMember::findOrFail($id);
        $project_member->update($request->all());



        return redirect()->route('admin.project_members.index');
    }


    /**
     * Display ProjectMember.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('project_member_view')) {
            return abort(401);
        }
        $project_member = ProjectMember::findOrFail($id);

        return view('admin.project_members.show', compact('project_member'));
    }


    /**
     * Remove ProjectMember from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('project_member_delete')) {
            return abort(401);
        }
        $project_member = ProjectMember::findOrFail($id);
        $project_member->delete();

        return redirect()->route('admin.project_members.index');
    }

    /**
     * Delete all selected ProjectMember at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('project_member_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ProjectMember::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ProjectMember from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('project_member_delete')) {
            return abort(401);
        }
        $project_member = ProjectMember::onlyTrashed()->findOrFail($id);
        $project_member->restore();

        return redirect()->route('admin.project_members.index');
    }

    /**
     * Permanently delete ProjectMember from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('project_member_delete')) {
            return abort(401);
        }
        $project_member = ProjectMember::onlyTrashed()->findOrFail($id);
        $project_member->forceDelete();

        return redirect()->route('admin.project_members.index');
    }
}
