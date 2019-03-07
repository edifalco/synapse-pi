@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.threshold-risks.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.threshold-risks.fields.value')</th>
                            <td field-key='value'>{{ $threshold_risk->value }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.threshold-risks.fields.project')</th>
                            <td field-key='project'>{{ $threshold_risk->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.threshold_risks.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


