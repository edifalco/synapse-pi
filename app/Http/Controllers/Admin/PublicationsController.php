<?php

namespace App\Http\Controllers\Admin;

use App\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePublicationsRequest;
use App\Http\Requests\Admin\UpdatePublicationsRequest;
use Yajra\DataTables\DataTables;

class PublicationsController extends Controller
{
    /**
     * Display a listing of Publication.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('publication_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Publication::query();
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('publication_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'publications.id',
                'publications.title',
                'publications.year',
                'publications.month',
                'publications.abbr',
                'publications.link',
                'publications.project_id',
                'publications.authors',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'publication_';
                $routeKey = 'admin.publications';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.publications.index');
    }

    /**
     * Show the form for creating new Publication.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('publication_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.publications.create', compact('projects'));
    }

    /**
     * Store a newly created Publication in storage.
     *
     * @param  \App\Http\Requests\StorePublicationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePublicationsRequest $request)
    {
        if (! Gate::allows('publication_create')) {
            return abort(401);
        }
        $publication = Publication::create($request->all());



        return redirect()->route('admin.publications.index');
    }


    /**
     * Show the form for editing Publication.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('publication_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $publication = Publication::findOrFail($id);

        return view('admin.publications.edit', compact('publication', 'projects'));
    }

    /**
     * Update Publication in storage.
     *
     * @param  \App\Http\Requests\UpdatePublicationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePublicationsRequest $request, $id)
    {
        if (! Gate::allows('publication_edit')) {
            return abort(401);
        }
        $publication = Publication::findOrFail($id);
        $publication->update($request->all());



        return redirect()->route('admin.publications.index');
    }


    /**
     * Display Publication.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('publication_view')) {
            return abort(401);
        }
        $publication = Publication::findOrFail($id);

        return view('admin.publications.show', compact('publication'));
    }


    /**
     * Remove Publication from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('publication_delete')) {
            return abort(401);
        }
        $publication = Publication::findOrFail($id);
        $publication->delete();

        return redirect()->route('admin.publications.index');
    }

    /**
     * Delete all selected Publication at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('publication_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Publication::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Publication from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('publication_delete')) {
            return abort(401);
        }
        $publication = Publication::onlyTrashed()->findOrFail($id);
        $publication->restore();

        return redirect()->route('admin.publications.index');
    }

    /**
     * Permanently delete Publication from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('publication_delete')) {
            return abort(401);
        }
        $publication = Publication::onlyTrashed()->findOrFail($id);
        $publication->forceDelete();

        return redirect()->route('admin.publications.index');
    }
}
