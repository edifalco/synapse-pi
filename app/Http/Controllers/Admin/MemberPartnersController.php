<?php

namespace App\Http\Controllers\Admin;

use App\MemberPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMemberPartnersRequest;
use App\Http\Requests\Admin\UpdateMemberPartnersRequest;
use Yajra\DataTables\DataTables;

class MemberPartnersController extends Controller
{
    /**
     * Display a listing of MemberPartner.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('member_partner_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = MemberPartner::query();
            $query->with("member");
            $query->with("partner");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('member_partner_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'member_partners.id',
                'member_partners.member_id',
                'member_partners.partner_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'member_partner_';
                $routeKey = 'admin.member_partners';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('member.name', function ($row) {
                return $row->member ? $row->member->name : '';
            });
            $table->editColumn('partner.name', function ($row) {
                return $row->partner ? $row->partner->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.member_partners.index');
    }

    /**
     * Show the form for creating new MemberPartner.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('member_partner_create')) {
            return abort(401);
        }
        
        $members = \App\Member::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.member_partners.create', compact('members', 'partners'));
    }

    /**
     * Store a newly created MemberPartner in storage.
     *
     * @param  \App\Http\Requests\StoreMemberPartnersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberPartnersRequest $request)
    {
        if (! Gate::allows('member_partner_create')) {
            return abort(401);
        }
        $member_partner = MemberPartner::create($request->all());



        return redirect()->route('admin.member_partners.index');
    }


    /**
     * Show the form for editing MemberPartner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('member_partner_edit')) {
            return abort(401);
        }
        
        $members = \App\Member::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $member_partner = MemberPartner::findOrFail($id);

        return view('admin.member_partners.edit', compact('member_partner', 'members', 'partners'));
    }

    /**
     * Update MemberPartner in storage.
     *
     * @param  \App\Http\Requests\UpdateMemberPartnersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemberPartnersRequest $request, $id)
    {
        if (! Gate::allows('member_partner_edit')) {
            return abort(401);
        }
        $member_partner = MemberPartner::findOrFail($id);
        $member_partner->update($request->all());



        return redirect()->route('admin.member_partners.index');
    }


    /**
     * Display MemberPartner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('member_partner_view')) {
            return abort(401);
        }
        $member_partner = MemberPartner::findOrFail($id);

        return view('admin.member_partners.show', compact('member_partner'));
    }


    /**
     * Remove MemberPartner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('member_partner_delete')) {
            return abort(401);
        }
        $member_partner = MemberPartner::findOrFail($id);
        $member_partner->delete();

        return redirect()->route('admin.member_partners.index');
    }

    /**
     * Delete all selected MemberPartner at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('member_partner_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = MemberPartner::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore MemberPartner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('member_partner_delete')) {
            return abort(401);
        }
        $member_partner = MemberPartner::onlyTrashed()->findOrFail($id);
        $member_partner->restore();

        return redirect()->route('admin.member_partners.index');
    }

    /**
     * Permanently delete MemberPartner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('member_partner_delete')) {
            return abort(401);
        }
        $member_partner = MemberPartner::onlyTrashed()->findOrFail($id);
        $member_partner->forceDelete();

        return redirect()->route('admin.member_partners.index');
    }
}
