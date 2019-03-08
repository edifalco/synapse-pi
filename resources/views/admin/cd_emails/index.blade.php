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
            <table class="table table-bordered table-striped {{ count($cd_emails) > 0 ? 'datatable' : '' }} @can('cd_email_delete') dt-select @endcan">
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
                
                <tbody>
                    @if (count($cd_emails) > 0)
                        @foreach ($cd_emails as $cd_email)
                            <tr data-entry-id="{{ $cd_email->id }}">
                                @can('cd_email_delete')
                                    <td></td>
                                @endcan

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
    </div>
@stop

@section('javascript') 
    <script>
        @can('cd_email_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.cd_emails.mass_destroy') }}';
        @endcan

    </script>
@endsection