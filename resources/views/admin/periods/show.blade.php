@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.periods.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.periods.fields.date')</th>
                            <td field-key='date'>{{ $period->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.periods.fields.period-num')</th>
                            <td field-key='period_num'>{{ $period->period_num }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.periods.fields.project')</th>
                            <td field-key='project'>{{ $period->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.periods.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


