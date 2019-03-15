@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.schedule-statuses.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.schedule-statuses.fields.name')</th>
                            <td field-key='name'>{{ $schedule_status->name }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#schedules" aria-controls="schedules" role="tab" data-toggle="tab">Schedules</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="schedules">
<table class="table table-bordered table-striped {{ count($schedules) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.schedules.fields.description')</th>
                        <th>@lang('global.schedules.fields.date')</th>
                        <th>@lang('global.schedules.fields.project')</th>
                        <th>@lang('global.schedules.fields.status')</th>
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
                    <td field-key='description'>{{ $schedule->description }}</td>
                                <td field-key='date'>{{ $schedule->date }}</td>
                                <td field-key='project'>{{ $schedule->project->name ?? '' }}</td>
                                <td field-key='status'>{{ $schedule->status->name ?? '' }}</td>
                                <td field-key='highlight'>{{ $schedule->highlight->name ?? '' }}</td>
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.schedule_statuses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


