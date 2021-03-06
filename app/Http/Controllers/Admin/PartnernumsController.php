<?php

namespace App\Http\Controllers\Admin;

use App\Partnernum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePartnernumsRequest;
use App\Http\Requests\Admin\UpdatePartnernumsRequest;
use Yajra\DataTables\DataTables;

class PartnernumsController extends Controller
{
    /**
     * Display a listing of Partnernum.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('partnernum_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Partnernum::query();
            $query->with("partner");
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('partnernum_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'partnernums.id',
                'partnernums.value',
                'partnernums.partner_id',
                'partnernums.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'partnernum_';
                $routeKey = 'admin.partnernums';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('partner.name', function ($row) {
                return $row->partner ? $row->partner->name : '';
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.partnernums.index');
    }

    /**
     * Show the form for creating new Partnernum.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('partnernum_create')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.partnernums.create', compact('partners', 'projects'));
    }

    /**
     * Store a newly created Partnernum in storage.
     *
     * @param  \App\Http\Requests\StorePartnernumsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnernumsRequest $request)
    {
        if (! Gate::allows('partnernum_create')) {
            return abort(401);
        }
        $partnernum = Partnernum::create($request->all());



        return redirect()->route('admin.partnernums.index');
    }


    /**
     * Show the form for editing Partnernum.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('partnernum_edit')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $partnernum = Partnernum::findOrFail($id);

        return view('admin.partnernums.edit', compact('partnernum', 'partners', 'projects'));
    }

    /**
     * Update Partnernum in storage.
     *
     * @param  \App\Http\Requests\UpdatePartnernumsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartnernumsRequest $request, $id)
    {
        if (! Gate::allows('partnernum_edit')) {
            return abort(401);
        }
        $partnernum = Partnernum::findOrFail($id);
        $partnernum->update($request->all());



        return redirect()->route('admin.partnernums.index');
    }


    /**
     * Display Partnernum.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('partnernum_view')) {
            return abort(401);
        }
        $partnernum = Partnernum::findOrFail($id);

        return view('admin.partnernums.show', compact('partnernum'));
    }


    /**
     * Remove Partnernum from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('partnernum_delete')) {
            return abort(401);
        }
        $partnernum = Partnernum::findOrFail($id);
        $partnernum->delete();

        return redirect()->route('admin.partnernums.index');
    }

    /**
     * Delete all selected Partnernum at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('partnernum_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Partnernum::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Partnernum from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('partnernum_delete')) {
            return abort(401);
        }
        $partnernum = Partnernum::onlyTrashed()->findOrFail($id);
        $partnernum->restore();

        return redirect()->route('admin.partnernums.index');
    }

    /**
     * Permanently delete Partnernum from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('partnernum_delete')) {
            return abort(401);
        }
        $partnernum = Partnernum::onlyTrashed()->findOrFail($id);
        $partnernum->forceDelete();

        return redirect()->route('admin.partnernums.index');
    }
}
