<?php

namespace App\Http\Controllers\Admin;

use App\Scoredescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreScoredescriptionsRequest;
use App\Http\Requests\Admin\UpdateScoredescriptionsRequest;

class ScoredescriptionsController extends Controller
{
    /**
     * Display a listing of Scoredescription.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('scoredescription_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('scoredescription_delete')) {
                return abort(401);
            }
            $scoredescriptions = Scoredescription::onlyTrashed()->get();
        } else {
            $scoredescriptions = Scoredescription::all();
        }

        return view('admin.scoredescriptions.index', compact('scoredescriptions'));
    }

    /**
     * Show the form for creating new Scoredescription.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('scoredescription_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.scoredescriptions.create', compact('projects'));
    }

    /**
     * Store a newly created Scoredescription in storage.
     *
     * @param  \App\Http\Requests\StoreScoredescriptionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScoredescriptionsRequest $request)
    {
        if (! Gate::allows('scoredescription_create')) {
            return abort(401);
        }
        $scoredescription = Scoredescription::create($request->all());



        return redirect()->route('admin.scoredescriptions.index');
    }


    /**
     * Show the form for editing Scoredescription.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('scoredescription_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $scoredescription = Scoredescription::findOrFail($id);

        return view('admin.scoredescriptions.edit', compact('scoredescription', 'projects'));
    }

    /**
     * Update Scoredescription in storage.
     *
     * @param  \App\Http\Requests\UpdateScoredescriptionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScoredescriptionsRequest $request, $id)
    {
        if (! Gate::allows('scoredescription_edit')) {
            return abort(401);
        }
        $scoredescription = Scoredescription::findOrFail($id);
        $scoredescription->update($request->all());



        return redirect()->route('admin.scoredescriptions.index');
    }


    /**
     * Display Scoredescription.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('scoredescription_view')) {
            return abort(401);
        }
        $scoredescription = Scoredescription::findOrFail($id);

        return view('admin.scoredescriptions.show', compact('scoredescription'));
    }


    /**
     * Remove Scoredescription from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('scoredescription_delete')) {
            return abort(401);
        }
        $scoredescription = Scoredescription::findOrFail($id);
        $scoredescription->delete();

        return redirect()->route('admin.scoredescriptions.index');
    }

    /**
     * Delete all selected Scoredescription at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('scoredescription_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Scoredescription::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Scoredescription from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('scoredescription_delete')) {
            return abort(401);
        }
        $scoredescription = Scoredescription::onlyTrashed()->findOrFail($id);
        $scoredescription->restore();

        return redirect()->route('admin.scoredescriptions.index');
    }

    /**
     * Permanently delete Scoredescription from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('scoredescription_delete')) {
            return abort(401);
        }
        $scoredescription = Scoredescription::onlyTrashed()->findOrFail($id);
        $scoredescription->forceDelete();

        return redirect()->route('admin.scoredescriptions.index');
    }
}
