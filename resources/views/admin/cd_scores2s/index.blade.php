@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.cd-scores2.title')</h3>
    @can('cd_scores2_create')
    <p>
        <a href="{{ route('admin.cd_scores2s.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
        @include('csvImport.modal', ['model' => 'CdScores2'])
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($cd_scores2s) > 0 ? 'datatable' : '' }} @can('cd_scores2_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('cd_scores2_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.cd-scores2.fields.month')</th>
                        <th>@lang('global.cd-scores2.fields.value')</th>
                        <th>@lang('global.cd-scores2.fields.project')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($cd_scores2s) > 0)
                        @foreach ($cd_scores2s as $cd_scores2)
                            <tr data-entry-id="{{ $cd_scores2->id }}">
                                @can('cd_scores2_delete')
                                    <td></td>
                                @endcan

                                <td field-key='month'>{{ $cd_scores2->month }}</td>
                                <td field-key='value'>{{ $cd_scores2->value }}</td>
                                <td field-key='project'>{{ $cd_scores2->project->name ?? '' }}</td>
                                                                <td>
                                    @can('cd_scores2_view')
                                    <a href="{{ route('admin.cd_scores2s.show',[$cd_scores2->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('cd_scores2_edit')
                                    <a href="{{ route('admin.cd_scores2s.edit',[$cd_scores2->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('cd_scores2_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cd_scores2s.destroy', $cd_scores2->id])) !!}
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
        @can('cd_scores2_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.cd_scores2s.mass_destroy') }}';
        @endcan

    </script>
@endsection