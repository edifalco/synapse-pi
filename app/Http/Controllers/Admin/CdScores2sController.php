<?php

namespace App\Http\Controllers\Admin;

use App\CdScores2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCdScores2sRequest;
use App\Http\Requests\Admin\UpdateCdScores2sRequest;
use Yajra\DataTables\DataTables;

class CdScores2sController extends Controller
{
    /**
     * Display a listing of CdScores2.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('cd_scores2_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = CdScores2::query();
            $query->with("project");
            $template = 'actionsTemplate';
            
            $query->select([
                'cd_scores2s.id',
                'cd_scores2s.month',
                'cd_scores2s.value',
                'cd_scores2s.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'cd_scores2_';
                $routeKey = 'admin.cd_scores2s';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.cd_scores2s.index');
    }

    /**
     * Show the form for creating new CdScores2.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('cd_scores2_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.cd_scores2s.create', compact('projects'));
    }

    /**
     * Store a newly created CdScores2 in storage.
     *
     * @param  \App\Http\Requests\StoreCdScores2sRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCdScores2sRequest $request)
    {
        if (! Gate::allows('cd_scores2_create')) {
            return abort(401);
        }
        $cd_scores2 = CdScores2::create($request->all());



        return redirect()->route('admin.cd_scores2s.index');
    }


    /**
     * Show the form for editing CdScores2.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('cd_scores2_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $cd_scores2 = CdScores2::findOrFail($id);

        return view('admin.cd_scores2s.edit', compact('cd_scores2', 'projects'));
    }

    /**
     * Update CdScores2 in storage.
     *
     * @param  \App\Http\Requests\UpdateCdScores2sRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCdScores2sRequest $request, $id)
    {
        if (! Gate::allows('cd_scores2_edit')) {
            return abort(401);
        }
        $cd_scores2 = CdScores2::findOrFail($id);
        $cd_scores2->update($request->all());



        return redirect()->route('admin.cd_scores2s.index');
    }


    /**
     * Display CdScores2.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('cd_scores2_view')) {
            return abort(401);
        }
        $cd_scores2 = CdScores2::findOrFail($id);

        return view('admin.cd_scores2s.show', compact('cd_scores2'));
    }


    /**
     * Remove CdScores2 from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('cd_scores2_delete')) {
            return abort(401);
        }
        $cd_scores2 = CdScores2::findOrFail($id);
        $cd_scores2->delete();

        return redirect()->route('admin.cd_scores2s.index');
    }

    /**
     * Delete all selected CdScores2 at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('cd_scores2_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CdScores2::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
