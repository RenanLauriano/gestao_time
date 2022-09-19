@extends('layout.template')

@section('content')
    <div class="col-10">
        <div class="d-flex justify-content-end">
            <a class="btn btn-app" href="{{ route('employee_events.create') }}" role="button">New Employee x Event</a>
        </div>
        @if (session('status'))
            <div class="alert alert-success mt-3">
                {{ session('status') }}
            </div>
        @endif
        @foreach($errors as $e)
            {{$e}}
        @endforeach
        <table class="table table-hover table-bordered mt-3">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Employee</th>
                <th scope="col">Event</th>
                <th scope="col">Due Date</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($employee_events as $ee)
                    <tr>
                        <th scope="row">{{ $ee->employee_event_id }}</th>
                        <td>{{ $ee->employee->employee_name }}</td>
                        <td>{{ $ee->event->event_description }}</td>
                        <td>{{ $ee->event->event_date }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                @if($ee->employee_event_status == 'Approved')
                                    <button type="button" class="btn btn-success">{{ $ee->employee_event_status }}</button>
                                @elseif($ee->employee_event_status == 'Not Approved')
                                    <button type="button" class="btn btn-danger">{{ $ee->employee_event_status }}</button>
                                @else
                                    <span>{{ $ee->employee_event_status }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="actions">
                            <div class="d-flex justify-content-center">
                                <div class="mr-1">
                                    <form action="{{ route('employee_events.destroy', $ee->employee_event_id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="text-danger" data-toggle="tooltip" title="Delete" type="submit"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                                <a class="mr-1" href="{{ route('employee_events.edit', $ee->employee_event_id) }}"><button data-toggle="tooltip" title="Edit"><i class="bi bi-pencil"></i></button></a>
                                @if(in_array($ee->employee_event_status, ['Pending', 'Not Approved']))
                                    <div class="mr-1">
                                        <form action="{{ route('employee_events.update', $ee->employee_event_id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            {{ @method_field('PATCH') }}
                                            <input type="hidden" name="employee_event_status" value="Approved" />
                                            <button type="submit" class="text-success" data-toggle="tooltip" title="Approve"><i class="bi bi-hand-thumbs-up"></i></button>
                                        </form>
                                    </div>
                                @endif
                                @if(in_array($ee->employee_event_status, ['Pending', 'Approved']))
                                    <div class="mr-1">
                                        <form action="{{ route('employee_events.update', $ee->employee_event_id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            {{ @method_field('PATCH') }}
                                            <input type="hidden" name="employee_event_status" value="Not Approved" />
                                            <button type="submit" class="text-danger" data-toggle="tooltip" title="Reject"><i class="bi bi-hand-thumbs-down"></i></button>
                                        </form>
                                    </div>
                                    
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection