<?php

namespace App\Http\Controllers\Admin;

use App\DeliverableReviewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeliverableReviewersRequest;
use App\Http\Requests\Admin\UpdateDeliverableReviewersRequest;

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


        if (request('show_deleted') == 1) {
            if (! Gate::allows('deliverable_reviewer_delete')) {
                return abort(401);
            }
            $deliverable_reviewers = DeliverableReviewer::onlyTrashed()->get();
        } else {
            $deliverable_reviewers = DeliverableReviewer::all();
        }

        return view('admin.deliverable_reviewers.index', compact('deliverable_reviewers'));
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
