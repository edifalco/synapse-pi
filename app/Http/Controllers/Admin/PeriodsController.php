<?php

namespace App\Http\Controllers\Admin;

use App\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePeriodsRequest;
use App\Http\Requests\Admin\UpdatePeriodsRequest;
use Yajra\DataTables\DataTables;

class PeriodsController extends Controller
{
    /**
     * Display a listing of Period.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('period_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Period::query();
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('period_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'periods.id',
                'periods.date',
                'periods.period_num',
                'periods.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'period_';
                $routeKey = 'admin.periods';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.periods.index');
    }

    /**
     * Show the form for creating new Period.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('period_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.periods.create', compact('projects'));
    }

    /**
     * Store a newly created Period in storage.
     *
     * @param  \App\Http\Requests\StorePeriodsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePeriodsRequest $request)
    {
        if (! Gate::allows('period_create')) {
            return abort(401);
        }
        $period = Period::create($request->all());



        return redirect()->route('admin.periods.index');
    }


    /**
     * Show the form for editing Period.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('period_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $period = Period::findOrFail($id);

        return view('admin.periods.edit', compact('period', 'projects'));
    }

    /**
     * Update Period in storage.
     *
     * @param  \App\Http\Requests\UpdatePeriodsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePeriodsRequest $request, $id)
    {
        if (! Gate::allows('period_edit')) {
            return abort(401);
        }
        $period = Period::findOrFail($id);
        $period->update($request->all());



        return redirect()->route('admin.periods.index');
    }


    /**
     * Display Period.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('period_view')) {
            return abort(401);
        }
        $period = Period::findOrFail($id);

        return view('admin.periods.show', compact('period'));
    }


    /**
     * Remove Period from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('period_delete')) {
            return abort(401);
        }
        $period = Period::findOrFail($id);
        $period->delete();

        return redirect()->route('admin.periods.index');
    }

    /**
     * Delete all selected Period at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('period_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Period::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Period from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('period_delete')) {
            return abort(401);
        }
        $period = Period::onlyTrashed()->findOrFail($id);
        $period->restore();

        return redirect()->route('admin.periods.index');
    }

    /**
     * Permanently delete Period from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('period_delete')) {
            return abort(401);
        }
        $period = Period::onlyTrashed()->findOrFail($id);
        $period->forceDelete();

        return redirect()->route('admin.periods.index');
    }
}
