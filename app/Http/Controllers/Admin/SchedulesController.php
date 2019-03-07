<?php

namespace App\Http\Controllers\Admin;

use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSchedulesRequest;
use App\Http\Requests\Admin\UpdateSchedulesRequest;

class SchedulesController extends Controller
{
    /**
     * Display a listing of Schedule.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('schedule_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('schedule_delete')) {
                return abort(401);
            }
            $schedules = Schedule::onlyTrashed()->get();
        } else {
            $schedules = Schedule::all();
        }

        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating new Schedule.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('schedule_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.schedules.create', compact('projects'));
    }

    /**
     * Store a newly created Schedule in storage.
     *
     * @param  \App\Http\Requests\StoreSchedulesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchedulesRequest $request)
    {
        if (! Gate::allows('schedule_create')) {
            return abort(401);
        }
        $schedule = Schedule::create($request->all());



        return redirect()->route('admin.schedules.index');
    }


    /**
     * Show the form for editing Schedule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('schedule_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $schedule = Schedule::findOrFail($id);

        return view('admin.schedules.edit', compact('schedule', 'projects'));
    }

    /**
     * Update Schedule in storage.
     *
     * @param  \App\Http\Requests\UpdateSchedulesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchedulesRequest $request, $id)
    {
        if (! Gate::allows('schedule_edit')) {
            return abort(401);
        }
        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());



        return redirect()->route('admin.schedules.index');
    }


    /**
     * Display Schedule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('schedule_view')) {
            return abort(401);
        }
        $schedule = Schedule::findOrFail($id);

        return view('admin.schedules.show', compact('schedule'));
    }


    /**
     * Remove Schedule from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('schedule_delete')) {
            return abort(401);
        }
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.schedules.index');
    }

    /**
     * Delete all selected Schedule at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('schedule_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Schedule::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Schedule from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('schedule_delete')) {
            return abort(401);
        }
        $schedule = Schedule::onlyTrashed()->findOrFail($id);
        $schedule->restore();

        return redirect()->route('admin.schedules.index');
    }

    /**
     * Permanently delete Schedule from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('schedule_delete')) {
            return abort(401);
        }
        $schedule = Schedule::onlyTrashed()->findOrFail($id);
        $schedule->forceDelete();

        return redirect()->route('admin.schedules.index');
    }
}
