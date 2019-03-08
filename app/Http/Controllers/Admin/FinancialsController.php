<?php

namespace App\Http\Controllers\Admin;

use App\Financial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFinancialsRequest;
use App\Http\Requests\Admin\UpdateFinancialsRequest;
use Yajra\DataTables\DataTables;

class FinancialsController extends Controller
{
    /**
     * Display a listing of Financial.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('financial_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Financial::query();
            $query->with("project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('financial_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'financials.id',
                'financials.document',
                'financials.project_id',
                'financials.title',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'financial_';
                $routeKey = 'admin.financials';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.financials.index');
    }

    /**
     * Show the form for creating new Financial.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('financial_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.financials.create', compact('projects'));
    }

    /**
     * Store a newly created Financial in storage.
     *
     * @param  \App\Http\Requests\StoreFinancialsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFinancialsRequest $request)
    {
        if (! Gate::allows('financial_create')) {
            return abort(401);
        }
        $financial = Financial::create($request->all());



        return redirect()->route('admin.financials.index');
    }


    /**
     * Show the form for editing Financial.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('financial_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $financial = Financial::findOrFail($id);

        return view('admin.financials.edit', compact('financial', 'projects'));
    }

    /**
     * Update Financial in storage.
     *
     * @param  \App\Http\Requests\UpdateFinancialsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFinancialsRequest $request, $id)
    {
        if (! Gate::allows('financial_edit')) {
            return abort(401);
        }
        $financial = Financial::findOrFail($id);
        $financial->update($request->all());



        return redirect()->route('admin.financials.index');
    }


    /**
     * Display Financial.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('financial_view')) {
            return abort(401);
        }
        $financial = Financial::findOrFail($id);

        return view('admin.financials.show', compact('financial'));
    }


    /**
     * Remove Financial from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('financial_delete')) {
            return abort(401);
        }
        $financial = Financial::findOrFail($id);
        $financial->delete();

        return redirect()->route('admin.financials.index');
    }

    /**
     * Delete all selected Financial at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('financial_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Financial::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Financial from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('financial_delete')) {
            return abort(401);
        }
        $financial = Financial::onlyTrashed()->findOrFail($id);
        $financial->restore();

        return redirect()->route('admin.financials.index');
    }

    /**
     * Permanently delete Financial from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('financial_delete')) {
            return abort(401);
        }
        $financial = Financial::onlyTrashed()->findOrFail($id);
        $financial->forceDelete();

        return redirect()->route('admin.financials.index');
    }
}
