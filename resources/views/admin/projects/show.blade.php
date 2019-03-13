@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.projects.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.projects.fields.name')</th>
                            <td field-key='name'>{!! $project->name !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.projects.fields.description')</th>
                            <td field-key='description'>{!! $project->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.projects.fields.date')</th>
                            <td field-key='date'>{{ $project->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.projects.fields.duration')</th>
                            <td field-key='duration'>{{ $project->duration }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.projects.fields.image')</th>
                            <td field-key='image'>{{ $project->image }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.projects.fields.partners')</th>
                            <td field-key='partners'>
                                @foreach ($project->partners as $singlePartners)
                                    <span class="label label-info label-many">{{ $singlePartners->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#project_members" aria-controls="project_members" role="tab" data-toggle="tab">Project members</a></li>
<li role="presentation" class=""><a href="#efforts" aria-controls="efforts" role="tab" data-toggle="tab">Efforts</a></li>
<li role="presentation" class=""><a href="#alternativescores" aria-controls="alternativescores" role="tab" data-toggle="tab">Alternativescores</a></li>
<li role="presentation" class=""><a href="#metriclabels" aria-controls="metriclabels" role="tab" data-toggle="tab">Metriclabels</a></li>
<li role="presentation" class=""><a href="#project_users" aria-controls="project_users" role="tab" data-toggle="tab">Project users</a></li>
<li role="presentation" class=""><a href="#risk_highlights" aria-controls="risk_highlights" role="tab" data-toggle="tab">Risk highlights</a></li>
<li role="presentation" class=""><a href="#scoredescriptions" aria-controls="scoredescriptions" role="tab" data-toggle="tab">Scoredescriptions</a></li>
<li role="presentation" class=""><a href="#threshold_deliverables" aria-controls="threshold_deliverables" role="tab" data-toggle="tab">Threshold deliverables</a></li>
<li role="presentation" class=""><a href="#threshold_risks" aria-controls="threshold_risks" role="tab" data-toggle="tab">Threshold risks</a></li>
<li role="presentation" class=""><a href="#document_favorites" aria-controls="document_favorites" role="tab" data-toggle="tab">Document favorites</a></li>
<li role="presentation" class=""><a href="#financials" aria-controls="financials" role="tab" data-toggle="tab">Financials</a></li>
<li role="presentation" class=""><a href="#financialvisibilities" aria-controls="financialvisibilities" role="tab" data-toggle="tab">Financialvisibilities</a></li>
<li role="presentation" class=""><a href="#memberroles" aria-controls="memberroles" role="tab" data-toggle="tab">Memberroles</a></li>
<li role="presentation" class=""><a href="#acronym_projects" aria-controls="acronym_projects" role="tab" data-toggle="tab">Acronym projects</a></li>
<li role="presentation" class=""><a href="#cd_disseminations" aria-controls="cd_disseminations" role="tab" data-toggle="tab">Cd disseminations</a></li>
<li role="presentation" class=""><a href="#metricicons" aria-controls="metricicons" role="tab" data-toggle="tab">Metricicons</a></li>
<li role="presentation" class=""><a href="#cd_emails" aria-controls="cd_emails" role="tab" data-toggle="tab">Cd emails</a></li>
<li role="presentation" class=""><a href="#cd_intranet_access" aria-controls="cd_intranet_access" role="tab" data-toggle="tab">Cd intranet access</a></li>
<li role="presentation" class=""><a href="#partnernums" aria-controls="partnernums" role="tab" data-toggle="tab">Partnernums</a></li>
<li role="presentation" class=""><a href="#cd_meetings" aria-controls="cd_meetings" role="tab" data-toggle="tab">Cd meetings</a></li>
<li role="presentation" class=""><a href="#partnerroles" aria-controls="partnerroles" role="tab" data-toggle="tab">Partnerroles</a></li>
<li role="presentation" class=""><a href="#cd_scores" aria-controls="cd_scores" role="tab" data-toggle="tab">Cd scores</a></li>
<li role="presentation" class=""><a href="#cd_scores2" aria-controls="cd_scores2" role="tab" data-toggle="tab">Cd scores2</a></li>
<li role="presentation" class=""><a href="#workpackages" aria-controls="workpackages" role="tab" data-toggle="tab">Workpackages</a></li>
<li role="presentation" class=""><a href="#project_periods" aria-controls="project_periods" role="tab" data-toggle="tab">Project Periods</a></li>
<li role="presentation" class=""><a href="#budgets" aria-controls="budgets" role="tab" data-toggle="tab">Budgets</a></li>
<li role="presentation" class=""><a href="#posts" aria-controls="posts" role="tab" data-toggle="tab">Posts</a></li>
<li role="presentation" class=""><a href="#schedules" aria-controls="schedules" role="tab" data-toggle="tab">Schedules</a></li>
<li role="presentation" class=""><a href="#documents" aria-controls="documents" role="tab" data-toggle="tab">Documents</a></li>
<li role="presentation" class=""><a href="#agenda" aria-controls="agenda" role="tab" data-toggle="tab">Agenda</a></li>
<li role="presentation" class=""><a href="#publications" aria-controls="publications" role="tab" data-toggle="tab">Publications</a></li>
<li role="presentation" class=""><a href="#risks" aria-controls="risks" role="tab" data-toggle="tab">Risks</a></li>
<li role="presentation" class=""><a href="#deliverables" aria-controls="deliverables" role="tab" data-toggle="tab">Deliverables</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="project_members">
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
<div role="tabpanel" class="tab-pane " id="alternativescores">
<table class="table table-bordered table-striped {{ count($alternativescores) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.alternativescores.fields.show')</th>
                        <th>@lang('global.alternativescores.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($alternativescores) > 0)
            @foreach ($alternativescores as $alternativescore)
                <tr data-entry-id="{{ $alternativescore->id }}">
                    <td field-key='show'>{{ $alternativescore->show }}</td>
                                <td field-key='project'>{{ $alternativescore->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.alternativescores.restore', $alternativescore->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.alternativescores.perma_del', $alternativescore->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('alternativescore_view')
                                    <a href="{{ route('admin.alternativescores.show',[$alternativescore->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('alternativescore_edit')
                                    <a href="{{ route('admin.alternativescores.edit',[$alternativescore->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('alternativescore_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.alternativescores.destroy', $alternativescore->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="metriclabels">
<table class="table table-bordered table-striped {{ count($metriclabels) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.metriclabels.fields.label')</th>
                        <th>@lang('global.metriclabels.fields.project')</th>
                        <th>@lang('global.metriclabels.fields.metric-id')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($metriclabels) > 0)
            @foreach ($metriclabels as $metriclabel)
                <tr data-entry-id="{{ $metriclabel->id }}">
                    <td field-key='label'>{{ $metriclabel->label }}</td>
                                <td field-key='project'>{{ $metriclabel->project->name ?? '' }}</td>
                                <td field-key='metric_id'>{{ $metriclabel->metric_id }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.metriclabels.restore', $metriclabel->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.metriclabels.perma_del', $metriclabel->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('metriclabel_view')
                                    <a href="{{ route('admin.metriclabels.show',[$metriclabel->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('metriclabel_edit')
                                    <a href="{{ route('admin.metriclabels.edit',[$metriclabel->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('metriclabel_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.metriclabels.destroy', $metriclabel->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="project_users">
<table class="table table-bordered table-striped {{ count($project_users) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.project-users.fields.userid')</th>
                        <th>@lang('global.project-users.fields.projectid')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($project_users) > 0)
            @foreach ($project_users as $project_user)
                <tr data-entry-id="{{ $project_user->id }}">
                    <td field-key='userID'>{{ $project_user->userID->name ?? '' }}</td>
                                <td field-key='projectID'>{{ $project_user->projectID->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.project_users.restore', $project_user->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.project_users.perma_del', $project_user->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('project_user_view')
                                    <a href="{{ route('admin.project_users.show',[$project_user->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('project_user_edit')
                                    <a href="{{ route('admin.project_users.edit',[$project_user->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('project_user_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.project_users.destroy', $project_user->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="risk_highlights">
<table class="table table-bordered table-striped {{ count($risk_highlights) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.risk-highlights.fields.risk')</th>
                        <th>@lang('global.risk-highlights.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($risk_highlights) > 0)
            @foreach ($risk_highlights as $risk_highlight)
                <tr data-entry-id="{{ $risk_highlight->id }}">
                    <td field-key='risk'>{{ $risk_highlight->risk->code ?? '' }}</td>
                                <td field-key='project'>{{ $risk_highlight->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_highlights.restore', $risk_highlight->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_highlights.perma_del', $risk_highlight->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('risk_highlight_view')
                                    <a href="{{ route('admin.risk_highlights.show',[$risk_highlight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('risk_highlight_edit')
                                    <a href="{{ route('admin.risk_highlights.edit',[$risk_highlight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('risk_highlight_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_highlights.destroy', $risk_highlight->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="scoredescriptions">
<table class="table table-bordered table-striped {{ count($scoredescriptions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.scoredescriptions.fields.description')</th>
                        <th>@lang('global.scoredescriptions.fields.project')</th>
                        <th>@lang('global.scoredescriptions.fields.score-id')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($scoredescriptions) > 0)
            @foreach ($scoredescriptions as $scoredescription)
                <tr data-entry-id="{{ $scoredescription->id }}">
                    <td field-key='description'>{!! $scoredescription->description !!}</td>
                                <td field-key='project'>{{ $scoredescription->project->name ?? '' }}</td>
                                <td field-key='score_id'>{{ $scoredescription->score_id }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.scoredescriptions.restore', $scoredescription->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.scoredescriptions.perma_del', $scoredescription->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('scoredescription_view')
                                    <a href="{{ route('admin.scoredescriptions.show',[$scoredescription->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('scoredescription_edit')
                                    <a href="{{ route('admin.scoredescriptions.edit',[$scoredescription->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('scoredescription_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.scoredescriptions.destroy', $scoredescription->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="threshold_deliverables">
<table class="table table-bordered table-striped {{ count($threshold_deliverables) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.threshold-deliverables.fields.value')</th>
                        <th>@lang('global.threshold-deliverables.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($threshold_deliverables) > 0)
            @foreach ($threshold_deliverables as $threshold_deliverable)
                <tr data-entry-id="{{ $threshold_deliverable->id }}">
                    <td field-key='value'>{{ $threshold_deliverable->value }}</td>
                                <td field-key='project'>{{ $threshold_deliverable->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.threshold_deliverables.restore', $threshold_deliverable->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.threshold_deliverables.perma_del', $threshold_deliverable->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('threshold_deliverable_view')
                                    <a href="{{ route('admin.threshold_deliverables.show',[$threshold_deliverable->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('threshold_deliverable_edit')
                                    <a href="{{ route('admin.threshold_deliverables.edit',[$threshold_deliverable->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('threshold_deliverable_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.threshold_deliverables.destroy', $threshold_deliverable->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="threshold_risks">
<table class="table table-bordered table-striped {{ count($threshold_risks) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.threshold-risks.fields.value')</th>
                        <th>@lang('global.threshold-risks.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($threshold_risks) > 0)
            @foreach ($threshold_risks as $threshold_risk)
                <tr data-entry-id="{{ $threshold_risk->id }}">
                    <td field-key='value'>{{ $threshold_risk->value }}</td>
                                <td field-key='project'>{{ $threshold_risk->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.threshold_risks.restore', $threshold_risk->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.threshold_risks.perma_del', $threshold_risk->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('threshold_risk_view')
                                    <a href="{{ route('admin.threshold_risks.show',[$threshold_risk->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('threshold_risk_edit')
                                    <a href="{{ route('admin.threshold_risks.edit',[$threshold_risk->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('threshold_risk_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.threshold_risks.destroy', $threshold_risk->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="document_favorites">
<table class="table table-bordered table-striped {{ count($document_favorites) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.document-favorites.fields.document')</th>
                        <th>@lang('global.document-favorites.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($document_favorites) > 0)
            @foreach ($document_favorites as $document_favorite)
                <tr data-entry-id="{{ $document_favorite->id }}">
                    <td field-key='document'>{{ $document_favorite->document->title ?? '' }}</td>
                                <td field-key='project'>{{ $document_favorite->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.document_favorites.restore', $document_favorite->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.document_favorites.perma_del', $document_favorite->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('document_favorite_view')
                                    <a href="{{ route('admin.document_favorites.show',[$document_favorite->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('document_favorite_edit')
                                    <a href="{{ route('admin.document_favorites.edit',[$document_favorite->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('document_favorite_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.document_favorites.destroy', $document_favorite->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="financials">
<table class="table table-bordered table-striped {{ count($financials) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.financials.fields.document')</th>
                        <th>@lang('global.financials.fields.project')</th>
                        <th>@lang('global.financials.fields.title')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($financials) > 0)
            @foreach ($financials as $financial)
                <tr data-entry-id="{{ $financial->id }}">
                    <td field-key='document'>{{ $financial->document }}</td>
                                <td field-key='project'>{{ $financial->project->name ?? '' }}</td>
                                <td field-key='title'>{{ $financial->title }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.financials.restore', $financial->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.financials.perma_del', $financial->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('financial_view')
                                    <a href="{{ route('admin.financials.show',[$financial->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('financial_edit')
                                    <a href="{{ route('admin.financials.edit',[$financial->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('financial_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.financials.destroy', $financial->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="financialvisibilities">
<table class="table table-bordered table-striped {{ count($financialvisibilities) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.financialvisibilities.fields.type')</th>
                        <th>@lang('global.financialvisibilities.fields.status')</th>
                        <th>@lang('global.financialvisibilities.fields.id-project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($financialvisibilities) > 0)
            @foreach ($financialvisibilities as $financialvisibility)
                <tr data-entry-id="{{ $financialvisibility->id }}">
                    <td field-key='type'>{{ $financialvisibility->type }}</td>
                                <td field-key='status'>{{ $financialvisibility->status }}</td>
                                <td field-key='id_project'>{{ $financialvisibility->id_project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.financialvisibilities.restore', $financialvisibility->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.financialvisibilities.perma_del', $financialvisibility->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('financialvisibility_view')
                                    <a href="{{ route('admin.financialvisibilities.show',[$financialvisibility->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('financialvisibility_edit')
                                    <a href="{{ route('admin.financialvisibilities.edit',[$financialvisibility->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('financialvisibility_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.financialvisibilities.destroy', $financialvisibility->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="memberroles">
<table class="table table-bordered table-striped {{ count($memberroles) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.memberroles.fields.member')</th>
                        <th>@lang('global.memberroles.fields.role')</th>
                        <th>@lang('global.memberroles.fields.project')</th>
                        <th>@lang('global.memberroles.fields.partner')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($memberroles) > 0)
            @foreach ($memberroles as $memberrole)
                <tr data-entry-id="{{ $memberrole->id }}">
                    <td field-key='member'>{{ $memberrole->member->name ?? '' }}</td>
                                <td field-key='role'>{{ $memberrole->role }}</td>
                                <td field-key='project'>{{ $memberrole->project->name ?? '' }}</td>
                                <td field-key='partner'>{{ $memberrole->partner->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.memberroles.restore', $memberrole->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.memberroles.perma_del', $memberrole->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('memberrole_view')
                                    <a href="{{ route('admin.memberroles.show',[$memberrole->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('memberrole_edit')
                                    <a href="{{ route('admin.memberroles.edit',[$memberrole->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('memberrole_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.memberroles.destroy', $memberrole->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="cd_disseminations">
<table class="table table-bordered table-striped {{ count($cd_disseminations) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.cd-disseminations.fields.month')</th>
                        <th>@lang('global.cd-disseminations.fields.value')</th>
                        <th>@lang('global.cd-disseminations.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($cd_disseminations) > 0)
            @foreach ($cd_disseminations as $cd_dissemination)
                <tr data-entry-id="{{ $cd_dissemination->id }}">
                    <td field-key='month'>{{ $cd_dissemination->month }}</td>
                                <td field-key='value'>{{ $cd_dissemination->value }}</td>
                                <td field-key='project'>{{ $cd_dissemination->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_disseminations.restore', $cd_dissemination->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_disseminations.perma_del', $cd_dissemination->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('cd_dissemination_view')
                                    <a href="{{ route('admin.cd_disseminations.show',[$cd_dissemination->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('cd_dissemination_edit')
                                    <a href="{{ route('admin.cd_disseminations.edit',[$cd_dissemination->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('cd_dissemination_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_disseminations.destroy', $cd_dissemination->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="metricicons">
<table class="table table-bordered table-striped {{ count($metricicons) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.metricicons.fields.metric-id')</th>
                        <th>@lang('global.metricicons.fields.icon-id')</th>
                        <th>@lang('global.metricicons.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($metricicons) > 0)
            @foreach ($metricicons as $metricicon)
                <tr data-entry-id="{{ $metricicon->id }}">
                    <td field-key='metric_id'>{{ $metricicon->metric_id }}</td>
                                <td field-key='icon_id'>{{ $metricicon->icon_id }}</td>
                                <td field-key='project'>{{ $metricicon->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.metricicons.restore', $metricicon->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.metricicons.perma_del', $metricicon->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('metricicon_view')
                                    <a href="{{ route('admin.metricicons.show',[$metricicon->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('metricicon_edit')
                                    <a href="{{ route('admin.metricicons.edit',[$metricicon->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('metricicon_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.metricicons.destroy', $metricicon->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="cd_emails">
<table class="table table-bordered table-striped {{ count($cd_emails) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.cd-emails.fields.month')</th>
                        <th>@lang('global.cd-emails.fields.value')</th>
                        <th>@lang('global.cd-emails.fields.project')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($cd_emails) > 0)
            @foreach ($cd_emails as $cd_email)
                <tr data-entry-id="{{ $cd_email->id }}">
                    <td field-key='month'>{{ $cd_email->month }}</td>
                                <td field-key='value'>{{ $cd_email->value }}</td>
                                <td field-key='project'>{{ $cd_email->project->name ?? '' }}</td>
                                                                <td>
                                    @can('cd_email_view')
                                    <a href="{{ route('admin.cd_emails.show',[$cd_email->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('cd_email_edit')
                                    <a href="{{ route('admin.cd_emails.edit',[$cd_email->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('cd_email_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_emails.destroy', $cd_email->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

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
<div role="tabpanel" class="tab-pane " id="cd_intranet_access">
<table class="table table-bordered table-striped {{ count($cd_intranet_accesses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.cd-intranet-access.fields.month')</th>
                        <th>@lang('global.cd-intranet-access.fields.value')</th>
                        <th>@lang('global.cd-intranet-access.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($cd_intranet_accesses) > 0)
            @foreach ($cd_intranet_accesses as $cd_intranet_access)
                <tr data-entry-id="{{ $cd_intranet_access->id }}">
                    <td field-key='month'>{{ $cd_intranet_access->month }}</td>
                                <td field-key='value'>{{ $cd_intranet_access->value }}</td>
                                <td field-key='project'>{{ $cd_intranet_access->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_intranet_accesses.restore', $cd_intranet_access->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_intranet_accesses.perma_del', $cd_intranet_access->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('cd_intranet_access_view')
                                    <a href="{{ route('admin.cd_intranet_accesses.show',[$cd_intranet_access->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('cd_intranet_access_edit')
                                    <a href="{{ route('admin.cd_intranet_accesses.edit',[$cd_intranet_access->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('cd_intranet_access_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_intranet_accesses.destroy', $cd_intranet_access->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="cd_meetings">
<table class="table table-bordered table-striped {{ count($cd_meetings) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.cd-meetings.fields.month')</th>
                        <th>@lang('global.cd-meetings.fields.value')</th>
                        <th>@lang('global.cd-meetings.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($cd_meetings) > 0)
            @foreach ($cd_meetings as $cd_meeting)
                <tr data-entry-id="{{ $cd_meeting->id }}">
                    <td field-key='month'>{{ $cd_meeting->month }}</td>
                                <td field-key='value'>{{ $cd_meeting->value }}</td>
                                <td field-key='project'>{{ $cd_meeting->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_meetings.restore', $cd_meeting->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_meetings.perma_del', $cd_meeting->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('cd_meeting_view')
                                    <a href="{{ route('admin.cd_meetings.show',[$cd_meeting->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('cd_meeting_edit')
                                    <a href="{{ route('admin.cd_meetings.edit',[$cd_meeting->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('cd_meeting_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_meetings.destroy', $cd_meeting->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="cd_scores">
<table class="table table-bordered table-striped {{ count($cd_scores) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.cd-scores.fields.month')</th>
                        <th>@lang('global.cd-scores.fields.value')</th>
                        <th>@lang('global.cd-scores.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($cd_scores) > 0)
            @foreach ($cd_scores as $cd_score)
                <tr data-entry-id="{{ $cd_score->id }}">
                    <td field-key='month'>{{ $cd_score->month }}</td>
                                <td field-key='value'>{{ $cd_score->value }}</td>
                                <td field-key='project'>{{ $cd_score->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_scores.restore', $cd_score->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_scores.perma_del', $cd_score->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('cd_score_view')
                                    <a href="{{ route('admin.cd_scores.show',[$cd_score->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('cd_score_edit')
                                    <a href="{{ route('admin.cd_scores.edit',[$cd_score->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('cd_score_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_scores.destroy', $cd_score->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="cd_scores2">
<table class="table table-bordered table-striped {{ count($cd_scores2s) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.cd-scores2.fields.month')</th>
                        <th>@lang('global.cd-scores2.fields.value')</th>
                        <th>@lang('global.cd-scores2.fields.project')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($cd_scores2s) > 0)
            @foreach ($cd_scores2s as $cd_scores2)
                <tr data-entry-id="{{ $cd_scores2->id }}">
                    <td field-key='month'>{{ $cd_scores2->month }}</td>
                                <td field-key='value'>{{ $cd_scores2->value }}</td>
                                <td field-key='project'>{{ $cd_scores2->project->name ?? '' }}</td>
                                                                <td>
                                    @can('cd_scores2_view')
                                    <a href="{{ route('admin.cd_scores2s.show',[$cd_scores2->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('cd_scores2_edit')
                                    <a href="{{ route('admin.cd_scores2s.edit',[$cd_scores2->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('cd_scores2_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_scores2s.destroy', $cd_scores2->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

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
<div role="tabpanel" class="tab-pane " id="workpackages">
<table class="table table-bordered table-striped {{ count($workpackages) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.workpackages.fields.wp-id')</th>
                        <th>@lang('global.workpackages.fields.name')</th>
                        <th>@lang('global.workpackages.fields.project')</th>
                        <th>@lang('global.workpackages.fields.order')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($workpackages) > 0)
            @foreach ($workpackages as $workpackage)
                <tr data-entry-id="{{ $workpackage->id }}">
                    <td field-key='wp_id'>{{ $workpackage->wp_id }}</td>
                                <td field-key='name'>{{ $workpackage->name }}</td>
                                <td field-key='project'>{{ $workpackage->project->name ?? '' }}</td>
                                <td field-key='order'>{{ $workpackage->order }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.workpackages.restore', $workpackage->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.workpackages.perma_del', $workpackage->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('workpackage_view')
                                    <a href="{{ route('admin.workpackages.show',[$workpackage->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('workpackage_edit')
                                    <a href="{{ route('admin.workpackages.edit',[$workpackage->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('workpackage_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.workpackages.destroy', $workpackage->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="project_periods">
<table class="table table-bordered table-striped {{ count($project_periods) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.project-periods.fields.date')</th>
                        <th>@lang('global.project-periods.fields.period-num')</th>
                        <th>@lang('global.project-periods.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($project_periods) > 0)
            @foreach ($project_periods as $project_period)
                <tr data-entry-id="{{ $project_period->id }}">
                    <td field-key='date'>{{ $project_period->date }}</td>
                                <td field-key='period_num'>{{ $project_period->period_num }}</td>
                                <td field-key='project'>{{ $project_period->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.project_periods.restore', $project_period->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.project_periods.perma_del', $project_period->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('project_period_view')
                                    <a href="{{ route('admin.project_periods.show',[$project_period->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('project_period_edit')
                                    <a href="{{ route('admin.project_periods.edit',[$project_period->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('project_period_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.project_periods.destroy', $project_period->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="budgets">
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
<div role="tabpanel" class="tab-pane " id="posts">
<table class="table table-bordered table-striped {{ count($posts) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.posts.fields.created')</th>
                        <th>@lang('global.posts.fields.iduser')</th>
                        <th>@lang('global.posts.fields.description')</th>
                        <th>@lang('global.posts.fields.idproject')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <tr data-entry-id="{{ $post->id }}">
                    <td field-key='created'>{{ $post->created }}</td>
                                <td field-key='idUser'>{{ $post->idUser->name ?? '' }}</td>
                                <td field-key='description'>{!! $post->description !!}</td>
                                <td field-key='idProject'>{{ $post->idProject->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.posts.restore', $post->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.posts.perma_del', $post->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('post_view')
                                    <a href="{{ route('admin.posts.show',[$post->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('post_edit')
                                    <a href="{{ route('admin.posts.edit',[$post->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('post_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.posts.destroy', $post->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="schedules">
<table class="table table-bordered table-striped {{ count($schedules) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.schedules.fields.date')</th>
                        <th>@lang('global.schedules.fields.description')</th>
                        <th>@lang('global.schedules.fields.status')</th>
                        <th>@lang('global.schedules.fields.project')</th>
                        <th>@lang('global.schedules.fields.highlight')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($schedules) > 0)
            @foreach ($schedules as $schedule)
                <tr data-entry-id="{{ $schedule->id }}">
                    <td field-key='date'>{{ $schedule->date }}</td>
                                <td field-key='description'>{{ $schedule->description }}</td>
                                <td field-key='status'>{{ $schedule->status }}</td>
                                <td field-key='project'>{{ $schedule->project->name ?? '' }}</td>
                                <td field-key='highlight'>{{ $schedule->highlight }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.schedules.restore', $schedule->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.schedules.perma_del', $schedule->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('schedule_view')
                                    <a href="{{ route('admin.schedules.show',[$schedule->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('schedule_edit')
                                    <a href="{{ route('admin.schedules.edit',[$schedule->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('schedule_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.schedules.destroy', $schedule->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="documents">
<table class="table table-bordered table-striped {{ count($documents) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.documents.fields.title')</th>
                        <th>@lang('global.documents.fields.folder')</th>
                        <th>@lang('global.documents.fields.document')</th>
                        <th>@lang('global.documents.fields.project')</th>
                        <th>@lang('global.documents.fields.deliverable')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($documents) > 0)
            @foreach ($documents as $document)
                <tr data-entry-id="{{ $document->id }}">
                    <td field-key='title'>{{ $document->title }}</td>
                                <td field-key='folder'>{{ $document->folder }}</td>
                                <td field-key='document'>{!! $document->document !!}</td>
                                <td field-key='project'>{{ $document->project->name ?? '' }}</td>
                                <td field-key='deliverable'>{{ $document->deliverable->label_identification ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.documents.restore', $document->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.documents.perma_del', $document->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('document_view')
                                    <a href="{{ route('admin.documents.show',[$document->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('document_edit')
                                    <a href="{{ route('admin.documents.edit',[$document->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('document_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.documents.destroy', $document->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="agenda">
<table class="table table-bordered table-striped {{ count($agendas) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.agenda.fields.date')</th>
                        <th>@lang('global.agenda.fields.hour')</th>
                        <th>@lang('global.agenda.fields.minute')</th>
                        <th>@lang('global.agenda.fields.title')</th>
                        <th>@lang('global.agenda.fields.description')</th>
                        <th>@lang('global.agenda.fields.project')</th>
                        <th>@lang('global.agenda.fields.category')</th>
                        <th>@lang('global.agenda.fields.duration')</th>
                        <th>@lang('global.agenda.fields.meeting-type')</th>
                        <th>@lang('global.agenda.fields.date-creation')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($agendas) > 0)
            @foreach ($agendas as $agenda)
                <tr data-entry-id="{{ $agenda->id }}">
                    <td field-key='date'>{{ $agenda->date }}</td>
                                <td field-key='hour'>{{ $agenda->hour }}</td>
                                <td field-key='minute'>{{ $agenda->minute }}</td>
                                <td field-key='title'>{{ $agenda->title }}</td>
                                <td field-key='description'>{!! $agenda->description !!}</td>
                                <td field-key='project'>{{ $agenda->project->name ?? '' }}</td>
                                <td field-key='category'>{{ $agenda->category }}</td>
                                <td field-key='duration'>{{ $agenda->duration }}</td>
                                <td field-key='meeting_type'>{{ $agenda->meeting_type }}</td>
                                <td field-key='date_creation'>{{ $agenda->date_creation }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.agendas.restore', $agenda->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.agendas.perma_del', $agenda->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('agenda_view')
                                    <a href="{{ route('admin.agendas.show',[$agenda->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('agenda_edit')
                                    <a href="{{ route('admin.agendas.edit',[$agenda->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('agenda_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.agendas.destroy', $agenda->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="15">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="publications">
<table class="table table-bordered table-striped {{ count($publications) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.publications.fields.title')</th>
                        <th>@lang('global.publications.fields.year')</th>
                        <th>@lang('global.publications.fields.month')</th>
                        <th>@lang('global.publications.fields.abbr')</th>
                        <th>@lang('global.publications.fields.link')</th>
                        <th>@lang('global.publications.fields.project')</th>
                        <th>@lang('global.publications.fields.authors')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($publications) > 0)
            @foreach ($publications as $publication)
                <tr data-entry-id="{{ $publication->id }}">
                    <td field-key='title'>{{ $publication->title }}</td>
                                <td field-key='year'>{{ $publication->year }}</td>
                                <td field-key='month'>{{ $publication->month }}</td>
                                <td field-key='abbr'>{{ $publication->abbr }}</td>
                                <td field-key='link'>{{ $publication->link }}</td>
                                <td field-key='project'>{{ $publication->project->name ?? '' }}</td>
                                <td field-key='authors'>{{ $publication->authors }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.publications.restore', $publication->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.publications.perma_del', $publication->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('publication_view')
                                    <a href="{{ route('admin.publications.show',[$publication->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('publication_edit')
                                    <a href="{{ route('admin.publications.edit',[$publication->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('publication_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.publications.destroy', $publication->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="risks">
<table class="table table-bordered table-striped {{ count($risks) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.risks.fields.code')</th>
                        <th>@lang('global.risks.fields.version')</th>
                        <th>@lang('global.risks.fields.parent-id')</th>
                        <th>@lang('global.risks.fields.description')</th>
                        <th>@lang('global.risks.fields.score')</th>
                        <th>@lang('global.risks.fields.flag')</th>
                        <th>@lang('global.risks.fields.project')</th>
                        <th>@lang('global.risks.fields.impact')</th>
                        <th>@lang('global.risks.fields.probability')</th>
                        <th>@lang('global.risks.fields.proximity')</th>
                        <th>@lang('global.risks.fields.title')</th>
                        <th>@lang('global.risks.fields.contingency')</th>
                        <th>@lang('global.risks.fields.mitigation')</th>
                        <th>@lang('global.risks.fields.triggerevents')</th>
                        <th>@lang('global.risks.fields.resolved')</th>
                        <th>@lang('global.risks.fields.risk-date')</th>
                        <th>@lang('global.risks.fields.version-date')</th>
                        <th>@lang('global.risks.fields.type')</th>
                        <th>@lang('global.risks.fields.notes')</th>
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
                    <td field-key='code'>{{ $risk->code }}</td>
                                <td field-key='version'>{{ $risk->version }}</td>
                                <td field-key='parent_id'>{{ $risk->parent_id }}</td>
                                <td field-key='description'>{!! $risk->description !!}</td>
                                <td field-key='score'>{{ $risk->score }}</td>
                                <td field-key='flag'>{{ $risk->flag }}</td>
                                <td field-key='project'>{{ $risk->project->name ?? '' }}</td>
                                <td field-key='impact'>{{ $risk->impact }}</td>
                                <td field-key='probability'>{{ $risk->probability }}</td>
                                <td field-key='proximity'>{{ $risk->proximity }}</td>
                                <td field-key='title'>{!! $risk->title !!}</td>
                                <td field-key='contingency'>{!! $risk->contingency !!}</td>
                                <td field-key='mitigation'>{!! $risk->mitigation !!}</td>
                                <td field-key='triggerevents'>{!! $risk->triggerevents !!}</td>
                                <td field-key='resolved'>{{ $risk->resolved }}</td>
                                <td field-key='risk_date'>{{ $risk->risk_date }}</td>
                                <td field-key='version_date'>{{ $risk->version_date }}</td>
                                <td field-key='type'>{{ $risk->type }}</td>
                                <td field-key='notes'>{!! $risk->notes !!}</td>
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
                <td colspan="24">@lang('global.app_no_entries_in_table')</td>
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
                        <th>@lang('global.deliverables.fields.idstatus')</th>
                        <th>@lang('global.deliverables.fields.notes')</th>
                        <th>@lang('global.deliverables.fields.project')</th>
                        <th>@lang('global.deliverables.fields.confidentiality')</th>
                        <th>@lang('global.deliverables.fields.submission-date')</th>
                        <th>@lang('global.deliverables.fields.due-date-months')</th>
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
                                <td field-key='idStatus'>{{ $deliverable->idStatus->label ?? '' }}</td>
                                <td field-key='notes'>{!! $deliverable->notes !!}</td>
                                <td field-key='project'>{{ $deliverable->project->name ?? '' }}</td>
                                <td field-key='confidentiality'>{{ $deliverable->confidentiality }}</td>
                                <td field-key='submission_date'>{{ $deliverable->submission_date }}</td>
                                <td field-key='due_date_months'>{{ $deliverable->due_date_months }}</td>
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
                <td colspan="15">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.projects.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop
