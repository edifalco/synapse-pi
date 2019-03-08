<?php

namespace App\Http\Controllers\Admin;

use App\Financialvisibility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFinancialvisibilitiesRequest;
use App\Http\Requests\Admin\UpdateFinancialvisibilitiesRequest;
use Yajra\DataTables\DataTables;

class FinancialvisibilitiesController extends Controller
{
    /**
     * Display a listing of Financialvisibility.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('financialvisibility_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Financialvisibility::query();
            $query->with("id_project");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('financialvisibility_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'financialvisibilities.id',
                'financialvisibilities.type',
                'financialvisibilities.status',
                'financialvisibilities.id_project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'financialvisibility_';
                $routeKey = 'admin.financialvisibilities';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('id_project.name', function ($row) {
                return $row->id_project ? $row->id_project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.financialvisibilities.index');
    }

    /**
     * Show the form for creating new Financialvisibility.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('financialvisibility_create')) {
            return abort(401);
        }
        
        $id_projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.financialvisibilities.create', compact('id_projects'));
    }

    /**
     * Store a newly created Financialvisibility in storage.
     *
     * @param  \App\Http\Requests\StoreFinancialvisibilitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFinancialvisibilitiesRequest $request)
    {
        if (! Gate::allows('financialvisibility_create')) {
            return abort(401);
        }
        $financialvisibility = Financialvisibility::create($request->all());



        return redirect()->route('admin.financialvisibilities.index');
    }


    /**
     * Show the form for editing Financialvisibility.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('financialvisibility_edit')) {
            return abort(401);
        }
        
        $id_projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $financialvisibility = Financialvisibility::findOrFail($id);

        return view('admin.financialvisibilities.edit', compact('financialvisibility', 'id_projects'));
    }

    /**
     * Update Financialvisibility in storage.
     *
     * @param  \App\Http\Requests\UpdateFinancialvisibilitiesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFinancialvisibilitiesRequest $request, $id)
    {
        if (! Gate::allows('financialvisibility_edit')) {
            return abort(401);
        }
        $financialvisibility = Financialvisibility::findOrFail($id);
        $financialvisibility->update($request->all());



        return redirect()->route('admin.financialvisibilities.index');
    }


    /**
     * Display Financialvisibility.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('financialvisibility_view')) {
            return abort(401);
        }
        $financialvisibility = Financialvisibility::findOrFail($id);

        return view('admin.financialvisibilities.show', compact('financialvisibility'));
    }


    /**
     * Remove Financialvisibility from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('financialvisibility_delete')) {
            return abort(401);
        }
        $financialvisibility = Financialvisibility::findOrFail($id);
        $financialvisibility->delete();

        return redirect()->route('admin.financialvisibilities.index');
    }

    /**
     * Delete all selected Financialvisibility at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('financialvisibility_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Financialvisibility::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Financialvisibility from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('financialvisibility_delete')) {
            return abort(401);
        }
        $financialvisibility = Financialvisibility::onlyTrashed()->findOrFail($id);
        $financialvisibility->restore();

        return redirect()->route('admin.financialvisibilities.index');
    }

    /**
     * Permanently delete Financialvisibility from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('financialvisibility_delete')) {
            return abort(401);
        }
        $financialvisibility = Financialvisibility::onlyTrashed()->findOrFail($id);
        $financialvisibility->forceDelete();

        return redirect()->route('admin.financialvisibilities.index');
    }
}
