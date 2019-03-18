<?php

namespace App\Http\Controllers\Admin;

use App\DocumentFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDocumentFoldersRequest;
use App\Http\Requests\Admin\UpdateDocumentFoldersRequest;
use Yajra\DataTables\DataTables;

class DocumentFoldersController extends Controller
{
    /**
     * Display a listing of DocumentFolder.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('document_folder_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = DocumentFolder::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('document_folder_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'document_folders.id',
                'document_folders.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'document_folder_';
                $routeKey = 'admin.document_folders';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.document_folders.index');
    }

    /**
     * Show the form for creating new DocumentFolder.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('document_folder_create')) {
            return abort(401);
        }
        return view('admin.document_folders.create');
    }

    /**
     * Store a newly created DocumentFolder in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentFoldersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentFoldersRequest $request)
    {
        if (! Gate::allows('document_folder_create')) {
            return abort(401);
        }
        $document_folder = DocumentFolder::create($request->all());



        return redirect()->route('admin.document_folders.index');
    }


    /**
     * Show the form for editing DocumentFolder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('document_folder_edit')) {
            return abort(401);
        }
        $document_folder = DocumentFolder::findOrFail($id);

        return view('admin.document_folders.edit', compact('document_folder'));
    }

    /**
     * Update DocumentFolder in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentFoldersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentFoldersRequest $request, $id)
    {
        if (! Gate::allows('document_folder_edit')) {
            return abort(401);
        }
        $document_folder = DocumentFolder::findOrFail($id);
        $document_folder->update($request->all());



        return redirect()->route('admin.document_folders.index');
    }


    /**
     * Display DocumentFolder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('document_folder_view')) {
            return abort(401);
        }
        $documents = \App\Document::where('folder_id', $id)->get();

        $document_folder = DocumentFolder::findOrFail($id);

        return view('admin.document_folders.show', compact('document_folder', 'documents'));
    }


    /**
     * Remove DocumentFolder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('document_folder_delete')) {
            return abort(401);
        }
        $document_folder = DocumentFolder::findOrFail($id);
        $document_folder->delete();

        return redirect()->route('admin.document_folders.index');
    }

    /**
     * Delete all selected DocumentFolder at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('document_folder_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DocumentFolder::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DocumentFolder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('document_folder_delete')) {
            return abort(401);
        }
        $document_folder = DocumentFolder::onlyTrashed()->findOrFail($id);
        $document_folder->restore();

        return redirect()->route('admin.document_folders.index');
    }

    /**
     * Permanently delete DocumentFolder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('document_folder_delete')) {
            return abort(401);
        }
        $document_folder = DocumentFolder::onlyTrashed()->findOrFail($id);
        $document_folder->forceDelete();

        return redirect()->route('admin.document_folders.index');
    }
}
