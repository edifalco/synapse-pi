<?php

namespace App\Http\Controllers\Admin;

use App\ProjectPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectPartnersRequest;
use App\Http\Requests\Admin\UpdateProjectPartnersRequest;
use Yajra\DataTables\DataTables;

class ProjectPartnersController extends Controller
{
    /**
     * Display a listing of ProjectPartner.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('project_partner_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = ProjectPartner::query();
            $query->with("project");
            $query->with("partner");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('project_partner_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'project_partners.id',
                'project_partners.project_id',
                'project_partners.partner_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'project_partner_';
                $routeKey = 'admin.project_partners';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });
            $table->editColumn('partner.name', function ($row) {
                return $row->partner ? $row->partner->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.project_partners.index');
    }

    /**
     * Show the form for creating new ProjectPartner.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('project_partner_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.project_partners.create', compact('projects', 'partners'));
    }

    /**
     * Store a newly created ProjectPartner in storage.
     *
     * @param  \App\Http\Requests\StoreProjectPartnersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectPartnersRequest $request)
    {
        if (! Gate::allows('project_partner_create')) {
            return abort(401);
        }
        $project_partner = ProjectPartner::create($request->all());



        return redirect()->route('admin.project_partners.index');
    }


    /**
     * Show the form for editing ProjectPartner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('project_partner_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $project_partner = ProjectPartner::findOrFail($id);

        return view('admin.project_partners.edit', compact('project_partner', 'projects', 'partners'));
    }

    /**
     * Update ProjectPartner in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectPartnersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectPartnersRequest $request, $id)
    {
        if (! Gate::allows('project_partner_edit')) {
            return abort(401);
        }
        $project_partner = ProjectPartner::findOrFail($id);
        $project_partner->update($request->all());



        return redirect()->route('admin.project_partners.index');
    }


    /**
     * Display ProjectPartner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('project_partner_view')) {
            return abort(401);
        }
        $project_partner = ProjectPartner::findOrFail($id);

        return view('admin.project_partners.show', compact('project_partner'));
    }


    /**
     * Remove ProjectPartner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('project_partner_delete')) {
            return abort(401);
        }
        $project_partner = ProjectPartner::findOrFail($id);
        $project_partner->delete();

        return redirect()->route('admin.project_partners.index');
    }

    /**
     * Delete all selected ProjectPartner at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('project_partner_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ProjectPartner::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ProjectPartner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('project_partner_delete')) {
            return abort(401);
        }
        $project_partner = ProjectPartner::onlyTrashed()->findOrFail($id);
        $project_partner->restore();

        return redirect()->route('admin.project_partners.index');
    }

    /**
     * Permanently delete ProjectPartner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('project_partner_delete')) {
            return abort(401);
        }
        $project_partner = ProjectPartner::onlyTrashed()->findOrFail($id);
        $project_partner->forceDelete();

        return redirect()->route('admin.project_partners.index');
    }
}
