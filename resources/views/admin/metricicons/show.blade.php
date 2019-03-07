@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.metricicons.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.metricicons.fields.metric-id')</th>
                            <td field-key='metric_id'>{{ $metricicon->metric_id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.metricicons.fields.icon-id')</th>
                            <td field-key='icon_id'>{{ $metricicon->icon_id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.metricicons.fields.project')</th>
                            <td field-key='project'>{{ $metricicon->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.metricicons.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


