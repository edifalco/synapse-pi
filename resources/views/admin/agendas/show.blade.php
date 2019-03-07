@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.agenda.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.agenda.fields.date')</th>
                            <td field-key='date'>{{ $agenda->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agenda.fields.hour')</th>
                            <td field-key='hour'>{{ $agenda->hour }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agenda.fields.minute')</th>
                            <td field-key='minute'>{{ $agenda->minute }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agenda.fields.title')</th>
                            <td field-key='title'>{{ $agenda->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agenda.fields.description')</th>
                            <td field-key='description'>{!! $agenda->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agenda.fields.project')</th>
                            <td field-key='project'>{{ $agenda->project->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agenda.fields.category')</th>
                            <td field-key='category'>{{ $agenda->category }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agenda.fields.duration')</th>
                            <td field-key='duration'>{{ $agenda->duration }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agenda.fields.meeting-type')</th>
                            <td field-key='meeting_type'>{{ $agenda->meeting_type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agenda.fields.date-creation')</th>
                            <td field-key='date_creation'>{{ $agenda->date_creation }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.agendas.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
            
        });
    </script>
            
@stop
