<?php

namespace App\Http\Controllers\Admin;

use App\DocumentFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDocumentFavoritesRequest;
use App\Http\Requests\Admin\UpdateDocumentFavoritesRequest;

class DocumentFavoritesController extends Controller
{
    /**
     * Display a listing of DocumentFavorite.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('document_favorite_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('document_favorite_delete')) {
                return abort(401);
            }
            $document_favorites = DocumentFavorite::onlyTrashed()->get();
        } else {
            $document_favorites = DocumentFavorite::all();
        }

        return view('admin.document_favorites.index', compact('document_favorites'));
    }

    /**
     * Show the form for creating new DocumentFavorite.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('document_favorite_create')) {
            return abort(401);
        }
        
        $documents = \App\Document::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.document_favorites.create', compact('documents', 'projects'));
    }

    /**
     * Store a newly created DocumentFavorite in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentFavoritesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentFavoritesRequest $request)
    {
        if (! Gate::allows('document_favorite_create')) {
            return abort(401);
        }
        $document_favorite = DocumentFavorite::create($request->all());



        return redirect()->route('admin.document_favorites.index');
    }


    /**
     * Show the form for editing DocumentFavorite.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('document_favorite_edit')) {
            return abort(401);
        }
        
        $documents = \App\Document::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $document_favorite = DocumentFavorite::findOrFail($id);

        return view('admin.document_favorites.edit', compact('document_favorite', 'documents', 'projects'));
    }

    /**
     * Update DocumentFavorite in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentFavoritesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentFavoritesRequest $request, $id)
    {
        if (! Gate::allows('document_favorite_edit')) {
            return abort(401);
        }
        $document_favorite = DocumentFavorite::findOrFail($id);
        $document_favorite->update($request->all());



        return redirect()->route('admin.document_favorites.index');
    }


    /**
     * Display DocumentFavorite.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('document_favorite_view')) {
            return abort(401);
        }
        $document_favorite = DocumentFavorite::findOrFail($id);

        return view('admin.document_favorites.show', compact('document_favorite'));
    }


    /**
     * Remove DocumentFavorite from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('document_favorite_delete')) {
            return abort(401);
        }
        $document_favorite = DocumentFavorite::findOrFail($id);
        $document_favorite->delete();

        return redirect()->route('admin.document_favorites.index');
    }

    /**
     * Delete all selected DocumentFavorite at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('document_favorite_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DocumentFavorite::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DocumentFavorite from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('document_favorite_delete')) {
            return abort(401);
        }
        $document_favorite = DocumentFavorite::onlyTrashed()->findOrFail($id);
        $document_favorite->restore();

        return redirect()->route('admin.document_favorites.index');
    }

    /**
     * Permanently delete DocumentFavorite from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('document_favorite_delete')) {
            return abort(401);
        }
        $document_favorite = DocumentFavorite::onlyTrashed()->findOrFail($id);
        $document_favorite->forceDelete();

        return redirect()->route('admin.document_favorites.index');
    }
}
