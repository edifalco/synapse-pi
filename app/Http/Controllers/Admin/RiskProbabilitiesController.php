<?php

namespace App\Http\Controllers\Admin;

use App\RiskProbability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRiskProbabilitiesRequest;
use App\Http\Requests\Admin\UpdateRiskProbabilitiesRequest;
use Yajra\DataTables\DataTables;

class RiskProbabilitiesController extends Controller
{
    /**
     * Display a listing of RiskProbability.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('risk_probability_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = RiskProbability::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('risk_probability_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'risk_probabilities.id',
                'risk_probabilities.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'risk_probability_';
                $routeKey = 'admin.risk_probabilities';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.risk_probabilities.index');
    }

    /**
     * Show the form for creating new RiskProbability.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('risk_probability_create')) {
            return abort(401);
        }
        return view('admin.risk_probabilities.create');
    }

    /**
     * Store a newly created RiskProbability in storage.
     *
     * @param  \App\Http\Requests\StoreRiskProbabilitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRiskProbabilitiesRequest $request)
    {
        if (! Gate::allows('risk_probability_create')) {
            return abort(401);
        }
        $risk_probability = RiskProbability::create($request->all());



        return redirect()->route('admin.risk_probabilities.index');
    }


    /**
     * Show the form for editing RiskProbability.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('risk_probability_edit')) {
            return abort(401);
        }
        $risk_probability = RiskProbability::findOrFail($id);

        return view('admin.risk_probabilities.edit', compact('risk_probability'));
    }

    /**
     * Update RiskProbability in storage.
     *
     * @param  \App\Http\Requests\UpdateRiskProbabilitiesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRiskProbabilitiesRequest $request, $id)
    {
        if (! Gate::allows('risk_probability_edit')) {
            return abort(401);
        }
        $risk_probability = RiskProbability::findOrFail($id);
        $risk_probability->update($request->all());



        return redirect()->route('admin.risk_probabilities.index');
    }


    /**
     * Display RiskProbability.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('risk_probability_view')) {
            return abort(401);
        }
        $risks = \App\Risk::where('risk_probabilities_id', $id)->get();

        $risk_probability = RiskProbability::findOrFail($id);

        return view('admin.risk_probabilities.show', compact('risk_probability', 'risks'));
    }


    /**
     * Remove RiskProbability from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('risk_probability_delete')) {
            return abort(401);
        }
        $risk_probability = RiskProbability::findOrFail($id);
        $risk_probability->delete();

        return redirect()->route('admin.risk_probabilities.index');
    }

    /**
     * Delete all selected RiskProbability at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('risk_probability_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = RiskProbability::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore RiskProbability from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('risk_probability_delete')) {
            return abort(401);
        }
        $risk_probability = RiskProbability::onlyTrashed()->findOrFail($id);
        $risk_probability->restore();

        return redirect()->route('admin.risk_probabilities.index');
    }

    /**
     * Permanently delete RiskProbability from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('risk_probability_delete')) {
            return abort(401);
        }
        $risk_probability = RiskProbability::onlyTrashed()->findOrFail($id);
        $risk_probability->forceDelete();

        return redirect()->route('admin.risk_probabilities.index');
    }
}
