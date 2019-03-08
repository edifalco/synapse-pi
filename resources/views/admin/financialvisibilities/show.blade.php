@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.financialvisibilities.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.financialvisibilities.fields.type')</th>
                            <td field-key='type'>{{ $financialvisibility->type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.financialvisibilities.fields.status')</th>
                            <td field-key='status'>{{ $financialvisibility->status }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.financialvisibilities.fields.id-project')</th>
                            <td field-key='id_project'>{{ $financialvisibility->id_project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.financialvisibilities.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


