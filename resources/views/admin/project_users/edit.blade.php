@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.project-users.title')</h3>
    
    {!! Form::model($project_user, ['method' => 'PUT', 'route' => ['admin.project_users.update', $project_user->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('userID_id', trans('global.project-users.fields.userid').'', ['class' => 'control-label']) !!}
                    {!! Form::select('userID_id', $userIDs, old('userID_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('userID_id'))
                        <p class="help-block">
                            {{ $errors->first('userID_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('projectID_id', trans('global.project-users.fields.projectid').'', ['class' => 'control-label']) !!}
                    {!! Form::select('projectID_id', $projectIDs, old('projectID_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('projectID_id'))
                        <p class="help-block">
                            {{ $errors->first('projectID_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

