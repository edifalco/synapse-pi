<?php

namespace App\Http\Controllers\Admin;

use App\Metricicon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMetriciconsRequest;
use App\Http\Requests\Admin\UpdateMetriciconsRequest;

class MetriciconsController extends Controller
{
    /**
     * Display a listing of Metricicon.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('metricicon_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('metricicon_delete')) {
                return abort(401);
            }
            $metricicons = Metricicon::onlyTrashed()->get();
        } else {
            $metricicons = Metricicon::all();
        }

        return view('admin.metricicons.index', compact('metricicons'));
    }

    /**
     * Show the form for creating new Metricicon.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('metricicon_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.metricicons.create', compact('projects'));
    }

    /**
     * Store a newly created Metricicon in storage.
     *
     * @param  \App\Http\Requests\StoreMetriciconsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMetriciconsRequest $request)
    {
        if (! Gate::allows('metricicon_create')) {
            return abort(401);
        }
        $metricicon = Metricicon::create($request->all());



        return redirect()->route('admin.metricicons.index');
    }


    /**
     * Show the form for editing Metricicon.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('metricicon_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $metricicon = Metricicon::findOrFail($id);

        return view('admin.metricicons.edit', compact('metricicon', 'projects'));
    }

    /**
     * Update Metricicon in storage.
     *
     * @param  \App\Http\Requests\UpdateMetriciconsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMetriciconsRequest $request, $id)
    {
        if (! Gate::allows('metricicon_edit')) {
            return abort(401);
        }
        $metricicon = Metricicon::findOrFail($id);
        $metricicon->update($request->all());



        return redirect()->route('admin.metricicons.index');
    }


    /**
     * Display Metricicon.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('metricicon_view')) {
            return abort(401);
        }
        $metricicon = Metricicon::findOrFail($id);

        return view('admin.metricicons.show', compact('metricicon'));
    }


    /**
     * Remove Metricicon from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('metricicon_delete')) {
            return abort(401);
        }
        $metricicon = Metricicon::findOrFail($id);
        $metricicon->delete();

        return redirect()->route('admin.metricicons.index');
    }

    /**
     * Delete all selected Metricicon at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('metricicon_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Metricicon::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Metricicon from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('metricicon_delete')) {
            return abort(401);
        }
        $metricicon = Metricicon::onlyTrashed()->findOrFail($id);
        $metricicon->restore();

        return redirect()->route('admin.metricicons.index');
    }

    /**
     * Permanently delete Metricicon from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('metricicon_delete')) {
            return abort(401);
        }
        $metricicon = Metricicon::onlyTrashed()->findOrFail($id);
        $metricicon->forceDelete();

        return redirect()->route('admin.metricicons.index');
    }
}
