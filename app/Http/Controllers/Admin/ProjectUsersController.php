<?php

namespace App\Http\Controllers\Admin;

use App\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectUsersRequest;
use App\Http\Requests\Admin\UpdateProjectUsersRequest;
use Yajra\DataTables\DataTables;

class ProjectUsersController extends Controller
{
    /**
     * Display a listing of ProjectUser.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('project_user_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = ProjectUser::query();
            $query->with("userID");
            $query->with("projectID");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('project_user_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'project_users.id',
                'project_users.userID_id',
                'project_users.projectID_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'project_user_';
                $routeKey = 'admin.project_users';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('userID.name', function ($row) {
                return $row->userID ? $row->userID->name : '';
            });
            $table->editColumn('projectID.name', function ($row) {
                return $row->projectID ? $row->projectID->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.project_users.index');
    }

    /**
     * Show the form for creating new ProjectUser.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('project_user_create')) {
            return abort(401);
        }
        
        $user_i_ds = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_i_ds = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.project_users.create', compact('user_i_ds', 'project_i_ds'));
    }

    /**
     * Store a newly created ProjectUser in storage.
     *
     * @param  \App\Http\Requests\StoreProjectUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectUsersRequest $request)
    {
        if (! Gate::allows('project_user_create')) {
            return abort(401);
        }
        $project_user = ProjectUser::create($request->all());



        return redirect()->route('admin.project_users.index');
    }


    /**
     * Show the form for editing ProjectUser.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('project_user_edit')) {
            return abort(401);
        }
        
        $user_i_ds = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_i_ds = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $project_user = ProjectUser::findOrFail($id);

        return view('admin.project_users.edit', compact('project_user', 'user_i_ds', 'project_i_ds'));
    }

    /**
     * Update ProjectUser in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectUsersRequest $request, $id)
    {
        if (! Gate::allows('project_user_edit')) {
            return abort(401);
        }
        $project_user = ProjectUser::findOrFail($id);
        $project_user->update($request->all());



        return redirect()->route('admin.project_users.index');
    }


    /**
     * Display ProjectUser.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('project_user_view')) {
            return abort(401);
        }
        $project_user = ProjectUser::findOrFail($id);

        return view('admin.project_users.show', compact('project_user'));
    }


    /**
     * Remove ProjectUser from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('project_user_delete')) {
            return abort(401);
        }
        $project_user = ProjectUser::findOrFail($id);
        $project_user->delete();

        return redirect()->route('admin.project_users.index');
    }

    /**
     * Delete all selected ProjectUser at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('project_user_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ProjectUser::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ProjectUser from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('project_user_delete')) {
            return abort(401);
        }
        $project_user = ProjectUser::onlyTrashed()->findOrFail($id);
        $project_user->restore();

        return redirect()->route('admin.project_users.index');
    }

    /**
     * Permanently delete ProjectUser from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('project_user_delete')) {
            return abort(401);
        }
        $project_user = ProjectUser::onlyTrashed()->findOrFail($id);
        $project_user->forceDelete();

        return redirect()->route('admin.project_users.index');
    }
}
