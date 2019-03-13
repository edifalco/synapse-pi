<?php

namespace App\Http\Controllers\Admin;

use App\DeliverableStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeliverableStatusesRequest;
use App\Http\Requests\Admin\UpdateDeliverableStatusesRequest;
use Yajra\DataTables\DataTables;

class DeliverableStatusesController extends Controller
{
    /**
     * Display a listing of DeliverableStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('deliverable_status_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = DeliverableStatus::query();
            $template = 'actionsTemplate';
            
            $query->select([
                'deliverable_statuses.id',
                'deliverable_statuses.label',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'deliverable_status_';
                $routeKey = 'admin.deliverable_statuses';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.deliverable_statuses.index');
    }

    /**
     * Show the form for creating new DeliverableStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('deliverable_status_create')) {
            return abort(401);
        }
        return view('admin.deliverable_statuses.create');
    }

    /**
     * Store a newly created DeliverableStatus in storage.
     *
     * @param  \App\Http\Requests\StoreDeliverableStatusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliverableStatusesRequest $request)
    {
        if (! Gate::allows('deliverable_status_create')) {
            return abort(401);
        }
        $deliverable_status = DeliverableStatus::create($request->all());



        return redirect()->route('admin.deliverable_statuses.index');
    }


    /**
     * Show the form for editing DeliverableStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('deliverable_status_edit')) {
            return abort(401);
        }
        $deliverable_status = DeliverableStatus::findOrFail($id);

        return view('admin.deliverable_statuses.edit', compact('deliverable_status'));
    }

    /**
     * Update DeliverableStatus in storage.
     *
     * @param  \App\Http\Requests\UpdateDeliverableStatusesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliverableStatusesRequest $request, $id)
    {
        if (! Gate::allows('deliverable_status_edit')) {
            return abort(401);
        }
        $deliverable_status = DeliverableStatus::findOrFail($id);
        $deliverable_status->update($request->all());



        return redirect()->route('admin.deliverable_statuses.index');
    }


    /**
     * Display DeliverableStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('deliverable_status_view')) {
            return abort(401);
        }
        $deliverables = \App\Deliverable::where('status_id', $id)->get();

        $deliverable_status = DeliverableStatus::findOrFail($id);

        return view('admin.deliverable_statuses.show', compact('deliverable_status', 'deliverables'));
    }


    /**
     * Remove DeliverableStatus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('deliverable_status_delete')) {
            return abort(401);
        }
        $deliverable_status = DeliverableStatus::findOrFail($id);
        $deliverable_status->delete();

        return redirect()->route('admin.deliverable_statuses.index');
    }

    /**
     * Delete all selected DeliverableStatus at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('deliverable_status_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DeliverableStatus::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
