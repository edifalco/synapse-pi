<?php

namespace App\Http\Controllers\Admin;

use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePartnersRequest;
use App\Http\Requests\Admin\UpdatePartnersRequest;
use Yajra\DataTables\DataTables;

class PartnersController extends Controller
{
    /**
     * Display a listing of Partner.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('partner_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Partner::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('partner_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'partners.id',
                'partners.name',
                'partners.acronym',
                'partners.image',
                'partners.country',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'partner_';
                $routeKey = 'admin.partners';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.partners.index');
    }

    /**
     * Show the form for creating new Partner.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('partner_create')) {
            return abort(401);
        }
        return view('admin.partners.create');
    }

    /**
     * Store a newly created Partner in storage.
     *
     * @param  \App\Http\Requests\StorePartnersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnersRequest $request)
    {
        if (! Gate::allows('partner_create')) {
            return abort(401);
        }
        $partner = Partner::create($request->all());

        foreach ($request->input('projects', []) as $data) {
            $partner->projects()->create($data);
        }


        return redirect()->route('admin.partners.index');
    }


    /**
     * Show the form for editing Partner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('partner_edit')) {
            return abort(401);
        }
        $partner = Partner::findOrFail($id);

        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Update Partner in storage.
     *
     * @param  \App\Http\Requests\UpdatePartnersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartnersRequest $request, $id)
    {
        if (! Gate::allows('partner_edit')) {
            return abort(401);
        }
        $partner = Partner::findOrFail($id);
        $partner->update($request->all());

        $projects           = $partner->projects;
        $currentProjectData = [];
        foreach ($request->input('projects', []) as $index => $data) {
            if (is_integer($index)) {
                $partner->projects()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentProjectData[$id] = $data;
            }
        }
        foreach ($projects as $item) {
            if (isset($currentProjectData[$item->id])) {
                $item->update($currentProjectData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.partners.index');
    }


    /**
     * Display Partner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('partner_view')) {
            return abort(401);
        }
        $budgets = \App\Budget::where('partner_id', $id)->get();$partnerroles = \App\Partnerrole::where('partner_id', $id)->get();$risk_powners = \App\RiskPowner::where('partner_id', $id)->get();$risk_preporters = \App\RiskPreporter::where('partner_id', $id)->get();$deliverable_partners = \App\DeliverablePartner::where('partner_id', $id)->get();$acronyms = \App\Acronym::where('partner_id', $id)->get();$member_partners = \App\MemberPartner::where('partner_id', $id)->get();$acronym_projects = \App\AcronymProject::where('partner_id', $id)->get();$partnernums = \App\Partnernum::where('partner_id', $id)->get();$project_partners = \App\ProjectPartner::where('partner_id', $id)->get();$project_members = \App\ProjectMember::where('partner_id', $id)->get();$members = \App\Member::where('partner_id', $id)->get();$efforts = \App\Effort::where('partner_id', $id)->get();$memberroles = \App\Memberrole::where('partner_id', $id)->get();$projects = \App\Project::where('partners_id', $id)->get();

        $partner = Partner::findOrFail($id);

        return view('admin.partners.show', compact('partner', 'budgets', 'partnerroles', 'risk_powners', 'risk_preporters', 'deliverable_partners', 'acronyms', 'member_partners', 'acronym_projects', 'partnernums', 'project_partners', 'project_members', 'members', 'efforts', 'memberroles', 'projects'));
    }


    /**
     * Remove Partner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('partner_delete')) {
            return abort(401);
        }
        $partner = Partner::findOrFail($id);
        $partner->delete();

        return redirect()->route('admin.partners.index');
    }

    /**
     * Delete all selected Partner at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('partner_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Partner::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Partner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('partner_delete')) {
            return abort(401);
        }
        $partner = Partner::onlyTrashed()->findOrFail($id);
        $partner->restore();

        return redirect()->route('admin.partners.index');
    }

    /**
     * Permanently delete Partner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('partner_delete')) {
            return abort(401);
        }
        $partner = Partner::onlyTrashed()->findOrFail($id);
        $partner->forceDelete();

        return redirect()->route('admin.partners.index');
    }
}
