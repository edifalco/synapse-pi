@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.risks.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.risks.fields.project')</th>
                            <td field-key='project'>{{ $risk->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.code')</th>
                            <td field-key='code'>{{ $risk->code }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.version')</th>
                            <td field-key='version'>{{ $risk->version }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.flag')</th>
                            <td field-key='flag'>{{ Form::checkbox("flag", 1, $risk->flag == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.resolved')</th>
                            <td field-key='resolved'>{{ Form::checkbox("resolved", 1, $risk->resolved == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.type')</th>
                            <td field-key='type'>{{ $risk->type->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.date')</th>
                            <td field-key='date'>{{ $risk->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.title')</th>
                            <td field-key='title'>{!! $risk->title !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.description')</th>
                            <td field-key='description'>{!! $risk->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.trigger-events')</th>
                            <td field-key='trigger_events'>{!! $risk->trigger_events !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.impact')</th>
                            <td field-key='impact'>{{ $risk->impact->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.probability')</th>
                            <td field-key='probability'>{{ $risk->probability->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.proximity')</th>
                            <td field-key='proximity'>{{ $risk->proximity->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.score')</th>
                            <td field-key='score'>{{ $risk->score }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.mitigation')</th>
                            <td field-key='mitigation'>{!! $risk->mitigation !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.owner')</th>
                            <td field-key='owner'>
                                @foreach ($risk->owner as $singleOwner)
                                    <span class="label label-info label-many">{{ $singleOwner->surname }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.notes')</th>
                            <td field-key='notes'>{!! $risk->notes !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.contingency')</th>
                            <td field-key='contingency'>{!! $risk->contingency !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.version-date')</th>
                            <td field-key='version_date'>{{ $risk->version_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.risks.fields.parent-id')</th>
                            <td field-key='parent_id'>{{ $risk->parent_id }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#risk_highlights" aria-controls="risk_highlights" role="tab" data-toggle="tab">Risk highlights</a></li>
<li role="presentation" class=""><a href="#risk_mowners" aria-controls="risk_mowners" role="tab" data-toggle="tab">Risk mowners</a></li>
<li role="presentation" class=""><a href="#risk_mreporters" aria-controls="risk_mreporters" role="tab" data-toggle="tab">Risk mreporters</a></li>
<li role="presentation" class=""><a href="#risk_powners" aria-controls="risk_powners" role="tab" data-toggle="tab">Risk powners</a></li>
<li role="presentation" class=""><a href="#risk_preporters" aria-controls="risk_preporters" role="tab" data-toggle="tab">Risk preporters</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="risk_highlights">
<table class="table table-bordered table-striped {{ count($risk_highlights) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.risk-highlights.fields.risk')</th>
                        <th>@lang('global.risk-highlights.fields.project')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($risk_highlights) > 0)
            @foreach ($risk_highlights as $risk_highlight)
                <tr data-entry-id="{{ $risk_highlight->id }}">
                    <td field-key='risk'>{{ $risk_highlight->risk->code ?? '' }}</td>
                                <td field-key='project'>{{ $risk_highlight->project->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_highlights.restore', $risk_highlight->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_highlights.perma_del', $risk_highlight->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('risk_highlight_view')
                                    <a href="{{ route('admin.risk_highlights.show',[$risk_highlight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('risk_highlight_edit')
                                    <a href="{{ route('admin.risk_highlights.edit',[$risk_highlight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('risk_highlight_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_highlights.destroy', $risk_highlight->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="risk_mowners">
<table class="table table-bordered table-striped {{ count($risk_mowners) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.risk-mowners.fields.member')</th>
                        <th>@lang('global.risk-mowners.fields.risk')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($risk_mowners) > 0)
            @foreach ($risk_mowners as $risk_mowner)
                <tr data-entry-id="{{ $risk_mowner->id }}">
                    <td field-key='member'>{{ $risk_mowner->member->name ?? '' }}</td>
                                <td field-key='risk'>{{ $risk_mowner->risk->code ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_mowners.restore', $risk_mowner->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_mowners.perma_del', $risk_mowner->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('risk_mowner_view')
                                    <a href="{{ route('admin.risk_mowners.show',[$risk_mowner->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('risk_mowner_edit')
                                    <a href="{{ route('admin.risk_mowners.edit',[$risk_mowner->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('risk_mowner_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_mowners.destroy', $risk_mowner->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="risk_mreporters">
<table class="table table-bordered table-striped {{ count($risk_mreporters) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.risk-mreporters.fields.member')</th>
                        <th>@lang('global.risk-mreporters.fields.risk')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($risk_mreporters) > 0)
            @foreach ($risk_mreporters as $risk_mreporter)
                <tr data-entry-id="{{ $risk_mreporter->id }}">
                    <td field-key='member'>{{ $risk_mreporter->member->name ?? '' }}</td>
                                <td field-key='risk'>{{ $risk_mreporter->risk->code ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_mreporters.restore', $risk_mreporter->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_mreporters.perma_del', $risk_mreporter->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('risk_mreporter_view')
                                    <a href="{{ route('admin.risk_mreporters.show',[$risk_mreporter->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('risk_mreporter_edit')
                                    <a href="{{ route('admin.risk_mreporters.edit',[$risk_mreporter->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('risk_mreporter_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_mreporters.destroy', $risk_mreporter->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="risk_powners">
<table class="table table-bordered table-striped {{ count($risk_powners) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.risk-powners.fields.partner')</th>
                        <th>@lang('global.risk-powners.fields.risk')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($risk_powners) > 0)
            @foreach ($risk_powners as $risk_powner)
                <tr data-entry-id="{{ $risk_powner->id }}">
                    <td field-key='partner'>{{ $risk_powner->partner->name ?? '' }}</td>
                                <td field-key='risk'>{{ $risk_powner->risk->code ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_powners.restore', $risk_powner->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_powners.perma_del', $risk_powner->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('risk_powner_view')
                                    <a href="{{ route('admin.risk_powners.show',[$risk_powner->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('risk_powner_edit')
                                    <a href="{{ route('admin.risk_powners.edit',[$risk_powner->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('risk_powner_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_powners.destroy', $risk_powner->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="risk_preporters">
<table class="table table-bordered table-striped {{ count($risk_preporters) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.risk-preporters.fields.partner')</th>
                        <th>@lang('global.risk-preporters.fields.risk')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($risk_preporters) > 0)
            @foreach ($risk_preporters as $risk_preporter)
                <tr data-entry-id="{{ $risk_preporter->id }}">
                    <td field-key='partner'>{{ $risk_preporter->partner->name ?? '' }}</td>
                                <td field-key='risk'>{{ $risk_preporter->risk->code ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_preporters.restore', $risk_preporter->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_preporters.perma_del', $risk_preporter->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('risk_preporter_view')
                                    <a href="{{ route('admin.risk_preporters.show',[$risk_preporter->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('risk_preporter_edit')
                                    <a href="{{ route('admin.risk_preporters.edit',[$risk_preporter->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('risk_preporter_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.risk_preporters.destroy', $risk_preporter->id])) !!}
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

            <a href="{{ route('admin.risks.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
            
            $('.timepicker').datetimepicker({
                format: "{{ config('app.time_format_moment') }}",
            });
            
        });
    </script>
            
@stop
