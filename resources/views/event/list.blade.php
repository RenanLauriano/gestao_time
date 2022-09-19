@extends('layout.template')

@section('content')
    <div class="col-10">
        <div class="d-flex justify-content-end">
            <a class="btn btn-app" href="{{ route('events.create') }}" role="button">New Event</a>
        </div>
        @if (session('status'))
            <div class="alert alert-success mt-3">
                {{ session('status') }}
            </div>
        @endif
        <table class="table table-hover table-bordered mt-3">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Description</th>
                <th scope="col">Date</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <th scope="row">{{ $event->event_id }}</th>
                        <td>{{ $event->event_description }}</td>
                        <td>{{ $event->event_date }}</td>
                        <td class="actions">
                            <div class="d-flex justify-content-start">
                                <div class="mr-1">
                                    <form action="{{ route('events.destroy', $event->event_id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                                <a class="mr-1" href="{{ route('events.edit', $event->event_id) }}"><button><i class="bi bi-pencil"></i></button></a>
                                <div class="mr-1">
                                    <form action="{{ route('events.generate') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="event_id" value="{{ $event->event_id }}" />
                                        <button type="submit">Vinculate to all Employees</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection