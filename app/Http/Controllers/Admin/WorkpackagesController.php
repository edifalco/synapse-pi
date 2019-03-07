<?php

namespace App\Http\Controllers\Admin;

use App\Workpackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWorkpackagesRequest;
use App\Http\Requests\Admin\UpdateWorkpackagesRequest;

class WorkpackagesController extends Controller
{
    /**
     * Display a listing of Workpackage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('workpackage_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('workpackage_delete')) {
                return abort(401);
            }
            $workpackages = Workpackage::onlyTrashed()->get();
        } else {
            $workpackages = Workpackage::all();
        }

        return view('admin.workpackages.index', compact('workpackages'));
    }

    /**
     * Show the form for creating new Workpackage.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('workpackage_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.workpackages.create', compact('projects'));
    }

    /**
     * Store a newly created Workpackage in storage.
     *
     * @param  \App\Http\Requests\StoreWorkpackagesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkpackagesRequest $request)
    {
        if (! Gate::allows('workpackage_create')) {
            return abort(401);
        }
        $workpackage = Workpackage::create($request->all());



        return redirect()->route('admin.workpackages.index');
    }


    /**
     * Show the form for editing Workpackage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('workpackage_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $workpackage = Workpackage::findOrFail($id);

        return view('admin.workpackages.edit', compact('workpackage', 'projects'));
    }

    /**
     * Update Workpackage in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkpackagesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkpackagesRequest $request, $id)
    {
        if (! Gate::allows('workpackage_edit')) {
            return abort(401);
        }
        $workpackage = Workpackage::findOrFail($id);
        $workpackage->update($request->all());



        return redirect()->route('admin.workpackages.index');
    }


    /**
     * Display Workpackage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('workpackage_view')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$deliverable_workpackages = \App\DeliverableWorkpackage::where('workpackage_id', $id)->get();$efforts = \App\Effort::where('workpackage_id', $id)->get();

        $workpackage = Workpackage::findOrFail($id);

        return view('admin.workpackages.show', compact('workpackage', 'deliverable_workpackages', 'efforts'));
    }


    /**
     * Remove Workpackage from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('workpackage_delete')) {
            return abort(401);
        }
        $workpackage = Workpackage::findOrFail($id);
        $workpackage->delete();

        return redirect()->route('admin.workpackages.index');
    }

    /**
     * Delete all selected Workpackage at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('workpackage_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Workpackage::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Workpackage from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('workpackage_delete')) {
            return abort(401);
        }
        $workpackage = Workpackage::onlyTrashed()->findOrFail($id);
        $workpackage->restore();

        return redirect()->route('admin.workpackages.index');
    }

    /**
     * Permanently delete Workpackage from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('workpackage_delete')) {
            return abort(401);
        }
        $workpackage = Workpackage::onlyTrashed()->findOrFail($id);
        $workpackage->forceDelete();

        return redirect()->route('admin.workpackages.index');
    }
}
