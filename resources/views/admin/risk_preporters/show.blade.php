@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.risk-preporters.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.risk-preporters.fields.partner')</th>
                            <td field-key='partner'>{{ $risk_preporter->partner->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risk-preporters.fields.risk')</th>
                            <td field-key='risk'>{{ $risk_preporter->risk->code ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.risk_preporters.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


