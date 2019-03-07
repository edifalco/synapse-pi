<?php

namespace App\Http\Controllers\Admin;

use App\Alternativescore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAlternativescoresRequest;
use App\Http\Requests\Admin\UpdateAlternativescoresRequest;

class AlternativescoresController extends Controller
{
    /**
     * Display a listing of Alternativescore.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('alternativescore_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('alternativescore_delete')) {
                return abort(401);
            }
            $alternativescores = Alternativescore::onlyTrashed()->get();
        } else {
            $alternativescores = Alternativescore::all();
        }

        return view('admin.alternativescores.index', compact('alternativescores'));
    }

    /**
     * Show the form for creating new Alternativescore.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('alternativescore_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.alternativescores.create', compact('projects'));
    }

    /**
     * Store a newly created Alternativescore in storage.
     *
     * @param  \App\Http\Requests\StoreAlternativescoresRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlternativescoresRequest $request)
    {
        if (! Gate::allows('alternativescore_create')) {
            return abort(401);
        }
        $alternativescore = Alternativescore::create($request->all());



        return redirect()->route('admin.alternativescores.index');
    }


    /**
     * Show the form for editing Alternativescore.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('alternativescore_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $alternativescore = Alternativescore::findOrFail($id);

        return view('admin.alternativescores.edit', compact('alternativescore', 'projects'));
    }

    /**
     * Update Alternativescore in storage.
     *
     * @param  \App\Http\Requests\UpdateAlternativescoresRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlternativescoresRequest $request, $id)
    {
        if (! Gate::allows('alternativescore_edit')) {
            return abort(401);
        }
        $alternativescore = Alternativescore::findOrFail($id);
        $alternativescore->update($request->all());



        return redirect()->route('admin.alternativescores.index');
    }


    /**
     * Display Alternativescore.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('alternativescore_view')) {
            return abort(401);
        }
        $alternativescore = Alternativescore::findOrFail($id);

        return view('admin.alternativescores.show', compact('alternativescore'));
    }


    /**
     * Remove Alternativescore from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('alternativescore_delete')) {
            return abort(401);
        }
        $alternativescore = Alternativescore::findOrFail($id);
        $alternativescore->delete();

        return redirect()->route('admin.alternativescores.index');
    }

    /**
     * Delete all selected Alternativescore at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('alternativescore_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Alternativescore::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Alternativescore from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('alternativescore_delete')) {
            return abort(401);
        }
        $alternativescore = Alternativescore::onlyTrashed()->findOrFail($id);
        $alternativescore->restore();

        return redirect()->route('admin.alternativescores.index');
    }

    /**
     * Permanently delete Alternativescore from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('alternativescore_delete')) {
            return abort(401);
        }
        $alternativescore = Alternativescore::onlyTrashed()->findOrFail($id);
        $alternativescore->forceDelete();

        return redirect()->route('admin.alternativescores.index');
    }
}
