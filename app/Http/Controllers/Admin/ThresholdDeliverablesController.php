<?php

namespace App\Http\Controllers\Admin;

use App\ThresholdDeliverable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreThresholdDeliverablesRequest;
use App\Http\Requests\Admin\UpdateThresholdDeliverablesRequest;

class ThresholdDeliverablesController extends Controller
{
    /**
     * Display a listing of ThresholdDeliverable.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('threshold_deliverable_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('threshold_deliverable_delete')) {
                return abort(401);
            }
            $threshold_deliverables = ThresholdDeliverable::onlyTrashed()->get();
        } else {
            $threshold_deliverables = ThresholdDeliverable::all();
        }

        return view('admin.threshold_deliverables.index', compact('threshold_deliverables'));
    }

    /**
     * Show the form for creating new ThresholdDeliverable.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('threshold_deliverable_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.threshold_deliverables.create', compact('projects'));
    }

    /**
     * Store a newly created ThresholdDeliverable in storage.
     *
     * @param  \App\Http\Requests\StoreThresholdDeliverablesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreThresholdDeliverablesRequest $request)
    {
        if (! Gate::allows('threshold_deliverable_create')) {
            return abort(401);
        }
        $threshold_deliverable = ThresholdDeliverable::create($request->all());



        return redirect()->route('admin.threshold_deliverables.index');
    }


    /**
     * Show the form for editing ThresholdDeliverable.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('threshold_deliverable_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $threshold_deliverable = ThresholdDeliverable::findOrFail($id);

        return view('admin.threshold_deliverables.edit', compact('threshold_deliverable', 'projects'));
    }

    /**
     * Update ThresholdDeliverable in storage.
     *
     * @param  \App\Http\Requests\UpdateThresholdDeliverablesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateThresholdDeliverablesRequest $request, $id)
    {
        if (! Gate::allows('threshold_deliverable_edit')) {
            return abort(401);
        }
        $threshold_deliverable = ThresholdDeliverable::findOrFail($id);
        $threshold_deliverable->update($request->all());



        return redirect()->route('admin.threshold_deliverables.index');
    }


    /**
     * Display ThresholdDeliverable.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('threshold_deliverable_view')) {
            return abort(401);
        }
        $threshold_deliverable = ThresholdDeliverable::findOrFail($id);

        return view('admin.threshold_deliverables.show', compact('threshold_deliverable'));
    }


    /**
     * Remove ThresholdDeliverable from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('threshold_deliverable_delete')) {
            return abort(401);
        }
        $threshold_deliverable = ThresholdDeliverable::findOrFail($id);
        $threshold_deliverable->delete();

        return redirect()->route('admin.threshold_deliverables.index');
    }

    /**
     * Delete all selected ThresholdDeliverable at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('threshold_deliverable_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ThresholdDeliverable::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ThresholdDeliverable from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('threshold_deliverable_delete')) {
            return abort(401);
        }
        $threshold_deliverable = ThresholdDeliverable::onlyTrashed()->findOrFail($id);
        $threshold_deliverable->restore();

        return redirect()->route('admin.threshold_deliverables.index');
    }

    /**
     * Permanently delete ThresholdDeliverable from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('threshold_deliverable_delete')) {
            return abort(401);
        }
        $threshold_deliverable = ThresholdDeliverable::onlyTrashed()->findOrFail($id);
        $threshold_deliverable->forceDelete();

        return redirect()->route('admin.threshold_deliverables.index');
    }
}
