@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.members.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.members.fields.name')</th>
                            <td field-key='name'>{{ $member->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.members.fields.surname')</th>
                            <td field-key='surname'>{{ $member->surname }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.members.fields.partner')</th>
                            <td field-key='partner'>{{ $member->partner->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.members.fields.email')</th>
                            <td field-key='email'>{{ $member->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.members.fields.phone')</th>
                            <td field-key='phone'>{{ $member->phone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.members.fields.notes')</th>
                            <td field-key='notes'>{!! $member->notes !!}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#member_partners" aria-controls="member_partners" role="tab" data-toggle="tab">Member partners</a></li>
<li role="presentation" class=""><a href="#team" aria-controls="team" role="tab" data-toggle="tab">Team</a></li>
<li role="presentation" class=""><a href="#risk_mreporters" aria-controls="risk_mreporters" role="tab" data-toggle="tab">Risk mreporters</a></li>
<li role="presentation" class=""><a href="#project_members" aria-controls="project_members" role="tab" data-toggle="tab">Project members</a></li>
<li role="presentation" class=""><a href="#deliverable_reviewers" aria-controls="deliverable_reviewers" role="tab" data-toggle="tab">Deliverable reviewers</a></li>
<li role="presentation" class=""><a href="#deliverables" aria-controls="deliverables" role="tab" data-toggle="tab">Deliverables</a></li>
<li role="presentation" class=""><a href="#risks" aria-controls="risks" role="tab" data-toggle="tab">Risks</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="member_partners">
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
<div role="tabpanel" class="tab-pane " id="team">
<table class="table table-bordered table-striped {{ count($teams) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.team.fields.member')</th>
                        <th>@lang('global.team.fields.project')</th>
                        <th>@lang('global.team.fields.partner')</th>
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
                                <td field-key='project'>{{ $team->project->name ?? '' }}</td>
                                <td field-key='partner'>{{ $team->partner->name ?? '' }}</td>
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
<div role="tabpanel" class="tab-pane " id="risk_mreporters">
<table class="table table-bordered table-striped {{ count($risk_mreporters) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.risk-mreporters.fields.member')</th>
                        <th>@lang('global.risk-mreporters.fields.risk')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($risk_mreporters) > 0)
            @foreach ($risk_mreporters as $risk_mreporter)
                <tr data-entry-id="{{ $risk_mreporter->id }}">
                    <td field-key='member'>{{ $risk_mreporter->member->name ?? '' }}</td>
                                <td field-key='risk'>{{ $risk_mreporter->risk->code ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_mreporters.restore', $risk_mreporter->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_mreporters.perma_del', $risk_mreporter->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('risk_mreporter_view')
                                    <a href="{{ route('admin.risk_mreporters.show',[$risk_mreporter->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('risk_mreporter_edit')
                                    <a href="{{ route('admin.risk_mreporters.edit',[$risk_mreporter->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('risk_mreporter_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_mreporters.destroy', $risk_mreporter->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="deliverable_reviewers">
<table class="table table-bordered table-striped {{ count($deliverable_reviewers) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.deliverable-reviewers.fields.deliverable')</th>
                        <th>@lang('global.deliverable-reviewers.fields.member')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($deliverable_reviewers) > 0)
            @foreach ($deliverable_reviewers as $deliverable_reviewer)
                <tr data-entry-id="{{ $deliverable_reviewer->id }}">
                    <td field-key='deliverable'>{{ $deliverable_reviewer->deliverable->label_identification ?? '' }}</td>
                                <td field-key='member'>{{ $deliverable_reviewer->member->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_reviewers.restore', $deliverable_reviewer->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_reviewers.perma_del', $deliverable_reviewer->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('deliverable_reviewer_view')
                                    <a href="{{ route('admin.deliverable_reviewers.show',[$deliverable_reviewer->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('deliverable_reviewer_edit')
                                    <a href="{{ route('admin.deliverable_reviewers.edit',[$deliverable_reviewer->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('deliverable_reviewer_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_reviewers.destroy', $deliverable_reviewer->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="deliverables">
<table class="table table-bordered table-striped {{ count($deliverables) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.deliverables.fields.label-identification')</th>
                        <th>@lang('global.deliverables.fields.title')</th>
                        <th>@lang('global.deliverables.fields.short-title')</th>
                        <th>@lang('global.deliverables.fields.date')</th>
                        <th>@lang('global.deliverables.fields.status')</th>
                        <th>@lang('global.deliverables.fields.notes')</th>
                        <th>@lang('global.deliverables.fields.project')</th>
                        <th>@lang('global.deliverables.fields.confidentiality')</th>
                        <th>@lang('global.deliverables.fields.submission-date')</th>
                        <th>@lang('global.deliverables.fields.due-date-months')</th>
                        <th>@lang('global.deliverables.fields.responsible')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($deliverables) > 0)
            @foreach ($deliverables as $deliverable)
                <tr data-entry-id="{{ $deliverable->id }}">
                    <td field-key='label_identification'>{{ $deliverable->label_identification }}</td>
                                <td field-key='title'>{!! $deliverable->title !!}</td>
                                <td field-key='short_title'>{!! $deliverable->short_title !!}</td>
                                <td field-key='date'>{{ $deliverable->date }}</td>
                                <td field-key='status'>{{ $deliverable->status->label ?? '' }}</td>
                                <td field-key='notes'>{!! $deliverable->notes !!}</td>
                                <td field-key='project'>{{ $deliverable->project->name ?? '' }}</td>
                                <td field-key='confidentiality'>{{ $deliverable->confidentiality }}</td>
                                <td field-key='submission_date'>{{ $deliverable->submission_date }}</td>
                                <td field-key='due_date_months'>{{ $deliverable->due_date_months }}</td>
                                <td field-key='responsible'>
                                    @foreach ($deliverable->responsible as $singleResponsible)
                                        <span class="label label-info label-many">{{ $singleResponsible->surname }}</span>
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverables.restore', $deliverable->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverables.perma_del', $deliverable->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('deliverable_view')
                                    <a href="{{ route('admin.deliverables.show',[$deliverable->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('deliverable_edit')
                                    <a href="{{ route('admin.deliverables.edit',[$deliverable->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('deliverable_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverables.destroy', $deliverable->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="17">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="risks">
<table class="table table-bordered table-striped {{ count($risks) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.risks.fields.project')</th>
                        <th>@lang('global.risks.fields.code')</th>
                        <th>@lang('global.risks.fields.version')</th>
                        <th>@lang('global.risks.fields.flag')</th>
                        <th>@lang('global.risks.fields.resolved')</th>
                        <th>@lang('global.risks.fields.type')</th>
                        <th>@lang('global.risks.fields.date')</th>
                        <th>@lang('global.risks.fields.title')</th>
                        <th>@lang('global.risks.fields.score')</th>
                        <th>@lang('global.risks.fields.proximity')</th>
                        <th>@lang('global.risks.fields.owner')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($risks) > 0)
            @foreach ($risks as $risk)
                <tr data-entry-id="{{ $risk->id }}">
                    <td field-key='project'>{{ $risk->project->name ?? '' }}</td>
                                <td field-key='code'>{{ $risk->code }}</td>
                                <td field-key='version'>{{ $risk->version }}</td>
                                <td field-key='flag'>{{ Form::checkbox("flag", 1, $risk->flag == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='resolved'>{{ Form::checkbox("resolved", 1, $risk->resolved == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='type'>{{ $risk->type->name ?? '' }}</td>
                                <td field-key='date'>{{ $risk->date }}</td>
                                <td field-key='title'>{{ $risk->title }}</td>
                                <td field-key='score'>{{ $risk->score }}</td>
                                <td field-key='proximity'>{{ $risk->proximity->name ?? '' }}</td>
                                <td field-key='owner'>
                                    @foreach ($risk->owner as $singleOwner)
                                        <span class="label label-info label-many">{{ $singleOwner->surname }}</span>
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risks.restore', $risk->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risks.perma_del', $risk->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('risk_view')
                                    <a href="{{ route('admin.risks.show',[$risk->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('risk_edit')
                                    <a href="{{ route('admin.risks.edit',[$risk->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('risk_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risks.destroy', $risk->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="25">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.members.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


