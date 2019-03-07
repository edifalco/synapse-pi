<?php

namespace App\Http\Controllers\Admin;

use App\DeliverableMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeliverableMembersRequest;
use App\Http\Requests\Admin\UpdateDeliverableMembersRequest;

class DeliverableMembersController extends Controller
{
    /**
     * Display a listing of DeliverableMember.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('deliverable_member_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('deliverable_member_delete')) {
                return abort(401);
            }
            $deliverable_members = DeliverableMember::onlyTrashed()->get();
        } else {
            $deliverable_members = DeliverableMember::all();
        }

        return view('admin.deliverable_members.index', compact('deliverable_members'));
    }

    /**
     * Show the form for creating new DeliverableMember.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('deliverable_member_create')) {
            return abort(401);
        }
        
        $members = \App\Member::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $deliverables = \App\Deliverable::get()->pluck('label_identification', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.deliverable_members.create', compact('members', 'deliverables'));
    }

    /**
     * Store a newly created DeliverableMember in storage.
     *
     * @param  \App\Http\Requests\StoreDeliverableMembersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliverableMembersRequest $request)
    {
        if (! Gate::allows('deliverable_member_create')) {
            return abort(401);
        }
        $deliverable_member = DeliverableMember::create($request->all());



        return redirect()->route('admin.deliverable_members.index');
    }


    /**
     * Show the form for editing DeliverableMember.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('deliverable_member_edit')) {
            return abort(401);
        }
        
        $members = \App\Member::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $deliverables = \App\Deliverable::get()->pluck('label_identification', 'id')->prepend(trans('global.app_please_select'), '');

        $deliverable_member = DeliverableMember::findOrFail($id);

        return view('admin.deliverable_members.edit', compact('deliverable_member', 'members', 'deliverables'));
    }

    /**
     * Update DeliverableMember in storage.
     *
     * @param  \App\Http\Requests\UpdateDeliverableMembersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliverableMembersRequest $request, $id)
    {
        if (! Gate::allows('deliverable_member_edit')) {
            return abort(401);
        }
        $deliverable_member = DeliverableMember::findOrFail($id);
        $deliverable_member->update($request->all());



        return redirect()->route('admin.deliverable_members.index');
    }


    /**
     * Display DeliverableMember.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('deliverable_member_view')) {
            return abort(401);
        }
        $deliverable_member = DeliverableMember::findOrFail($id);

        return view('admin.deliverable_members.show', compact('deliverable_member'));
    }


    /**
     * Remove DeliverableMember from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('deliverable_member_delete')) {
            return abort(401);
        }
        $deliverable_member = DeliverableMember::findOrFail($id);
        $deliverable_member->delete();

        return redirect()->route('admin.deliverable_members.index');
    }

    /**
     * Delete all selected DeliverableMember at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('deliverable_member_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DeliverableMember::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DeliverableMember from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('deliverable_member_delete')) {
            return abort(401);
        }
        $deliverable_member = DeliverableMember::onlyTrashed()->findOrFail($id);
        $deliverable_member->restore();

        return redirect()->route('admin.deliverable_members.index');
    }

    /**
     * Permanently delete DeliverableMember from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('deliverable_member_delete')) {
            return abort(401);
        }
        $deliverable_member = DeliverableMember::onlyTrashed()->findOrFail($id);
        $deliverable_member->forceDelete();

        return redirect()->route('admin.deliverable_members.index');
    }
}
