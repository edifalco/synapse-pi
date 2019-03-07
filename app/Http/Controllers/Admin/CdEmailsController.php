<?php

namespace App\Http\Controllers\Admin;

use App\CdEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCdEmailsRequest;
use App\Http\Requests\Admin\UpdateCdEmailsRequest;

class CdEmailsController extends Controller
{
    /**
     * Display a listing of CdEmail.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('cd_email_access')) {
            return abort(401);
        }


                $cd_emails = CdEmail::all();

        return view('admin.cd_emails.index', compact('cd_emails'));
    }

    /**
     * Show the form for creating new CdEmail.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('cd_email_create')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.cd_emails.create', compact('projects'));
    }

    /**
     * Store a newly created CdEmail in storage.
     *
     * @param  \App\Http\Requests\StoreCdEmailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCdEmailsRequest $request)
    {
        if (! Gate::allows('cd_email_create')) {
            return abort(401);
        }
        $cd_email = CdEmail::create($request->all());



        return redirect()->route('admin.cd_emails.index');
    }


    /**
     * Show the form for editing CdEmail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('cd_email_edit')) {
            return abort(401);
        }
        
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $cd_email = CdEmail::findOrFail($id);

        return view('admin.cd_emails.edit', compact('cd_email', 'projects'));
    }

    /**
     * Update CdEmail in storage.
     *
     * @param  \App\Http\Requests\UpdateCdEmailsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCdEmailsRequest $request, $id)
    {
        if (! Gate::allows('cd_email_edit')) {
            return abort(401);
        }
        $cd_email = CdEmail::findOrFail($id);
        $cd_email->update($request->all());



        return redirect()->route('admin.cd_emails.index');
    }


    /**
     * Display CdEmail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('cd_email_view')) {
            return abort(401);
        }
        $cd_email = CdEmail::findOrFail($id);

        return view('admin.cd_emails.show', compact('cd_email'));
    }


    /**
     * Remove CdEmail from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('cd_email_delete')) {
            return abort(401);
        }
        $cd_email = CdEmail::findOrFail($id);
        $cd_email->delete();

        return redirect()->route('admin.cd_emails.index');
    }

    /**
     * Delete all selected CdEmail at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('cd_email_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CdEmail::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
