<?php

namespace App\Http\Controllers\Admin;

use App\ThresholdRisk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreThresholdRisksRequest;
use App\Http\Requests\Admin\UpdateThresholdRisksRequest;
use Yajra\DataTables\DataTables;

class ThresholdRisksController extends Controller
{
    /**
     * Display a listing of ThresholdRisk.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('threshold_risk_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = ThresholdRisk::query();
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('threshold_risk_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'threshold_risks.id',
                'threshold_risks.value',
                'threshold_risks.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'threshold_risk_';
                $routeKey = 'admin.threshold_risks';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.threshold_risks.index');
    }

    /**
     * Show the form for creating new ThresholdRisk.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('threshold_risk_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.threshold_risks.create', compact('projects'));
    }

    /**
     * Store a newly created ThresholdRisk in storage.
     *
     * @param  \App\Http\Requests\StoreThresholdRisksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreThresholdRisksRequest $request)
    {
        if (! Gate::allows('threshold_risk_create')) {
            return abort(401);
        }
        $threshold_risk = ThresholdRisk::create($request->all());



        return redirect()->route('admin.threshold_risks.index');
    }


    /**
     * Show the form for editing ThresholdRisk.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('threshold_risk_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $threshold_risk = ThresholdRisk::findOrFail($id);

        return view('admin.threshold_risks.edit', compact('threshold_risk', 'projects'));
    }

    /**
     * Update ThresholdRisk in storage.
     *
     * @param  \App\Http\Requests\UpdateThresholdRisksRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateThresholdRisksRequest $request, $id)
    {
        if (! Gate::allows('threshold_risk_edit')) {
            return abort(401);
        }
        $threshold_risk = ThresholdRisk::findOrFail($id);
        $threshold_risk->update($request->all());



        return redirect()->route('admin.threshold_risks.index');
    }


    /**
     * Display ThresholdRisk.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('threshold_risk_view')) {
            return abort(401);
        }
        $threshold_risk = ThresholdRisk::findOrFail($id);

        return view('admin.threshold_risks.show', compact('threshold_risk'));
    }


    /**
     * Remove ThresholdRisk from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('threshold_risk_delete')) {
            return abort(401);
        }
        $threshold_risk = ThresholdRisk::findOrFail($id);
        $threshold_risk->delete();

        return redirect()->route('admin.threshold_risks.index');
    }

    /**
     * Delete all selected ThresholdRisk at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('threshold_risk_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ThresholdRisk::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ThresholdRisk from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('threshold_risk_delete')) {
            return abort(401);
        }
        $threshold_risk = ThresholdRisk::onlyTrashed()->findOrFail($id);
        $threshold_risk->restore();

        return redirect()->route('admin.threshold_risks.index');
    }

    /**
     * Permanently delete ThresholdRisk from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('threshold_risk_delete')) {
            return abort(401);
        }
        $threshold_risk = ThresholdRisk::onlyTrashed()->findOrFail($id);
        $threshold_risk->forceDelete();

        return redirect()->route('admin.threshold_risks.index');
    }
}
