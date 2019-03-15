<?php

namespace App\Http\Controllers\Admin;

use App\RiskType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRiskTypesRequest;
use App\Http\Requests\Admin\UpdateRiskTypesRequest;
use Yajra\DataTables\DataTables;

class RiskTypesController extends Controller
{
    /**
     * Display a listing of RiskType.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('risk_type_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = RiskType::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('risk_type_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'risk_types.id',
                'risk_types.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'risk_type_';
                $routeKey = 'admin.risk_types';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.risk_types.index');
    }

    /**
     * Show the form for creating new RiskType.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('risk_type_create')) {
            return abort(401);
        }
        return view('admin.risk_types.create');
    }

    /**
     * Store a newly created RiskType in storage.
     *
     * @param  \App\Http\Requests\StoreRiskTypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRiskTypesRequest $request)
    {
        if (! Gate::allows('risk_type_create')) {
            return abort(401);
        }
        $risk_type = RiskType::create($request->all());



        return redirect()->route('admin.risk_types.index');
    }


    /**
     * Show the form for editing RiskType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('risk_type_edit')) {
            return abort(401);
        }
        $risk_type = RiskType::findOrFail($id);

        return view('admin.risk_types.edit', compact('risk_type'));
    }

    /**
     * Update RiskType in storage.
     *
     * @param  \App\Http\Requests\UpdateRiskTypesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRiskTypesRequest $request, $id)
    {
        if (! Gate::allows('risk_type_edit')) {
            return abort(401);
        }
        $risk_type = RiskType::findOrFail($id);
        $risk_type->update($request->all());



        return redirect()->route('admin.risk_types.index');
    }


    /**
     * Display RiskType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('risk_type_view')) {
            return abort(401);
        }
        $risks = \App\Risk::where('risks_type_id', $id)->get();

        $risk_type = RiskType::findOrFail($id);

        return view('admin.risk_types.show', compact('risk_type', 'risks'));
    }


    /**
     * Remove RiskType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('risk_type_delete')) {
            return abort(401);
        }
        $risk_type = RiskType::findOrFail($id);
        $risk_type->delete();

        return redirect()->route('admin.risk_types.index');
    }

    /**
     * Delete all selected RiskType at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('risk_type_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = RiskType::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore RiskType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('risk_type_delete')) {
            return abort(401);
        }
        $risk_type = RiskType::onlyTrashed()->findOrFail($id);
        $risk_type->restore();

        return redirect()->route('admin.risk_types.index');
    }

    /**
     * Permanently delete RiskType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('risk_type_delete')) {
            return abort(401);
        }
        $risk_type = RiskType::onlyTrashed()->findOrFail($id);
        $risk_type->forceDelete();

        return redirect()->route('admin.risk_types.index');
    }
}
