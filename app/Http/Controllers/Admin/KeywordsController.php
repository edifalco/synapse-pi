<?php

namespace App\Http\Controllers\Admin;

use App\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreKeywordsRequest;
use App\Http\Requests\Admin\UpdateKeywordsRequest;
use Yajra\DataTables\DataTables;

class KeywordsController extends Controller
{
    /**
     * Display a listing of Keyword.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('keyword_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Keyword::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('keyword_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'keywords.id',
                'keywords.word',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'keyword_';
                $routeKey = 'admin.keywords';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.keywords.index');
    }

    /**
     * Show the form for creating new Keyword.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('keyword_create')) {
            return abort(401);
        }
        return view('admin.keywords.create');
    }

    /**
     * Store a newly created Keyword in storage.
     *
     * @param  \App\Http\Requests\StoreKeywordsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKeywordsRequest $request)
    {
        if (! Gate::allows('keyword_create')) {
            return abort(401);
        }
        $keyword = Keyword::create($request->all());



        return redirect()->route('admin.keywords.index');
    }


    /**
     * Show the form for editing Keyword.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('keyword_edit')) {
            return abort(401);
        }
        $keyword = Keyword::findOrFail($id);

        return view('admin.keywords.edit', compact('keyword'));
    }

    /**
     * Update Keyword in storage.
     *
     * @param  \App\Http\Requests\UpdateKeywordsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKeywordsRequest $request, $id)
    {
        if (! Gate::allows('keyword_edit')) {
            return abort(401);
        }
        $keyword = Keyword::findOrFail($id);
        $keyword->update($request->all());



        return redirect()->route('admin.keywords.index');
    }


    /**
     * Display Keyword.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('keyword_view')) {
            return abort(401);
        }
        $keyword = Keyword::findOrFail($id);

        return view('admin.keywords.show', compact('keyword'));
    }


    /**
     * Remove Keyword from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('keyword_delete')) {
            return abort(401);
        }
        $keyword = Keyword::findOrFail($id);
        $keyword->delete();

        return redirect()->route('admin.keywords.index');
    }

    /**
     * Delete all selected Keyword at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('keyword_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Keyword::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Keyword from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('keyword_delete')) {
            return abort(401);
        }
        $keyword = Keyword::onlyTrashed()->findOrFail($id);
        $keyword->restore();

        return redirect()->route('admin.keywords.index');
    }

    /**
     * Permanently delete Keyword from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('keyword_delete')) {
            return abort(401);
        }
        $keyword = Keyword::onlyTrashed()->findOrFail($id);
        $keyword->forceDelete();

        return redirect()->route('admin.keywords.index');
    }
}
