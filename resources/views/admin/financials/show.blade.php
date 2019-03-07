@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.financials.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.financials.fields.document')</th>
                            <td field-key='document'>{{ $financial->document }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.financials.fields.project')</th>
                            <td field-key='project'>{{ $financial->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.financials.fields.title')</th>
                            <td field-key='title'>{{ $financial->title }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.financials.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


