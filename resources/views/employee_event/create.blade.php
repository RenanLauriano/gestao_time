@extends('layout.template')

@section('content')
    <div class="col-10">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left mb-2">
                        <h2>Add Employee x Event</h2>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a class="btn-app btn" href="{{ route('employee_events.index') }}">Back</a>
                    </div>
                </div>
            </div>
            <form action="{{ route('employee_events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="employee_id">Employee</label>
                            <select name="employee_id" class="selectpicker form-control" data-live-search="true" title="Select Employee">
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->employee_id }}">{{ $employee->employee_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="employee_id">Event</label>
                            <select name="event_id" class="selectpicker form-control" data-live-search="true" title="Select Event">
                                @foreach ($events as $event)
                                    <option value="{{ $event->event_id }}">{{ $event->event_description." | ".$event->event_date }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-app ml-3">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
