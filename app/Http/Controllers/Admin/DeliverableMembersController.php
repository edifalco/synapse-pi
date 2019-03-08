<?php

namespace App\Http\Controllers\Admin;

use App\DeliverableMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeliverableMembersRequest;
use App\Http\Requests\Admin\UpdateDeliverableMembersRequest;
use Yajra\DataTables\DataTables;

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


        
        if (request()->ajax()) {
            $query = DeliverableMember::query();
            $query->with("member");
            $query->with("deliverable");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('deliverable_member_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'deliverable_members.id',
                'deliverable_members.member_id',
                'deliverable_members.deliverable_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'deliverable_member_';
                $routeKey = 'admin.deliverable_members';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('member.name', function ($row) {
                return $row->member ? $row->member->name : '';
            });
            $table->editColumn('deliverable.label_identification', function ($row) {
                return $row->deliverable ? $row->deliverable->label_identification : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.deliverable_members.index');
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
