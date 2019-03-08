@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.cd-emails.title')</h3>
    @can('cd_email_create')
    <p>
        <a href="{{ route('admin.cd_emails.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
        @include('csvImport.modal', ['model' => 'CdEmail'])
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('cd_email_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('cd_email_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.cd-emails.fields.month')</th>
                        <th>@lang('global.cd-emails.fields.value')</th>
                        <th>@lang('global.cd-emails.fields.project')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('cd_email_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.cd_emails.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.cd_emails.index') !!}';
            window.dtDefaultOptions.columns = [@can('cd_email_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan{data: 'month', name: 'month'},
                {data: 'value', name: 'value'},
                {data: 'project.name', name: 'project.name'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection