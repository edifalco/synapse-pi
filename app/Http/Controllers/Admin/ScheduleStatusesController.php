<?php

namespace App\Http\Controllers\Admin;

use App\ScheduleStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreScheduleStatusesRequest;
use App\Http\Requests\Admin\UpdateScheduleStatusesRequest;
use Yajra\DataTables\DataTables;

class ScheduleStatusesController extends Controller
{
    /**
     * Display a listing of ScheduleStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('schedule_status_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = ScheduleStatus::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('schedule_status_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'schedule_statuses.id',
                'schedule_statuses.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'schedule_status_';
                $routeKey = 'admin.schedule_statuses';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.schedule_statuses.index');
    }

    /**
     * Show the form for creating new ScheduleStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('schedule_status_create')) {
            return abort(401);
        }
        return view('admin.schedule_statuses.create');
    }

    /**
     * Store a newly created ScheduleStatus in storage.
     *
     * @param  \App\Http\Requests\StoreScheduleStatusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScheduleStatusesRequest $request)
    {
        if (! Gate::allows('schedule_status_create')) {
            return abort(401);
        }
        $schedule_status = ScheduleStatus::create($request->all());



        return redirect()->route('admin.schedule_statuses.index');
    }


    /**
     * Show the form for editing ScheduleStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('schedule_status_edit')) {
            return abort(401);
        }
        $schedule_status = ScheduleStatus::findOrFail($id);

        return view('admin.schedule_statuses.edit', compact('schedule_status'));
    }

    /**
     * Update ScheduleStatus in storage.
     *
     * @param  \App\Http\Requests\UpdateScheduleStatusesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScheduleStatusesRequest $request, $id)
    {
        if (! Gate::allows('schedule_status_edit')) {
            return abort(401);
        }
        $schedule_status = ScheduleStatus::findOrFail($id);
        $schedule_status->update($request->all());



        return redirect()->route('admin.schedule_statuses.index');
    }


    /**
     * Display ScheduleStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('schedule_status_view')) {
            return abort(401);
        }
        $schedules = \App\Schedule::where('status_id', $id)->get();

        $schedule_status = ScheduleStatus::findOrFail($id);

        return view('admin.schedule_statuses.show', compact('schedule_status', 'schedules'));
    }


    /**
     * Remove ScheduleStatus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('schedule_status_delete')) {
            return abort(401);
        }
        $schedule_status = ScheduleStatus::findOrFail($id);
        $schedule_status->delete();

        return redirect()->route('admin.schedule_statuses.index');
    }

    /**
     * Delete all selected ScheduleStatus at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('schedule_status_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ScheduleStatus::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ScheduleStatus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('schedule_status_delete')) {
            return abort(401);
        }
        $schedule_status = ScheduleStatus::onlyTrashed()->findOrFail($id);
        $schedule_status->restore();

        return redirect()->route('admin.schedule_statuses.index');
    }

    /**
     * Permanently delete ScheduleStatus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('schedule_status_delete')) {
            return abort(401);
        }
        $schedule_status = ScheduleStatus::onlyTrashed()->findOrFail($id);
        $schedule_status->forceDelete();

        return redirect()->route('admin.schedule_statuses.index');
    }
}
