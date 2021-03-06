@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.partnerroles.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.partnerroles.fields.partner')</th>
                            <td field-key='partner'>{{ $partnerrole->partner->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.partnerroles.fields.role-id')</th>
                            <td field-key='role_id'>{{ $partnerrole->role_id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.partnerroles.fields.project')</th>
                            <td field-key='project'>{{ $partnerrole->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.partnerroles.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


