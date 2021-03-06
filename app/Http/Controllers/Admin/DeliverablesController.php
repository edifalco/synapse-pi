<?php

namespace App\Http\Controllers\Admin;

use App\Deliverable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeliverablesRequest;
use App\Http\Requests\Admin\UpdateDeliverablesRequest;
use Yajra\DataTables\DataTables;

class DeliverablesController extends Controller
{
    /**
     * Display a listing of Deliverable.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('deliverable_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Deliverable::query();
            $query->with("workpackage");
            $query->with("status");
            $query->with("project");
            $query->with("responsible");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('deliverable_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'deliverables.id',
                'deliverables.workpackage_id',
                'deliverables.label_identification',
                'deliverables.title',
                'deliverables.short_title',
                'deliverables.date',
                'deliverables.status_id',
                'deliverables.notes',
                'deliverables.project_id',
                'deliverables.confidentiality',
                'deliverables.submission_date',
                'deliverables.due_date_months',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'deliverable_';
                $routeKey = 'admin.deliverables';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('workpackage.wp_id', function ($row) {
                return $row->workpackage ? $row->workpackage->wp_id : '';
            });
            $table->editColumn('status.label', function ($row) {
                return $row->status ? $row->status->label : '';
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });
            $table->editColumn('responsible.surname', function ($row) {
                if(count($row->responsible) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->responsible->pluck('surname')->toArray()) . '</span>';
            });

            $table->rawColumns(['actions','massDelete','responsible.surname']);

            return $table->make(true);
        }

        return view('admin.deliverables.index');
    }

    /**
     * Show the form for creating new Deliverable.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('deliverable_create')) {
            return abort(401);
        }
        
        $workpackages = \App\Workpackage::get()->pluck('wp_id', 'id')->prepend(trans('global.app_please_select'), '');
        $statuses = \App\DeliverableStatus::get()->pluck('label', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $responsibles = \App\Member::get()->pluck('surname', 'id');


        return view('admin.deliverables.create', compact('workpackages', 'statuses', 'projects', 'responsibles'));
    }

    /**
     * Store a newly created Deliverable in storage.
     *
     * @param  \App\Http\Requests\StoreDeliverablesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliverablesRequest $request)
    {
        if (! Gate::allows('deliverable_create')) {
            return abort(401);
        }
        $deliverable = Deliverable::create($request->all());
        $deliverable->responsible()->sync(array_filter((array)$request->input('responsible')));



        return redirect()->route('admin.deliverables.index');
    }


    /**
     * Show the form for editing Deliverable.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('deliverable_edit')) {
            return abort(401);
        }
        
        $workpackages = \App\Workpackage::get()->pluck('wp_id', 'id')->prepend(trans('global.app_please_select'), '');
        $statuses = \App\DeliverableStatus::get()->pluck('label', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $responsibles = \App\Member::get()->pluck('surname', 'id');


        $deliverable = Deliverable::findOrFail($id);

        return view('admin.deliverables.edit', compact('deliverable', 'workpackages', 'statuses', 'projects', 'responsibles'));
    }

    /**
     * Update Deliverable in storage.
     *
     * @param  \App\Http\Requests\UpdateDeliverablesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliverablesRequest $request, $id)
    {
        if (! Gate::allows('deliverable_edit')) {
            return abort(401);
        }
        $deliverable = Deliverable::findOrFail($id);
        $deliverable->update($request->all());
        $deliverable->responsible()->sync(array_filter((array)$request->input('responsible')));



        return redirect()->route('admin.deliverables.index');
    }


    /**
     * Display Deliverable.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('deliverable_view')) {
            return abort(401);
        }
        
        $workpackages = \App\Workpackage::get()->pluck('wp_id', 'id')->prepend(trans('global.app_please_select'), '');
        $statuses = \App\DeliverableStatus::get()->pluck('label', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $responsibles = \App\Member::get()->pluck('surname', 'id');
$deliverable_documents = \App\DeliverableDocument::where('deliverable_id', $id)->get();$deliverable_reviewers = \App\DeliverableReviewer::where('deliverable_id', $id)->get();$deliverable_workpackages = \App\DeliverableWorkpackage::where('deliverable_id', $id)->get();$deliverable_partners = \App\DeliverablePartner::where('deliverable_id', $id)->get();$documents = \App\Document::where('deliverable_id', $id)->get();

        $deliverable = Deliverable::findOrFail($id);

        return view('admin.deliverables.show', compact('deliverable', 'deliverable_documents', 'deliverable_reviewers', 'deliverable_workpackages', 'deliverable_partners', 'documents'));
    }


    /**
     * Remove Deliverable from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('deliverable_delete')) {
            return abort(401);
        }
        $deliverable = Deliverable::findOrFail($id);
        $deliverable->delete();

        return redirect()->route('admin.deliverables.index');
    }

    /**
     * Delete all selected Deliverable at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('deliverable_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Deliverable::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Deliverable from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('deliverable_delete')) {
            return abort(401);
        }
        $deliverable = Deliverable::onlyTrashed()->findOrFail($id);
        $deliverable->restore();

        return redirect()->route('admin.deliverables.index');
    }

    /**
     * Permanently delete Deliverable from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('deliverable_delete')) {
            return abort(401);
        }
        $deliverable = Deliverable::onlyTrashed()->findOrFail($id);
        $deliverable->forceDelete();

        return redirect()->route('admin.deliverables.index');
    }
}
