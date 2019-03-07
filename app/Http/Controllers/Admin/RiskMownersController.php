<?php

namespace App\Http\Controllers\Admin;

use App\RiskMowner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRiskMownersRequest;
use App\Http\Requests\Admin\UpdateRiskMownersRequest;

class RiskMownersController extends Controller
{
    /**
     * Display a listing of RiskMowner.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('risk_mowner_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('risk_mowner_delete')) {
                return abort(401);
            }
            $risk_mowners = RiskMowner::onlyTrashed()->get();
        } else {
            $risk_mowners = RiskMowner::all();
        }

        return view('admin.risk_mowners.index', compact('risk_mowners'));
    }

    /**
     * Show the form for creating new RiskMowner.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('risk_mowner_create')) {
            return abort(401);
        }
        
        $members = \App\Member::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $risks = \App\Risk::get()->pluck('code', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.risk_mowners.create', compact('members', 'risks'));
    }

    /**
     * Store a newly created RiskMowner in storage.
     *
     * @param  \App\Http\Requests\StoreRiskMownersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRiskMownersRequest $request)
    {
        if (! Gate::allows('risk_mowner_create')) {
            return abort(401);
        }
        $risk_mowner = RiskMowner::create($request->all());



        return redirect()->route('admin.risk_mowners.index');
    }


    /**
     * Show the form for editing RiskMowner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('risk_mowner_edit')) {
            return abort(401);
        }
        
        $members = \App\Member::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $risks = \App\Risk::get()->pluck('code', 'id')->prepend(trans('global.app_please_select'), '');

        $risk_mowner = RiskMowner::findOrFail($id);

        return view('admin.risk_mowners.edit', compact('risk_mowner', 'members', 'risks'));
    }

    /**
     * Update RiskMowner in storage.
     *
     * @param  \App\Http\Requests\UpdateRiskMownersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRiskMownersRequest $request, $id)
    {
        if (! Gate::allows('risk_mowner_edit')) {
            return abort(401);
        }
        $risk_mowner = RiskMowner::findOrFail($id);
        $risk_mowner->update($request->all());



        return redirect()->route('admin.risk_mowners.index');
    }


    /**
     * Display RiskMowner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('risk_mowner_view')) {
            return abort(401);
        }
        $risk_mowner = RiskMowner::findOrFail($id);

        return view('admin.risk_mowners.show', compact('risk_mowner'));
    }


    /**
     * Remove RiskMowner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('risk_mowner_delete')) {
            return abort(401);
        }
        $risk_mowner = RiskMowner::findOrFail($id);
        $risk_mowner->delete();

        return redirect()->route('admin.risk_mowners.index');
    }

    /**
     * Delete all selected RiskMowner at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('risk_mowner_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = RiskMowner::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore RiskMowner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('risk_mowner_delete')) {
            return abort(401);
        }
        $risk_mowner = RiskMowner::onlyTrashed()->findOrFail($id);
        $risk_mowner->restore();

        return redirect()->route('admin.risk_mowners.index');
    }

    /**
     * Permanently delete RiskMowner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('risk_mowner_delete')) {
            return abort(401);
        }
        $risk_mowner = RiskMowner::onlyTrashed()->findOrFail($id);
        $risk_mowner->forceDelete();

        return redirect()->route('admin.risk_mowners.index');
    }
}
