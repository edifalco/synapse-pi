<?php

namespace App\Http\Controllers\Admin;

use App\RiskHighlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRiskHighlightsRequest;
use App\Http\Requests\Admin\UpdateRiskHighlightsRequest;
use Yajra\DataTables\DataTables;

class RiskHighlightsController extends Controller
{
    /**
     * Display a listing of RiskHighlight.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('risk_highlight_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = RiskHighlight::query();
            $query->with("risk");
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('risk_highlight_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'risk_highlights.id',
                'risk_highlights.risk_id',
                'risk_highlights.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'risk_highlight_';
                $routeKey = 'admin.risk_highlights';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('risk.code', function ($row) {
                return $row->risk ? $row->risk->code : '';
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.risk_highlights.index');
    }

    /**
     * Show the form for creating new RiskHighlight.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('risk_highlight_create')) {
            return abort(401);
        }
        
        $risks = \App\Risk::get()->pluck('code', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.risk_highlights.create', compact('risks', 'projects'));
    }

    /**
     * Store a newly created RiskHighlight in storage.
     *
     * @param  \App\Http\Requests\StoreRiskHighlightsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRiskHighlightsRequest $request)
    {
        if (! Gate::allows('risk_highlight_create')) {
            return abort(401);
        }
        $risk_highlight = RiskHighlight::create($request->all());



        return redirect()->route('admin.risk_highlights.index');
    }


    /**
     * Show the form for editing RiskHighlight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('risk_highlight_edit')) {
            return abort(401);
        }
        
        $risks = \App\Risk::get()->pluck('code', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $risk_highlight = RiskHighlight::findOrFail($id);

        return view('admin.risk_highlights.edit', compact('risk_highlight', 'risks', 'projects'));
    }

    /**
     * Update RiskHighlight in storage.
     *
     * @param  \App\Http\Requests\UpdateRiskHighlightsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRiskHighlightsRequest $request, $id)
    {
        if (! Gate::allows('risk_highlight_edit')) {
            return abort(401);
        }
        $risk_highlight = RiskHighlight::findOrFail($id);
        $risk_highlight->update($request->all());



        return redirect()->route('admin.risk_highlights.index');
    }


    /**
     * Display RiskHighlight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('risk_highlight_view')) {
            return abort(401);
        }
        $risk_highlight = RiskHighlight::findOrFail($id);

        return view('admin.risk_highlights.show', compact('risk_highlight'));
    }


    /**
     * Remove RiskHighlight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('risk_highlight_delete')) {
            return abort(401);
        }
        $risk_highlight = RiskHighlight::findOrFail($id);
        $risk_highlight->delete();

        return redirect()->route('admin.risk_highlights.index');
    }

    /**
     * Delete all selected RiskHighlight at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('risk_highlight_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = RiskHighlight::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore RiskHighlight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('risk_highlight_delete')) {
            return abort(401);
        }
        $risk_highlight = RiskHighlight::onlyTrashed()->findOrFail($id);
        $risk_highlight->restore();

        return redirect()->route('admin.risk_highlights.index');
    }

    /**
     * Permanently delete RiskHighlight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('risk_highlight_delete')) {
            return abort(401);
        }
        $risk_highlight = RiskHighlight::onlyTrashed()->findOrFail($id);
        $risk_highlight->forceDelete();

        return redirect()->route('admin.risk_highlights.index');
    }
}
