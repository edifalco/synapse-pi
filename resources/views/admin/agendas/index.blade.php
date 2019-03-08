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
            <table class="table table-bordered table-striped ajaxTable @can('agenda_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
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
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('agenda_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.agendas.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.agendas.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [@can('agenda_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'date', name: 'date'},
                {data: 'hour', name: 'hour'},
                {data: 'minute', name: 'minute'},
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description'},
                {data: 'project.name', name: 'project.name'},
                {data: 'category', name: 'category'},
                {data: 'duration', name: 'duration'},
                {data: 'meeting_type', name: 'meeting_type'},
                {data: 'date_creation', name: 'date_creation'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection