@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.project-members.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.project_members.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_id', trans('global.project-members.fields.project').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('member_id', trans('global.project-members.fields.member').'', ['class' => 'control-label']) !!}
                    {!! Form::select('member_id', $members, old('member_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('member_id'))
                        <p class="help-block">
                            {{ $errors->first('member_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('partner_id', trans('global.project-members.fields.partner').'', ['class' => 'control-label']) !!}
                    {!! Form::select('partner_id', $partners, old('partner_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('partner_id'))
                        <p class="help-block">
                            {{ $errors->first('partner_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

