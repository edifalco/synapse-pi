@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.cd-emails.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.cd-emails.fields.month')</th>
                            <td field-key='month'>{{ $cd_email->month }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.cd-emails.fields.value')</th>
                            <td field-key='value'>{{ $cd_email->value }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.cd-emails.fields.project')</th>
                            <td field-key='project'>{{ $cd_email->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.cd_emails.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


