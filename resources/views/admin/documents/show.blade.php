@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.documents.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.documents.fields.title')</th>
                            <td field-key='title'>{{ $document->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.documents.fields.project')</th>
                            <td field-key='project'>{{ $document->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.documents.fields.deliverable')</th>
                            <td field-key='deliverable'>{{ $document->deliverable->label_identification ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.documents.fields.document')</th>
                            <td field-key='document'>@if($document->document)<a href="{{ asset(env('UPLOAD_PATH').'/' . $document->document) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.documents.fields.folder')</th>
                            <td field-key='folder'>{{ $document->folder->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#document_favorites" aria-controls="document_favorites" role="tab" data-toggle="tab">Document favorites</a></li>
<li role="presentation" class=""><a href="#deliverable_documents" aria-controls="deliverable_documents" role="tab" data-toggle="tab">Deliverable documents</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="document_favorites">
<table class="table table-bordered table-striped {{ count($document_favorites) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.document-favorites.fields.document')</th>
                        <th>@lang('global.document-favorites.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($document_favorites) > 0)
            @foreach ($document_favorites as $document_favorite)
                <tr data-entry-id="{{ $document_favorite->id }}">
                    <td field-key='document'>{{ $document_favorite->document->title ?? '' }}</td>
                                <td field-key='project'>{{ $document_favorite->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.document_favorites.restore', $document_favorite->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.document_favorites.perma_del', $document_favorite->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('document_favorite_view')
                                    <a href="{{ route('admin.document_favorites.show',[$document_favorite->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('document_favorite_edit')
                                    <a href="{{ route('admin.document_favorites.edit',[$document_favorite->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('document_favorite_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.document_favorites.destroy', $document_favorite->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="deliverable_documents">
<table class="table table-bordered table-striped {{ count($deliverable_documents) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.deliverable-documents.fields.deliverable')</th>
                        <th>@lang('global.deliverable-documents.fields.document')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($deliverable_documents) > 0)
            @foreach ($deliverable_documents as $deliverable_document)
                <tr data-entry-id="{{ $deliverable_document->id }}">
                    <td field-key='deliverable'>{{ $deliverable_document->deliverable->label_identification ?? '' }}</td>
                                <td field-key='document'>{{ $deliverable_document->document->title ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_documents.restore', $deliverable_document->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_documents.perma_del', $deliverable_document->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('deliverable_document_view')
                                    <a href="{{ route('admin.deliverable_documents.show',[$deliverable_document->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('deliverable_document_edit')
                                    <a href="{{ route('admin.deliverable_documents.edit',[$deliverable_document->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('deliverable_document_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_documents.destroy', $deliverable_document->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.documents.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


