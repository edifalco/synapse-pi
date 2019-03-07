@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.budgets.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.budgets.fields.partner')</th>
                            <td field-key='partner'>{{ $budget->partner->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.budgets.fields.value')</th>
                            <td field-key='value'>{{ $budget->value }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.budgets.fields.period')</th>
                            <td field-key='period'>{{ $budget->period }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.budgets.fields.project')</th>
                            <td field-key='project'>{{ $budget->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.budgets.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


