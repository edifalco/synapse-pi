<?php

namespace App\Http\Controllers\Admin;

use App\RiskProximity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRiskProximitiesRequest;
use App\Http\Requests\Admin\UpdateRiskProximitiesRequest;
use Yajra\DataTables\DataTables;

class RiskProximitiesController extends Controller
{
    /**
     * Display a listing of RiskProximity.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('risk_proximity_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = RiskProximity::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('risk_proximity_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'risk_proximities.id',
                'risk_proximities.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'risk_proximity_';
                $routeKey = 'admin.risk_proximities';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.risk_proximities.index');
    }

    /**
     * Show the form for creating new RiskProximity.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('risk_proximity_create')) {
            return abort(401);
        }
        return view('admin.risk_proximities.create');
    }

    /**
     * Store a newly created RiskProximity in storage.
     *
     * @param  \App\Http\Requests\StoreRiskProximitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRiskProximitiesRequest $request)
    {
        if (! Gate::allows('risk_proximity_create')) {
            return abort(401);
        }
        $risk_proximity = RiskProximity::create($request->all());



        return redirect()->route('admin.risk_proximities.index');
    }


    /**
     * Show the form for editing RiskProximity.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('risk_proximity_edit')) {
            return abort(401);
        }
        $risk_proximity = RiskProximity::findOrFail($id);

        return view('admin.risk_proximities.edit', compact('risk_proximity'));
    }

    /**
     * Update RiskProximity in storage.
     *
     * @param  \App\Http\Requests\UpdateRiskProximitiesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRiskProximitiesRequest $request, $id)
    {
        if (! Gate::allows('risk_proximity_edit')) {
            return abort(401);
        }
        $risk_proximity = RiskProximity::findOrFail($id);
        $risk_proximity->update($request->all());



        return redirect()->route('admin.risk_proximities.index');
    }


    /**
     * Display RiskProximity.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('risk_proximity_view')) {
            return abort(401);
        }
        $risks = \App\Risk::where('risk_proximity_id', $id)->get();

        $risk_proximity = RiskProximity::findOrFail($id);

        return view('admin.risk_proximities.show', compact('risk_proximity', 'risks'));
    }


    /**
     * Remove RiskProximity from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('risk_proximity_delete')) {
            return abort(401);
        }
        $risk_proximity = RiskProximity::findOrFail($id);
        $risk_proximity->delete();

        return redirect()->route('admin.risk_proximities.index');
    }

    /**
     * Delete all selected RiskProximity at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('risk_proximity_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = RiskProximity::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore RiskProximity from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('risk_proximity_delete')) {
            return abort(401);
        }
        $risk_proximity = RiskProximity::onlyTrashed()->findOrFail($id);
        $risk_proximity->restore();

        return redirect()->route('admin.risk_proximities.index');
    }

    /**
     * Permanently delete RiskProximity from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('risk_proximity_delete')) {
            return abort(401);
        }
        $risk_proximity = RiskProximity::onlyTrashed()->findOrFail($id);
        $risk_proximity->forceDelete();

        return redirect()->route('admin.risk_proximities.index');
    }
}
