<?php

namespace App\Http\Controllers\Admin;

use App\CdScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCdScoresRequest;
use App\Http\Requests\Admin\UpdateCdScoresRequest;
use Yajra\DataTables\DataTables;

class CdScoresController extends Controller
{
    /**
     * Display a listing of CdScore.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('cd_score_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = CdScore::query();
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('cd_score_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'cd_scores.id',
                'cd_scores.month',
                'cd_scores.value',
                'cd_scores.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'cd_score_';
                $routeKey = 'admin.cd_scores';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.cd_scores.index');
    }

    /**
     * Show the form for creating new CdScore.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('cd_score_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.cd_scores.create', compact('projects'));
    }

    /**
     * Store a newly created CdScore in storage.
     *
     * @param  \App\Http\Requests\StoreCdScoresRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCdScoresRequest $request)
    {
        if (! Gate::allows('cd_score_create')) {
            return abort(401);
        }
        $cd_score = CdScore::create($request->all());



        return redirect()->route('admin.cd_scores.index');
    }


    /**
     * Show the form for editing CdScore.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('cd_score_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $cd_score = CdScore::findOrFail($id);

        return view('admin.cd_scores.edit', compact('cd_score', 'projects'));
    }

    /**
     * Update CdScore in storage.
     *
     * @param  \App\Http\Requests\UpdateCdScoresRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCdScoresRequest $request, $id)
    {
        if (! Gate::allows('cd_score_edit')) {
            return abort(401);
        }
        $cd_score = CdScore::findOrFail($id);
        $cd_score->update($request->all());



        return redirect()->route('admin.cd_scores.index');
    }


    /**
     * Display CdScore.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('cd_score_view')) {
            return abort(401);
        }
        $cd_score = CdScore::findOrFail($id);

        return view('admin.cd_scores.show', compact('cd_score'));
    }


    /**
     * Remove CdScore from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('cd_score_delete')) {
            return abort(401);
        }
        $cd_score = CdScore::findOrFail($id);
        $cd_score->delete();

        return redirect()->route('admin.cd_scores.index');
    }

    /**
     * Delete all selected CdScore at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('cd_score_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CdScore::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore CdScore from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('cd_score_delete')) {
            return abort(401);
        }
        $cd_score = CdScore::onlyTrashed()->findOrFail($id);
        $cd_score->restore();

        return redirect()->route('admin.cd_scores.index');
    }

    /**
     * Permanently delete CdScore from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('cd_score_delete')) {
            return abort(401);
        }
        $cd_score = CdScore::onlyTrashed()->findOrFail($id);
        $cd_score->forceDelete();

        return redirect()->route('admin.cd_scores.index');
    }
}
