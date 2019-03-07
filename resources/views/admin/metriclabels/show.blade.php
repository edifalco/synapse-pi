@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.metriclabels.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.metriclabels.fields.label')</th>
                            <td field-key='label'>{{ $metriclabel->label }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.metriclabels.fields.project')</th>
                            <td field-key='project'>{{ $metriclabel->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.metriclabels.fields.metric-id')</th>
                            <td field-key='metric_id'>{{ $metriclabel->metric_id }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.metriclabels.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


