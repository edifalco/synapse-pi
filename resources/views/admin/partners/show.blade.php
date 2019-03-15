@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.partners.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.partners.fields.name')</th>
                            <td field-key='name'>{!! $partner->name !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.partners.fields.acronym')</th>
                            <td field-key='acronym'>{{ $partner->acronym }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.partners.fields.image')</th>
                            <td field-key='image'>{{ $partner->image }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.partners.fields.country')</th>
                            <td field-key='country'>{{ $partner->country->title ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#budgets" aria-controls="budgets" role="tab" data-toggle="tab">Budgets</a></li>
<li role="presentation" class=""><a href="#partnerroles" aria-controls="partnerroles" role="tab" data-toggle="tab">Partnerroles</a></li>
<li role="presentation" class=""><a href="#risk_powners" aria-controls="risk_powners" role="tab" data-toggle="tab">Risk powners</a></li>
<li role="presentation" class=""><a href="#risk_preporters" aria-controls="risk_preporters" role="tab" data-toggle="tab">Risk preporters</a></li>
<li role="presentation" class=""><a href="#deliverable_partners" aria-controls="deliverable_partners" role="tab" data-toggle="tab">Deliverable partners</a></li>
<li role="presentation" class=""><a href="#acronyms" aria-controls="acronyms" role="tab" data-toggle="tab">Acronyms</a></li>
<li role="presentation" class=""><a href="#member_partners" aria-controls="member_partners" role="tab" data-toggle="tab">Member partners</a></li>
<li role="presentation" class=""><a href="#acronym_projects" aria-controls="acronym_projects" role="tab" data-toggle="tab">Acronym projects</a></li>
<li role="presentation" class=""><a href="#partnernums" aria-controls="partnernums" role="tab" data-toggle="tab">Partnernums</a></li>
<li role="presentation" class=""><a href="#team" aria-controls="team" role="tab" data-toggle="tab">Team</a></li>
<li role="presentation" class=""><a href="#project_members" aria-controls="project_members" role="tab" data-toggle="tab">Project members</a></li>
<li role="presentation" class=""><a href="#members" aria-controls="members" role="tab" data-toggle="tab">Members</a></li>
<li role="presentation" class=""><a href="#efforts" aria-controls="efforts" role="tab" data-toggle="tab">Efforts</a></li>
<li role="presentation" class=""><a href="#projects" aria-controls="projects" role="tab" data-toggle="tab">Projects</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="budgets">
<table class="table table-bordered table-striped {{ count($budgets) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.budgets.fields.partner')</th>
                        <th>@lang('global.budgets.fields.value')</th>
                        <th>@lang('global.budgets.fields.period')</th>
                        <th>@lang('global.budgets.fields.project')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($budgets) > 0)
            @foreach ($budgets as $budget)
                <tr data-entry-id="{{ $budget->id }}">
                    <td field-key='partner'>{{ $budget->partner->name ?? '' }}</td>
                                <td field-key='value'>{{ $budget->value }}</td>
                                <td field-key='period'>{{ $budget->period }}</td>
                                <td field-key='project'>{{ $budget->project->name ?? '' }}</td>
                                                                <td>
                                    @can('budget_view')
                                    <a href="{{ route('admin.budgets.show',[$budget->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('budget_edit')
                                    <a href="{{ route('admin.budgets.edit',[$budget->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('budget_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.budgets.destroy', $budget->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="partnerroles">
<table class="table table-bordered table-striped {{ count($partnerroles) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.partnerroles.fields.partner')</th>
                        <th>@lang('global.partnerroles.fields.role-id')</th>
                        <th>@lang('global.partnerroles.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($partnerroles) > 0)
            @foreach ($partnerroles as $partnerrole)
                <tr data-entry-id="{{ $partnerrole->id }}">
                    <td field-key='partner'>{{ $partnerrole->partner->name ?? '' }}</td>
                                <td field-key='role_id'>{{ $partnerrole->role_id }}</td>
                                <td field-key='project'>{{ $partnerrole->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.partnerroles.restore', $partnerrole->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.partnerroles.perma_del', $partnerrole->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('partnerrole_view')
                                    <a href="{{ route('admin.partnerroles.show',[$partnerrole->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('partnerrole_edit')
                                    <a href="{{ route('admin.partnerroles.edit',[$partnerrole->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('partnerrole_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.partnerroles.destroy', $partnerrole->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="risk_powners">
<table class="table table-bordered table-striped {{ count($risk_powners) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.risk-powners.fields.partner')</th>
                        <th>@lang('global.risk-powners.fields.risk')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($risk_powners) > 0)
            @foreach ($risk_powners as $risk_powner)
                <tr data-entry-id="{{ $risk_powner->id }}">
                    <td field-key='partner'>{{ $risk_powner->partner->name ?? '' }}</td>
                                <td field-key='risk'>{{ $risk_powner->risk->code ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_powners.restore', $risk_powner->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_powners.perma_del', $risk_powner->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('risk_powner_view')
                                    <a href="{{ route('admin.risk_powners.show',[$risk_powner->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('risk_powner_edit')
                                    <a href="{{ route('admin.risk_powners.edit',[$risk_powner->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('risk_powner_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_powners.destroy', $risk_powner->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="risk_preporters">
<table class="table table-bordered table-striped {{ count($risk_preporters) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.risk-preporters.fields.partner')</th>
                        <th>@lang('global.risk-preporters.fields.risk')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($risk_preporters) > 0)
            @foreach ($risk_preporters as $risk_preporter)
                <tr data-entry-id="{{ $risk_preporter->id }}">
                    <td field-key='partner'>{{ $risk_preporter->partner->name ?? '' }}</td>
                                <td field-key='risk'>{{ $risk_preporter->risk->code ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_preporters.restore', $risk_preporter->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_preporters.perma_del', $risk_preporter->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('risk_preporter_view')
                                    <a href="{{ route('admin.risk_preporters.show',[$risk_preporter->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('risk_preporter_edit')
                                    <a href="{{ route('admin.risk_preporters.edit',[$risk_preporter->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('risk_preporter_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_preporters.destroy', $risk_preporter->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="deliverable_partners">
<table class="table table-bordered table-striped {{ count($deliverable_partners) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.deliverable-partners.fields.partner')</th>
                        <th>@lang('global.deliverable-partners.fields.deliverable')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($deliverable_partners) > 0)
            @foreach ($deliverable_partners as $deliverable_partner)
                <tr data-entry-id="{{ $deliverable_partner->id }}">
                    <td field-key='partner'>{{ $deliverable_partner->partner->name ?? '' }}</td>
                                <td field-key='deliverable'>{{ $deliverable_partner->deliverable->label_identification ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_partners.restore', $deliverable_partner->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_partners.perma_del', $deliverable_partner->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('deliverable_partner_view')
                                    <a href="{{ route('admin.deliverable_partners.show',[$deliverable_partner->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('deliverable_partner_edit')
                                    <a href="{{ route('admin.deliverable_partners.edit',[$deliverable_partner->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('deliverable_partner_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_partners.destroy', $deliverable_partner->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="acronyms">
<table class="table table-bordered table-striped {{ count($acronyms) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.acronyms.fields.acronym')</th>
                        <th>@lang('global.acronyms.fields.partner')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($acronyms) > 0)
            @foreach ($acronyms as $acronym)
                <tr data-entry-id="{{ $acronym->id }}">
                    <td field-key='acronym'>{{ $acronym->acronym }}</td>
                                <td field-key='partner'>{{ $acronym->partner->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.acronyms.restore', $acronym->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.acronyms.perma_del', $acronym->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('acronym_view')
                                    <a href="{{ route('admin.acronyms.show',[$acronym->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('acronym_edit')
                                    <a href="{{ route('admin.acronyms.edit',[$acronym->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('acronym_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.acronyms.destroy', $acronym->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="member_partners">
<table class="table table-bordered table-striped {{ count($member_partners) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.member-partners.fields.member')</th>
                        <th>@lang('global.member-partners.fields.partner')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($member_partners) > 0)
            @foreach ($member_partners as $member_partner)
                <tr data-entry-id="{{ $member_partner->id }}">
                    <td field-key='member'>{{ $member_partner->member->name ?? '' }}</td>
                                <td field-key='partner'>{{ $member_partner->partner->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.member_partners.restore', $member_partner->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.member_partners.perma_del', $member_partner->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('member_partner_view')
                                    <a href="{{ route('admin.member_partners.show',[$member_partner->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('member_partner_edit')
                                    <a href="{{ route('admin.member_partners.edit',[$member_partner->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('member_partner_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.member_partners.destroy', $member_partner->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="acronym_projects">
<table class="table table-bordered table-striped {{ count($acronym_projects) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.acronym-projects.fields.acronyms')</th>
                        <th>@lang('global.acronym-projects.fields.partner')</th>
                        <th>@lang('global.acronym-projects.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($acronym_projects) > 0)
            @foreach ($acronym_projects as $acronym_project)
                <tr data-entry-id="{{ $acronym_project->id }}">
                    <td field-key='acronyms'>{{ $acronym_project->acronyms->acronym ?? '' }}</td>
                                <td field-key='partner'>{{ $acronym_project->partner->name ?? '' }}</td>
                                <td field-key='project'>{{ $acronym_project->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.acronym_projects.restore', $acronym_project->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.acronym_projects.perma_del', $acronym_project->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('acronym_project_view')
                                    <a href="{{ route('admin.acronym_projects.show',[$acronym_project->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('acronym_project_edit')
                                    <a href="{{ route('admin.acronym_projects.edit',[$acronym_project->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('acronym_project_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.acronym_projects.destroy', $acronym_project->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="partnernums">
<table class="table table-bordered table-striped {{ count($partnernums) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.partnernums.fields.value')</th>
                        <th>@lang('global.partnernums.fields.partner')</th>
                        <th>@lang('global.partnernums.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($partnernums) > 0)
            @foreach ($partnernums as $partnernum)
                <tr data-entry-id="{{ $partnernum->id }}">
                    <td field-key='value'>{{ $partnernum->value }}</td>
                                <td field-key='partner'>{{ $partnernum->partner->name ?? '' }}</td>
                                <td field-key='project'>{{ $partnernum->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.partnernums.restore', $partnernum->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.partnernums.perma_del', $partnernum->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('partnernum_view')
                                    <a href="{{ route('admin.partnernums.show',[$partnernum->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('partnernum_edit')
                                    <a href="{{ route('admin.partnernums.edit',[$partnernum->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('partnernum_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.partnernums.destroy', $partnernum->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="team">
<table class="table table-bordered table-striped {{ count($teams) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.team.fields.member')</th>
                        <th>@lang('global.team.fields.partner')</th>
                        <th>@lang('global.team.fields.project')</th>
                        <th>@lang('global.team.fields.role')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($teams) > 0)
            @foreach ($teams as $team)
                <tr data-entry-id="{{ $team->id }}">
                    <td field-key='member'>{{ $team->member->surname ?? '' }}</td>
                                <td field-key='partner'>{{ $team->partner->name ?? '' }}</td>
                                <td field-key='project'>{{ $team->project->name ?? '' }}</td>
                                <td field-key='role'>{{ $team->role }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.teams.restore', $team->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.teams.perma_del', $team->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('team_view')
                                    <a href="{{ route('admin.teams.show',[$team->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('team_edit')
                                    <a href="{{ route('admin.teams.edit',[$team->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('team_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.teams.destroy', $team->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="project_members">
<table class="table table-bordered table-striped {{ count($project_members) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.project-members.fields.project')</th>
                        <th>@lang('global.project-members.fields.member')</th>
                        <th>@lang('global.project-members.fields.partner')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($project_members) > 0)
            @foreach ($project_members as $project_member)
                <tr data-entry-id="{{ $project_member->id }}">
                    <td field-key='project'>{{ $project_member->project->name ?? '' }}</td>
                                <td field-key='member'>{{ $project_member->member->name ?? '' }}</td>
                                <td field-key='partner'>{{ $project_member->partner->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.project_members.restore', $project_member->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.project_members.perma_del', $project_member->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('project_member_view')
                                    <a href="{{ route('admin.project_members.show',[$project_member->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('project_member_edit')
                                    <a href="{{ route('admin.project_members.edit',[$project_member->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('project_member_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.project_members.destroy', $project_member->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="members">
<table class="table table-bordered table-striped {{ count($members) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.members.fields.name')</th>
                        <th>@lang('global.members.fields.surname')</th>
                        <th>@lang('global.members.fields.partner')</th>
                        <th>@lang('global.members.fields.email')</th>
                        <th>@lang('global.members.fields.phone')</th>
                        <th>@lang('global.members.fields.notes')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($members) > 0)
            @foreach ($members as $member)
                <tr data-entry-id="{{ $member->id }}">
                    <td field-key='name'>{{ $member->name }}</td>
                                <td field-key='surname'>{{ $member->surname }}</td>
                                <td field-key='partner'>{{ $member->partner->name ?? '' }}</td>
                                <td field-key='email'>{{ $member->email }}</td>
                                <td field-key='phone'>{{ $member->phone }}</td>
                                <td field-key='notes'>{!! $member->notes !!}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.members.restore', $member->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.members.perma_del', $member->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('member_view')
                                    <a href="{{ route('admin.members.show',[$member->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('member_edit')
                                    <a href="{{ route('admin.members.edit',[$member->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('member_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.members.destroy', $member->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="efforts">
<table class="table table-bordered table-striped {{ count($efforts) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.efforts.fields.project')</th>
                        <th>@lang('global.efforts.fields.workpackage')</th>
                        <th>@lang('global.efforts.fields.partner')</th>
                        <th>@lang('global.efforts.fields.value')</th>
                        <th>@lang('global.efforts.fields.period')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($efforts) > 0)
            @foreach ($efforts as $effort)
                <tr data-entry-id="{{ $effort->id }}">
                    <td field-key='project'>{{ $effort->project->name ?? '' }}</td>
                                <td field-key='workpackage'>{{ $effort->workpackage->wp_id ?? '' }}</td>
                                <td field-key='partner'>{{ $effort->partner->name ?? '' }}</td>
                                <td field-key='value'>{{ $effort->value }}</td>
                                <td field-key='period'>{{ $effort->period }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.efforts.restore', $effort->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.efforts.perma_del', $effort->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('effort_view')
                                    <a href="{{ route('admin.efforts.show',[$effort->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('effort_edit')
                                    <a href="{{ route('admin.efforts.edit',[$effort->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('effort_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.efforts.destroy', $effort->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="projects">
<table class="table table-bordered table-striped {{ count($projects) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.projects.fields.name')</th>
                        <th>@lang('global.projects.fields.description')</th>
                        <th>@lang('global.projects.fields.date')</th>
                        <th>@lang('global.projects.fields.duration')</th>
                        <th>@lang('global.projects.fields.image')</th>
                        <th>@lang('global.projects.fields.partners')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($projects) > 0)
            @foreach ($projects as $project)
                <tr data-entry-id="{{ $project->id }}">
                    <td field-key='name'>{!! $project->name !!}</td>
                                <td field-key='description'>{!! $project->description !!}</td>
                                <td field-key='date'>{{ $project->date }}</td>
                                <td field-key='duration'>{{ $project->duration }}</td>
                                <td field-key='image'>{{ $project->image }}</td>
                                <td field-key='partners'>
                                    @foreach ($project->partners as $singlePartners)
                                        <span class="label label-info label-many">{{ $singlePartners->name }}</span>
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.projects.restore', $project->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.projects.perma_del', $project->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('project_view')
                                    <a href="{{ route('admin.projects.show',[$project->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('project_edit')
                                    <a href="{{ route('admin.projects.edit',[$project->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('project_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.projects.destroy', $project->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.partners.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


