@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.document-favorites.title')</h3>
    
    {!! Form::model($document_favorite, ['method' => 'PUT', 'route' => ['admin.document_favorites.update', $document_favorite->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('document_id', trans('global.document-favorites.fields.document').'', ['class' => 'control-label']) !!}
                    {!! Form::select('document_id', $documents, old('document_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('document_id'))
                        <p class="help-block">
                            {{ $errors->first('document_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_id', trans('global.document-favorites.fields.project').'', ['class' => 'control-label']) !!}
                    {!! Form::select('project_id', $projects, old('project_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('project_id'))
                        <p class="help-block">
                            {{ $errors->first('project_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

