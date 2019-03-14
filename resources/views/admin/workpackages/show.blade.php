@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.workpackages.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.workpackages.fields.wp-id')</th>
                            <td field-key='wp_id'>{{ $workpackage->wp_id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.workpackages.fields.name')</th>
                            <td field-key='name'>{{ $workpackage->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.workpackages.fields.project')</th>
                            <td field-key='project'>{{ $workpackage->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.workpackages.fields.order')</th>
                            <td field-key='order'>{{ $workpackage->order }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#deliverables" aria-controls="deliverables" role="tab" data-toggle="tab">Deliverables</a></li>
<li role="presentation" class=""><a href="#deliverable_workpackages" aria-controls="deliverable_workpackages" role="tab" data-toggle="tab">Deliverable workpackages</a></li>
<li role="presentation" class=""><a href="#efforts" aria-controls="efforts" role="tab" data-toggle="tab">Efforts</a></li>
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
                        <th>@lang('global.deliverables.fields.status')</th>
                        <th>@lang('global.deliverables.fields.notes')</th>
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
<div role="tabpanel" class="tab-pane " id="deliverable_workpackages">
<table class="table table-bordered table-striped {{ count($deliverable_workpackages) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.deliverable-workpackages.fields.deliverable')</th>
                        <th>@lang('global.deliverable-workpackages.fields.workpackage')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($deliverable_workpackages) > 0)
            @foreach ($deliverable_workpackages as $deliverable_workpackage)
                <tr data-entry-id="{{ $deliverable_workpackage->id }}">
                    <td field-key='deliverable'>{{ $deliverable_workpackage->deliverable->label_identification ?? '' }}</td>
                                <td field-key='workpackage'>{{ $deliverable_workpackage->workpackage->wp_id ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_workpackages.restore', $deliverable_workpackage->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_workpackages.perma_del', $deliverable_workpackage->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('deliverable_workpackage_view')
                                    <a href="{{ route('admin.deliverable_workpackages.show',[$deliverable_workpackage->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('deliverable_workpackage_edit')
                                    <a href="{{ route('admin.deliverable_workpackages.edit',[$deliverable_workpackage->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('deliverable_workpackage_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_workpackages.destroy', $deliverable_workpackage->id])) !!}
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.workpackages.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


