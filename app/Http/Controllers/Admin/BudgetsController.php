<?php

namespace App\Http\Controllers\Admin;

use App\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBudgetsRequest;
use App\Http\Requests\Admin\UpdateBudgetsRequest;
use Yajra\DataTables\DataTables;

class BudgetsController extends Controller
{
    /**
     * Display a listing of Budget.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('budget_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Budget::query();
            $query->with("partner");
            $query->with("project");
            $template = 'actionsTemplate';
            
            $query->select([
                'budgets.id',
                'budgets.partner_id',
                'budgets.value',
                'budgets.period',
                'budgets.project_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'budget_';
                $routeKey = 'admin.budgets';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('partner.name', function ($row) {
                return $row->partner ? $row->partner->name : '';
            });
            $table->editColumn('project.name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.budgets.index');
    }

    /**
     * Show the form for creating new Budget.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('budget_create')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.budgets.create', compact('partners', 'projects'));
    }

    /**
     * Store a newly created Budget in storage.
     *
     * @param  \App\Http\Requests\StoreBudgetsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBudgetsRequest $request)
    {
        if (! Gate::allows('budget_create')) {
            return abort(401);
        }
        $budget = Budget::create($request->all());



        return redirect()->route('admin.budgets.index');
    }


    /**
     * Show the form for editing Budget.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('budget_edit')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $budget = Budget::findOrFail($id);

        return view('admin.budgets.edit', compact('budget', 'partners', 'projects'));
    }

    /**
     * Update Budget in storage.
     *
     * @param  \App\Http\Requests\UpdateBudgetsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBudgetsRequest $request, $id)
    {
        if (! Gate::allows('budget_edit')) {
            return abort(401);
        }
        $budget = Budget::findOrFail($id);
        $budget->update($request->all());



        return redirect()->route('admin.budgets.index');
    }


    /**
     * Display Budget.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('budget_view')) {
            return abort(401);
        }
        $budget = Budget::findOrFail($id);

        return view('admin.budgets.show', compact('budget'));
    }


    /**
     * Remove Budget from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('budget_delete')) {
            return abort(401);
        }
        $budget = Budget::findOrFail($id);
        $budget->delete();

        return redirect()->route('admin.budgets.index');
    }

    /**
     * Delete all selected Budget at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('budget_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Budget::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
