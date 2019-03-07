<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectsRequest;
use App\Http\Requests\Admin\UpdateProjectsRequest;

class ProjectsController extends Controller
{
    /**
     * Display a listing of Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('project_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('project_delete')) {
                return abort(401);
            }
            $projects = Project::onlyTrashed()->get();
        } else {
            $projects = Project::all();
        }

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating new Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('project_create')) {
            return abort(401);
        }
        return view('admin.projects.create');
    }

    /**
     * Store a newly created Project in storage.
     *
     * @param  \App\Http\Requests\StoreProjectsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectsRequest $request)
    {
        if (! Gate::allows('project_create')) {
            return abort(401);
        }
        $project = Project::create($request->all());



        return redirect()->route('admin.projects.index');
    }


    /**
     * Show the form for editing Project.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('project_edit')) {
            return abort(401);
        }
        $project = Project::findOrFail($id);

        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update Project in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectsRequest $request, $id)
    {
        if (! Gate::allows('project_edit')) {
            return abort(401);
        }
        $project = Project::findOrFail($id);
        $project->update($request->all());



        return redirect()->route('admin.projects.index');
    }


    /**
     * Display Project.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('project_view')) {
            return abort(401);
        }
        $project_members = \App\ProjectMember::where('project_id', $id)->get();$project_partners = \App\ProjectPartner::where('project_id', $id)->get();$efforts = \App\Effort::where('project_id', $id)->get();$alternativescores = \App\Alternativescore::where('project_id', $id)->get();$metriclabels = \App\Metriclabel::where('project_id', $id)->get();$project_users = \App\ProjectUser::where('projectID_id', $id)->get();$risk_highlights = \App\RiskHighlight::where('project_id', $id)->get();$scoredescriptions = \App\Scoredescription::where('project_id', $id)->get();$threshold_deliverables = \App\ThresholdDeliverable::where('project_id', $id)->get();$threshold_risks = \App\ThresholdRisk::where('project_id', $id)->get();$document_favorites = \App\DocumentFavorite::where('project_id', $id)->get();$financials = \App\Financial::where('project_id', $id)->get();$financialvisibilities = \App\Financialvisibility::where('id_project_id', $id)->get();$memberroles = \App\Memberrole::where('project_id', $id)->get();$acronym_projects = \App\AcronymProject::where('project_id', $id)->get();$cd_disseminations = \App\CdDissemination::where('project_id', $id)->get();$metricicons = \App\Metricicon::where('project_id', $id)->get();$cd_emails = \App\CdEmail::where('project_id', $id)->get();$cd_intranet_accesses = \App\CdIntranetAccess::where('project_id', $id)->get();$partnernums = \App\Partnernum::where('project_id', $id)->get();$cd_meetings = \App\CdMeeting::where('project_id', $id)->get();$partnerroles = \App\Partnerrole::where('project_id', $id)->get();$cd_scores = \App\CdScore::where('project_id', $id)->get();$cd_scores2s = \App\CdScores2::where('project_id', $id)->get();$periods = \App\Period::where('project_id', $id)->get();$workpackages = \App\Workpackage::where('project_id', $id)->get();$budgets = \App\Budget::where('project_id', $id)->get();$posts = \App\Post::where('idProject_id', $id)->get();$schedules = \App\Schedule::where('project_id', $id)->get();$documents = \App\Document::where('project_id', $id)->get();$agendas = \App\Agenda::where('project_id', $id)->get();$publications = \App\Publication::where('project_id', $id)->get();$risks = \App\Risk::where('project_id', $id)->get();$deliverables = \App\Deliverable::where('project_id', $id)->get();

        $project = Project::findOrFail($id);

        return view('admin.projects.show', compact('project', 'project_members', 'project_partners', 'efforts', 'alternativescores', 'metriclabels', 'project_users', 'risk_highlights', 'scoredescriptions', 'threshold_deliverables', 'threshold_risks', 'document_favorites', 'financials', 'financialvisibilities', 'memberroles', 'acronym_projects', 'cd_disseminations', 'metricicons', 'cd_emails', 'cd_intranet_accesses', 'partnernums', 'cd_meetings', 'partnerroles', 'cd_scores', 'cd_scores2s', 'periods', 'workpackages', 'budgets', 'posts', 'schedules', 'documents', 'agendas', 'publications', 'risks', 'deliverables'));
    }


    /**
     * Remove Project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('project_delete')) {
            return abort(401);
        }
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.projects.index');
    }

    /**
     * Delete all selected Project at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('project_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Project::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('project_delete')) {
            return abort(401);
        }
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('admin.projects.index');
    }

    /**
     * Permanently delete Project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('project_delete')) {
            return abort(401);
        }
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->forceDelete();

        return redirect()->route('admin.projects.index');
    }
}
