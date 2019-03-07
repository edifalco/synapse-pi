@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.efforts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.efforts.fields.project')</th>
                            <td field-key='project'>{{ $effort->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.efforts.fields.workpackage')</th>
                            <td field-key='workpackage'>{{ $effort->workpackage->wp_id ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.efforts.fields.partner')</th>
                            <td field-key='partner'>{{ $effort->partner->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.efforts.fields.value')</th>
                            <td field-key='value'>{{ $effort->value }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.efforts.fields.period')</th>
                            <td field-key='period'>{{ $effort->period }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.efforts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


