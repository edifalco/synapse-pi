@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.partnernums.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.partnernums.fields.value')</th>
                            <td field-key='value'>{{ $partnernum->value }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.partnernums.fields.partner')</th>
                            <td field-key='partner'>{{ $partnernum->partner->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.partnernums.fields.project')</th>
                            <td field-key='project'>{{ $partnernum->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.partnernums.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


