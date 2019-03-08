@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.agenda.title')</h3>
    @can('agenda_create')
    <p>
        <a href="{{ route('admin.agendas.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
        @include('csvImport.modal', ['model' => 'Agenda'])
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.agendas.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.agendas.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($agendas) > 0 ? 'datatable' : '' }} @can('agenda_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('agenda_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('agenda_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
    </div>
@stop

@section('javascript') 
    <script>
        @can('agenda_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.agendas.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection