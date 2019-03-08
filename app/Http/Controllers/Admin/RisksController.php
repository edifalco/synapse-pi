<?php

namespace App\Http\Controllers\Admin;

use App\Risk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRisksRequest;
use App\Http\Requests\Admin\UpdateRisksRequest;
use Yajra\DataTables\DataTables;

class RisksController extends Controller
{
    /**
     * Display a listing of Risk.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('risk_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Risk::query();
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('risk_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'risks.id',
                'risks.code',
                'risks.version',
                'risks.parent_id',
                'risks.description',
                'risks.score',
                'risks.flag',
                'risks.project_id',
                'risks.impact',
                'risks.probability',
                'risks.proximity',
                'risks.title',
                'risks.contingency',
                'risks.mitigation',
                'risks.triggerevents',
                'risks.resolved',
                'risks.risk_date',
                'risks.version_date',
                'risks.type',
                'risks.notes',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'risk_';
                $routeKey = 'admin.risks';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.risks.index');
    }

    /**
     * Show the form for creating new Risk.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('risk_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.risks.create', compact('projects'));
    }

    /**
     * Store a newly created Risk in storage.
     *
     * @param  \App\Http\Requests\StoreRisksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRisksRequest $request)
    {
        if (! Gate::allows('risk_create')) {
            return abort(401);
        }
        $risk = Risk::create($request->all());



        return redirect()->route('admin.risks.index');
    }


    /**
     * Show the form for editing Risk.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('risk_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $risk = Risk::findOrFail($id);

        return view('admin.risks.edit', compact('risk', 'projects'));
    }

    /**
     * Update Risk in storage.
     *
     * @param  \App\Http\Requests\UpdateRisksRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRisksRequest $request, $id)
    {
        if (! Gate::allows('risk_edit')) {
            return abort(401);
        }
        $risk = Risk::findOrFail($id);
        $risk->update($request->all());



        return redirect()->route('admin.risks.index');
    }


    /**
     * Display Risk.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('risk_view')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$risk_highlights = \App\RiskHighlight::where('risk_id', $id)->get();$risk_mowners = \App\RiskMowner::where('risk_id', $id)->get();$risk_mreporters = \App\RiskMreporter::where('risk_id', $id)->get();$risk_powners = \App\RiskPowner::where('risk_id', $id)->get();$risk_preporters = \App\RiskPreporter::where('risk_id', $id)->get();

        $risk = Risk::findOrFail($id);

        return view('admin.risks.show', compact('risk', 'risk_highlights', 'risk_mowners', 'risk_mreporters', 'risk_powners', 'risk_preporters'));
    }


    /**
     * Remove Risk from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('risk_delete')) {
            return abort(401);
        }
        $risk = Risk::findOrFail($id);
        $risk->delete();

        return redirect()->route('admin.risks.index');
    }

    /**
     * Delete all selected Risk at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('risk_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Risk::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Risk from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('risk_delete')) {
            return abort(401);
        }
        $risk = Risk::onlyTrashed()->findOrFail($id);
        $risk->restore();

        return redirect()->route('admin.risks.index');
    }

    /**
     * Permanently delete Risk from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('risk_delete')) {
            return abort(401);
        }
        $risk = Risk::onlyTrashed()->findOrFail($id);
        $risk->forceDelete();

        return redirect()->route('admin.risks.index');
    }
}
