<?php

namespace App\Http\Controllers\Admin;

use App\RiskPowner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRiskPownersRequest;
use App\Http\Requests\Admin\UpdateRiskPownersRequest;
use Yajra\DataTables\DataTables;

class RiskPownersController extends Controller
{
    /**
     * Display a listing of RiskPowner.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('risk_powner_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = RiskPowner::query();
            $query->with("partner");
            $query->with("risk");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('risk_powner_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'risk_powners.id',
                'risk_powners.partner_id',
                'risk_powners.risk_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'risk_powner_';
                $routeKey = 'admin.risk_powners';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('partner.name', function ($row) {
                return $row->partner ? $row->partner->name : '';
            });
            $table->editColumn('risk.code', function ($row) {
                return $row->risk ? $row->risk->code : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.risk_powners.index');
    }

    /**
     * Show the form for creating new RiskPowner.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('risk_powner_create')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $risks = \App\Risk::get()->pluck('code', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.risk_powners.create', compact('partners', 'risks'));
    }

    /**
     * Store a newly created RiskPowner in storage.
     *
     * @param  \App\Http\Requests\StoreRiskPownersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRiskPownersRequest $request)
    {
        if (! Gate::allows('risk_powner_create')) {
            return abort(401);
        }
        $risk_powner = RiskPowner::create($request->all());



        return redirect()->route('admin.risk_powners.index');
    }


    /**
     * Show the form for editing RiskPowner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('risk_powner_edit')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $risks = \App\Risk::get()->pluck('code', 'id')->prepend(trans('global.app_please_select'), '');

        $risk_powner = RiskPowner::findOrFail($id);

        return view('admin.risk_powners.edit', compact('risk_powner', 'partners', 'risks'));
    }

    /**
     * Update RiskPowner in storage.
     *
     * @param  \App\Http\Requests\UpdateRiskPownersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRiskPownersRequest $request, $id)
    {
        if (! Gate::allows('risk_powner_edit')) {
            return abort(401);
        }
        $risk_powner = RiskPowner::findOrFail($id);
        $risk_powner->update($request->all());



        return redirect()->route('admin.risk_powners.index');
    }


    /**
     * Display RiskPowner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('risk_powner_view')) {
            return abort(401);
        }
        $risk_powner = RiskPowner::findOrFail($id);

        return view('admin.risk_powners.show', compact('risk_powner'));
    }


    /**
     * Remove RiskPowner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('risk_powner_delete')) {
            return abort(401);
        }
        $risk_powner = RiskPowner::findOrFail($id);
        $risk_powner->delete();

        return redirect()->route('admin.risk_powners.index');
    }

    /**
     * Delete all selected RiskPowner at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('risk_powner_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = RiskPowner::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore RiskPowner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('risk_powner_delete')) {
            return abort(401);
        }
        $risk_powner = RiskPowner::onlyTrashed()->findOrFail($id);
        $risk_powner->restore();

        return redirect()->route('admin.risk_powners.index');
    }

    /**
     * Permanently delete RiskPowner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('risk_powner_delete')) {
            return abort(401);
        }
        $risk_powner = RiskPowner::onlyTrashed()->findOrFail($id);
        $risk_powner->forceDelete();

        return redirect()->route('admin.risk_powners.index');
    }
}
