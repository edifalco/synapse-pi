@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.budgets.title')</h3>
    @can('budget_create')
    <p>
        <a href="{{ route('admin.budgets.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
        @include('csvImport.modal', ['model' => 'Budget'])
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('budget_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('budget_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.budgets.fields.partner')</th>
                        <th>@lang('global.budgets.fields.value')</th>
                        <th>@lang('global.budgets.fields.period')</th>
                        <th>@lang('global.budgets.fields.project')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('budget_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.budgets.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.budgets.index') !!}';
            window.dtDefaultOptions.columns = [@can('budget_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan{data: 'partner.name', name: 'partner.name'},
                {data: 'value', name: 'value'},
                {data: 'period', name: 'period'},
                {data: 'project.name', name: 'project.name'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection