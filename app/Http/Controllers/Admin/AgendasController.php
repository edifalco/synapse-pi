<?php

namespace App\Http\Controllers\Admin;

use App\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAgendasRequest;
use App\Http\Requests\Admin\UpdateAgendasRequest;
use Yajra\DataTables\DataTables;

class AgendasController extends Controller
{
    /**
     * Display a listing of Agenda.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('agenda_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Agenda::query();
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('agenda_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'agendas.id',
                'agendas.date',
                'agendas.hour',
                'agendas.minute',
                'agendas.title',
                'agendas.description',
                'agendas.project_id',
                'agendas.category',
                'agendas.duration',
                'agendas.meeting_type',
                'agendas.date_creation',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'agenda_';
                $routeKey = 'admin.agendas';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.agendas.index');
    }

    /**
     * Show the form for creating new Agenda.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('agenda_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.agendas.create', compact('projects'));
    }

    /**
     * Store a newly created Agenda in storage.
     *
     * @param  \App\Http\Requests\StoreAgendasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgendasRequest $request)
    {
        if (! Gate::allows('agenda_create')) {
            return abort(401);
        }
        $agenda = Agenda::create($request->all());



        return redirect()->route('admin.agendas.index');
    }


    /**
     * Show the form for editing Agenda.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('agenda_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $agenda = Agenda::findOrFail($id);

        return view('admin.agendas.edit', compact('agenda', 'projects'));
    }

    /**
     * Update Agenda in storage.
     *
     * @param  \App\Http\Requests\UpdateAgendasRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgendasRequest $request, $id)
    {
        if (! Gate::allows('agenda_edit')) {
            return abort(401);
        }
        $agenda = Agenda::findOrFail($id);
        $agenda->update($request->all());



        return redirect()->route('admin.agendas.index');
    }


    /**
     * Display Agenda.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('agenda_view')) {
            return abort(401);
        }
        $agenda = Agenda::findOrFail($id);

        return view('admin.agendas.show', compact('agenda'));
    }


    /**
     * Remove Agenda from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('agenda_delete')) {
            return abort(401);
        }
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return redirect()->route('admin.agendas.index');
    }

    /**
     * Delete all selected Agenda at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('agenda_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Agenda::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Agenda from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('agenda_delete')) {
            return abort(401);
        }
        $agenda = Agenda::onlyTrashed()->findOrFail($id);
        $agenda->restore();

        return redirect()->route('admin.agendas.index');
    }

    /**
     * Permanently delete Agenda from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('agenda_delete')) {
            return abort(401);
        }
        $agenda = Agenda::onlyTrashed()->findOrFail($id);
        $agenda->forceDelete();

        return redirect()->route('admin.agendas.index');
    }
}
