@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deliverable-status.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.deliverable-status.fields.label')</th>
                            <td field-key='label'>{{ $deliverable_status->label }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#deliverables" aria-controls="deliverables" role="tab" data-toggle="tab">Deliverables</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="deliverables">
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

            <a href="{{ route('admin.deliverable_statuses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


