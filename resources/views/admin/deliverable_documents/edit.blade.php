@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deliverable-documents.title')</h3>
    
    {!! Form::model($deliverable_document, ['method' => 'PUT', 'route' => ['admin.deliverable_documents.update', $deliverable_document->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('deliverable_id', trans('global.deliverable-documents.fields.deliverable').'', ['class' => 'control-label']) !!}
                    {!! Form::select('deliverable_id', $deliverables, old('deliverable_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('deliverable_id'))
                        <p class="help-block">
                            {{ $errors->first('deliverable_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('document_id', trans('global.deliverable-documents.fields.document').'', ['class' => 'control-label']) !!}
                    {!! Form::select('document_id', $documents, old('document_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('document_id'))
                        <p class="help-block">
                            {{ $errors->first('document_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

