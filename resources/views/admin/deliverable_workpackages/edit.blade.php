@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deliverable-workpackages.title')</h3>
    
    {!! Form::model($deliverable_workpackage, ['method' => 'PUT', 'route' => ['admin.deliverable_workpackages.update', $deliverable_workpackage->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('deliverable_id', trans('global.deliverable-workpackages.fields.deliverable').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('workpackage_id', trans('global.deliverable-workpackages.fields.workpackage').'', ['class' => 'control-label']) !!}
                    {!! Form::select('workpackage_id', $workpackages, old('workpackage_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('workpackage_id'))
                        <p class="help-block">
                            {{ $errors->first('workpackage_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

