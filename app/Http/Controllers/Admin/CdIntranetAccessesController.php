<?php

namespace App\Http\Controllers\Admin;

use App\CdIntranetAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCdIntranetAccessesRequest;
use App\Http\Requests\Admin\UpdateCdIntranetAccessesRequest;
use Yajra\DataTables\DataTables;

class CdIntranetAccessesController extends Controller
{
    /**
     * Display a listing of CdIntranetAccess.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('cd_intranet_access_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = CdIntranetAccess::query();
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('cd_intranet_access_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'cd_intranet_accesses.id',
                'cd_intranet_accesses.month',
                'cd_intranet_accesses.value',
                'cd_intranet_accesses.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'cd_intranet_access_';
                $routeKey = 'admin.cd_intranet_accesses';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.cd_intranet_accesses.index');
    }

    /**
     * Show the form for creating new CdIntranetAccess.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('cd_intranet_access_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.cd_intranet_accesses.create', compact('projects'));
    }

    /**
     * Store a newly created CdIntranetAccess in storage.
     *
     * @param  \App\Http\Requests\StoreCdIntranetAccessesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCdIntranetAccessesRequest $request)
    {
        if (! Gate::allows('cd_intranet_access_create')) {
            return abort(401);
        }
        $cd_intranet_access = CdIntranetAccess::create($request->all());



        return redirect()->route('admin.cd_intranet_accesses.index');
    }


    /**
     * Show the form for editing CdIntranetAccess.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('cd_intranet_access_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $cd_intranet_access = CdIntranetAccess::findOrFail($id);

        return view('admin.cd_intranet_accesses.edit', compact('cd_intranet_access', 'projects'));
    }

    /**
     * Update CdIntranetAccess in storage.
     *
     * @param  \App\Http\Requests\UpdateCdIntranetAccessesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCdIntranetAccessesRequest $request, $id)
    {
        if (! Gate::allows('cd_intranet_access_edit')) {
            return abort(401);
        }
        $cd_intranet_access = CdIntranetAccess::findOrFail($id);
        $cd_intranet_access->update($request->all());



        return redirect()->route('admin.cd_intranet_accesses.index');
    }


    /**
     * Display CdIntranetAccess.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('cd_intranet_access_view')) {
            return abort(401);
        }
        $cd_intranet_access = CdIntranetAccess::findOrFail($id);

        return view('admin.cd_intranet_accesses.show', compact('cd_intranet_access'));
    }


    /**
     * Remove CdIntranetAccess from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('cd_intranet_access_delete')) {
            return abort(401);
        }
        $cd_intranet_access = CdIntranetAccess::findOrFail($id);
        $cd_intranet_access->delete();

        return redirect()->route('admin.cd_intranet_accesses.index');
    }

    /**
     * Delete all selected CdIntranetAccess at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('cd_intranet_access_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CdIntranetAccess::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore CdIntranetAccess from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('cd_intranet_access_delete')) {
            return abort(401);
        }
        $cd_intranet_access = CdIntranetAccess::onlyTrashed()->findOrFail($id);
        $cd_intranet_access->restore();

        return redirect()->route('admin.cd_intranet_accesses.index');
    }

    /**
     * Permanently delete CdIntranetAccess from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('cd_intranet_access_delete')) {
            return abort(401);
        }
        $cd_intranet_access = CdIntranetAccess::onlyTrashed()->findOrFail($id);
        $cd_intranet_access->forceDelete();

        return redirect()->route('admin.cd_intranet_accesses.index');
    }
}
