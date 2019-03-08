<?php

namespace App\Http\Controllers\Admin;

use App\CdDissemination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCdDisseminationsRequest;
use App\Http\Requests\Admin\UpdateCdDisseminationsRequest;
use Yajra\DataTables\DataTables;

class CdDisseminationsController extends Controller
{
    /**
     * Display a listing of CdDissemination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('cd_dissemination_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = CdDissemination::query();
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('cd_dissemination_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'cd_disseminations.id',
                'cd_disseminations.month',
                'cd_disseminations.value',
                'cd_disseminations.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'cd_dissemination_';
                $routeKey = 'admin.cd_disseminations';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.cd_disseminations.index');
    }

    /**
     * Show the form for creating new CdDissemination.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('cd_dissemination_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.cd_disseminations.create', compact('projects'));
    }

    /**
     * Store a newly created CdDissemination in storage.
     *
     * @param  \App\Http\Requests\StoreCdDisseminationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCdDisseminationsRequest $request)
    {
        if (! Gate::allows('cd_dissemination_create')) {
            return abort(401);
        }
        $cd_dissemination = CdDissemination::create($request->all());



        return redirect()->route('admin.cd_disseminations.index');
    }


    /**
     * Show the form for editing CdDissemination.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('cd_dissemination_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $cd_dissemination = CdDissemination::findOrFail($id);

        return view('admin.cd_disseminations.edit', compact('cd_dissemination', 'projects'));
    }

    /**
     * Update CdDissemination in storage.
     *
     * @param  \App\Http\Requests\UpdateCdDisseminationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCdDisseminationsRequest $request, $id)
    {
        if (! Gate::allows('cd_dissemination_edit')) {
            return abort(401);
        }
        $cd_dissemination = CdDissemination::findOrFail($id);
        $cd_dissemination->update($request->all());



        return redirect()->route('admin.cd_disseminations.index');
    }


    /**
     * Display CdDissemination.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('cd_dissemination_view')) {
            return abort(401);
        }
        $cd_dissemination = CdDissemination::findOrFail($id);

        return view('admin.cd_disseminations.show', compact('cd_dissemination'));
    }


    /**
     * Remove CdDissemination from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('cd_dissemination_delete')) {
            return abort(401);
        }
        $cd_dissemination = CdDissemination::findOrFail($id);
        $cd_dissemination->delete();

        return redirect()->route('admin.cd_disseminations.index');
    }

    /**
     * Delete all selected CdDissemination at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('cd_dissemination_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CdDissemination::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore CdDissemination from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('cd_dissemination_delete')) {
            return abort(401);
        }
        $cd_dissemination = CdDissemination::onlyTrashed()->findOrFail($id);
        $cd_dissemination->restore();

        return redirect()->route('admin.cd_disseminations.index');
    }

    /**
     * Permanently delete CdDissemination from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('cd_dissemination_delete')) {
            return abort(401);
        }
        $cd_dissemination = CdDissemination::onlyTrashed()->findOrFail($id);
        $cd_dissemination->forceDelete();

        return redirect()->route('admin.cd_disseminations.index');
    }
}
