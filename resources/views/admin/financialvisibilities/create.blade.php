@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.financialvisibilities.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.financialvisibilities.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('type', trans('global.financialvisibilities.fields.type').'', ['class' => 'control-label']) !!}
                    {!! Form::text('type', old('type'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('type'))
                        <p class="help-block">
                            {{ $errors->first('type') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('status', trans('global.financialvisibilities.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::number('status', old('status'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_project_id', trans('global.financialvisibilities.fields.id-project').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_project_id', $id_projects, old('id_project_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_project_id'))
                        <p class="help-block">
                            {{ $errors->first('id_project_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

