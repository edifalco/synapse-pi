<?php

namespace App\Http\Controllers\Admin;

use App\Partnerrole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePartnerrolesRequest;
use App\Http\Requests\Admin\UpdatePartnerrolesRequest;
use Yajra\DataTables\DataTables;

class PartnerrolesController extends Controller
{
    /**
     * Display a listing of Partnerrole.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('partnerrole_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Partnerrole::query();
            $query->with("partner");
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('partnerrole_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'partnerroles.id',
                'partnerroles.partner_id',
                'partnerroles.role_id',
                'partnerroles.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'partnerrole_';
                $routeKey = 'admin.partnerroles';

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

        return view('admin.partnerroles.index');
    }

    /**
     * Show the form for creating new Partnerrole.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('partnerrole_create')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.partnerroles.create', compact('partners', 'projects'));
    }

    /**
     * Store a newly created Partnerrole in storage.
     *
     * @param  \App\Http\Requests\StorePartnerrolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnerrolesRequest $request)
    {
        if (! Gate::allows('partnerrole_create')) {
            return abort(401);
        }
        $partnerrole = Partnerrole::create($request->all());



        return redirect()->route('admin.partnerroles.index');
    }


    /**
     * Show the form for editing Partnerrole.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('partnerrole_edit')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $partnerrole = Partnerrole::findOrFail($id);

        return view('admin.partnerroles.edit', compact('partnerrole', 'partners', 'projects'));
    }

    /**
     * Update Partnerrole in storage.
     *
     * @param  \App\Http\Requests\UpdatePartnerrolesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartnerrolesRequest $request, $id)
    {
        if (! Gate::allows('partnerrole_edit')) {
            return abort(401);
        }
        $partnerrole = Partnerrole::findOrFail($id);
        $partnerrole->update($request->all());



        return redirect()->route('admin.partnerroles.index');
    }


    /**
     * Display Partnerrole.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('partnerrole_view')) {
            return abort(401);
        }
        $partnerrole = Partnerrole::findOrFail($id);

        return view('admin.partnerroles.show', compact('partnerrole'));
    }


    /**
     * Remove Partnerrole from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('partnerrole_delete')) {
            return abort(401);
        }
        $partnerrole = Partnerrole::findOrFail($id);
        $partnerrole->delete();

        return redirect()->route('admin.partnerroles.index');
    }

    /**
     * Delete all selected Partnerrole at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('partnerrole_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Partnerrole::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Partnerrole from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('partnerrole_delete')) {
            return abort(401);
        }
        $partnerrole = Partnerrole::onlyTrashed()->findOrFail($id);
        $partnerrole->restore();

        return redirect()->route('admin.partnerroles.index');
    }

    /**
     * Permanently delete Partnerrole from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('partnerrole_delete')) {
            return abort(401);
        }
        $partnerrole = Partnerrole::onlyTrashed()->findOrFail($id);
        $partnerrole->forceDelete();

        return redirect()->route('admin.partnerroles.index');
    }
}
