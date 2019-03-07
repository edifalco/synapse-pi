<?php

namespace App\Http\Controllers\Admin;

use App\DeliverableDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeliverableDocumentsRequest;
use App\Http\Requests\Admin\UpdateDeliverableDocumentsRequest;

class DeliverableDocumentsController extends Controller
{
    /**
     * Display a listing of DeliverableDocument.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('deliverable_document_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('deliverable_document_delete')) {
                return abort(401);
            }
            $deliverable_documents = DeliverableDocument::onlyTrashed()->get();
        } else {
            $deliverable_documents = DeliverableDocument::all();
        }

        return view('admin.deliverable_documents.index', compact('deliverable_documents'));
    }

    /**
     * Show the form for creating new DeliverableDocument.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('deliverable_document_create')) {
            return abort(401);
        }
        
        $deliverables = \App\Deliverable::get()->pluck('label_identification', 'id')->prepend(trans('global.app_please_select'), '');
        $documents = \App\Document::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.deliverable_documents.create', compact('deliverables', 'documents'));
    }

    /**
     * Store a newly created DeliverableDocument in storage.
     *
     * @param  \App\Http\Requests\StoreDeliverableDocumentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliverableDocumentsRequest $request)
    {
        if (! Gate::allows('deliverable_document_create')) {
            return abort(401);
        }
        $deliverable_document = DeliverableDocument::create($request->all());



        return redirect()->route('admin.deliverable_documents.index');
    }


    /**
     * Show the form for editing DeliverableDocument.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('deliverable_document_edit')) {
            return abort(401);
        }
        
        $deliverables = \App\Deliverable::get()->pluck('label_identification', 'id')->prepend(trans('global.app_please_select'), '');
        $documents = \App\Document::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $deliverable_document = DeliverableDocument::findOrFail($id);

        return view('admin.deliverable_documents.edit', compact('deliverable_document', 'deliverables', 'documents'));
    }

    /**
     * Update DeliverableDocument in storage.
     *
     * @param  \App\Http\Requests\UpdateDeliverableDocumentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliverableDocumentsRequest $request, $id)
    {
        if (! Gate::allows('deliverable_document_edit')) {
            return abort(401);
        }
        $deliverable_document = DeliverableDocument::findOrFail($id);
        $deliverable_document->update($request->all());



        return redirect()->route('admin.deliverable_documents.index');
    }


    /**
     * Display DeliverableDocument.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('deliverable_document_view')) {
            return abort(401);
        }
        $deliverable_document = DeliverableDocument::findOrFail($id);

        return view('admin.deliverable_documents.show', compact('deliverable_document'));
    }


    /**
     * Remove DeliverableDocument from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('deliverable_document_delete')) {
            return abort(401);
        }
        $deliverable_document = DeliverableDocument::findOrFail($id);
        $deliverable_document->delete();

        return redirect()->route('admin.deliverable_documents.index');
    }

    /**
     * Delete all selected DeliverableDocument at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('deliverable_document_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DeliverableDocument::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DeliverableDocument from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('deliverable_document_delete')) {
            return abort(401);
        }
        $deliverable_document = DeliverableDocument::onlyTrashed()->findOrFail($id);
        $deliverable_document->restore();

        return redirect()->route('admin.deliverable_documents.index');
    }

    /**
     * Permanently delete DeliverableDocument from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('deliverable_document_delete')) {
            return abort(401);
        }
        $deliverable_document = DeliverableDocument::onlyTrashed()->findOrFail($id);
        $deliverable_document->forceDelete();

        return redirect()->route('admin.deliverable_documents.index');
    }
}
