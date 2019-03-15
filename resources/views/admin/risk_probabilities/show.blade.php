@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.risk-probabilities.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.risk-probabilities.fields.name')</th>
                            <td field-key='name'>{{ $risk_probability->name }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#risks" aria-controls="risks" role="tab" data-toggle="tab">Risks</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="risks">
<table class="table table-bordered table-striped {{ count($risks) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.risks.fields.project')</th>
                        <th>@lang('global.risks.fields.code')</th>
                        <th>@lang('global.risks.fields.version')</th>
                        <th>@lang('global.risks.fields.flag')</th>
                        <th>@lang('global.risks.fields.resolved')</th>
                        <th>@lang('global.risks.fields.risks-type')</th>
                        <th>@lang('global.risks.fields.risk-date')</th>
                        <th>@lang('global.risks.fields.title')</th>
                        <th>@lang('global.risks.fields.description')</th>
                        <th>@lang('global.risks.fields.trigger-events')</th>
                        <th>@lang('global.risks.fields.risk-impact')</th>
                        <th>@lang('global.risks.fields.risk-probabilities')</th>
                        <th>@lang('global.risks.fields.score')</th>
                        <th>@lang('global.risks.fields.risk-proximity')</th>
                        <th>@lang('global.risks.fields.mitigation')</th>
                        <th>@lang('global.risks.fields.risk-owner')</th>
                        <th>@lang('global.risks.fields.notes')</th>
                        <th>@lang('global.risks.fields.contingency')</th>
                        <th>@lang('global.risks.fields.version-date')</th>
                        <th>@lang('global.risks.fields.parent-id')</th>
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
                                <td field-key='risks_type'>{{ $risk->risks_type->name ?? '' }}</td>
                                <td field-key='risk_date'>{{ $risk->risk_date }}</td>
                                <td field-key='title'>{!! $risk->title !!}</td>
                                <td field-key='description'>{!! $risk->description !!}</td>
                                <td field-key='trigger_events'>{!! $risk->trigger_events !!}</td>
                                <td field-key='risk_impact'>{{ $risk->risk_impact->name ?? '' }}</td>
                                <td field-key='risk_probabilities'>{{ $risk->risk_probabilities->name ?? '' }}</td>
                                <td field-key='score'>{{ $risk->score }}</td>
                                <td field-key='risk_proximity'>{{ $risk->risk_proximity->name ?? '' }}</td>
                                <td field-key='mitigation'>{!! $risk->mitigation !!}</td>
                                <td field-key='risk_owner'>
                                    @foreach ($risk->risk_owner as $singleRiskOwner)
                                        <span class="label label-info label-many">{{ $singleRiskOwner->surname }}</span>
                                    @endforeach
                                </td>
                                <td field-key='notes'>{!! $risk->notes !!}</td>
                                <td field-key='contingency'>{!! $risk->contingency !!}</td>
                                <td field-key='version_date'>{{ $risk->version_date }}</td>
                                <td field-key='parent_id'>{{ $risk->parent_id }}</td>
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

            <a href="{{ route('admin.risk_probabilities.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


