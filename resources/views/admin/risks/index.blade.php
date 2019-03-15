@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.risks.title')</h3>
    @can('risk_create')
    <p>
        <a href="{{ route('admin.risks.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
        @include('csvImport.modal', ['model' => 'Risk'])
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.risks.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.risks.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('risk_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('risk_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('risk_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.risks.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.risks.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [@can('risk_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'project.name', name: 'project.name'},
                {data: 'code', name: 'code'},
                {data: 'version', name: 'version'},
                {data: 'flag', name: 'flag'},
                {data: 'resolved', name: 'resolved'},
                {data: 'risks_type.name', name: 'risks_type.name'},
                {data: 'risk_date', name: 'risk_date'},
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description'},
                {data: 'trigger_events', name: 'trigger_events'},
                {data: 'risk_impact.name', name: 'risk_impact.name'},
                {data: 'risk_probabilities.name', name: 'risk_probabilities.name'},
                {data: 'score', name: 'score'},
                {data: 'risk_proximity.name', name: 'risk_proximity.name'},
                {data: 'mitigation', name: 'mitigation'},
                {data: 'risk_owner.surname', name: 'risk_owner.surname'},
                {data: 'notes', name: 'notes'},
                {data: 'contingency', name: 'contingency'},
                {data: 'version_date', name: 'version_date'},
                {data: 'parent_id', name: 'parent_id'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection