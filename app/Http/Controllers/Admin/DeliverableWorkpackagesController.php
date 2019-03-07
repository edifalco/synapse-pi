<?php

namespace App\Http\Controllers\Admin;

use App\DeliverableWorkpackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeliverableWorkpackagesRequest;
use App\Http\Requests\Admin\UpdateDeliverableWorkpackagesRequest;

class DeliverableWorkpackagesController extends Controller
{
    /**
     * Display a listing of DeliverableWorkpackage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('deliverable_workpackage_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('deliverable_workpackage_delete')) {
                return abort(401);
            }
            $deliverable_workpackages = DeliverableWorkpackage::onlyTrashed()->get();
        } else {
            $deliverable_workpackages = DeliverableWorkpackage::all();
        }

        return view('admin.deliverable_workpackages.index', compact('deliverable_workpackages'));
    }

    /**
     * Show the form for creating new DeliverableWorkpackage.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('deliverable_workpackage_create')) {
            return abort(401);
        }
        
        $deliverables = \App\Deliverable::get()->pluck('label_identification', 'id')->prepend(trans('global.app_please_select'), '');
        $workpackages = \App\Workpackage::get()->pluck('wp_id', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.deliverable_workpackages.create', compact('deliverables', 'workpackages'));
    }

    /**
     * Store a newly created DeliverableWorkpackage in storage.
     *
     * @param  \App\Http\Requests\StoreDeliverableWorkpackagesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliverableWorkpackagesRequest $request)
    {
        if (! Gate::allows('deliverable_workpackage_create')) {
            return abort(401);
        }
        $deliverable_workpackage = DeliverableWorkpackage::create($request->all());



        return redirect()->route('admin.deliverable_workpackages.index');
    }


    /**
     * Show the form for editing DeliverableWorkpackage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('deliverable_workpackage_edit')) {
            return abort(401);
        }
        
        $deliverables = \App\Deliverable::get()->pluck('label_identification', 'id')->prepend(trans('global.app_please_select'), '');
        $workpackages = \App\Workpackage::get()->pluck('wp_id', 'id')->prepend(trans('global.app_please_select'), '');

        $deliverable_workpackage = DeliverableWorkpackage::findOrFail($id);

        return view('admin.deliverable_workpackages.edit', compact('deliverable_workpackage', 'deliverables', 'workpackages'));
    }

    /**
     * Update DeliverableWorkpackage in storage.
     *
     * @param  \App\Http\Requests\UpdateDeliverableWorkpackagesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliverableWorkpackagesRequest $request, $id)
    {
        if (! Gate::allows('deliverable_workpackage_edit')) {
            return abort(401);
        }
        $deliverable_workpackage = DeliverableWorkpackage::findOrFail($id);
        $deliverable_workpackage->update($request->all());



        return redirect()->route('admin.deliverable_workpackages.index');
    }


    /**
     * Display DeliverableWorkpackage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('deliverable_workpackage_view')) {
            return abort(401);
        }
        $deliverable_workpackage = DeliverableWorkpackage::findOrFail($id);

        return view('admin.deliverable_workpackages.show', compact('deliverable_workpackage'));
    }


    /**
     * Remove DeliverableWorkpackage from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('deliverable_workpackage_delete')) {
            return abort(401);
        }
        $deliverable_workpackage = DeliverableWorkpackage::findOrFail($id);
        $deliverable_workpackage->delete();

        return redirect()->route('admin.deliverable_workpackages.index');
    }

    /**
     * Delete all selected DeliverableWorkpackage at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('deliverable_workpackage_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DeliverableWorkpackage::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DeliverableWorkpackage from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('deliverable_workpackage_delete')) {
            return abort(401);
        }
        $deliverable_workpackage = DeliverableWorkpackage::onlyTrashed()->findOrFail($id);
        $deliverable_workpackage->restore();

        return redirect()->route('admin.deliverable_workpackages.index');
    }

    /**
     * Permanently delete DeliverableWorkpackage from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('deliverable_workpackage_delete')) {
            return abort(401);
        }
        $deliverable_workpackage = DeliverableWorkpackage::onlyTrashed()->findOrFail($id);
        $deliverable_workpackage->forceDelete();

        return redirect()->route('admin.deliverable_workpackages.index');
    }
}
