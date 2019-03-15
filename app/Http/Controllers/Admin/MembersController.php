<?php

namespace App\Http\Controllers\Admin;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMembersRequest;
use App\Http\Requests\Admin\UpdateMembersRequest;
use Yajra\DataTables\DataTables;

class MembersController extends Controller
{
    /**
     * Display a listing of Member.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('member_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Member::query();
            $query->with("partner");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('member_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'members.id',
                'members.name',
                'members.surname',
                'members.partner_id',
                'members.email',
                'members.phone',
                'members.notes',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'member_';
                $routeKey = 'admin.members';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('partner.name', function ($row) {
                return $row->partner ? $row->partner->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.members.index');
    }

    /**
     * Show the form for creating new Member.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('member_create')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.members.create', compact('partners'));
    }

    /**
     * Store a newly created Member in storage.
     *
     * @param  \App\Http\Requests\StoreMembersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembersRequest $request)
    {
        if (! Gate::allows('member_create')) {
            return abort(401);
        }
        $member = Member::create($request->all());



        return redirect()->route('admin.members.index');
    }


    /**
     * Show the form for editing Member.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('member_edit')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $member = Member::findOrFail($id);

        return view('admin.members.edit', compact('member', 'partners'));
    }

    /**
     * Update Member in storage.
     *
     * @param  \App\Http\Requests\UpdateMembersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembersRequest $request, $id)
    {
        if (! Gate::allows('member_edit')) {
            return abort(401);
        }
        $member = Member::findOrFail($id);
        $member->update($request->all());



        return redirect()->route('admin.members.index');
    }


    /**
     * Display Member.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('member_view')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$member_partners = \App\MemberPartner::where('member_id', $id)->get();$memberroles = \App\Memberrole::where('member_id', $id)->get();$risk_mowners = \App\RiskMowner::where('member_id', $id)->get();$risk_mreporters = \App\RiskMreporter::where('member_id', $id)->get();$project_members = \App\ProjectMember::where('member_id', $id)->get();$deliverable_reviewers = \App\DeliverableReviewer::where('member_id', $id)->get();$deliverables = \App\Deliverable::whereHas('responsible',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$risks = \App\Risk::where('owner_id', $id)->get();

        $member = Member::findOrFail($id);

        return view('admin.members.show', compact('member', 'member_partners', 'memberroles', 'risk_mowners', 'risk_mreporters', 'project_members', 'deliverable_reviewers', 'deliverables', 'risks'));
    }


    /**
     * Remove Member from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('member_delete')) {
            return abort(401);
        }
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('admin.members.index');
    }

    /**
     * Delete all selected Member at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('member_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Member::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Member from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('member_delete')) {
            return abort(401);
        }
        $member = Member::onlyTrashed()->findOrFail($id);
        $member->restore();

        return redirect()->route('admin.members.index');
    }

    /**
     * Permanently delete Member from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('member_delete')) {
            return abort(401);
        }
        $member = Member::onlyTrashed()->findOrFail($id);
        $member->forceDelete();

        return redirect()->route('admin.members.index');
    }
}
