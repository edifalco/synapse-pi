<?php

namespace App\Http\Controllers\Admin;

use App\RiskMreporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRiskMreportersRequest;
use App\Http\Requests\Admin\UpdateRiskMreportersRequest;
use Yajra\DataTables\DataTables;

class RiskMreportersController extends Controller
{
    /**
     * Display a listing of RiskMreporter.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('risk_mreporter_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = RiskMreporter::query();
            $query->with("member");
            $query->with("risk");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('risk_mreporter_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'risk_mreporters.id',
                'risk_mreporters.member_id',
                'risk_mreporters.risk_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'risk_mreporter_';
                $routeKey = 'admin.risk_mreporters';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('member.name', function ($row) {
                return $row->member ? $row->member->name : '';
            });
            $table->editColumn('risk.code', function ($row) {
                return $row->risk ? $row->risk->code : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.risk_mreporters.index');
    }

    /**
     * Show the form for creating new RiskMreporter.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('risk_mreporter_create')) {
            return abort(401);
        }
        
        $members = \App\Member::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $risks = \App\Risk::get()->pluck('code', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.risk_mreporters.create', compact('members', 'risks'));
    }

    /**
     * Store a newly created RiskMreporter in storage.
     *
     * @param  \App\Http\Requests\StoreRiskMreportersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRiskMreportersRequest $request)
    {
        if (! Gate::allows('risk_mreporter_create')) {
            return abort(401);
        }
        $risk_mreporter = RiskMreporter::create($request->all());



        return redirect()->route('admin.risk_mreporters.index');
    }


    /**
     * Show the form for editing RiskMreporter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('risk_mreporter_edit')) {
            return abort(401);
        }
        
        $members = \App\Member::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $risks = \App\Risk::get()->pluck('code', 'id')->prepend(trans('global.app_please_select'), '');

        $risk_mreporter = RiskMreporter::findOrFail($id);

        return view('admin.risk_mreporters.edit', compact('risk_mreporter', 'members', 'risks'));
    }

    /**
     * Update RiskMreporter in storage.
     *
     * @param  \App\Http\Requests\UpdateRiskMreportersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRiskMreportersRequest $request, $id)
    {
        if (! Gate::allows('risk_mreporter_edit')) {
            return abort(401);
        }
        $risk_mreporter = RiskMreporter::findOrFail($id);
        $risk_mreporter->update($request->all());



        return redirect()->route('admin.risk_mreporters.index');
    }


    /**
     * Display RiskMreporter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('risk_mreporter_view')) {
            return abort(401);
        }
        $risk_mreporter = RiskMreporter::findOrFail($id);

        return view('admin.risk_mreporters.show', compact('risk_mreporter'));
    }


    /**
     * Remove RiskMreporter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('risk_mreporter_delete')) {
            return abort(401);
        }
        $risk_mreporter = RiskMreporter::findOrFail($id);
        $risk_mreporter->delete();

        return redirect()->route('admin.risk_mreporters.index');
    }

    /**
     * Delete all selected RiskMreporter at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('risk_mreporter_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = RiskMreporter::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore RiskMreporter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('risk_mreporter_delete')) {
            return abort(401);
        }
        $risk_mreporter = RiskMreporter::onlyTrashed()->findOrFail($id);
        $risk_mreporter->restore();

        return redirect()->route('admin.risk_mreporters.index');
    }

    /**
     * Permanently delete RiskMreporter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('risk_mreporter_delete')) {
            return abort(401);
        }
        $risk_mreporter = RiskMreporter::onlyTrashed()->findOrFail($id);
        $risk_mreporter->forceDelete();

        return redirect()->route('admin.risk_mreporters.index');
    }
}
