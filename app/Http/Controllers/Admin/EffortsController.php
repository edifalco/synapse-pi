<?php

namespace App\Http\Controllers\Admin;

use App\Effort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEffortsRequest;
use App\Http\Requests\Admin\UpdateEffortsRequest;
use Yajra\DataTables\DataTables;

class EffortsController extends Controller
{
    /**
     * Display a listing of Effort.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('effort_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Effort::query();
            $query->with("project");
            $query->with("workpackage");
            $query->with("partner");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('effort_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'efforts.id',
                'efforts.project_id',
                'efforts.workpackage_id',
                'efforts.partner_id',
                'efforts.value',
                'efforts.period',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'effort_';
                $routeKey = 'admin.efforts';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });
            $table->editColumn('workpackage.wp_id', function ($row) {
                return $row->workpackage ? $row->workpackage->wp_id : '';
            });
            $table->editColumn('partner.name', function ($row) {
                return $row->partner ? $row->partner->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.efforts.index');
    }

    /**
     * Show the form for creating new Effort.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('effort_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $workpackages = \App\Workpackage::get()->pluck('wp_id', 'id')->prepend(trans('global.app_please_select'), '');
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.efforts.create', compact('projects', 'workpackages', 'partners'));
    }

    /**
     * Store a newly created Effort in storage.
     *
     * @param  \App\Http\Requests\StoreEffortsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEffortsRequest $request)
    {
        if (! Gate::allows('effort_create')) {
            return abort(401);
        }
        $effort = Effort::create($request->all());



        return redirect()->route('admin.efforts.index');
    }


    /**
     * Show the form for editing Effort.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('effort_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $workpackages = \App\Workpackage::get()->pluck('wp_id', 'id')->prepend(trans('global.app_please_select'), '');
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $effort = Effort::findOrFail($id);

        return view('admin.efforts.edit', compact('effort', 'projects', 'workpackages', 'partners'));
    }

    /**
     * Update Effort in storage.
     *
     * @param  \App\Http\Requests\UpdateEffortsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEffortsRequest $request, $id)
    {
        if (! Gate::allows('effort_edit')) {
            return abort(401);
        }
        $effort = Effort::findOrFail($id);
        $effort->update($request->all());



        return redirect()->route('admin.efforts.index');
    }


    /**
     * Display Effort.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('effort_view')) {
            return abort(401);
        }
        $effort = Effort::findOrFail($id);

        return view('admin.efforts.show', compact('effort'));
    }


    /**
     * Remove Effort from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('effort_delete')) {
            return abort(401);
        }
        $effort = Effort::findOrFail($id);
        $effort->delete();

        return redirect()->route('admin.efforts.index');
    }

    /**
     * Delete all selected Effort at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('effort_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Effort::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Effort from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('effort_delete')) {
            return abort(401);
        }
        $effort = Effort::onlyTrashed()->findOrFail($id);
        $effort->restore();

        return redirect()->route('admin.efforts.index');
    }

    /**
     * Permanently delete Effort from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('effort_delete')) {
            return abort(401);
        }
        $effort = Effort::onlyTrashed()->findOrFail($id);
        $effort->forceDelete();

        return redirect()->route('admin.efforts.index');
    }
}
