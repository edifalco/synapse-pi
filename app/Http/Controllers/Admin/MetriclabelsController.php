<?php

namespace App\Http\Controllers\Admin;

use App\Metriclabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMetriclabelsRequest;
use App\Http\Requests\Admin\UpdateMetriclabelsRequest;

class MetriclabelsController extends Controller
{
    /**
     * Display a listing of Metriclabel.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('metriclabel_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('metriclabel_delete')) {
                return abort(401);
            }
            $metriclabels = Metriclabel::onlyTrashed()->get();
        } else {
            $metriclabels = Metriclabel::all();
        }

        return view('admin.metriclabels.index', compact('metriclabels'));
    }

    /**
     * Show the form for creating new Metriclabel.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('metriclabel_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.metriclabels.create', compact('projects'));
    }

    /**
     * Store a newly created Metriclabel in storage.
     *
     * @param  \App\Http\Requests\StoreMetriclabelsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMetriclabelsRequest $request)
    {
        if (! Gate::allows('metriclabel_create')) {
            return abort(401);
        }
        $metriclabel = Metriclabel::create($request->all());



        return redirect()->route('admin.metriclabels.index');
    }


    /**
     * Show the form for editing Metriclabel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('metriclabel_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $metriclabel = Metriclabel::findOrFail($id);

        return view('admin.metriclabels.edit', compact('metriclabel', 'projects'));
    }

    /**
     * Update Metriclabel in storage.
     *
     * @param  \App\Http\Requests\UpdateMetriclabelsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMetriclabelsRequest $request, $id)
    {
        if (! Gate::allows('metriclabel_edit')) {
            return abort(401);
        }
        $metriclabel = Metriclabel::findOrFail($id);
        $metriclabel->update($request->all());



        return redirect()->route('admin.metriclabels.index');
    }


    /**
     * Display Metriclabel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('metriclabel_view')) {
            return abort(401);
        }
        $metriclabel = Metriclabel::findOrFail($id);

        return view('admin.metriclabels.show', compact('metriclabel'));
    }


    /**
     * Remove Metriclabel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('metriclabel_delete')) {
            return abort(401);
        }
        $metriclabel = Metriclabel::findOrFail($id);
        $metriclabel->delete();

        return redirect()->route('admin.metriclabels.index');
    }

    /**
     * Delete all selected Metriclabel at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('metriclabel_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Metriclabel::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Metriclabel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('metriclabel_delete')) {
            return abort(401);
        }
        $metriclabel = Metriclabel::onlyTrashed()->findOrFail($id);
        $metriclabel->restore();

        return redirect()->route('admin.metriclabels.index');
    }

    /**
     * Permanently delete Metriclabel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('metriclabel_delete')) {
            return abort(401);
        }
        $metriclabel = Metriclabel::onlyTrashed()->findOrFail($id);
        $metriclabel->forceDelete();

        return redirect()->route('admin.metriclabels.index');
    }
}
