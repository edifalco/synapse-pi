@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deliverable-reviewers.title')</h3>
    
    {!! Form::model($deliverable_reviewer, ['method' => 'PUT', 'route' => ['admin.deliverable_reviewers.update', $deliverable_reviewer->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('deliverable_id', trans('global.deliverable-reviewers.fields.deliverable').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('member_id', trans('global.deliverable-reviewers.fields.member').'', ['class' => 'control-label']) !!}
                    {!! Form::select('member_id', $members, old('member_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('member_id'))
                        <p class="help-block">
                            {{ $errors->first('member_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

