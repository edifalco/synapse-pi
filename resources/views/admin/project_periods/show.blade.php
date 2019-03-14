@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.project-periods.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.project-periods.fields.date')</th>
                            <td field-key='date'>{{ $project_period->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.project-periods.fields.period-num')</th>
                            <td field-key='period_num'>{{ $project_period->period_num }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.project_periods.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


