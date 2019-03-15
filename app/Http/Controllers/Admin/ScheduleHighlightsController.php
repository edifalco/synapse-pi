<?php

namespace App\Http\Controllers\Admin;

use App\ScheduleHighlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreScheduleHighlightsRequest;
use App\Http\Requests\Admin\UpdateScheduleHighlightsRequest;
use Yajra\DataTables\DataTables;

class ScheduleHighlightsController extends Controller
{
    /**
     * Display a listing of ScheduleHighlight.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('schedule_highlight_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = ScheduleHighlight::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('schedule_highlight_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'schedule_highlights.id',
                'schedule_highlights.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'schedule_highlight_';
                $routeKey = 'admin.schedule_highlights';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.schedule_highlights.index');
    }

    /**
     * Show the form for creating new ScheduleHighlight.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('schedule_highlight_create')) {
            return abort(401);
        }
        return view('admin.schedule_highlights.create');
    }

    /**
     * Store a newly created ScheduleHighlight in storage.
     *
     * @param  \App\Http\Requests\StoreScheduleHighlightsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScheduleHighlightsRequest $request)
    {
        if (! Gate::allows('schedule_highlight_create')) {
            return abort(401);
        }
        $schedule_highlight = ScheduleHighlight::create($request->all());



        return redirect()->route('admin.schedule_highlights.index');
    }


    /**
     * Show the form for editing ScheduleHighlight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('schedule_highlight_edit')) {
            return abort(401);
        }
        $schedule_highlight = ScheduleHighlight::findOrFail($id);

        return view('admin.schedule_highlights.edit', compact('schedule_highlight'));
    }

    /**
     * Update ScheduleHighlight in storage.
     *
     * @param  \App\Http\Requests\UpdateScheduleHighlightsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScheduleHighlightsRequest $request, $id)
    {
        if (! Gate::allows('schedule_highlight_edit')) {
            return abort(401);
        }
        $schedule_highlight = ScheduleHighlight::findOrFail($id);
        $schedule_highlight->update($request->all());



        return redirect()->route('admin.schedule_highlights.index');
    }


    /**
     * Display ScheduleHighlight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('schedule_highlight_view')) {
            return abort(401);
        }
        $schedules = \App\Schedule::where('highlight_id', $id)->get();

        $schedule_highlight = ScheduleHighlight::findOrFail($id);

        return view('admin.schedule_highlights.show', compact('schedule_highlight', 'schedules'));
    }


    /**
     * Remove ScheduleHighlight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('schedule_highlight_delete')) {
            return abort(401);
        }
        $schedule_highlight = ScheduleHighlight::findOrFail($id);
        $schedule_highlight->delete();

        return redirect()->route('admin.schedule_highlights.index');
    }

    /**
     * Delete all selected ScheduleHighlight at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('schedule_highlight_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ScheduleHighlight::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ScheduleHighlight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('schedule_highlight_delete')) {
            return abort(401);
        }
        $schedule_highlight = ScheduleHighlight::onlyTrashed()->findOrFail($id);
        $schedule_highlight->restore();

        return redirect()->route('admin.schedule_highlights.index');
    }

    /**
     * Permanently delete ScheduleHighlight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('schedule_highlight_delete')) {
            return abort(401);
        }
        $schedule_highlight = ScheduleHighlight::onlyTrashed()->findOrFail($id);
        $schedule_highlight->forceDelete();

        return redirect()->route('admin.schedule_highlights.index');
    }
}
