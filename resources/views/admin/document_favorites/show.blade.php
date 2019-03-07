@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.document-favorites.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.document-favorites.fields.document')</th>
                            <td field-key='document'>{{ $document_favorite->document->title ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.document-favorites.fields.project')</th>
                            <td field-key='project'>{{ $document_favorite->project->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.document_favorites.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


