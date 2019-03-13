<?php

namespace App\Http\Controllers\Admin;

use App\ProjectPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectPeriodsRequest;
use App\Http\Requests\Admin\UpdateProjectPeriodsRequest;
use Yajra\DataTables\DataTables;

class ProjectPeriodsController extends Controller
{
    /**
     * Display a listing of ProjectPeriod.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('project_period_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = ProjectPeriod::query();
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('project_period_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'project_periods.id',
                'project_periods.date',
                'project_periods.period_num',
                'project_periods.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'project_period_';
                $routeKey = 'admin.project_periods';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->date : '';
            });
            $table->editColumn('period_num', function ($row) {
                return $row->period_num ? $row->period_num : '';
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.project_periods.index');
    }

    /**
     * Show the form for creating new ProjectPeriod.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('project_period_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.project_periods.create', compact('projects'));
    }

    /**
     * Store a newly created ProjectPeriod in storage.
     *
     * @param  \App\Http\Requests\StoreProjectPeriodsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectPeriodsRequest $request)
    {
        if (! Gate::allows('project_period_create')) {
            return abort(401);
        }
        $project_period = ProjectPeriod::create($request->all());



        return redirect()->route('admin.project_periods.index');
    }


    /**
     * Show the form for editing ProjectPeriod.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('project_period_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $project_period = ProjectPeriod::findOrFail($id);

        return view('admin.project_periods.edit', compact('project_period', 'projects'));
    }

    /**
     * Update ProjectPeriod in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectPeriodsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectPeriodsRequest $request, $id)
    {
        if (! Gate::allows('project_period_edit')) {
            return abort(401);
        }
        $project_period = ProjectPeriod::findOrFail($id);
        $project_period->update($request->all());



        return redirect()->route('admin.project_periods.index');
    }


    /**
     * Display ProjectPeriod.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('project_period_view')) {
            return abort(401);
        }
        $project_period = ProjectPeriod::findOrFail($id);

        return view('admin.project_periods.show', compact('project_period'));
    }


    /**
     * Remove ProjectPeriod from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('project_period_delete')) {
            return abort(401);
        }
        $project_period = ProjectPeriod::findOrFail($id);
        $project_period->delete();

        return redirect()->route('admin.project_periods.index');
    }

    /**
     * Delete all selected ProjectPeriod at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('project_period_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ProjectPeriod::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ProjectPeriod from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('project_period_delete')) {
            return abort(401);
        }
        $project_period = ProjectPeriod::onlyTrashed()->findOrFail($id);
        $project_period->restore();

        return redirect()->route('admin.project_periods.index');
    }

    /**
     * Permanently delete ProjectPeriod from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('project_period_delete')) {
            return abort(401);
        }
        $project_period = ProjectPeriod::onlyTrashed()->findOrFail($id);
        $project_period->forceDelete();

        return redirect()->route('admin.project_periods.index');
    }
}
