<?php

namespace App\Http\Controllers\Admin;

use App\RiskImpact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRiskImpactsRequest;
use App\Http\Requests\Admin\UpdateRiskImpactsRequest;
use Yajra\DataTables\DataTables;

class RiskImpactsController extends Controller
{
    /**
     * Display a listing of RiskImpact.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('risk_impact_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = RiskImpact::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('risk_impact_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'risk_impacts.id',
                'risk_impacts.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'risk_impact_';
                $routeKey = 'admin.risk_impacts';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.risk_impacts.index');
    }

    /**
     * Show the form for creating new RiskImpact.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('risk_impact_create')) {
            return abort(401);
        }
        return view('admin.risk_impacts.create');
    }

    /**
     * Store a newly created RiskImpact in storage.
     *
     * @param  \App\Http\Requests\StoreRiskImpactsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRiskImpactsRequest $request)
    {
        if (! Gate::allows('risk_impact_create')) {
            return abort(401);
        }
        $risk_impact = RiskImpact::create($request->all());



        return redirect()->route('admin.risk_impacts.index');
    }


    /**
     * Show the form for editing RiskImpact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('risk_impact_edit')) {
            return abort(401);
        }
        $risk_impact = RiskImpact::findOrFail($id);

        return view('admin.risk_impacts.edit', compact('risk_impact'));
    }

    /**
     * Update RiskImpact in storage.
     *
     * @param  \App\Http\Requests\UpdateRiskImpactsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRiskImpactsRequest $request, $id)
    {
        if (! Gate::allows('risk_impact_edit')) {
            return abort(401);
        }
        $risk_impact = RiskImpact::findOrFail($id);
        $risk_impact->update($request->all());



        return redirect()->route('admin.risk_impacts.index');
    }


    /**
     * Display RiskImpact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('risk_impact_view')) {
            return abort(401);
        }
        $risks = \App\Risk::where('risk_impact_id', $id)->get();

        $risk_impact = RiskImpact::findOrFail($id);

        return view('admin.risk_impacts.show', compact('risk_impact', 'risks'));
    }


    /**
     * Remove RiskImpact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('risk_impact_delete')) {
            return abort(401);
        }
        $risk_impact = RiskImpact::findOrFail($id);
        $risk_impact->delete();

        return redirect()->route('admin.risk_impacts.index');
    }

    /**
     * Delete all selected RiskImpact at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('risk_impact_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = RiskImpact::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore RiskImpact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('risk_impact_delete')) {
            return abort(401);
        }
        $risk_impact = RiskImpact::onlyTrashed()->findOrFail($id);
        $risk_impact->restore();

        return redirect()->route('admin.risk_impacts.index');
    }

    /**
     * Permanently delete RiskImpact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('risk_impact_delete')) {
            return abort(401);
        }
        $risk_impact = RiskImpact::onlyTrashed()->findOrFail($id);
        $risk_impact->forceDelete();

        return redirect()->route('admin.risk_impacts.index');
    }
}
