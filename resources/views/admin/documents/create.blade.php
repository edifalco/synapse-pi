@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.documents.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.documents.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('global.documents.fields.title').'', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('folder', trans('global.documents.fields.folder').'', ['class' => 'control-label']) !!}
                    {!! Form::text('folder', old('folder'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('folder'))
                        <p class="help-block">
                            {{ $errors->first('folder') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_id', trans('global.documents.fields.project').'', ['class' => 'control-label']) !!}
                    {!! Form::select('project_id', $projects, old('project_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('project_id'))
                        <p class="help-block">
                            {{ $errors->first('project_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('deliverable_id', trans('global.documents.fields.deliverable').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('document', trans('global.documents.fields.document').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('document', old('document')) !!}
                    {!! Form::file('document', ['class' => 'form-control']) !!}
                    {!! Form::hidden('document_max_size', 2) !!}
                    <p class="help-block"></p>
                    @if($errors->has('document'))
                        <p class="help-block">
                            {{ $errors->first('document') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

