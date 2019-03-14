@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deliverables.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.deliverables.fields.label-identification')</th>
                            <td field-key='label_identification'>{{ $deliverable->label_identification }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.title')</th>
                            <td field-key='title'>{!! $deliverable->title !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.short-title')</th>
                            <td field-key='short_title'>{!! $deliverable->short_title !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.date')</th>
                            <td field-key='date'>{{ $deliverable->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.status')</th>
                            <td field-key='status'>{{ $deliverable->status->label ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.notes')</th>
                            <td field-key='notes'>{!! $deliverable->notes !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.project')</th>
                            <td field-key='project'>{{ $deliverable->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.confidentiality')</th>
                            <td field-key='confidentiality'>{{ $deliverable->confidentiality }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.submission-date')</th>
                            <td field-key='submission_date'>{{ $deliverable->submission_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.due-date-months')</th>
                            <td field-key='due_date_months'>{{ $deliverable->due_date_months }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deliverables.fields.responsible')</th>
                            <td field-key='responsible'>
                                @foreach ($deliverable->responsible as $singleResponsible)
                                    <span class="label label-info label-many">{{ $singleResponsible->surname }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#deliverable_documents" aria-controls="deliverable_documents" role="tab" data-toggle="tab">Deliverable documents</a></li>
<li role="presentation" class=""><a href="#deliverable_reviewers" aria-controls="deliverable_reviewers" role="tab" data-toggle="tab">Deliverable reviewers</a></li>
<li role="presentation" class=""><a href="#deliverable_workpackages" aria-controls="deliverable_workpackages" role="tab" data-toggle="tab">Deliverable workpackages</a></li>
<li role="presentation" class=""><a href="#deliverable_partners" aria-controls="deliverable_partners" role="tab" data-toggle="tab">Deliverable partners</a></li>
<li role="presentation" class=""><a href="#documents" aria-controls="documents" role="tab" data-toggle="tab">Documents</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="deliverable_documents">
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
<div role="tabpanel" class="tab-pane " id="deliverable_reviewers">
<table class="table table-bordered table-striped {{ count($deliverable_reviewers) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.deliverable-reviewers.fields.deliverable')</th>
                        <th>@lang('global.deliverable-reviewers.fields.member')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($deliverable_reviewers) > 0)
            @foreach ($deliverable_reviewers as $deliverable_reviewer)
                <tr data-entry-id="{{ $deliverable_reviewer->id }}">
                    <td field-key='deliverable'>{{ $deliverable_reviewer->deliverable->label_identification ?? '' }}</td>
                                <td field-key='member'>{{ $deliverable_reviewer->member->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_reviewers.restore', $deliverable_reviewer->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_reviewers.perma_del', $deliverable_reviewer->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('deliverable_reviewer_view')
                                    <a href="{{ route('admin.deliverable_reviewers.show',[$deliverable_reviewer->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('deliverable_reviewer_edit')
                                    <a href="{{ route('admin.deliverable_reviewers.edit',[$deliverable_reviewer->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('deliverable_reviewer_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_reviewers.destroy', $deliverable_reviewer->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="deliverable_workpackages">
<table class="table table-bordered table-striped {{ count($deliverable_workpackages) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.deliverable-workpackages.fields.deliverable')</th>
                        <th>@lang('global.deliverable-workpackages.fields.workpackage')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($deliverable_workpackages) > 0)
            @foreach ($deliverable_workpackages as $deliverable_workpackage)
                <tr data-entry-id="{{ $deliverable_workpackage->id }}">
                    <td field-key='deliverable'>{{ $deliverable_workpackage->deliverable->label_identification ?? '' }}</td>
                                <td field-key='workpackage'>{{ $deliverable_workpackage->workpackage->wp_id ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_workpackages.restore', $deliverable_workpackage->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_workpackages.perma_del', $deliverable_workpackage->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('deliverable_workpackage_view')
                                    <a href="{{ route('admin.deliverable_workpackages.show',[$deliverable_workpackage->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('deliverable_workpackage_edit')
                                    <a href="{{ route('admin.deliverable_workpackages.edit',[$deliverable_workpackage->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('deliverable_workpackage_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_workpackages.destroy', $deliverable_workpackage->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="deliverable_partners">
<table class="table table-bordered table-striped {{ count($deliverable_partners) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.deliverable-partners.fields.partner')</th>
                        <th>@lang('global.deliverable-partners.fields.deliverable')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($deliverable_partners) > 0)
            @foreach ($deliverable_partners as $deliverable_partner)
                <tr data-entry-id="{{ $deliverable_partner->id }}">
                    <td field-key='partner'>{{ $deliverable_partner->partner->name ?? '' }}</td>
                                <td field-key='deliverable'>{{ $deliverable_partner->deliverable->label_identification ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_partners.restore', $deliverable_partner->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_partners.perma_del', $deliverable_partner->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('deliverable_partner_view')
                                    <a href="{{ route('admin.deliverable_partners.show',[$deliverable_partner->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('deliverable_partner_edit')
                                    <a href="{{ route('admin.deliverable_partners.edit',[$deliverable_partner->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('deliverable_partner_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deliverable_partners.destroy', $deliverable_partner->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="documents">
<table class="table table-bordered table-striped {{ count($documents) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.documents.fields.title')</th>
                        <th>@lang('global.documents.fields.folder')</th>
                        <th>@lang('global.documents.fields.document')</th>
                        <th>@lang('global.documents.fields.project')</th>
                        <th>@lang('global.documents.fields.deliverable')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($documents) > 0)
            @foreach ($documents as $document)
                <tr data-entry-id="{{ $document->id }}">
                    <td field-key='title'>{{ $document->title }}</td>
                                <td field-key='folder'>{{ $document->folder }}</td>
                                <td field-key='document'>{!! $document->document !!}</td>
                                <td field-key='project'>{{ $document->project->name ?? '' }}</td>
                                <td field-key='deliverable'>{{ $document->deliverable->label_identification ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.documents.restore', $document->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.documents.perma_del', $document->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('document_view')
                                    <a href="{{ route('admin.documents.show',[$document->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('document_edit')
                                    <a href="{{ route('admin.documents.edit',[$document->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('document_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.documents.destroy', $document->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.deliverables.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop
