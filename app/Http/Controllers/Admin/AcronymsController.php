<?php

namespace App\Http\Controllers\Admin;

use App\Acronym;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAcronymsRequest;
use App\Http\Requests\Admin\UpdateAcronymsRequest;

class AcronymsController extends Controller
{
    /**
     * Display a listing of Acronym.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('acronym_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('acronym_delete')) {
                return abort(401);
            }
            $acronyms = Acronym::onlyTrashed()->get();
        } else {
            $acronyms = Acronym::all();
        }

        return view('admin.acronyms.index', compact('acronyms'));
    }

    /**
     * Show the form for creating new Acronym.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('acronym_create')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.acronyms.create', compact('partners'));
    }

    /**
     * Store a newly created Acronym in storage.
     *
     * @param  \App\Http\Requests\StoreAcronymsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcronymsRequest $request)
    {
        if (! Gate::allows('acronym_create')) {
            return abort(401);
        }
        $acronym = Acronym::create($request->all());



        return redirect()->route('admin.acronyms.index');
    }


    /**
     * Show the form for editing Acronym.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('acronym_edit')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $acronym = Acronym::findOrFail($id);

        return view('admin.acronyms.edit', compact('acronym', 'partners'));
    }

    /**
     * Update Acronym in storage.
     *
     * @param  \App\Http\Requests\UpdateAcronymsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAcronymsRequest $request, $id)
    {
        if (! Gate::allows('acronym_edit')) {
            return abort(401);
        }
        $acronym = Acronym::findOrFail($id);
        $acronym->update($request->all());



        return redirect()->route('admin.acronyms.index');
    }


    /**
     * Display Acronym.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('acronym_view')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$acronym_projects = \App\AcronymProject::where('acronym_id', $id)->get();

        $acronym = Acronym::findOrFail($id);

        return view('admin.acronyms.show', compact('acronym', 'acronym_projects'));
    }


    /**
     * Remove Acronym from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('acronym_delete')) {
            return abort(401);
        }
        $acronym = Acronym::findOrFail($id);
        $acronym->delete();

        return redirect()->route('admin.acronyms.index');
    }

    /**
     * Delete all selected Acronym at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('acronym_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Acronym::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Acronym from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('acronym_delete')) {
            return abort(401);
        }
        $acronym = Acronym::onlyTrashed()->findOrFail($id);
        $acronym->restore();

        return redirect()->route('admin.acronyms.index');
    }

    /**
     * Permanently delete Acronym from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('acronym_delete')) {
            return abort(401);
        }
        $acronym = Acronym::onlyTrashed()->findOrFail($id);
        $acronym->forceDelete();

        return redirect()->route('admin.acronyms.index');
    }
}
