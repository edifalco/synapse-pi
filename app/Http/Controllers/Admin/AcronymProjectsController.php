<?php

namespace App\Http\Controllers\Admin;

use App\AcronymProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAcronymProjectsRequest;
use App\Http\Requests\Admin\UpdateAcronymProjectsRequest;
use Yajra\DataTables\DataTables;

class AcronymProjectsController extends Controller
{
    /**
     * Display a listing of AcronymProject.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('acronym_project_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = AcronymProject::query();
            $query->with("acronym");
            $query->with("partner");
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('acronym_project_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'acronym_projects.id',
                'acronym_projects.acronym_id',
                'acronym_projects.partner_id',
                'acronym_projects.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'acronym_project_';
                $routeKey = 'admin.acronym_projects';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('acronym.acronym', function ($row) {
                return $row->acronym ? $row->acronym->acronym : '';
            });
            $table->editColumn('partner.name', function ($row) {
                return $row->partner ? $row->partner->name : '';
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.acronym_projects.index');
    }

    /**
     * Show the form for creating new AcronymProject.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('acronym_project_create')) {
            return abort(401);
        }
        
        $acronyms = \App\Acronym::get()->pluck('acronym', 'id')->prepend(trans('global.app_please_select'), '');
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.acronym_projects.create', compact('acronyms', 'partners', 'projects'));
    }

    /**
     * Store a newly created AcronymProject in storage.
     *
     * @param  \App\Http\Requests\StoreAcronymProjectsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcronymProjectsRequest $request)
    {
        if (! Gate::allows('acronym_project_create')) {
            return abort(401);
        }
        $acronym_project = AcronymProject::create($request->all());



        return redirect()->route('admin.acronym_projects.index');
    }


    /**
     * Show the form for editing AcronymProject.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('acronym_project_edit')) {
            return abort(401);
        }
        
        $acronyms = \App\Acronym::get()->pluck('acronym', 'id')->prepend(trans('global.app_please_select'), '');
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $acronym_project = AcronymProject::findOrFail($id);

        return view('admin.acronym_projects.edit', compact('acronym_project', 'acronyms', 'partners', 'projects'));
    }

    /**
     * Update AcronymProject in storage.
     *
     * @param  \App\Http\Requests\UpdateAcronymProjectsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAcronymProjectsRequest $request, $id)
    {
        if (! Gate::allows('acronym_project_edit')) {
            return abort(401);
        }
        $acronym_project = AcronymProject::findOrFail($id);
        $acronym_project->update($request->all());



        return redirect()->route('admin.acronym_projects.index');
    }


    /**
     * Display AcronymProject.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('acronym_project_view')) {
            return abort(401);
        }
        $acronym_project = AcronymProject::findOrFail($id);

        return view('admin.acronym_projects.show', compact('acronym_project'));
    }


    /**
     * Remove AcronymProject from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('acronym_project_delete')) {
            return abort(401);
        }
        $acronym_project = AcronymProject::findOrFail($id);
        $acronym_project->delete();

        return redirect()->route('admin.acronym_projects.index');
    }

    /**
     * Delete all selected AcronymProject at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('acronym_project_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = AcronymProject::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore AcronymProject from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('acronym_project_delete')) {
            return abort(401);
        }
        $acronym_project = AcronymProject::onlyTrashed()->findOrFail($id);
        $acronym_project->restore();

        return redirect()->route('admin.acronym_projects.index');
    }

    /**
     * Permanently delete AcronymProject from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('acronym_project_delete')) {
            return abort(401);
        }
        $acronym_project = AcronymProject::onlyTrashed()->findOrFail($id);
        $acronym_project->forceDelete();

        return redirect()->route('admin.acronym_projects.index');
    }
}
