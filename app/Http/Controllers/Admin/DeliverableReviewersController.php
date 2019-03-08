<?php

namespace App\Http\Controllers\Admin;

use App\DeliverableReviewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeliverableReviewersRequest;
use App\Http\Requests\Admin\UpdateDeliverableReviewersRequest;
use Yajra\DataTables\DataTables;

class DeliverableReviewersController extends Controller
{
    /**
     * Display a listing of DeliverableReviewer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('deliverable_reviewer_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = DeliverableReviewer::query();
            $query->with("deliverable");
            $query->with("member");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('deliverable_reviewer_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'deliverable_reviewers.id',
                'deliverable_reviewers.deliverable_id',
                'deliverable_reviewers.member_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'deliverable_reviewer_';
                $routeKey = 'admin.deliverable_reviewers';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('deliverable.label_identification', function ($row) {
                return $row->deliverable ? $row->deliverable->label_identification : '';
            });
            $table->editColumn('member.name', function ($row) {
                return $row->member ? $row->member->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.deliverable_reviewers.index');
    }

    /**
     * Show the form for creating new DeliverableReviewer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('deliverable_reviewer_create')) {
            return abort(401);
        }
        
        $deliverables = \App\Deliverable::get()->pluck('label_identification', 'id')->prepend(trans('global.app_please_select'), '');
        $members = \App\Member::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.deliverable_reviewers.create', compact('deliverables', 'members'));
    }

    /**
     * Store a newly created DeliverableReviewer in storage.
     *
     * @param  \App\Http\Requests\StoreDeliverableReviewersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliverableReviewersRequest $request)
    {
        if (! Gate::allows('deliverable_reviewer_create')) {
            return abort(401);
        }
        $deliverable_reviewer = DeliverableReviewer::create($request->all());



        return redirect()->route('admin.deliverable_reviewers.index');
    }


    /**
     * Show the form for editing DeliverableReviewer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('deliverable_reviewer_edit')) {
            return abort(401);
        }
        
        $deliverables = \App\Deliverable::get()->pluck('label_identification', 'id')->prepend(trans('global.app_please_select'), '');
        $members = \App\Member::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $deliverable_reviewer = DeliverableReviewer::findOrFail($id);

        return view('admin.deliverable_reviewers.edit', compact('deliverable_reviewer', 'deliverables', 'members'));
    }

    /**
     * Update DeliverableReviewer in storage.
     *
     * @param  \App\Http\Requests\UpdateDeliverableReviewersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliverableReviewersRequest $request, $id)
    {
        if (! Gate::allows('deliverable_reviewer_edit')) {
            return abort(401);
        }
        $deliverable_reviewer = DeliverableReviewer::findOrFail($id);
        $deliverable_reviewer->update($request->all());



        return redirect()->route('admin.deliverable_reviewers.index');
    }


    /**
     * Display DeliverableReviewer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('deliverable_reviewer_view')) {
            return abort(401);
        }
        $deliverable_reviewer = DeliverableReviewer::findOrFail($id);

        return view('admin.deliverable_reviewers.show', compact('deliverable_reviewer'));
    }


    /**
     * Remove DeliverableReviewer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('deliverable_reviewer_delete')) {
            return abort(401);
        }
        $deliverable_reviewer = DeliverableReviewer::findOrFail($id);
        $deliverable_reviewer->delete();

        return redirect()->route('admin.deliverable_reviewers.index');
    }

    /**
     * Delete all selected DeliverableReviewer at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('deliverable_reviewer_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DeliverableReviewer::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DeliverableReviewer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('deliverable_reviewer_delete')) {
            return abort(401);
        }
        $deliverable_reviewer = DeliverableReviewer::onlyTrashed()->findOrFail($id);
        $deliverable_reviewer->restore();

        return redirect()->route('admin.deliverable_reviewers.index');
    }

    /**
     * Permanently delete DeliverableReviewer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('deliverable_reviewer_delete')) {
            return abort(401);
        }
        $deliverable_reviewer = DeliverableReviewer::onlyTrashed()->findOrFail($id);
        $deliverable_reviewer->forceDelete();

        return redirect()->route('admin.deliverable_reviewers.index');
    }
}
