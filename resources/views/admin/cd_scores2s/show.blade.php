@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.cd-scores2.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.cd-scores2.fields.month')</th>
                            <td field-key='month'>{{ $cd_scores2->month }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.cd-scores2.fields.value')</th>
                            <td field-key='value'>{{ $cd_scores2->value }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.cd-scores2.fields.project')</th>
                            <td field-key='project'>{{ $cd_scores2->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.cd_scores2s.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


