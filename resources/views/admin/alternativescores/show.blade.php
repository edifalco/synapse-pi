@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.alternativescores.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.alternativescores.fields.show')</th>
                            <td field-key='show'>{{ $alternativescore->show }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.alternativescores.fields.project')</th>
                            <td field-key='project'>{{ $alternativescore->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.alternativescores.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


