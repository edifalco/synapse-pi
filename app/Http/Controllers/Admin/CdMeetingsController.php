<?php

namespace App\Http\Controllers\Admin;

use App\CdMeeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCdMeetingsRequest;
use App\Http\Requests\Admin\UpdateCdMeetingsRequest;
use Yajra\DataTables\DataTables;

class CdMeetingsController extends Controller
{
    /**
     * Display a listing of CdMeeting.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('cd_meeting_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = CdMeeting::query();
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('cd_meeting_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'cd_meetings.id',
                'cd_meetings.month',
                'cd_meetings.value',
                'cd_meetings.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'cd_meeting_';
                $routeKey = 'admin.cd_meetings';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.cd_meetings.index');
    }

    /**
     * Show the form for creating new CdMeeting.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('cd_meeting_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.cd_meetings.create', compact('projects'));
    }

    /**
     * Store a newly created CdMeeting in storage.
     *
     * @param  \App\Http\Requests\StoreCdMeetingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCdMeetingsRequest $request)
    {
        if (! Gate::allows('cd_meeting_create')) {
            return abort(401);
        }
        $cd_meeting = CdMeeting::create($request->all());



        return redirect()->route('admin.cd_meetings.index');
    }


    /**
     * Show the form for editing CdMeeting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('cd_meeting_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $cd_meeting = CdMeeting::findOrFail($id);

        return view('admin.cd_meetings.edit', compact('cd_meeting', 'projects'));
    }

    /**
     * Update CdMeeting in storage.
     *
     * @param  \App\Http\Requests\UpdateCdMeetingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCdMeetingsRequest $request, $id)
    {
        if (! Gate::allows('cd_meeting_edit')) {
            return abort(401);
        }
        $cd_meeting = CdMeeting::findOrFail($id);
        $cd_meeting->update($request->all());



        return redirect()->route('admin.cd_meetings.index');
    }


    /**
     * Display CdMeeting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('cd_meeting_view')) {
            return abort(401);
        }
        $cd_meeting = CdMeeting::findOrFail($id);

        return view('admin.cd_meetings.show', compact('cd_meeting'));
    }


    /**
     * Remove CdMeeting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('cd_meeting_delete')) {
            return abort(401);
        }
        $cd_meeting = CdMeeting::findOrFail($id);
        $cd_meeting->delete();

        return redirect()->route('admin.cd_meetings.index');
    }

    /**
     * Delete all selected CdMeeting at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('cd_meeting_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CdMeeting::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore CdMeeting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('cd_meeting_delete')) {
            return abort(401);
        }
        $cd_meeting = CdMeeting::onlyTrashed()->findOrFail($id);
        $cd_meeting->restore();

        return redirect()->route('admin.cd_meetings.index');
    }

    /**
     * Permanently delete CdMeeting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('cd_meeting_delete')) {
            return abort(401);
        }
        $cd_meeting = CdMeeting::onlyTrashed()->findOrFail($id);
        $cd_meeting->forceDelete();

        return redirect()->route('admin.cd_meetings.index');
    }
}
