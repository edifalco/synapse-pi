@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.cd-meetings.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.cd-meetings.fields.month')</th>
                            <td field-key='month'>{{ $cd_meeting->month }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.cd-meetings.fields.value')</th>
                            <td field-key='value'>{{ $cd_meeting->value }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.cd-meetings.fields.project')</th>
                            <td field-key='project'>{{ $cd_meeting->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.cd_meetings.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


