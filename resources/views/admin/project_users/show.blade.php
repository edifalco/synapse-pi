@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.project-users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.project-users.fields.userid')</th>
                            <td field-key='userID'>{{ $project_user->userID->name ?? '' }}</td>
<td field-key='name'>{{ isset($project_user->userID) ? $project_user->userID->name : '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.project-users.fields.projectid')</th>
                            <td field-key='projectID'>{{ $project_user->projectID->name ?? '' }}</td>
<td field-key='name'>{!! isset($project_user->projectID) ? $project_user->projectID->name : '' !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.project_users.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


