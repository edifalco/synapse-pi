@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.keywords.title')</h3>
    
    {!! Form::model($keyword, ['method' => 'PUT', 'route' => ['admin.keywords.update', $keyword->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('word', trans('global.keywords.fields.word').'', ['class' => 'control-label']) !!}
                    {!! Form::text('word', old('word'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('word'))
                        <p class="help-block">
                            {{ $errors->first('word') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

