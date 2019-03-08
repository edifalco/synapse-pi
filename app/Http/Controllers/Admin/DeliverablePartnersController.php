<?php

namespace App\Http\Controllers\Admin;

use App\DeliverablePartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeliverablePartnersRequest;
use App\Http\Requests\Admin\UpdateDeliverablePartnersRequest;
use Yajra\DataTables\DataTables;

class DeliverablePartnersController extends Controller
{
    /**
     * Display a listing of DeliverablePartner.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('deliverable_partner_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = DeliverablePartner::query();
            $query->with("partner");
            $query->with("deliverable");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('deliverable_partner_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'deliverable_partners.id',
                'deliverable_partners.partner_id',
                'deliverable_partners.deliverable_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'deliverable_partner_';
                $routeKey = 'admin.deliverable_partners';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('partner.name', function ($row) {
                return $row->partner ? $row->partner->name : '';
            });
            $table->editColumn('deliverable.label_identification', function ($row) {
                return $row->deliverable ? $row->deliverable->label_identification : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.deliverable_partners.index');
    }

    /**
     * Show the form for creating new DeliverablePartner.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('deliverable_partner_create')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $deliverables = \App\Deliverable::get()->pluck('label_identification', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.deliverable_partners.create', compact('partners', 'deliverables'));
    }

    /**
     * Store a newly created DeliverablePartner in storage.
     *
     * @param  \App\Http\Requests\StoreDeliverablePartnersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliverablePartnersRequest $request)
    {
        if (! Gate::allows('deliverable_partner_create')) {
            return abort(401);
        }
        $deliverable_partner = DeliverablePartner::create($request->all());



        return redirect()->route('admin.deliverable_partners.index');
    }


    /**
     * Show the form for editing DeliverablePartner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('deliverable_partner_edit')) {
            return abort(401);
        }
        
        $partners = \App\Partner::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $deliverables = \App\Deliverable::get()->pluck('label_identification', 'id')->prepend(trans('global.app_please_select'), '');

        $deliverable_partner = DeliverablePartner::findOrFail($id);

        return view('admin.deliverable_partners.edit', compact('deliverable_partner', 'partners', 'deliverables'));
    }

    /**
     * Update DeliverablePartner in storage.
     *
     * @param  \App\Http\Requests\UpdateDeliverablePartnersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliverablePartnersRequest $request, $id)
    {
        if (! Gate::allows('deliverable_partner_edit')) {
            return abort(401);
        }
        $deliverable_partner = DeliverablePartner::findOrFail($id);
        $deliverable_partner->update($request->all());



        return redirect()->route('admin.deliverable_partners.index');
    }


    /**
     * Display DeliverablePartner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('deliverable_partner_view')) {
            return abort(401);
        }
        $deliverable_partner = DeliverablePartner::findOrFail($id);

        return view('admin.deliverable_partners.show', compact('deliverable_partner'));
    }


    /**
     * Remove DeliverablePartner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('deliverable_partner_delete')) {
            return abort(401);
        }
        $deliverable_partner = DeliverablePartner::findOrFail($id);
        $deliverable_partner->delete();

        return redirect()->route('admin.deliverable_partners.index');
    }

    /**
     * Delete all selected DeliverablePartner at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('deliverable_partner_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DeliverablePartner::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DeliverablePartner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('deliverable_partner_delete')) {
            return abort(401);
        }
        $deliverable_partner = DeliverablePartner::onlyTrashed()->findOrFail($id);
        $deliverable_partner->restore();

        return redirect()->route('admin.deliverable_partners.index');
    }

    /**
     * Permanently delete DeliverablePartner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('deliverable_partner_delete')) {
            return abort(401);
        }
        $deliverable_partner = DeliverablePartner::onlyTrashed()->findOrFail($id);
        $deliverable_partner->forceDelete();

        return redirect()->route('admin.deliverable_partners.index');
    }
}
