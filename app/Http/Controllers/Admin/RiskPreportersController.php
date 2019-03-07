<?php

namespace App\Http\Controllers\Admin;

use App\RiskPreporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRiskPreportersRequest;
use App\Http\Requests\Admin\UpdateRiskPreportersRequest;

class RiskPreportersController extends Controller
{
    /**
     * Display a listing of RiskPreporter.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('risk_preporter_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('risk_preporter_delete')) {
                return abort(401);
            }
            $risk_preporters = RiskPreporter::onlyTrashed()->get();
        } else {
            $risk_preporters = RiskPreporter::all();
        }

        return view('admin.risk_preporters.index', compact('risk_preporters'));
    }

    /**
     * Show the form for creating new RiskPreporter.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('risk_preporter_create')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $risks = \App\Risk::get()->pluck('code', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.risk_preporters.create', compact('partners', 'risks'));
    }

    /**
     * Store a newly created RiskPreporter in storage.
     *
     * @param  \App\Http\Requests\StoreRiskPreportersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRiskPreportersRequest $request)
    {
        if (! Gate::allows('risk_preporter_create')) {
            return abort(401);
        }
        $risk_preporter = RiskPreporter::create($request->all());



        return redirect()->route('admin.risk_preporters.index');
    }


    /**
     * Show the form for editing RiskPreporter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('risk_preporter_edit')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $risks = \App\Risk::get()->pluck('code', 'id')->prepend(trans('global.app_please_select'), '');

        $risk_preporter = RiskPreporter::findOrFail($id);

        return view('admin.risk_preporters.edit', compact('risk_preporter', 'partners', 'risks'));
    }

    /**
     * Update RiskPreporter in storage.
     *
     * @param  \App\Http\Requests\UpdateRiskPreportersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRiskPreportersRequest $request, $id)
    {
        if (! Gate::allows('risk_preporter_edit')) {
            return abort(401);
        }
        $risk_preporter = RiskPreporter::findOrFail($id);
        $risk_preporter->update($request->all());



        return redirect()->route('admin.risk_preporters.index');
    }


    /**
     * Display RiskPreporter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('risk_preporter_view')) {
            return abort(401);
        }
        $risk_preporter = RiskPreporter::findOrFail($id);

        return view('admin.risk_preporters.show', compact('risk_preporter'));
    }


    /**
     * Remove RiskPreporter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('risk_preporter_delete')) {
            return abort(401);
        }
        $risk_preporter = RiskPreporter::findOrFail($id);
        $risk_preporter->delete();

        return redirect()->route('admin.risk_preporters.index');
    }

    /**
     * Delete all selected RiskPreporter at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('risk_preporter_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = RiskPreporter::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore RiskPreporter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('risk_preporter_delete')) {
            return abort(401);
        }
        $risk_preporter = RiskPreporter::onlyTrashed()->findOrFail($id);
        $risk_preporter->restore();

        return redirect()->route('admin.risk_preporters.index');
    }

    /**
     * Permanently delete RiskPreporter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('risk_preporter_delete')) {
            return abort(401);
        }
        $risk_preporter = RiskPreporter::onlyTrashed()->findOrFail($id);
        $risk_preporter->forceDelete();

        return redirect()->route('admin.risk_preporters.index');
    }
}
